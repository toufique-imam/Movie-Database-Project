@extends('_shared')

@section('content')
    <div class="container">
        <h3>Advance Search</h3>
        <hr/>
        <form class="pd-5" action="srch_category" method="post">
            <div class="input-group">

                <div class="input-group-prepend">
                    <label class="input-group-text" for="category">Category</label>
                </div>
                <select name="category" id="category" class="custom-select">
                    <option value="" disabled class="form-control">Select A Category</option>
                    <option value="1" class="form-control">Movie</option>
                    <option value="2" class="form-control">Actor</option>
                    <option value="3" class="form-control">Director</option>
                </select>
                <div class="input-group-postpend">
                    <input type="submit" class="btn btn-outline-success" value="Go"/>
                </div>
            </div>
            @csrf
        </form>
    </div>
@endsection
