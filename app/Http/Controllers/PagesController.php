<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

use App\theloai;
use App\slide;
use App\loaitin;
use App\tintuc;
use App\user;
/**
 * 
 */
class PagesController extends Controller
{
	function __construct()
	{

		$theloai = TheLoai::all();
		$slide = Slide::all();
		view()->share('theloai',$theloai);
		view()->share('slide',$slide);

		if(Auth::check())
		{
			view()->share('nguoidung',Auth::user());
		}


	}
	function trangchu()
	{
		
        return view('pages.trangchu');
	}
	function lienhe()
	{
		return view('pages.lienhe');
    }
    function gioithieu()
	{
		$tintuc = TinTuc::all();
		
		
		return view('pages.gioithieu');

    }

	function loaitin($id)
	{
		$loaitin = LoaiTin::find($id);
		$tintuc = TinTuc::where('idLoaiTin',$id)->paginate(5);
		return view('pages.loaitin',['loaitin'=>$loaitin,'tintuc'=>$tintuc]);
	}
	function tintuc($id)
	{
		$tintuc = TinTuc::find($id);
		$tinnoibat = TinTuc::where('NoiBat',1)->take(4)->get();
		$tinlienquan = TinTuc::where('idLoaiTin',$tintuc->idLoaiTin)->take(4)->get();
		return view('pages.tintuc',['tintuc'=>$tintuc,'tinnoibat'=>$tinnoibat,'tinlienquan'=>$tinlienquan]);
	}
	function getDangnhap()
	{
		return view('pages.dangnhap');

	}
	function postDangnhap(Request $request)
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
            return redirect('trangchu');
        }
        else
        {

            return redirect('dangnhap')->with('thongbao','Dang nhap khong thanh cong');
        }
		
	}
	function getDangxuat()
	{
		Auth::logout();
		return redirect('trangchu');
	}
	function getDangky()
	{
		return view('pages.dangky');
	}
	function postDangky(Request $request)
	{
		$this->validate($request,[
            'name'=>'required|min:3',
            'email'=>'required|min:3|unique:users,email',
            'password'=>'required|min:3|max:32',
            
            ],[
            'name.required'=>'Bạn Chưa Nhập Tên Người Dùng',
            'name.min'=>'Tên Người Dùng Phải Có Ít Nhất 3 Ký Tự',
            'email.unique'=>'Email Đã Tồn Tại',
            'email.required'=>'Bạn Chưa Nhập Email',
            'email.email'=>'Bạn Chưa Nhập Đúng Định Dạng Email',
            'password.required'=>'Bạn Chưa Nhập Mật Khẩu',
            'password.min'=>'Tên Người Dùng Phải Có Ít Nhất 3 Ký Tự',
            'password.max'=>'Tên Người Dùng Phải Có Ít Nhất 3 Ký Tự',
            
            ]);
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password =bcrypt($request->password);
        $user->level = 0;

        $user->save();

        return redirect('dangky')->with('thongbao','Bạn Đã Đăng Ký Thành Công');
	}
	}
	function timkiem( Request $request)
	{
		$key = $request->key;
		$tintuc = TinTuc::where('Title','like',"%$key%")->orWhere('TomTat','like',"%$key%")->orWhere('Content','like',"%$key%")->take(20)->paginate(5);
		return view('pages.timkiem',['tintuc'=>$tintuc,'key'=>$key]);
	}
	function dashboard()
	{
		return view('pages.dashboard');
}
  function getNguoidung()
  {
    $user = Auth::user();
    return view('pages.nguoidung',['nguoidung'=>$user]);
  }

	function postNguoidung(Request $request)
	{
		 $this->validate($request,[
            'name'=>'required|min:3',
            ],[
            'name.required'=>'Bạn Chưa Nhập Tên Người Dùng',
            'name.min'=>'Tên Người Dùng Phải Có Ít Nhất 3 Ký Tự'          
            ]);
        $user = Auth::user();
        $user->name = $request->name;

        if($request->changePassword == "on")
        {
            $this->validate($request,[
            'password'=>'required|min:3|max:32',
            
            ],[
            'password.required'=>'Bạn Chưa Nhập Mật Khẩu',
            'password.min'=>'Tên Người Dùng Phải Có Ít Nhất 3 Ký Tự',
            'password.max'=>'Tên Người Dùng Phải Có Ít Nhất 3 Ký Tự',
            
            ]);
            $user->password =bcrypt($request->password);
        }
        $user->save();
        return redirect('nguoidung')->with('thongbao','Bạn Đã Sửa Thành Công');
	}
  function dashboard()
  {
    return view('pages.dashboard');
  }
  // function getNguoidung()
  // {
  //   $user = Auth::user();
  //   return view('pages.nguoidung',['nguoidung'=>$user]);
  // }



	

