@extends('_shared')

@section('content')
    <div class="container">
        <form method="post" action="AddDirector" class="pd-5">
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
            <br>
            <hr>
            <button type="submit" class="btn btn-outline-success"> Submit</button>
            @csrf
        </form>
    </div>
@endsection
