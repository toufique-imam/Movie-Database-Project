@extends('_shared')

@section('content')
    <div class="container">
        <form method="post" action="AddMovie" class="pd-5">
            <label for="title">
                Title :
            </label>
            <input name="title" type="text" class="form-control" placeholder="Title.. " required
                   value="{{ old('title') }}"/>

            <label for="lang">
                Language :
            </label>
            <input name="lang" type="text" class="form-control" placeholder="Language" required
                   value="{{ old('lang') }}"/>
            <label for="year">
                Year :
            </label>

            <input name="year" value="{{ old("year") }}" type="number" class="form-control" placeholder="Release Date"
                   required min="1000" max="9999"/>
            <label for="time">
                Run Time :
            </label>

            <input min="0" max="9999" name="time" value="{{ old("time") }}" type="number" class="form-control" placeholder="Run Time"
                   required/>
            <label for="genre">
                Genre:
            </label>
            <input name="genre" value="{{ old('genre') }}" type="text" class="form-control"
                   placeholder="Genre Separate with comma" required/>
            <label for="director">
                Director:
            </label>
            <input name="director" value="{{ old('director') }}" type="text" class="form-control"
                   placeholder="Director" required>
            <label for="cast">
                Cast:
            </label>
            <input name="cast" value="{{ old('cast') }}" type="text" class="form-control"
                   placeholder="Cast List Separate with comma" required/>

            <label for="overview">
                Overview:
            </label>
            <textarea name="overview" value="" {{ old('overview') }} class="form-control"
                      placeholder="OverView" required></textarea>
            <br>
            <hr>
            <button type="submit" class="btn btn-outline-success"> Submit</button>
            @csrf
        </form>
    </div>
@endsection
