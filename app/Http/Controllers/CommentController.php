<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\theloai;
use App\loaitin;
use App\comment;
use App\tintuc;

class CommentController extends Controller
{
    public function getXoa($id,$idTinTuc)
    {
        $comment = Comment::find($id);
        $comment->delete();

        return redirect('admin/tintuc/sua/'.$idTinTuc)->with('thongbao', 'Ban da xoa comment thanh cong');
    }
    public function postComment($id,Request $request)
    {
    	$comment = new Comment;
    	$idTinTuc = $id;
    	$tintuc = TinTuc::find($id);
    	
    	$comment->idTinTuc = $idTinTuc;
    	$comment->idUser = Auth::user()->id;
    	$comment->NoiDung = $request->NoiDung;
    	$comment->save();

    	return redirect("tintuc/$id/")->with('thongbao', 'Ban da dang comment thanh cong');;
    }
}