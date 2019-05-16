@extends('layouts.app')

@section('content')


    @include('layouts.errors')

    <div class="card">
        <div class="card-header">
            Create New Project
        </div>
        <div class="card-body">
            <form method="post" action="{{route('project.store')}}">
                @csrf

                <div class="form-group">
                    <label for="name" class="label">
                        title
                    </label>
                    <input type="text" class="form-control" name="title">
                </div>


                <div class="form-group">
                    <label for="description" class="label">
                        description
                    </label>
                    <input type="text" class="form-control" name="description">
                </div>
                <div class="form-group">
                    <label for="description" class="label">
                        department
                    </label>
                    <input type="text" class="form-control" name="department">
                </div>

                <div class="form-group">
                    <label for="description" class="label">
                        start date
                    </label>
                    <input type="date" class="form-control" name="start_date">
                </div>


                <div class="form-group">
                    <label for="description" class="label">
                        end date
                    </label>
                    <input type="date" class="form-control" name="end_date">
                </div>


                <div class="form-group">
                    <label for="description" class="label">
                        Team
                    </label>
                    <select class="form-control" name="team">
                        @foreach($teams as $team)
                        <option value="{{$team->id}}">{{$team->name}}</option>
                        @endforeach
                    </select>
                </div>


                <div class="form-group">
                    <div class="text-center">
                        <button class="btn btn-success" type="submit">Add Project</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
@stop