@extends('_shared')

@section('content')
    <h1>Advance Search</h1>
    <div class="container">
        <form class="pd-5" action="category" method="post">
            <div class="form-group">
                <label >
                    Category:
                    <select name="category" id="category">
                        <option value="" disabled class="form-control">Select A Category</option>
                        <option value="1" class="form-control">Movie</option>
                        <option value="2" class="form-control">Actor</option>
                        <option value="3" class="form-control">Director</option>
                    </select>
                </label>
                <button type="submit" class="btn btn-outline-dark">Go</button>
            </div>
            @csrf
        </form>
    </div>
@endsection
