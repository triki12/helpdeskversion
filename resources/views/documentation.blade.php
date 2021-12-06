@extends('base')


@section('content')


<section class="hero-wrap js-fullheight img" style="  background-image: url('{{asset('assets/images/bg_3.jpg')}}'); ">
  		<div class="overlay"></div>
  		<div class="container " >
  		
                        
                            <div class="row doc-content mt-30"  >
                            <div class="col-12 col-md-10 offset-md-1" style="margin-top:130px">
                                <div class="col-12 grid-margin" id="doc-intro">
                                    <div class="card">
                                        <div class="card-body">
                                            <h3 class="mb-4 mt-4">Introduction</h3>
                                            <p> {!! lorem(1) !!}</p>
                                            <p> {!! lorem(1) !!}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 grid-margin" id="doc-started">
                                    <div class="card">
                                        <div class="card-body">
                                            <h3 class="mb-4">Getting started</h3>
                                            <p>{!! lorem(1) !!}.</p>
                                            <p> {!! lorem(1) !!}</p>
                                      
                                            {!! lorem(1) !!} {!! lorem(1) !!}
                                            <div class="alert alert-warning mt-4" role="alert">
                                            <i class="ti-info-alt-outline"></i>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Totam inventore atque amet ratione blanditiis officia cumque sapiente harum provident commodi sed sit, est laudantium laboriosam voluptas sequi fugit voluptates aperiam!.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
  		</div>
  	</section>
</div>
</div>





	  <!-- - - - - -end- - - - -  -->


   


@endsection
