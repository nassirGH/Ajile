@extends('layouts.app')

@section('content')

    @include('layouts.errors')

    <div class="card">
        <div class="card-header">
            <div class="card-title">
                Users
                <a href="{{route('user.create')}}" style="float: right" class="btn btn-blue">Add User</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-hover">

                <thead>
                <th>
                    Name
                </th>
                <th>
                    username
                </th>
                <th>
                    phone
                </th>
                <th>
                    Role
                </th>
                <th>
                    Delete
                </th>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>
                            {{$user->name}}
                        </td>
                        <td>
                            {{$user->username}}
                        </td>
                        <td>
                            {{$user->phone}}
                        </td>
                        <td>
                            {{$user->role}}
                        </td>
                        <td>
                            @if(Auth::user()->id!=$user->id)
                                <a href="{{route('user.delete',['id'=>$user->id])}}" class="btn  btn-danger">
                                    <i class="fas fa-trash"></i> Delete
                                </a>
                            @endif
                        </td>
                    </tr>

                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection