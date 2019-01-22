@extends('admin.layout.index')

@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">News
                    <small>{{$tintuc->Title}}</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                @if(count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach($errors->all() as $err)
                    {{$err}}<br>
                    @endforeach
                </div>
                @endif

                @if(session('thongbao'))
                <div class="alert alert-success">
                    {{session('thongbao')}}
                </div>
                @endif

                <form action="admin/tintuc/sua/{{$tintuc->id}}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{csrf_token()}}" />
                    <div class="form-group">
                        <label>Category</label>
                        <select class="form-control" name="TheLoai" id="TheLoai"> 

                            @foreach($theloai as $tl)
                            <option 
                            @if($tintuc->loaitin->theloai->id == $tl->id)
                            {{"selected"}}
                            @endif

                            value="{{$tl->id}}">{{$tl->Name}}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="form-group">
                        <label>Genre</label>
                        <select class="form-control" name="LoaiTin" id="LoaiTin">

                            @foreach($loaitin as $lt)
                            <option 
                            @if($tintuc->loaitin->id == $lt->id)
                            {{"selected"}}
                            @endif
                            value="{{$lt->id}}">{{$lt->Name}}</option>
                            @endforeach                 

                        </select>
                    </div>
                    <div class="form-group">
                        <label>Title</label>
                        <input class="form-control" name="TieuDe" placeholder="Please Enter Title" value="{{$tintuc->Title}}" />
                    </div>
                    <div class="form-group">
                        <label>Content</label>  
                        <textarea name="Content" id="demo" class="form-control ckeditor" rows="5">
                            {{$tintuc->Content}}
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <p>
                            <img width="300px" src="upload/images/{{$tintuc->Hinh}}">
                        </p>
                        <input type="file" name="Image">
                        
                    </div>
                    <div class="form-group">
                        <label>Outstand</label>
                        <label class="radio-inline">
                            <input name="Outstand" value="0" 
                            @if($tintuc->NoiBat == 0)
                            {{"checked"}}
                            @endif
                            type="radio">Yes
                        </label>
                        <label class="radio-inline">
                            <input name="Outstand" value="1" 
                            @if($tintuc->NoiBat == 1)
                            {{"checked"}}
                            @endif
                            type="radio">No
                        </label>
                    </div>
                    <button type="submit" class="btn btn-default">Edit</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                    <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Comment
                    <small>List</small>
                </h1>
            </div>

            @if(session('thongbao'))          

            <div class="alert alert-success">                {{session('thongbao')}}
            </div>
            @endif
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>User</th>
                        <th>Content</th>
                        <th>Created_at</th>
                        <th>Delete</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($tintuc->comment as $cm )
                    <tr class="odd gradeX" align="center">
                        <td>{{$cm->id}}</td>
                        <td>{{$cm->user->name}}</td>
                        <td>{{$cm->NoiDung}}</td>
                        <td>{{$cm->created_at}}</td>

                        <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="<td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/comment/xoa/{{$cm->id}}/{{$tintuc->id}}">Delete</a></td>

                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <!-- end row -->

        @endsection

        @section('script')
        <script>
            $(document).ready(function(){
            // alert('Da chay duoc');
            $("#TheLoai").change(function(){
                var idTheLoai = $(this).val();
                // alert(idTheLoai);
                $.get("admin/ajax/loaitin/"+idTheLoai,function(data){
                    // alert(data)
                    $("#LoaiTin").html(data);
                });
            });
        });
    </script>
    @endsection