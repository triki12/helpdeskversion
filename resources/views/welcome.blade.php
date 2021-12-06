@extends('base')


@section('content')


<section class="hero-wrap js-fullheight img" style="  background-image: url('{{asset('assets/images/bg_3.jpg')}}'); ">
  		<div class="overlay"></div>
  		<div class="container">
  			<div class="row description js-fullheight align-items-center justify-content-center">
  				<div class="col-md-8 text-center">
  					<div class="text">
  						<h1>Helpdesk System.</h1>
  						<h4 class="mb-5">Ticketing System</h4>
					


					
						  @if(Auth::guest())
						  <p><a href="{{ url('login') }}" class="btn btn-primary px-4 py-3">

						  Log in
						  </a> </p>

						  @else
						  <p><a href="{{ url('home') }}" class="btn btn-primary px-4 py-3">   

                          Dashboard
						</a> </p>
						  @endif
						

						
						
  					</div>
  				</div>
  			</div>
  		</div>
  	</section>



	  <!-- - - - - -end- - - - -  -->

	  @include('sweetalert::alert')

@endsection
