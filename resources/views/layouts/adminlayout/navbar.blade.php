<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class=" navbar-brand-wrapper d-flex align-items-center justify-content-center  " >
 

           @foreach ($settings as $set)
           <!-- <div class="panel-heading"> -->
           <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
            <a class="navbar-brand brand-logo" href="index.html"><h3 style="color:white">{{$set->nameweb}}</h3></a>
            <a class="navbar-brand brand-logo-mini" href="index.html"><h1 style="color:white">{{$set->nameweb}}</h1></a>
          </div>
           
            <!-- <a class="navbar-brand brand-logo text-right " href="/home"><h3 style="color:#fff;font-size:20px"> -->
            <!-- <img  class="text-left pull-left" style="width:60px; border-radius:10px; height:35px" src="{{asset('storage/images/'.$set->logo)}}"> -->
            <!-- {!! "&nbsp;" !!}{!! "&nbsp;" !!}{!! "&nbsp;" !!}  </h3></a> -->

            <!-- <a class="navbar-brand brand-logo-mini text-right " href="/home"><h3 >
            <img  class="text-left pull-left" style="width:60px; border-radius:10px; height:35px" src="{{asset('storage/images/'.$set->logo)}}">
            </h3></a> -->
          <!-- </div> -->
            @endforeach


   


      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
        <ul class="navbar-nav mr-lg-2">
          <li class="nav-item nav-search d-none d-lg-block">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text" id="search">
                  <i class="icon-search"></i>
                </span>
              </div>
              <input type="text" class="form-control" placeholder="Search Projects.." aria-label="search" aria-describedby="search">
            </div>
          </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
            <!-- <li class="nav-item dropdown d-lg-flex d-none">
                <button type="button" class="btn btn-info font-weight-bold">+ Create New</button>
            </li> -->
          <li class="nav-item dropdown d-flex">
            <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center" id="messageDropdown" href="#" data-toggle="dropdown">
            @php ($nbn=0)

            @foreach ($allnotofadmin as $not)
            @php($nbn=$nbn+1)
            @endforeach

            @if ($nbn == 0)
            <i class="icon-bell"></i> &nbsp;&nbsp;
            @elseif ( $nbn < 5 && $nbn > 0 )
            <i class="icon-bell"></i> <span class="badge badge-danger" >  {{$nbn}} </span>&nbsp;&nbsp;
            @else 
            <i class="icon-bell"></i> <span class="badge badge-danger" >  +5 </span>&nbsp;&nbsp;
            @endif

            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
              <p class="mb-0 font-weight-normal float-left dropdown-header">Messages</p>
              
              @foreach ($allnotofadmin as $not)
              <a class="dropdown-item preview-item"  href="{{ url('/markasvnotification/'.$not->id)}}">
                <div class="preview-thumbnail">
                    <img src="{{URL::asset('assets/images/faces/face4.jpg')}}" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content flex-grow">
                  <h6 class="preview-subject ellipsis font-weight-normal">{{$not->username}}  
                
                  </h6>
                  <p class="font-weight-light small-text text-muted mb-0">
                  Ref: #{{$not->ref}}                 
               

                  </p>
                  <p class="font-weight-light small-text text-muted mb-0">
                 {{$not->message}}                    
               

                  </p>

                  
                  @if ( now()->diffInSeconds($not->created_at) < 61 )
                           {{ now()->diffInSeconds($not->created_at) }}  Seconds ago
                  @elseif ( now()->diffInMinutes($not->created_at) < 61 )
                           {{ now()->diffInMinutes($not->created_at) }}  Minutes ago
                  @elseif ( now()->diffInHours($not->created_at) <= 24 )
                          {{ now()->diffInHours($not->created_at) }}  hours ago
                  @elseif ( now()->diffInDays($not->created_at) < 30 )
                          {{ now()->diffInDays($not->created_at) }}  Days ago
                  @elseif ( now()->diffInMonths($not->created_at) > 0 )
                    {{ now()->diffInMonths($not->created_at) }}  Months ago
                  @elseif ( now()->diffInYears($not->created_at) > 0 )
                    {{ now()->diffInYears($not->created_at) }}  Years ago


                  @endif
                </div>
              </a>
              @endforeach

              @if($nbn==0)
              <a class="dropdown-item preview-item">
                
                <div class="preview-item-content flex-grow">
                  <h6 class="preview-subject ellipsis font-weight-normal">No Record Found
                  </h6>
                  
                </div>
              </a>

              @endif
            
              
           
            </div>
          </li>
          <li class="nav-item dropdown d-flex mr-4 ">
            <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center" id="notificationDropdown" href="#" data-toggle="dropdown">
              <i class="icon-cog"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
              <p class="mb-0 font-weight-normal float-left dropdown-header">Settings</p>
              <a class="dropdown-item preview-item" href="{{ url('/' . $page='settings') }}">               
                  <i class="icon-head"></i> Profile
              </a>
              <a class="dropdown-item preview-item" href="{{ route('logout') }} " onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                  <i class="icon-inbox"></i> Logout

              </a>
              <form id="logout-form" action="{{ route('logout') }} " method="POST" style="display:none;"> 
              @csrf
              </form>
            </div>
          </li>
          <li class="nav-item dropdown mr-4 d-lg-flex d-none">
            <a class="nav-link count-indicatord-flex align-item s-center justify-content-center" href="#">
              <i class="icon-grid"></i>
            </a>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>
    </nav>