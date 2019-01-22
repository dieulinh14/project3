@extends('layout.index')

@section('content')

<!-- Page Content -->
<div class="container">
    <div class="row">

        <!-- Blog Post Content Column -->
        <div class="col-lg-9">

            <!-- Blog Post -->

            <!-- Title -->
            
                <h1 style="text-align: center;font-size: 50px; margin: 0 auto;">{{$tintuc->Title}}</h1>
            

            <!-- Author -->
            <p class="lead">
                <a href="#"></a>
            </p>

            <!-- Preview Image -->
            
            <img style="margin: 0 auto;" class="img-responsive" src="upload/images/{{$tintuc->Hinh}}" alt="">
            
            

            <!-- Date/Time -->
            <p><span class="glyphicon glyphicon-time"></span> Posted on : {{$tintuc->created_at}}</p>
            <hr>

            <!-- Post Content -->
            <p class="lead">
                {!! $tintuc->Content !!}
            </p>
            <hr>

            <!-- Blog Comments -->

            <!-- Comments Form -->
            
            <div class="well">
                <h4>Comment ...<span class="glyphicon glyphicon-pencil"></span></h4>
                <form action="comment/{{$tintuc->id}}" method="post" role="form">
                <input type="hidden" name="_token" value="{{csrf_token()}}" />
                    <div class="form-group">
                        <textarea class="form-control" name="NoiDung" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            
            <hr>

            <!-- Posted Comments -->

            <!-- Comment -->
            @foreach($tintuc->comment as $cm)
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">{{$cm->user->name}}
                        <small>{{$cm->created_at}}</small>
                    </h4>
                    {{$cm->NoiDung}}
                </div>
            </div>
            @endforeach

        </div>

        <!-- Blog Sidebar Widgets Column -->
        <div class="col-md-3">

            <div class="panel panel-default">
                <div class="panel-heading"><b>Related news</b></div>
                <div class="panel-body">
                    @foreach($tinlienquan as $tt)
                    <!-- item -->
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-md-5">
                            <a href="tintuc/{{$tt->id}}">
                                <img class="img-responsive" src="upload/images/{{$tt->Hinh}}" alt="">
                            </a>
                        </div>
                        <div class="col-md-7">
                            <a href="#"><b>{{$tt->Title}}</b></a>
                        </div>
                        <p 
                        style="padding-left: 5px;>{{$tt->TomTat}}</p>
                        <div class="break"></div>
                    </div>
                    @endforeach
                    <!-- end item -->


                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading"><b>Our Favorites</b></div>
                <div class="panel-body">
                    @foreach($tinnoibat as $tt)
                    <!-- item -->
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-md-5">
                            <a href="tintuc/{{$tt->id}}">
                                <img class="img-responsive" src="upload/images/{{$tt->Hinh}}" alt="">
                            </a>
                        </div>
                        <div class="col-md-7">
                            <a href="#"><b>{{$tt->Title}}</b></a>
                        </div>
                        <p style="padding-left: 5px;">{{$tt->TomTat}}</p>
                        <div class="break"></div>
                    </div>
                    <!-- end item -->
                    @endforeach
                   
                </div>
            </div>

        </div>

    </div>
    <!-- /.row -->
</div>
<!-- end Page Content -->

@endsection
