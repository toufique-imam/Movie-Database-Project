@extends('_shared')

@section('content')
    <div class="container">
        <form method="post" action="AddActor" class="pd-5">
            <label for="fname">
                First Name :
            </label>
            <input name="fname" type="text" class="form-control" placeholder="First Name" required
                   value="{{ old('fname') }}"/>

            <label for="lname">
                Last Name :
            </label>
            <input name="lname" type="text" class="form-control" placeholder="Last Name" required
                   value="{{ old('lname') }}"/>
            <div class="input-group">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="category">Gender</label>
                </div>
                <select name="gender" id="gender" class="custom-select">
                    <option value="" disabled class="form-control">Select Gender</option>
                    <option value="M" class="form-control">Male</option>
                    <option value="F" class="form-control">Female</option>
                    <option value="H" class="form-control">Something else</option>
                </select>
            </div>
            <br>
            <hr>
            <button type="submit" class="btn btn-outline-success"> Submit</button>
            @csrf
        </form>
    </div>
@endsection
