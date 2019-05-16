@extends('layouts.app')

@section('content')

    @include('layouts.errors')

    <div class="card">
        <div class="card-header">
            <div class="card-title">
                Teams
                <a href="{{route('team.create')}}" style="float: right" class="btn btn-blue">Add Team</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-hover">

                <thead>
                <th>
                    Name
                </th>
                <th>
                    Users
                </th>
                <th>
                    Delete
                </th>
                </thead>
                <tbody>
                @foreach($teams as $team)
                    <tr>
                        <td>
                            {{$team->name}}
                        </td>

                        <td>
                            {{count($team->users)}}
                        </td>
                        <td>
                            <a href="{{route('team.delete',['id'=>$team->id])}}" class="btn  btn-danger">
                                <i class="fas fa-trash"></i> Delete
                            </a>
                        </td>
                    </tr>

                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection