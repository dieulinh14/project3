@extends('layout.index')

@section('content')

<!-- Page Content -->
    <div class="container">

    	<!-- slider -->
        <div c`lass="row carousel-holder">
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
                            <img class="slide-image" src="upload/slide/{{$sl->Hinh}}" alt="">
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

            <div class="col-md-9

	            <div  class="panel panel-default" 
                style="font-size: 20px;">
                <!-- </style>
                style="font-size: 20px,line-height: 1.5;font-weight: 500;">     -->        
	            	<div class="panel-heading" style="background-color:pink; color:white;" >
	            		<h2 style="margin-top:0px; margin-bottom:0px;"></h2>
	            	</div>


	            		<!-- item -->
                        
                        <h3> <span class="" " style="font-size: 10px;"></span>Contact Us</h3>
					    
                        <div class="break"></div>
					   	<h4><span class= "glyphicon glyphicon-home "></span> Address : </h4>
                        <p>Lynchwood Business Park </p>

                        <h4><span class="glyphicon glyphicon-envelope"></span></h4>
                        <p>For Baking Queries: Email us at customerservices@bakingmad.com and we will aim to respond to you within 48 hours</p>

                        <h4><span class="glyphicon glyphicon-phone-alt"></span></h4>
                        <p>Whether you want to share your suggestions, thoughts and comments, or if you have any questions - we'd love to hear from you. </p> 
                        </form>
					</div>
	            </div>
        	</div>
        </div>
        <!-- /.row -->
    </div>
    <!-- end Page Content -->

@endsection