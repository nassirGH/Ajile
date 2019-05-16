@extends('layouts.app')

@section('content')

    @include('layouts.errors')

    <div class="card">
        <div class="card-header">
            <div class="card-title">
                Questionnaires Not Answered Yet
            </div>
        </div>
        <div class="card-body">
            <table class="table table-hover">

                <thead>
                <th>
                    Name
                </th>
                <th>
                    Number of questions
                </th>
                <th>
                    Answer
                </th>
                </thead>
                <tbody>
                @foreach($questionnaires as $key=>$value)
                    <tr>
                        <td>
                            {{\App\Questionnaire::find($key)->name}}
                        </td>

                        <td>
                            {{count($value)}}
                        </td>
                        <td>
                            <a href="{{route('notification.show',['id'=>$key])}}" class="btn  btn-primary">
                                Answer
                            </a>
                        </td>
                    </tr>

                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection