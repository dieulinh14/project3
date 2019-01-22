<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\theloai;
use App\loaitin;

class LoaiTinController extends Controller
{
    
    public function getDanhSach(){
        $loaitin = LoaiTin::all();
        return view('admin.loaitin.danhsach',['loaitin'=>$loaitin]);
        return view('admin.loaitin.danhsach');
    }

    public function getThem(){
        $theloai = TheLoai::all();
        return view('admin.loaitin.them',['theloai'=>$theloai]);
    }

    public function postThem(Request $request)
    {
        $this->validate($request,
            [
                'Name' => 'required|unique:LoaiTin,Name|min:3|max:100',
                'TheLoai'=>'required'
            ],
            [
                'Name.required'=>'Ban chua nhap ten loai tin',
                'Name.min'=>'Ten phai co do dai it nhat bang 3 ky tu',
                'Name.max'=>'Ten co do dai lon nhat bang 100 ky tu',
                'Name.unique'=>'Ten da ton tai',

            ]);
        $loaitin = new LoaiTin;
        $loaitin->Name = $request->Name;
        $loaitin->idTheLoai = $request->TheLoai;
        $loaitin->save();

        return redirect('admin/loaitin/them')->with('thongbao','Them thanh cong');
    }

    public function getSua($id){
        // Khi người dùng gửi request lên server như form chẳng hạn thì mới dùng request để nhận dữ liệu, bình thường ta dùng biến bình thường.
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::find($id);
        return view('admin.loaitin.sua',['loaitin'=>$loaitin,'theloai'=>$theloai]);
    }
    public function postSua(Request $request,$id)
    {
        $this->validate($request,
            [
                'Name' => 'required|unique:LoaiTin,Name|min:3|max:100',
                'TheLoai'=>'required'
            ],
            [
                'Name.required'=>'Ban chua nhap ten loai tin',
                'Name.min'=>'Ten phai co do dai it nhat bang 3 ky tu',
                'Name.max'=>'Ten co do dai lon nhat bang 100 ky tu',
                'Name.unique'=>'Ten da ton tai',

            ]);
        $loaitin = LoaiTin::find($id);
        $loaitin->Name = $request->Name;
        $loaitin->idTheLoai = $request->TheLoai;
        $loaitin->save();

        return redirect('admin/loaitin/sua/'.$id)->with('thongbao','Sua thanh cong');
    }
    public function getXoa($id)
    {
        $loaitin = LoaiTin::find($id);
        $loaitin->delete();

        return redirect('admin/loaitin/danhsach')->with('thongbao', 'Ban da xoa thanh cong');
    }
}