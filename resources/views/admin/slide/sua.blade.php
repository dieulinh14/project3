@extends('admin.layout.index')

@section('content')
      <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Slide
                            <small>{{$slide->Name}}</small>
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

                        <form action="admin/slide/sua/{{$slide->id}}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{csrf_token()}}" />
                            
                            <div class="form-group">
                                <label>Name</label>
                                <input class="form-control" name="Name" placeholder="Please Enter Name Slide" value="{{$slide->Name}}" />
                            </div>
                            <div class="form-group">
                                <label>Content</label>  
                                <textarea name="NoiDung" id="demo" class="form-control ckeditor" rows="5">
                                    {{$slide->NoiDung}}
                                </textarea>
                            <div class="form-group">
                                <label>Link</label>
                                <input class="form-control" name="link" placeholder="Please Enter Link"
                                value="{{$slide->link}}"    
                                />
                            </div>
                            <div class="form-group">
                                <label>Image</label>
                                <p>
                                    <img width="300px" src="upload/slide/{{$slide->Hinh}}">
                                </p>
                                <input type="file" name="Image">
                                
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

@endsection