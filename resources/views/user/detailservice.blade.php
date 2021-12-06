@extends('layouts.userlayout.master')


@section('content')

<div class="content-wrapper">
              <div class="col-md-9">
                <div class="card">
                  <div class="col-sm-9">
                    <div class="p-5">

                        <h3 class="title mb-5">Service Name : {{$data->service_name}}</h3>


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
                            <dt class="col-sm-3"> Image : </dt>
                            <dd class="col-sm-9">  <div class="container">
                                                    <div class="col-md-12">
                                                    <div class="card border-primary mb-3">
                                                       
                                                        
                                                        <div class="card-body text-primary">
                                                          <img src="{{asset('storage/images/'.$data->gallery)}}" class="card-img-top" alt="...">
                                                        </div>
                                                    
                                                    </div><!-- /.card -->
                                                    </div>
                           </dd>
                     
                        </dl>

</div>
       
        </div>
    </div>
</div>


</div>

@endsection

          
