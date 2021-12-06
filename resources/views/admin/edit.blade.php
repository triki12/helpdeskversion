@extends('layouts.adminlayout.master')
@section('content')
<div class="content-wrapper">
          <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Update Service</h4>
                   
                  <form class="forms-sample" action="/editservice" method="POST">
                  @csrf
            <input type="hidden" name="id" value="{{$data['id']}}">
                   
                    <div class="form-group">
                      <label for="sujet">service_name</label>
                      <input type="text"  name="service_name" class="form-control" id="service_name" placeholder="service_name" value="{{$data['service_name']}}">
                    </div>
                    <div class="form-group">
                      <label for="description">Description</label>
                      <input type="text" name="description" class="form-control" id="description" placeholder="Description" value="{{$data['description']}}"> 
                    </div>
                    <div class="form-group">
                      <label for="service">gallery</label>
                      <input type="file" name="gallery" class="form-control" id="gallery" placeholder="gallery" value="{{$data['gallery']}}">
                    </div>
                    
                    <!-- <div class="form-group">
                    <label for="crit">Priorité</label>
                    <select class="form-control" name="criticité" id="criticité">
                                        <option selected disabled>----Select priorité----</option>
                                        <option value="urgente">urgente</option>
                                        <option value="normal">normal</option>
                                        <option value="basse">basse</option>
                    </select>
                    </div> -->
                 
                    <button type="submit" class="btn btn-primary mr-2">Edit</button>
                  </form>
                </div>
              </div>
            </div>
</div>
</div>
@endsection