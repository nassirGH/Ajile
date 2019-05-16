@extends('layouts.app')

@section('content')


    @include('layouts.errors')

    <div class="card">
        <div class="card-header">
            {{'Questionnaire '.$questionnaire->name}}
        </div>
        <div class="card-body">
            <form id="frm" method="post" action="{{route('notification.store',['id'=>$questionnaire->id])}}">
                @csrf
                <div class="form-group">
                    <label for="avatar" class="label">
                        Comment on {{'Questionnaire '.$questionnaire->name}}
                    </label>
                    <input type="text" class="form-control" name="{{'comment'}}">
                </div>

                <hr/>
                @foreach($questionnaire->questions as $question)
                    <div class="form-group">
                        <label for="avatar" class="label">
                            {{'Question: '.$question->question}}
                        </label>
                        <input type="text"  data-id="{{$question->id}}" class="form-control tt" name="questions[]">
                    </div>
                @endforeach
                <div class="form-group">
                    <div class="text-center">
                        <button class="btn btn-success"  id="submit">Save</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
@stop
@section('scripts')
<script>
    $(document).ready(function () {
        $('#submit').click(function (el) {
            $('.tt').each(function(i, obj) {
                $(obj).val($(obj).val()+'/'+$(obj).attr('data-id'));
                $('#frm').submit(function (e) {
                    return true;
                });
            });
        });
    });


</script>
@endsection