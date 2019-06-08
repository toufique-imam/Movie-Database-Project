@extends('_shared')

@section('content')
    <div class="container">
        <h3>Advance Actor Search</h3>
        <hr/>
        <form method="post" class="pd-5" action="SearchActor">
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
            </div>
            <br/>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="gender">Gender</label>
                </div>
                <select name="gender" id="gender" class="custom-select">
                    <option value="" disabled class="form-control">Select Gender</option>
                    <option value="" class="form-control">Any</option>
                    <option value="M" class="form-control">Male</option>
                    <option value="F" class="form-control">Female</option>
                    <option value="H" class="form-control">Something else</option>
                </select>
            </div>
            <br>
            <button class="btn btn-outline-dark" type="Submit">Search</button>
            @csrf
        </form>
        <hr/>
        @if(isset($data) and sizeof($data)>0)
            <h5> Search Results for Actors:</h5>
            <table class="table table-hover table-dark">
                <thead>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Gender</th>
                </thead>
                <tbody>
                @foreach($data as $actor)
                    <tr>
                        <td>{{ $actor['act_fname'] }}</td>
                        <td>{{ $actor['act_lname'] }}</td>
                        <td>{{ $actor['act_gender'] }}</td>
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
