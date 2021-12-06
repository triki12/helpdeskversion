@extends('layouts.adminlayout.master')

@section('content')
<div class="content-wrapper">

    <div class="row">

    <div class="container">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if($errors)
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">{{ $error }}</div>
                        @endforeach
                    @endif

                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb" class="main-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home')  }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Profile Settings</li>
                    </ol>
                    </nav>
                    <!-- /Breadcrumb -->

                    <div class="row gutters-sm">
                    <div class="col-md-4 d-none d-md-block">
                        <div class="card">
                        <div class="card-body">
                            <nav class="nav flex-column nav-pills nav-gap-y-1">
                            <a href="#profile" data-toggle="tab" class="nav-item nav-link has-icon nav-link-faded active">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user mr-2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>Profile Information
                            </a>
                            <a href="#account" data-toggle="tab" class="nav-item nav-link has-icon nav-link-faded">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings mr-2"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>Account Settings
                            </a>
                            <a href="#security" data-toggle="tab" class="nav-item nav-link has-icon nav-link-faded">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shield mr-2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>Security
                            </a>
                           
                            </nav>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                        <div class="card-header border-bottom mb-3 d-flex d-md-none">
                            <ul class="nav nav-tabs card-header-tabs nav-gap-x-1" role="tablist">
                            <li class="nav-item">
                                <a href="#profile" data-toggle="tab" class="nav-link has-icon active"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg></a>
                            </li>
                            <li class="nav-item">
                                <a href="#account" data-toggle="tab" class="nav-link has-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg></a>
                            </li>
                            <li class="nav-item">
                                <a href="#security" data-toggle="tab" class="nav-link has-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shield"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg></a>
                            </li>
                          
                            </ul>
                        </div>
                        <div class="card-body tab-content">
                            <div class="tab-pane active" id="profile">
                            <h6>YOUR PROFILE INFORMATION</h6>
                            <hr>
                            <form method="POST" action="{{ route('changeNameandMail') }}">
                            {{ csrf_field() }}
                            
                                <div class="form-group">
                                <label for="fullName">Full Name</label>
                                <input type="text"  name="name" class="form-control" id="fullName" aria-describedby="fullNameHelp" placeholder="Enter your fullname" value=" {{Auth::user()->name}}">
                                <small id="fullNameHelp" class="form-text text-muted">Your name may appear around here where you are mentioned. You can change or remove it at any time.</small>
                                </div>

                                <div class="form-group" style="display:none">
                                <label for="id">id</label>
                                <input type="text" class="form-control"  id="id" name="id" value=" {{Auth::user()->id}}">
                                </div>
                                
                                <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" name="email" class="form-control" id="email" placeholder="Enter your email address" value=" {{Auth::user()->email}}">
                                </div>
                               
                                <div class="form-group small text-muted">
                                All of the fields on this page are optional and can be deleted at any time, and by filling them out, you're giving us consent to share this data wherever your user profile appears.
                                </div>
                                <button type="submit" class="btn btn-info">Update Profile</button>
                            </form>
                            </div>
                            <div class="tab-pane" id="account">
                            <h6>ACCOUNT SETTINGS</h6>
                            <hr>
                            <form method="POST" action="{{ route('changesettings') }}"  enctype="multipart/form-data">
                            {{ csrf_field() }}
                                
                            @foreach ($settings as $set)
                                 <div class="form-group">
                                <label for="fullName">Site Name</label>
                                <input type="text"  name="nameweb" class="form-control" id="fullName" aria-describedby="fullNameHelp" placeholder="Enter your fullname" value=" {{$set->nameweb}}">
                                <small id="fullNameHelp" class="form-text text-muted">Your name of website may appear around here where you are mentioned. You can change or remove it at any time.</small>
                                </div>
                                <div class="form-group">
                                <label for="fullName">Url Site</label>
                                <input type="text"  name="url" class="form-control" id="url" aria-describedby="fullNameHelp" placeholder="Enter your url" value="Url">
                                <small id="url" class="form-text text-muted">Your Url of website may appear around here where you are mentioned. You can change or remove it at any time.</small>
                                </div>
                                <div class="form-group">
                                <label for="fullName">Site Logo</label>
                                <input type="file"  name="image" class="form-control" id="logo" aria-describedby="fullNameHelp" placeholder="Enter your fullname" value="{{$set->logo}}">
                                <small id="fullNameHelp" class="form-text text-muted">Your Logo of website may appear around here where you are mentioned. You can change or remove it at any time.</small>
                                </div>
                                <button class="btn btn-info" type="submit">Submit</button>
                            @endforeach
                            </form>
                            </div>
                            <div class="tab-pane" id="security">
                            <h6>SECURITY SETTINGS</h6>
                            <hr>
                            <form method="POST" action="{{ route('changePasswordPost') }}">
                            {{ csrf_field() }}
                                <label class="d-block">Change Password</label>
                                <div class="form-group {{ $errors->has('current-password') ? ' has-error' : '' }}"  >
                                <input type="password" class="form-control" placeholder="Enter your current password"  name="current-password" required>
                                
                                @if ($errors->has('current-password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('current-password') }}</strong>
                                    </span>
                                @endif
                                </div>
                                <div class="form-group {{ $errors->has('new-password') ? ' has-error' : '' }}"  >
                                <input type="password" class="form-control mt-1" placeholder="New password"  name="new-password" required>
                                
                                @if ($errors->has('new-password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('new-password') }}</strong>
                                    </span>
                                @endif
                                </div>
                                <div class="form-group"  >
                                <input type="password" class="form-control mt-1" placeholder="Confirm new password" name="new-password_confirmation" required>
                                </div>
                                <button class="btn btn-info" type="submit">Submit</button>

                            </form>
            
                            <hr>
                            <form>
                                <div class="form-group mb-0">
                                <label class="d-block">Sessions</label>
                                <p class="font-size-sm text-secondary">This is a list of devices that have logged into your account. Revoke any sessions that you do not recognize.</p>
                                <ul class="list-group list-group-sm">
                                    <li class="list-group-item has-icon">
                                    <div>
                                        <h6 class="mb-0">Tunis center , 190.24.335.55</h6>
                                        <small class="text-muted">Your current session seen in Tunisia</small>
                                    </div>
                                    <button class="btn btn-light btn-sm ml-auto" type="button">More info</button>
                                    </li>
                                </ul>
                                </div>
                            </form>
                            </div>
                          
                            
                        </div>
                        </div>
                    </div>
                    </div>

                    </div>
        
    </div>

</div>

@endsection