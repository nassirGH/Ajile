@extends('layouts.app')

@section('content')


    @include('layouts.errors')

    <div class="card">
        <div class="card-header">
            Create New User
        </div>
        <div class="card-body">
            <form method="post" action="{{route('user.store')}}">
                @csrf

                <div class="form-group">
                    <label for="name" class="label">
                        Name
                    </label>
                    <input type="text" class="form-control" name="name">
                </div>

                <div class="form-group">
                    <label for="username" class="label">
                        Username
                    </label>
                    <input type="text" class="form-control" name="username">
                </div>


                <div class="form-group">
                    <label for="email" class="label">
                        Email
                    </label>
                    <input type="email" class="form-control" name="email">
                </div>

                <div class="form-group">
                    <label for="phone" class="label">
                        phone
                    </label>
                    <input type="number" class="form-control" name="phone">
                </div>

                <div class="form-group">
                    <label for="phone" class="label">
                        password
                    </label>
                    <input type="password" class="form-control" name="password">
                </div>


                <div class="form-group">
                    <label for="name" class="label">
                        Role
                    </label>
                    <select name="role" class="form-control">
                        <option value="admin">Admin</option>
                        <option value="developer">developer</option>
                        <option value="coach">coach</option>
                        <option value="product_owner">Product Owner</option>
                        <option value="scrum_master">Scrum Master</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="name" class="label">
                        Parent Coach
                    </label>
                    <select name="parent_id" class="form-control">
                        <option value="0">No Parent</option>
                        @foreach($coaches as $coach)
                        <option value="{{$coach->id}}">{{$coach->name}}</option>
                            @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <div class="text-center">
                        <button class="btn btn-success" type="submit">Add user</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
@stop