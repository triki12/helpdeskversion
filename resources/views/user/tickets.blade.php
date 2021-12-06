@extends('layouts.userlayout.master')


@section('content')
<div class="content-wrapper">

<div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">My Tickets</h4>
                  <p class="card-description">
                  @if ($message = Session::get('success'))
                      <div class="alert alert-success">
                          <p>{{ $message }}</p>
                      </div>
                  @endif 
                  </p>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr class="text-center">
                          <th>
                            Référence
                          </th>
                          <th>
                            Subject
                          </th>
                          <th >
                            Services
                          </th>
                          <th>
                            Created At
                          </th>
                          <th>
                          Status
                          </th>
                          <th>
                          Assigned to 
                          </th>
	            					  <th>
                            Actions
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach ($tickets as $ticket)

                        <tr class="text-center">
                                            <td class="py-1">
                                            {{ $ticket->ref }}                                            

                                            </td>
                                            <td>
                                            {{ $ticket->sujet }}                                            

                                           </td>
                                            <td class="py-1">
                                              @foreach ( $services as $ser)
                                                @if($ser->id ==  $ticket->service)
                                                <div >
                                                <img  src="{{asset('storage/images/'.$ser->gallery)}}" alt="image"/>

                                                  <p >{{ $ser->service_name }}    </p>
                                                </div>
                                                @endif                                       


                                              @endforeach

                                           </td>
                                            <td>
                                            {{ $ticket->created_at }}                                            

                                            </td>
                                     
                                       
                                <td>
                                  @if ( $ticket->status == "Open" )
                                  <label class="badge badge-info">  {{ $ticket->status }}     </label>

                                  @elseif( $ticket->status == "Pending" )
                                  <label class="badge badge-warning">  {{ $ticket->status }}     </label>
                                  @elseif( $ticket->status == "Resolved" )
                                  <label class="badge badge-success">  {{ $ticket->status }}     </label>
                                  @elseif( $ticket->status == "Closed" )
                                  <label class="badge badge-danger">  {{ $ticket->status }}     </label>


                                  @endif
                              </td>
                              @if ($ticket->assignedto == null )

                              <td class="text-danger"> Not assigned to Sprovider <i class="mdi mdi-arrow-down"></i></td>
                              @else

                              <td class="text-success"> Assigned to Sprovider <i class="mdi mdi-arrow-up"></i></td>


                              @endif
                                            
                              

                                <td>
                                 @if ( $ticket->status == "Open" )
                                <a href="/confirmer/{{$ticket->id}}" class="btn btn-danger">Delete</a>
                                <a href="editticket/{{$ticket->id}}" class="btn btn-warning">Edit</a>
                                @endif

                                @if ( $ticket->status == "Resolved" )
                                <a href="" class="btn btn-danger">Close</a>
                                @endif
                              <a href="detail/{{$ticket->id}}" class="btn btn-info">Detailes</a>




                                            </td>
                         </tr>
                         @endforeach

                         {{ $tickets->links() }}

						
                 
                      </tbody>
                      @include('sweetalert::alert')

                    </table>
                  </div>
                </div>
              </div>
            </div>
</div>
@endsection
