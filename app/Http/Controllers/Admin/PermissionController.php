<?php

namespace App\Http\Controllers\Admin;

use App\Events\SetPermission;
use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionRequest;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class PermissionController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Role::with('permissions')->orderBy('id', 'DESC')->get();
            return DataTables::of($data)
                ->addIndexColumn() 
                ->addColumn('permission', function ($row) {

                    return json_decode($row->permissions->pluck('name'));
                })
                ->addColumn('action', function ($row) {

                    return '<div>
                        <a href=' . route("admin.permission.edit", [encrypt($row->id)]) . '>
                            <i class="ml-2 fas fa-edit" style="color:black;font-size:20px;font-weight:normal;"></i>
                        </a>
                        <a href="javascript:void(0)" data-id="'.encrypt($row->id).'" class="confirm-delete">
                            <i class="ml-2 fas fa-trash-alt click_me" style="color:black;font-size:20px;font-weight:normal;"></i>
                        </a>
                    </div>';
                })
                ->rawColumns(['permission','action'])
                ->make(true);
        }
        return view('admin.permission.index');
    }
    public function add(){
        $data['roles'] = Role::all();
        return view('admin.permission.create',$data);
    }
    public function store(PermissionRequest $request){ 
         $permissions = explode(",",$request->permission);
         $ids = [];
         foreach($permissions as $permission){
            $data = [
                'name' => $permission,
                'guard_name' => Auth::guard()->name
            ];
            $ids[] = Permission::firstOrCreate($data)->id;
         }
         if($ids != []){
             $this->setRolePermission($request->role_id,$ids);
             $role = Role::find($request->role_id);
             $role->permissions()->attach($ids);
         }
        return response()->json(['data' => [], 'status' => 200]); 
    }
    public function delete($id){
        $permission = Permission::find(decrypt($id));
        if($permission){
            $permission->delete();
        }
        return response()->json(['data' => [], 'status' => 200]); 
    }
    public function edit($id){
        $data['roles'] = Role::all();
        $data['permission'] = Role::with('permissions')->where('id',decrypt($id))->first();
        return view('admin.permission.create',$data);
    }
    public function update(PermissionRequest $request){
        $permissions = explode(",",$request->permission);
        $ids = [];
        foreach($permissions as $permission){
            $data = [
                'name' => $permission,
                'guard_name' => Auth::guard()->name
            ];
            $ids[] = Permission::firstOrCreate($data)->id;
        } 
        if($ids != []){
            $this->setRolePermission($request->role_id,$ids);
            $role = Role::find($request->role_id);
            $role->permissions()->sync($ids);
        }
        return response()->json(['data' => [], 'status' => 200]); 
    }
    public function setRolePermission($role_id,$permission) {
        event(new SetPermission($role_id,$permission));
    }
}
