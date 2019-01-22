 @extends('layout.index')

 @section('content')
 <!-- Page Content -->
    <div class="container">
        <div class="row">
            <div class="col-md-3 ">
                <ul class="list-group" id="menu">
                    <li href="#" class="list-group-item menu1 active">
                        Menu
                    </li>

                    @foreach($theloai as $tl)

                    <li href="#" class="list-group-item menu1">
                        {{$tl->Name}}
                    </li>

                    <ul>
                        @foreach($tl->loaitin as $lt)
                        <li class="list-group-item">
                            <a href="loaitin/{{$lt->id}}">{{$lt->Name}}</a>
                        </li>
                    @endforeach

                    </ul>
                    
                    @endforeach

                </ul>
            </div>

            <div class="col-md-9 ">
                <div class="panel panel-default">
                    <div class="panel-heading" style="text-align: center;text-transform: uppercase; background-color:pink; color:white;">
                        <h4><b>{{$key}}</b></h4>
                    </div>

                    @foreach($tintuc as $tt)
                    <div class="row-item row">
                        <div class="col-md-3">

                            <a href="detail.html">
                                <br>
                                <img width="200px" height="200px" class="img-responsive" src="upload/images/{{$tt->Hinh}}" alt="">
                            </a>
                        </div>

                        <div class="col-md-9">
                            <h3>{{$tt->Title}}</h3>
                            <p>{{$tt->TomTat}}</p>
                            <a class="btn btn-primary" href="tintuc/{{$tt->id}}">More<span class="glyphicon glyphicon-chevron-right"></span></a>
                        </div>
                        <div class="break"></div>
                    </div>

                    @endforeach
                    <div style="text-align: center;">
                    {{$tintuc->links()}}
                    </div>
                </div>
            </div> 

        </div>

    </div>
    <!-- end Page Content -->

    <!-- Footer -->
@endsection