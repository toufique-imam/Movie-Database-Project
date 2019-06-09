@extends('_shared')

@section('content')
    <form method="post" action="Search" class="pd-5">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search" name="search_str" value="{{ old('search_str') }}">
            <div class="input-group-append">
                <select class="btn btn-outline-primary" name="search_cat" id="search_cat">
                    <option value="" disabled class="btn-outline-dark">Select Category</option>
                    <option value="0" class="btn-outline-dark">All</option>
                    <option value="1" class="btn-outline-dark">Movie</option>
                    <option value="2" class="btn-outline-dark">Actor</option>
                    <option value="3" class="btn-outline-dark">Director</option>
                </select>
            </div>
            <input class="input-group-append btn btn-danger" type="submit" value="Search">
        </div>
        @csrf
    </form>
    <hr/>
    @if(isset($movies) and sizeof($movies)>0)
        <h5> Search Results for Movies:</h5>
        <table class="table table-hover table-dark">
            <thead>
                <th scope="col">Title</th>
                <th scope="col">Release Year</th>
                <th scope="col">Run Time</th>
                <th scope="col">Language</th>
                <th scope="col">Overview</th>
                <th scope="col">Edit</th>
            </thead>
            <tbody>
                @foreach($movies as $movie)
                    <tr>
                        <td>{{ $movie['mov_title'] }}</td>
                        <td>{{ $movie['mov_year'] }}</td>
                        <td>{{ $movie['mov_time'] }}</td>
                        <td>{{ $movie['mov_lang'] }}</td>
                        <td>{{ $movie['mov_overview'] }}</td>
                        <td><a href="{{ url('/Edit/' . 1 . '/'. $movie['mov_id'].'/Edit') }}" class="btn btn-xs btn-info pull-right">Edit</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <hr/>
    @endif
    @if(isset($actors) and sizeof($actors)>0)
        <h5> Search Results for Actors:</h5>
        <table class="table table-hover table-dark">
            <thead>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Gender</th>
            <th scope="col">Edit</th>
            </thead>
            <tbody>
            @foreach($actors as $actor)
                <tr>
                    <td>{{ $actor['act_fname'] }}</td>
                    <td>{{ $actor['act_lname'] }}</td>
                    <td>{{ $actor['act_gender'] }}</td>
                    <td><a href="{{ url('/Edit/' . 2 . '/'. $actor['act_id'].'/Edit') }}" class="btn btn-xs btn-info pull-right">Edit</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <hr/>
    @endif
    @if(isset($directors) and sizeof($directors)>0)
        <h5> Search Results for Directors:</h5>
        <table class="table table-hover table-dark">
            <thead>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Edit</th>
            </thead>
            <tbody>
            @foreach($directors as $director)
                <tr>
                    <td>{{ $director['dir_fname'] }}</td>
                    <td>{{ $director['dir_lname'] }}</td>
                    <td><a href="{{ url('/Edit/' . 3 . '/'. $director['dir_id'].'/Edit') }}" class="btn btn-xs btn-info pull-right">Edit</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <hr/>
    @endif
    @if(isset($actors) and isset($directors) and isset($movies) and sizeof($directors)<1 && sizeof($actors)<1 && sizeof($movies)<1)
        <h5> Nothing Found </h5>
    @endif
@endsection
