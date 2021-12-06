@extends('layouts.userlayout.master')


@section('content')



<div class="content-wrapper">
<main>
                 @if ($message = Session::get('success'))
                      <div class="alert alert-success">
                          <p>{{ $message }}</p>
                      </div>
                  @endif 
           
    <div class="container-fluid bg-trasparent my-4 p-3" style="position: relative;">
           <div class="col-sm-12 mb-4 mb-xl-0">
              <h4 class="font-weight-bold text-dark">IT department Services </h4>
            </div>
        <div class="row row-cols-1 row-cols-xs-2 row-cols-sm-2 row-cols-lg-4 g-3 " style="margin-top :30px;">
            
        @foreach ($services as $item)

            <div class="col mt-7">
                <div class="card h-100 shadow-sm">
                    
                <div class="shadow-sm p-4 mb-6 bg-light rounded">
                        <strong style="color:black"> {{$item->service_name}} </strong>
                    </div>
                    <div class="card-body">
                        <div class="clearfix mb-3">  </div>
                        <img src="{{asset('storage/images/'.$item->gallery)}}" class="card-img-top" alt="...">
                    </div>

                    
                    
                        <div class="text-center my-4 ">  
                     
                        <a href="detailservice/{{$item->id}}" class="btn btn-info">More info</a> </div>
                </div>
            </div>
            @endforeach

            
        </div>
    </div>
</main>
                
  
</div>

@endsection