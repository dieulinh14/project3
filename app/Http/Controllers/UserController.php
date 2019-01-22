<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;

use App\user;

class UserController extends Controller
{
    public function getDanhSach()
    {
        $user = User::all();
        return view('admin/user/danhsach',['user'=>$user]);

    }

    public function getThem()
    {
        return view('admin/user/them');
        
    }


    public function postThem(Request $request)
    {
        $this->validate($request,
            [
                
                'name'=>'required|min:3',
                'email' => 'required|unique:users,email',
                'password' => 'required|min:3',
                're-password' => 'required|same:password',

            ],
            [
                'name.required'=>'Ban chua nhap ten user',
                'name.min'=>'Ten phai co do dai it nhat bang 3 ky tu',
                'email.required'=>'Ban chua nhap email',
                'email.email'=>'Ban chua nhap dung dinh dang email',
                'email.unique'=>'Email da ton tai',
                'password.required'=>'Ban chua nhap password',
                'password.min'=>'Password phai co do dai it nhat bang 3 ky tu',
                // 'password.max'=>'Password co do dai lon nhat bang 15 ky tu',
                're-password.required'=>'Ban chua nhap lai password',
                're-password.same'=>'Password chua khop',
            ]);
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->level = $request->level;
        $user->save();

        return redirect('admin/user/them')->with('thongbao','Them thanh cong');
    }

    public function getSua($id)
    {
        $user = User::find($id);
        return view('admin.user.sua',['user'=>$user]);
    }
    public function postSua(Request $request,$id)
    
    {
        $this->validate($request,
            [
                
                'name'=>'required|min:3',

            ],
            [
                'name.required'=>'Ban chua nhap ten user',
                'name.min'=>'Ten phai co do dai it nhat bang 3 ky tu',
                
            ]);
        $user = User::find($id);
        $user->name = $request->name;
        $user->level = $request->level;

        if($request->changePassword == "on")
        {
            $this->validate($request,
            [

                'password' => 'required|min:3',
                're-password' => 'required|same:password',

            ],
            [

                'password.required'=>'Ban chua nhap password',
                'password.min'=>'Password phai co do dai it nhat bang 3 ky tu',
                're-password.required'=>'Ban chua nhap lai password',
                're-password.same'=>'Password chua khop',
            ]);
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect('admin/user/sua/'.$id)->with('thongbao','Sua thanh cong');   
     
    }
    public function getXoa($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect('admin/user/danhsach')->with('thongbao','Xoa thanh cong');
    }
    public function getDangnhapAdmin()
    {
        return view('admin.login');
    }
    public function postDangnhapAdmin(Request $request)
    {
        $this->validate($request,
        [
            'email'=>'required',
            'password'=>'required|min:3',
        ],
        [
            'email.required'=>'Ban chua nhap email',
            'password.required'=>'Ban chua nhap password',
            'password.min'=>'Password tu 3 ky tu tro len',
        ]);
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password]))
        {
            return redirect('admin/theloai/danhsach');
        }else
        {

            return redirect('admin/dangnhap')->with('thongbao','Dang nhap khong thanh cong');
        }

    }
    public function getDangXuatAdmin()
    {
        Auth::logout();
        return redirect('admin/dangnhap');
    }


}