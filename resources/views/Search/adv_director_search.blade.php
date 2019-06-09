@extends('_shared')

@section('content')
    <div class="container">
        <h3>Advance Director Search</h3>
        <hr/>
        <form method="post" class="pd-5" action="SearchDirector">
            <div class="row">
                <div class="col input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">First Name</span>
                    </div>
                    <input name="fname" type="text" class="form-control" value="{{ old('fname') }}">
                </div>
                <div class="col input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Last Name</span>
                    </div>
                    <input name="lname" type="text" class="form-control" value="{{ old('lname') }}">
                </div>
                <div class="col input-group">
                    <input type="submit" class="btn btn-outline-success" value="Search"/>
                </div>
            </div>
            @csrf
        </form>
        <hr/>
        @if(isset($data) and sizeof($data)>0)
            <h5> Search Results for Directors:</h5>
            <table class="table table-hover table-dark">
                <thead>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Details</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
                </thead>
                <tbody>
                @foreach($data as $director)
                    <tr>
                        <td>{{ $director['dir_fname'] }}</td>
                        <td>{{ $director['dir_lname'] }}</td>
                        <td><a href="{{ url('/Details/' . 3 . '/'. $director['dir_id'].'/Details') }}"
                               class="btn btn-xs btn-info">Details</a></td>
                        <td><a href="{{ url('/Edit/' . 3 . '/'. $director['dir_id'].'/Edit') }}" class="btn btn-xs btn-info">Edit</a></td>
                        <td><a onclick="return confirm('Are you sure you wish to delete this Director?');"
                               href="{{ url('/Delete/' . 3 . '/'. $director['dir_id'].'/Delete') }}"
                               class="btn btn-xs btn-danger">Delete</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <hr/>
        @elseif(isset($data))
            <h5> Nothing Found </h5>
        @endif
    </div>
@endsection
