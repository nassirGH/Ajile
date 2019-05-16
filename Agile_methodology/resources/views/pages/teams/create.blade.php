@extends('layouts.app')

@section('content')


    @include('layouts.errors')

    <div class="card">
        <div class="card-header">
            Create New User
        </div>
        <div class="card-body">
            <form method="post" action="{{route('team.store')}}">
                @csrf

                <div class="form-group">
                    <label for="name" class="label">
                        Name
                    </label>
                    <input type="text" class="form-control" name="name">
                </div>


                <div class="form-group">
                    <label for="name" class="label">
                        Product Owner
                    </label>
                    <select name="product_owner" class="form-control">
                        @foreach($owners as $owner)
                            <option value="{{$owner->id}}">{{$owner->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="name" class="label">
                        Scrum Master
                    </label>
                    <select name="scrum_master" class="form-control">
                        @foreach($masters as $master)
                            <option value="{{$master->id}}">{{$master->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="name" class="label">
                        Developers
                    </label>
                    <select name="developers[]" class="form-control" multiple>
                        @foreach($developers as $developer)
                            <option value="{{$developer->id}}">{{$developer->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <div class="text-center">
                        <button class="btn btn-success" type="submit">Add Team</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
@stop