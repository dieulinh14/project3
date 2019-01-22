@extends('layout.index')

@section('content')
<!-- Page Content -->
    <div class="container">

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

        <div class="space20"></div>


        <div class="row main-left">
        	
        	<!-- @include('layout.menu') -->
        	<div class="col-md-3 ">
                <ul  class="list-group" id="menu">
                    <li href="#" class="list-group-item menu1 active" style="background-color:pink; color:white;">
                        Recipes
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

			<div class="col-md-9">
                <div class="panel panel-default">            
                    <div class="panel-heading" style="background-color:pink; color:white;" >
                        <h2 style="margin-top:0px; margin-bottom:0px;">Category</h2>
                    </div>

                    <div class="panel-body">

                    	@foreach($theloai as $tl)
                        <!-- item -->
                        <div class="row-item row">
                            <h3>
                                <a href="category.html">{{$tl->Name}}</a> |  
                                
                                @foreach($tl->loaitin as $lt)
                                <small>
                                	<a href="loaitin/{{$lt->id}}"><i>{{$lt->Name}}</i></a>/</small>
                                @endforeach

                            </h3>
                            <?php
                            $data = $tl->tintuc->where('NoiBat',1)->sortByDesc('created_at')->take(3);  
                            // mang
                            $tin1 = $data->shift()
                            ?>

                            <div  class="col-md-8 border-right">
                                <div class="col-md-5">
                                    <a href="tintuc/{{$tin1['id']}}">
                                        <img class="img-responsive" src="upload/images/{{$tin1['Hinh']}}" alt="">
                                    </a>
                                </div>

                                <div  class="col-md-7">
                                    <h3>{{$tin1['Title']}}</h3>
                                    <p>{{$tin1['TomTat']}}</p>
                                    <a class="btn btn-primary" href="tintuc/{{$tin1['id']}}">View More <span class="glyphicon glyphicon-chevron-right"></span></a>
                                </div>

                            </div>
                            

                            <div class="col-md-4">
                                
                                @foreach($data->all() as $tintuc)
                                <a href="tintuc/{{$tintuc['id']}}">
                                	<img class="img-responsive" src="upload/images/{{$tintuc->Hinh}}" alt="">
                                    <h4>
                                        <span class="glyphicon glyphicon-list-alt"></span>
                                        {{$tintuc['Title']}}
                                    </h4>
                                </a>

                  				@endforeach
                            </div>
                            
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