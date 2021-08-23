@extends('Layouts.Admin')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">


            @if(Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
                @php
                Session::forget('success');
                @endphp
            </div>
            @endif


            <div class="panel panel-default">
                <div class="panel-heading">Users Management</div>


                <div class="panel-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>                          
                        </tr>
                        @if($users->count())
                            @foreach($users as $key => $user)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>                                                      
                                </tr>
                            @endforeach
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
