<?php

namespace App\Http\Controllers\Admin;

use App\Events\SetPermission;
use App\Http\Controllers\Controller;
use App\Http\Requests\EditUserRequest;
use App\Http\Requests\UserRequest;
use App\Mail\SendUserPasswordMail;
use App\Models\City; 
use App\Models\Role; 
use App\Models\State; 
use App\Models\User; 
use App\Traits\FileUpload;
use App\Models\UserImage; 
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{ 
    use FileUpload;
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::where('status', 1)->where('id','!=',Auth::user()->id)->orderBy('id', 'DESC')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return $row->first_name .' '.$row->last_name;
                })
                ->addColumn('status', function ($row) {

                    if ($row->status == 1) {
                        return '<span class="badge badge-success user-status cursor-pointer offset-3">Active</span>';
                    } else {
                        return '<span class="badge badge-danger user-status cursor-pointer offset-2">InActive</span>';
                    }
                })
                ->addColumn('action', function ($row) {

                    return '<div>
                        <a href=' . route("admin.user.view", [encrypt($row->id)]) . '>
                            <i class="ml-2 fas fa-eye" style="color:black;font-size:20px;font-weight:normal;"></i>
                        </a>
                        <a href=' . route("admin.user.edit", [encrypt($row->id)]) . '>
                            <i class="ml-2 fas fa-edit" style="color:black;font-size:20px;font-weight:normal;"></i>
                        </a>
                        <a href="javascript:void(0)" data-id="'.encrypt($row->id).'" class="confirm-delete">
                            <i class="ml-2 fas fa-trash-alt click_me" style="color:black;font-size:20px;font-weight:normal;"></i>
                        </a>
                    </div>';
                })
                ->rawColumns(['name','status', 'action'])
                ->make(true);
        }
        return view('admin.user.index');
    }
    public function add(){
        $data['state'] = State::all(); 
        $data['role'] = Role::all();
        return view('admin.user.create',$data);
    }
    public function store(UserRequest $request){
        $input = $request->all(); 
        $input['password'] = Hash::make($request->password);
        $input['hobbies'] = json_encode(explode(',', $request->hobby));
        $user = User::create($input);
        $filePaths = $this->handleProfileUpload($request->file('profile'),$user->id);
        UserImage::insert($filePaths);
        $user = User::find($user->id);
        $user->roles()->attach($request->role_id,['created_at' => now(),'updated_at' => now()]);
        $name = $request->first_name.' '.$request->last_name;
        Mail::to($request->email)->send(new SendUserPasswordMail($name, $request->password));
        return response()->json(['data' => $user, 'status' => 200]); 
    }
    public function delete($id){
        $user = User::find(decrypt($id));
        if($user){
            $userImages = UserImage::where('user_id', $user->id)->get();
            foreach($userImages as $key => $val){
                $filePath = public_path('uploads/user/'.$val->name);
                if (File::exists($filePath)) {
                    unlink($filePath);
                    $val->delete();
                }
            } 
            $user->delete();
        }
        return response()->json(['data' => $user, 'status' => 200]); 
    }
    public function edit($id){
        $data['user'] = User::find(decrypt($id));
        $data['user_images'] = UserImage::where('user_id', decrypt($id))->get(); 
        $data['state'] = State::all(); 
        $data['role'] = Role::all();
        return view('admin.user.create',$data);
    }
    public function view($id){
        $data['user'] = User::with(['state', 'city', 'roles','images'])->where('id',decrypt($id))->first();
        return view('admin.user.view',$data);
    }
    public function update(EditUserRequest $request){
        $user = User::find(decrypt($request->id));
        $input['hobbies'] = json_encode(explode(',', $request->hobby));
        $user->update($input);
        if($request->file('profile')){
            $filePaths = [];
            $userImages = UserImage::where('user_id', $user->id)->get();
            foreach($userImages as $val){
                $filePath = public_path('uploads/user/'.$val->name);
                if (File::exists($filePath)) {
                    unlink($filePath);
                    $val->delete();
                }
            } 
            $filePaths = $this->handleProfileUpload($request->file('profile'),decrypt($request->id));
            UserImage::insert($filePaths);
        }
        if($request->role_id != $user->role_id){ 
            $user->roles()->detach();
            $user->roles()->attach($request->role_id,['created_at' => now(),'updated_at' => now()]);
        }
        return response()->json(['data' => $user, 'status' => 200]); 
    }
    public function getCity($state_id,Request $request){
        $city = City::where('state_id',$state_id);
        if(!empty($request->all()['search'])){
            $city = $city->where('name', 'like', '%' . $request->all()['search'] . '%');
        }
        $city = $city->get();
        return response()->json(['data' => $city]);
    } 
    public function filterState(Request $request){
        $state = State::query();
        if(!empty($request->all()['search'])){
            $state = $state->where('name', 'like', '%' . $request->all()['search'] . '%');
        }
        $state = $state->get();
        return response()->json(['data' => $state]);
    } 
}

