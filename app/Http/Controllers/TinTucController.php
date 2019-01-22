<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\theloai;
use App\loaitin;
use App\tintuc;
class TinTucController extends Controller
{
    
    public function getDanhSach(){
        $tintuc = TinTuc::all();
        return view('admin.tintuc.danhsach',['tintuc'=>$tintuc]);
        return view('admin.loaitin.danhsach');
    }

    public function getThem(){
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::all();
        return view('admin.tintuc.them',['theloai'=>$theloai,'loaitin'=>$loaitin]);
    }

    public function postThem(Request $request)
    {
        $this->validate($request,
            [
                'LoaiTin' => 'required',
                'Title'=>'required|min:3|unique:TinTuc,Title',
                'Content'=>'required',
            ],
            [
                'LoaiTin.required'=>'Ban chua nhap ten loai tin',
                'Title.required'=>'Ban chua nhap ten tieu de',
                'Title.min'=>'Tieu de phai co do dai it nhat bang 3 ky tu',
                'Content.required'=>'Chua nhap TieuDenoi dung',

            ]);
        $tintuc = new TinTuc;
        $tintuc->Title = $request->Title;
        $tintuc->idLoaiTin = $request->LoaiTin;
        $tintuc->Content = $request->Content;
        $tintuc->save();
        if($request->hasFile('Image'))
        {
            $file = $request->file('Image');

            $name = $file->getClientOriginalName();
            $Hinh = str_random(4)."_".$name;
            while (file_exists("upload/images/".$Hinh))
            {
               $Hinh = str_random(4)."_".$name; 
            }
            $file->move("upload/images",$Hinh);
            $tintuc->Hinh = $Hinh;
        }
        else
        {
            $tintuc->Hinh = "";
        } 

        $tintuc->save();

        return redirect('admin/tintuc/them')->with('thongbao','Them thanh cong');
        
    }

    public function getSua($id)
    {
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::all();
        $tintuc = TinTuc::find($id);
        return view('admin.tintuc.sua',['tintuc'=>$tintuc,'theloai'=>$theloai,'loaitin'=>$loaitin]);    
    }
    public function postSua(Request $request,$id)
    {
        $tintuc = TinTuc::find($id);  
        $this->validate($request,
            [
                'LoaiTin' => 'required',
                
                'Content'=>'required',
            ],
            [
                'LoaiTin.required'=>'Ban chua nhap ten loai tin',
                
                'Content.required'=>'Chua nhap noi dung',

            ]);
       
        $tintuc->Title = $request->TieuDe;
        $tintuc->idLoaiTin = $request->LoaiTin;
        $tintuc->Content = $request->Content;
        $tintuc->save();
        if($request->hasFile('Image'))
        {
            $file = $request->file('Image');

            $name = $file->getClientOriginalName();
            $Hinh = str_random(4)."_".$name;
            while (file_exists("upload/images/".$Hinh))
            {
               $Hinh = str_random(4)."_".$name; 
            }

            $file->move("upload/images",$Hinh);
            unlink("upload/images/".$tintuc->Hinh);
            $tintuc->Hinh = $Hinh;
        }
        $tintuc->save();  
        return redirect('admin/tintuc/sua/'.$id)->with('thongbao','Sua thanh cong');      

    }
    public function getXoa($id)
    {
        $tintuc = TinTuc::find($id);
        $tintuc->delete();    

        return redirect('admin/tintuc/danhsach')->with('thongbao','Xoa thanh cong');
    }
    }