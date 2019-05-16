@extends('layouts.app')

@section('content')


    @include('layouts.errors')

    <div class="card">
        <div class="card-header">
            Create New Questionnaire
        </div>
        <div class="card-body">
            <form method="post" action="{{route('questionnaire.store')}}">
                @csrf

                <div class="form-group">
                    <label for="name" class="label">
                        Name
                    </label>
                    <input type="text" class="form-control" name="name">
                </div>


                <div class="form-group">
                    <label for="name" class="label">
                        teams
                    </label>
                    <select name="teams[]" class="form-control" multiple>
                        @foreach($teams as $team)
                            <option value="{{$team->id}}">{{$team->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div id="questions">
                    <input placeholder="number of questions" type="number" class="form-control" id="number_questions">

                    <button style="margin: 0 auto;display: block;margin-top: 10px;margin-bottom: 10px" class="btn btn--green"
                    onclick="addQuestion(event)">Add Questions
                    </button>
                </div>

                <div id="questions_div">

                </div>

                <input type="hidden" id="questions_count" name="number_questions" value="0"/>


                <div class="form-group">
                    <div class="text-center">
                        <button class="btn btn-success" type="submit">Add Questionnaire</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
@stop
@section('scripts')
    <script>
        function addQuestion(e) {
            e.preventDefault();
            let questions=$('#number_questions').val();
            let html='';
            for(let i=0;i<questions;i++){
                 html+= '<div class="form-group">\n' +
                    '                        <label for="name" class="label">\n' +
                    '                            Question\n' +
                    '                        </label>\n' +
                    '                        <input type="text" class="form-control" name="question-' + i + '">\n' +
                    '                    </div>';
            }
            $('#questions_div').html(html);
            $('#questions_count').val(questions);

        }

    </script>
@endsection