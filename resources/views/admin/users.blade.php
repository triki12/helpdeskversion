@extends('layouts.adminlayout.master')
@section('content')
<div class="content-wrapper">

<div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Users Accounts</h4>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>
                            id
                          </th>
                          <th>
                              name
                          </th>  
                          <th>
                              email 
                           </th>
                           <th>
                               Created_at
                           </th>
                        </tr>
                        </thead>
                        <tbody>
                      @foreach ($users as $user)

                        <tr>
                          <td class="py-4">
                           {{$user->id}}
                          </td>
                          <td class="py-4">
                           {{$user->name}}
                          </td>
                          <td class="py-4">
                           {{$user->email}}
                          </td>
                          <td class="py-4">
                           {{$user->created_at}}
                          </td>
                        </tr>
                        @endforeach

                        {{ $users->links() }}

                        </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
</div>
@endsection