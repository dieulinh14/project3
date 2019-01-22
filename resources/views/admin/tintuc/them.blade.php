@extends('admin.layout.index')

@section('content')
      <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">News
                            <small>Add</small>
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

                        <form action="admin/tintuc/them" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{csrf_token()}}" />
                            <div class="form-group">
                                <label>Category</label>
                                <select class="form-control" name="TheLoai" id="TheLoai"> 
                                    
                                    @foreach($theloai as $tl)
                                    <option value="{{$tl->id}}">{{$tl->Name}}</option>
                                    @endforeach
                                
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Genre</label>
                                <select class="form-control" name="LoaiTin" id="LoaiTin">
                                    
                                    @foreach($loaitin as $lt)
                                    <option value="{{$lt->id}}">{{$lt->Name}}</option>
                                    @endforeach                 
                                
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Title</label>
                                <input class="form-control" name="Title" placeholder="Please Enter Title" />
                            </div>
                            <div class="form-group">
                                <label>Summary</label>  
                                <textarea name="Summary" id="demo" class="form-control ckeditor" rows="5"></textarea>
                            </div>

                            <div class="form-group">
                                <label>Content</label>  
                                <textarea name="Content" id="demo" class="form-control ckeditor" rows="5"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Image</label>
                                <input type="file" name="Image">
                                
                            </div>
                            <div class="form-group">
                                <label>Outstand</label>
                                <label class="radio-inline">
                                    <input name="Outstand" value="0" checked="" type="radio">Yes
                                </label>
                                <label class="radio-inline">
                                    <input name="Outstand" value="1" type="radio">No
                                </label>
                            </div>
                            <button type="submit" class="btn btn-default">Add</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

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