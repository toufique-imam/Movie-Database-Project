@extends('_shared')

@section('content')
    <div class="container">
        @if(isset($movie))
            <div class="card text-center">
                <div class="card-header">
                    <h6>{{ $movie['mov_year'] }} </h6>
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $movie['mov_title'] }}</h5>
                    <p class="card-text">Run Time: {{ $movie['mov_time'] }}</p>
                    <p class="card-text">Language: {{ $movie['mov_lang'] }}</p>
                    <p class="card-text">Overview: {{ $movie['mov_overview'] }}</p>
                </div>
                <div class="card-footer text-muted">
                    <div class="btn-group" role="group">
                        @foreach($movie['mov_genres'] as $genre)
                            <button type="button" class="btn btn-outline-info">{{ $genre['gen_title'] }}</button>
                        @endforeach
                    </div>
                </div>
            </div>
            <hr/>
            <h5> Cast List:</h5>
            <table class="table table-hover table-secondary">
                <thead>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Gender</th>
                </thead>
                <tbody>
                @foreach($movie['mov_actors'] as $actor)
                    <tr>
                        <td>{{ $actor['act_fname'] }}</td>
                        <td>{{ $actor['act_lname'] }}</td>
                        <td>{{ $actor['act_gender'] }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <hr/>
            <h5>Directors:</h5>
            <table class="table table-hover table-secondary">
                <thead>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                </thead>
                <tbody>
                @foreach($movie['mov_directors'] as $director)
                    <tr>
                        <td>{{ $director['dir_fname'] }}</td>
                        <td>{{ $director['dir_lname'] }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <hr/>
        @elseif(isset($actor))
            <h5>{{ $actor['act_fname'] }} {{ $actor['act_lname'] }}</h5>
            <h7>Gender: {{ $actor['act_gender']}}</h7>
            <hr/>
            @if(sizeof($actor['act_movie'])>0)
                <h6>Movies:</h6>
                <table class="table table-hover table-dark">
                    <thead>
                    <th scope="col">Title</th>
                    <th scope="col">Release Year</th>
                    <th scope="col">Run Time</th>
                    <th scope="col">Language</th>
                    <th scope="col">Overview</th>
                    </thead>
                    <tbody>
                    @foreach($actor['act_movie'] as $movie)
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
            @endif
        @elseif(isset($director))
            <h5>{{ $director['dir_fname'] }} {{ $director['dir_lname'] }}</h5>
            <hr/>
            @if(sizeof($director['dir_movie'])>0)
                <h6>Movies:</h6>
                <table class="table table-hover table-dark">
                    <thead>
                    <th scope="col">Title</th>
                    <th scope="col">Release Year</th>
                    <th scope="col">Run Time</th>
                    <th scope="col">Language</th>
                    <th scope="col">Overview</th>
                    </thead>
                    <tbody>
                    @foreach($director['dir_movie'] as $movie)
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
            @endif
        @endif
    </div>
@endsection
