@extends('_shared')

@section('content')
    <div class="container">
        <h3>Advance Movie Search</h3>
        <hr/>
        <form method="post" class="pd-5" action="SearchMovie">
            <div class="row">
                <div class="col input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Title</span>
                    </div>
                    <input name="title" type="text" class="form-control" value="{{ old('title') }}">
                </div>
                <div class="col input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Language</span>
                    </div>
                    <input name="lang" type="text" class="form-control" value="{{ old('lang') }}">
                </div>
            </div>
            <br/>
            <label class="text-dark">Release Year:</label>
            <div class="row">
                <div class="col input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">From</span>
                    </div>
                    <input min="1000" max="9999" name="rl_from" type="number" class="form-control" value="{{ 1000 }}">
                </div>
                <div class="col input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">To</span>
                    </div>
                    <input max="9999" min="1000" name="rl_to" type="number" class="form-control" value="{{ 9999 }}">
                </div>
            </div>
            <br/>
            <label class="text-dark">Run Time:</label>
            <div class="row">
                <div class="col input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">From</span>
                    </div>
                    <input name="time_from" min="0" max="9999" type="number" class="form-control" value="{{ 0 }}">
                </div>
                <div class="col input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">To</span>
                    </div>
                    <input name="time_to" type="number" max="9999" min="0" class="form-control" value="{{ 9999 }}">
                </div>
            </div>
            <br>
            <button class="btn btn-outline-dark" type="Submit">Search</button>
            @csrf
        </form>
        <hr>
        @if(isset($data) && sizeof($data))
            <h5> Search Results for Movies:</h5>
            <table class="table table-hover table-dark">
                <thead>
                <th scope="col">Title</th>
                <th scope="col">Release Year</th>
                <th scope="col">Run Time</th>
                <th scope="col">Language</th>
                <th scope="col">Overview</th>
                </thead>
                <tbody>
                @foreach($data as $movie)
                    <tr>
                        <td>{{ $movie['mov_title'] }}</td>
                        <td>{{ $movie['mov_year'] }}</td>
                        <td>{{ $movie['mov_time'] }}</td>
                        <td>{{ $movie['mov_lang'] }}</td>
                        <td>{{ $movie['mov_overview'] }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <hr/>
        @endif
        @if(isset($data) && sizeof($data)==0)
            <h5> Nothing Found </h5>
        @endif
    </div>
@endsection
