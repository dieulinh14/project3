@extends('layout.index')

@section('content')

<!-- Page Content -->
    <div class="container">


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

	            <div  class="panel panel-default" 
                style="font-size: 20px;">
                <!-- </style>
                style="font-size: 20px,line-height: 1.5;font-weight: 500;">     -->        
	            	<div class="panel-heading"  style="background-color:pink; color:#44b1b3;font-size: 40px; text-transform: uppercase; text-align: center;" >
	            		<h2 style="margin-top:0px; margin-bottom:0px;" >About Baking Mad</h2>
	            	</div>


	            		<!-- item -->
                        
                        <h3 style="font-size: 30px"> <span class="" ></span>The Baking Mad Story</h3>
					    
                    
                        <p>
Baking Mad is the trusted destination for bakers of all levels to learn, be inspired, and share their enthusiasm for baking with those they love. Home to the best recipes, content, tips and tools; we bring baking to life in everything we do, so you can do the same in your own home.

We want to create, educate and inspire you to become the best baker you can be, so we never show you a cake without helping you make it, reveal a product without a recipe, or recommend anything that doesn’t make you and your baking better.

Our recipes are scrumptious, and like all good things in life are best enjoyed as part of a balanced lifestyle. With that in mind, we create alternative recipe options to suit your needs including; reduced sugar, no-nuts, gluten-free and many more. Have a peek at those recipes here.

As part of The Silver Spoon Company; a trusted family of baking brands including Silver Spoon Sugar, Allinson Flour, Billington’s Sugar and Nielsen-Massey Vanilla and Flavoured Extracts, we will only ever bring you brands we believe will make you a better baker. If you know of a brand, or you are a brand that you think deserves to be a part of the mixing bowl contact us here</p>

                        
					</div>
	            </div>
        	</div>
        </div>
        <!-- /.row -->
    </div>
    <!-- end Page Content -->

@endsection