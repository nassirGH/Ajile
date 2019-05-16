@extends('layouts.app')

@section('content')


    @include('layouts.errors')

    <div class="card">
        <div class="card-header">
            Update {{$user->name}}'s Profile
        </div>
        <div class="card-body">
            <form method="post" action="{{route('user.profile.update')}}" enctype="multipart/form-data">
                @csrf

                <div class="row justify-content-center">
                    <div class="col-lg-6 offset-3">
                        <img src="{{asset($user->profile->avatar)}}" style="border-radius: 100%;height: 100px;width: 100px"  />
                    </div>
                </div>
                <div class="form-group">
                    <label for="avatar" class="label">
                        Profile Picture
                    </label>
                    <input type="file" class="form-control" name="avatar">
                </div>

                <div class="form-group">
                    <label for="name" class="label">
                        Name
                    </label>
                    <input type="text" class="form-control" name="name" value="{{$user->name}}">
                </div>


                <div class="form-group">
                    <label for="email" class="label">
                        Email
                    </label>
                    <input type="email" class="form-control" name="email" value="{{$user->email}}">
                </div>

                <div class="form-group">
                    <label for="password" class="label">
                        New password
                    </label>
                    <input type="password" class="form-control"  name="password">
                </div>
                <div class="form-group">
                    <label for="about" class="label">
                        About
                    </label>
                    <br>
                    <textarea class="form-control" name="about" rows="2" >{{$user->profile->about}}</textarea>
                </div>
                <div class="form-group">
                    <label for="facebook" class="label">
                        Facebook Profile
                    </label>
                    <input type="text" class="form-control" name="facebook" value="{{$user->profile->facebook}}">
                </div>
                <div class="form-group">
                    <label for="youtube" class="label">
                        Youtube Profile
                    </label>
                    <input type="text" class="form-control" name="youtube" value="{{$user->profile->youtube}}">
                </div>
                <div class="form-group">
                    <div class="text-center">
                        <button class="btn btn-success" type="submit">Update Profile</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
@stop