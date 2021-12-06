@extends('layouts.techlayout.master')


@section('content')

<div class="content-wrapper">
<h4 class="card-title">Ref :{{$data->ref}}</h4>
              <div class="col-md-9">
                <div class="card">
                  <div class="col-sm-9">
                    <div class="p-5">
                        <h3 class="title ml-9 pull-right">                        
</h3>
                        <h3 class="title mb-5">Subject : {{$data->sujet}}</h3>


                        <dl class="row">
                            <dt class="col-sm-3">Description :</dt>
                            <dd class="col-sm-9">
                                                   <div class="container">
                                                    <div class="col-md-12">
                                                    <div class="card border-primary mb-3">
                                                        <div class="card-body  text-dark ">
                                                        <p class="card-text text-dark">{{$data->description}}.</p>
                                                        </div>
                                                    </div><!-- /.card -->
                                                    </div>
                               </dd>
                            <hr>
                            <dt class="col-sm-3">Service : </dt>
                            <dd class="col-sm-9">  <div class="container">
                                                    <div class="col-md-12">
                                                    <div class="card border-primary mb-3">
                                                        @foreach ( $services as $ser )
                                                        
                                                        @if($ser->id == $data->service)
                                                        
                                                        <div class="card-header">{{$ser->service_name}}</div>
                                                        <div class="card-body text-primary">
                                                          <img src="{{asset('storage/images/'.$ser->gallery)}}" class="card-img-top" alt="...">
                                                        </div>
                                                        @endif
                                                        @endforeach
                                                    </div><!-- /.card -->
                                                    </div>
                           </dd>
                            <dt class="col-sm-3">Criticité :</dt>
                            <dd class="col-sm-9">{{ $data->criticité }}</dd>
                            <dt class="col-sm-3">Status :</dt>
                            <dd class="col-sm-9">{{ $data->status }}</dd>
                            <dt class="col-sm-3">Created At :</dt>
                            <dd class="col-sm-9">{{ $data->created_at }}</dd>
                           
</div>
       
        </div>
    </div>
</div>


</div>

@endsection

          
