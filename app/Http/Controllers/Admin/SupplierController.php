<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SupplierRequest;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class SupplierController extends Controller
{
    protected $user;
    protected $permissions;

    public function __construct()
    {
        $this->user = Auth::user();
        $this->permissions = $this->user->getPermissionsList();
    }

    public function index(Request $request)
    {
        $user = $this->user;
        $permissions = $this->permissions;
        if ($request->ajax()) { 
            $data = Supplier::orderBy('id', 'DESC')->get();
            return DataTables::of($data)
                ->addIndexColumn() 
                ->addColumn('action', function ($row) use ($user,$permissions) {
                    
                    $actionHTML = '<div>';
                    if(($user->hasRole('Supplier') && in_array('Edit', $permissions) || in_array('Delete', $permissions))){
                        if (in_array('Edit', $permissions)) {
                            $actionHTML .= '
                                <a href="' . route("admin.supplier.edit", [encrypt($row->id)]) . '">
                                    <i class="ml-2 fas fa-edit" style="color:black;font-size:20px;font-weight:normal;"></i>
                                </a>
                            ';
                        }
                        if (in_array('Delete', $permissions)) {
                            $actionHTML .= '
                               <a href="javascript:void(0)" data-id="' . encrypt($row->id) . '" class="confirm-delete">
                                <i class="ml-2 fas fa-trash-alt click_me" style="color:black;font-size:20px;font-weight:normal;"></i>
                            </a>';
                        }
                    }else{
                        $actionHTML .= '
                        <a href="' . route("admin.supplier.edit", [encrypt($row->id)]) . '">
                            <i class="ml-2 fas fa-edit" style="color:black;font-size:20px;font-weight:normal;"></i>
                        </a>
                        <a href="javascript:void(0)" data-id="' . encrypt($row->id) . '" class="confirm-delete">
                            <i class="ml-2 fas fa-trash-alt click_me" style="color:black;font-size:20px;font-weight:normal;"></i>
                        </a>';
                 
                    }
                    return $actionHTML .= '<div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.supplier.index',compact('user','permissions'));
    }
    public function add(){
        $user = $this->user;
        $permissions = $this->permissions;
        return view('admin.supplier.create',compact('permissions','user'));
    }
    public function store(SupplierRequest $request){
        if(($this->user->hasRole('Supplier') && in_array('Create', $this->permissions)) || $this->user->hasRole('Admin') || $this->user->hasRole('User')){
            $input = $request->all();
            $supplier = Supplier::create($input);
            return response()->json(['data' => $supplier, 'status' => 200]); 
        }
    }
    public function delete($id){
        if($this->user->hasRole('Supplier') && in_array('Delete', $this->permissions) || $this->user->hasRole('Admin') || $this->user->hasRole('User')){
            $supplier = Supplier::find(decrypt($id));
            if($supplier){
                $supplier->delete();
            }
            return response()->json(['data' => [], 'status' => 200]); 
        }
    }
    public function edit($id){
        if($this->user->hasRole('Supplier') && in_array('Edit', $this->permissions) || $this->user->hasRole('Admin') || $this->user->hasRole('User')){
            $user = $this->user;
            $permissions = $this->permissions;
            $supplier = Supplier::find(decrypt($id));
            return view('admin.supplier.create',compact('permissions','user'));
        }
    }
    public function update(SupplierRequest $request){
        if($this->user->hasRole('Supplier') && in_array('Edit', $this->permissions) || $this->user->hasRole('Admin') || $this->user->hasRole('User')){
            $supplier = Supplier::find(decrypt($request->id));
            $supplier->update($request->all());
            
            return response()->json(['data' => [], 'status' => 200]); 
        }
    }
}
