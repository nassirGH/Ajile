@extends('layouts.app')

@section('content')

    @include('layouts.errors')

    <div class="card">
        <div class="card-header">
            <div class="card-title">
                Teams
                <a href="{{route('questionnaire.create')}}" style="float: right" class="btn btn-blue">Add Questionnaire</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-hover">

                <thead>
                <th>
                    Name
                </th>
                <th>
                    Teams Associated to
                </th>
                <th>
                    Delete
                </th>
                </thead>
                <tbody>
                @foreach($questionnaires as $questionnaire)
                    <tr>
                        <td>
                            {{$questionnaire->name}}
                        </td>

                        <td>
                            {{count($questionnaire->teams)}}
                        </td>
                        <td>
                            <a href="{{route('questionnaire.delete',['id'=>$questionnaire->id])}}" class="btn  btn-danger">
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