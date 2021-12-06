@extends('layouts.adminlayout.master')


@section('content')



<div class="content-wrapper">
<main>
                 @if ($message = Session::get('success'))
                      <div class="alert alert-success">
                          <p>{{ $message }}</p>
                      </div>
                  @endif 
            <div class="nav-item dropdown d-lg-flex d-none">
                <a href="{{ url('/' . $page='newservice') }}" class="btn btn-info font-weight-bold">+ Create Service</a>
             </div>
    <div class="container-fluid bg-trasparent my-4 p-3" >
        <div class="row row-cols-1 row-cols-xs-2 row-cols-sm-2 row-cols-lg-4 g-3">
        @foreach ($services as $item)

            <div class="col mt-4">
                <div class="card h-100 shadow-sm text-center"> 
                   
                    
                    <div class="shadow-sm p-4 mb-6 bg-light rounded">
                        <strong style="color:black">{{$item->service_name}}</strong>
                    </div>
                    <div class="card-body">
                        <div class="clearfix mb-3">  </div>
                        <img src="{{asset('storage/images/'.$item->gallery)}}" class="card-img-top" alt="...">
                        
                    </div>

                    
                    
                        <div class="text-center my-4 "><a href="/confirmerService/{{$item->id}}" class="btn btn-danger">Delete</a> 
                        <a href="editservice/{{$item->id}}" class="btn btn-warning">Edit</a> 
                        <a href="detailservice/{{$item->id}}" class="btn btn-info">More info</a> </div>
                </div>
            </div>
            @endforeach
            @include('sweetalert::alert')


            
        </div>
    </div>
</main>
                
  
</div>

@endsection