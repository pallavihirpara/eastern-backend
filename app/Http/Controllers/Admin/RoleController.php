<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    public function index(Request $request)
    { 
        if ($request->ajax()) {
            $data = Role::orderBy('id', 'ASC')->get();
            return DataTables::of($data)
                ->addIndexColumn() 
                ->addColumn('action', function ($row) {

                    return '<div>
                        <a href=' . route("admin.role.edit", [encrypt($row->id)]) . '>
                            <i class="ml-2 fas fa-edit" style="color:black;font-size:20px;font-weight:normal;"></i>
                        </a>
                        <a href="javascript:void(0)" data-id="'.encrypt($row->id).'" class="confirm-delete">
                            <i class="ml-2 fas fa-trash-alt click_me" style="color:black;font-size:20px;font-weight:normal;"></i>
                        </a>
                    </div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.roles.index');
    }
    public function add(){
        return view('admin.roles.create');
    }
    public function store(RoleRequest $request){
        $input = $request->all();
        $input['guard_name'] = Auth::guard()->name;
        $role = Role::create($input);
        return response()->json(['data' => $role, 'status' => 200]); 
    }
    public function delete($id){
        $role = Role::find(decrypt($id));
        if($role){
            $role->delete();
        }
        return response()->json(['data' => [], 'status' => 200]); 
    }
    public function edit($id){
        $data['role'] = Role::find(decrypt($id));
        return view('admin.roles.create',$data);
    }
    public function update(RoleRequest $request){
        $role = Role::find(decrypt($request->id));
        $role->update($request->all());
        
        return response()->json(['data' => [], 'status' => 200]); 
    }
}
