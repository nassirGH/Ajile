@extends('layouts.app')

@section('content')

    @include('layouts.errors')

    <div class="card">
        <div class="card-header">
            <div class="card-title">
                Projects
                <a href="{{route('project.create')}}" style="float: right" class="btn btn-blue">Add Project</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-hover">

                <thead>
                <th>
                    Title
                </th>
                <th>
                    Description
                </th>
                <th>
                    Department
                </th>
                <th>
                    Start date
                </th>
                <th>
                    End date
                </th>
                <th>
                    Team
                </th>
                <th>
                    Delete
                </th>
                </thead>
                <tbody>
                @foreach($projects as $project)
                    <tr>
                        <td>
                            {{$project->title}}
                        </td>
                        <td>
                            {{$project->description}}
                        </td>
                        <td>
                            {{$project->department}}
                        </td>
                        <td>
                            {{$project->start_date}}
                        </td>
                        <td>
                            {{$project->end_date}}
                        </td>
                        <td>
                            {{$project->team->name}}
                        </td>
                        <td>
                            <a href="{{route('project.delete',['id'=>$project->id])}}" class="btn  btn-danger">
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