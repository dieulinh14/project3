 @extends('layout.index')

 @section('content')

<!-- slider -->
        <div class="row carousel-holder">
            <div class="col-md-12">
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                    <?php $i=0; ?>  
                        @foreach($slide as $sl)
                        <li data-target="#carousel-example-generic" data-slide-to="{{{$i}}}" 
                        @if($i == 0)
                            class="active"
                        @endif
                        ></li>
                        <?php $i++; ?>  
                        @endforeach
                    </ol>
                    <div class="carousel-inner">
                        <?php $i=0; ?>
                        @foreach($slide as $sl)
                        <div 
                        @if($i == 0)
                            class="item active"
                        @else 
                            class="item"
                        @endif 
                        >

                        <?php $i++; ?>      
                            <img width="300px" height="800px" class="slide-image" src="upload/slide/{{$sl->Hinh}}" alt="{{$sl->NoiDung}}">
                        </div>
                        @endforeach
                    </div>
                    <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                </div>
            </div>
        </div>
        <!-- end slide -->
 <!-- Page Content -->
    <div class="container">
        <div  class="row">
            <div  class="col-md-3 ">
                <ul  class="list-group" id="menu">
                    <li href="#" class="list-group-item menu1 active" style="background-color:pink; color:white;">
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
                    <div class="panel-heading" style="background-color:pink; color:white;">
                        <h4><b>{{$loaitin->Name}}</b></h4>
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