@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Actor {{ $actor->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('/admin/actors') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/actors/' . $actor->id . '/edit') }}" title="Edit Actor"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/actors', $actor->id],
                            'style' => 'display:inline'
                        ]) !!}
                        @if ($actor->movies->count() == 0)
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Actor',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        @endif
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $actor->id }}</td>
                                    </tr>
                                    <tr><th> Name </th><td> {{ $actor->name }} </td></tr><tr><th> Fakename </th><td> {{ $actor->fakename }} </td></tr><tr><th> Date </th><td> {{ $actor->date }} </td></tr>
                                    <tr><th> Gender </th><td> {{ $actor->gender }} </td></tr>
                                    <tr><th> Oscars </th><td> {{ $actor->oscars }} </td></tr>
                                    <tr><th> Nominated </th><td> {{ $actor->nominated }} </td></tr>
                                    <th>List of movies</th>
                                    <td>
                                    @forelse ($actor->movies as $movie)
                                        <tr><td><strong>[{{$loop->iteration}}] </strong>{{$movie->title}}</td></tr>
                                    @empty
                                        No movies registered
                                    @endforelse
                                    </td>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
