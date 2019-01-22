<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\slide;

class SlideController extends Controller
{
    
    public function getDanhSach(){
        $slide = Slide::all();
        return view('admin.slide.danhsach',['slide'=>$slide]);
        // return view('admin.loaitin.danhsach');
    }

    public function getThem(){
        
        return view('admin.slide.them');
            // ,['slide'=>$slide]);
    }


    public function postThem(Request $request)
    {
        $this->validate($request,
            [
                'Name' => 'required',
                'NoiDung'=>'required',
                
            ],
            [
                'Name.required'=>'Ban chua nhap ten',
                'NoiDung.required'=>'Ban chua nhap noi dung',

            ]);
        $slide = new Slide;
        $slide->Name = $request->Name;
        $slide->NoiDung = $request->NoiDung;
        if($request->has('link'))
            $slide->link = $request->link;
        if($request->hasFile('Image'))
        {
            $file = $request->file('Image');

            $name = $file->getClientOriginalName();
            $Hinh = str_random(4)."_".$name;
            while (file_exists("upload/slide/".$Hinh))
            {
               $Hinh = str_random(4)."_".$name; 
            }
            $file->move("upload/slide",$Hinh);
            $slide->Hinh = $Hinh;
        }
        else
        {
            $slide->Hinh = "";
        } 

        $slide->save();
        return redirect('admin/slide/them')->with('thongbao','Them thanh cong');
         
    }

    public function getSua($id)
    {
        $slide = Slide::find($id);
        return view('admin/slide.sua',['slide'=>$slide]);
    }
    public function postSua(Request $request,$id)
    
    {
        $this->validate($request,
            [
                'Name' => 'required',
                'NoiDung'=>'required',
                
            ],
            [
                'Name.required'=>'Ban chua nhap ten',
                'NoiDung.required'=>'Ban chua nhap noi dung',

            ]);
        $slide = Slide::find($id);
        $slide->Name = $request->Name;
        $slide->NoiDung = $request->NoiDung;
        if($request->has('link'))
            $slide->link = $request->link;
        if($request->hasFile('Image'))
        {
            $file = $request->file('Image');

            $name = $file->getClientOriginalName();
            $Hinh = str_random(4)."_".$name;
            while (file_exists("upload/slide/".$Hinh))
            {
               $Hinh = str_random(4)."_".$name; 
            }
            unlink("upload/slide/".$slide->Hinh);
            $file->move("upload/slide",$Hinh);
            $slide->Hinh = $Hinh;
        }
        else
        {
            $slide->Hinh = "";
        } 

        $slide->save();
        return redirect('admin/slide/sua/'.$id)->with('thongbao','Sua thanh cong');
    }
    public function getXoa($id)
    {
        $slide = Slide::find($id);
        $slide->delete();

        return redirect('admin/slide/danhsach')->with('thongbao','Xoa thanh cong');
    }
    }