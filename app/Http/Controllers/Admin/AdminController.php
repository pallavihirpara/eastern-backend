<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Banner;
use App\Models\Category;
use App\Models\City;
use App\Models\Commission;
use App\Models\ContactUs;
use App\Models\Customer;
use App\Models\Notification;
use App\Models\Order;
use App\Models\Product;
use App\Models\Rating;
use App\Models\Role;
use App\Models\Setting;
use App\Models\SocialMedia;
use App\Models\State;
use App\Models\SubCategory;
use App\Models\Supplier;
use App\Models\User;
use App\Models\UserBank;
use App\Models\UserImage;
use App\Models\Vat; 
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    public function index()
    { 
        $data['users'] = User::where('status',1)->count(); 
        return view('admin.dashboard.index', $data);
    }
    public function reviewIndex(Request $request)
    {
        // $data['rating'] = Rating::all();
        if ($request->ajax()) {
            $data = Product::select('ratings.*', 'products.en_name', 'products.ar_name', 'users.en_name as user_name')
                ->join('users', 'users.id', '=', 'products.user_id')
                ->join('ratings', 'ratings.product_id', '=', 'products.id')
                ->orderBy('ratings.id', 'DESC')
                ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {

                    if ($row->status == 1) {
                        return '<span class="badge badge-success user-status cursor-pointer" onclick="changeStatus(' . $row->id . ');">Active</span>';
                    } else {
                        return '<span class="badge badge-danger user-status cursor-pointer" onclick="changeStatus(' . $row->id . ');">InActive</span>';
                    }
                })
                ->addColumn('name', function ($row) {

                    return $row->en_name . ' ' . $row->ar_name;
                })
                ->addColumn('action', function ($row) {

                    return '<div>
                        <a href=' . route("admin.sp.view", [encrypt($row->id)]) . '>
                            <i class="fas fa-eye" style="color:black;font-size:20px;font-weight:normal;"></i>
                        </a>
                    </div>';
                })
                ->rawColumns(['status', 'name', 'action'])
                ->make(true);
        }
        return view('admin.product.ratingIndex');
    }
    public function changePass()
    {
        return view('admin.dashboard.changepass');
    }
    public function changePassStore(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'new_password' => 'required|same:con_password'
        ]);
        $input = $request->all();
        $userPassword = Auth::user()->password;
        if (!Hash::check($request->old_password, $userPassword)) {
            return redirect()->back()->with("error", "Your current password does not matches with old password.");
        } else {
            $password = Hash::make($request->new_password);
            $admin = User::where('id', Auth::user()->id)->update(['password' => $password]);
            return redirect()->back()->with('success', 'Your password change successfully.');
        }
    } 
}
