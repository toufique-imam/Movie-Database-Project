@extends('_shared')
@section('content')
    @if(isset($movie))
        <div class="container">
            <form method="post" action="EditMovie" class="pd-5">
                <input hidden name="id" type="text" value="{{ $movie["mov_id"] }}"/>
                <label for="title">
                    Title :
                </label>
                <input name="title" type="text" class="form-control" placeholder="Title.. " required
                       value="{{ $movie["mov_title"] }}"/>

                <label for="lang">
                    Language :
                </label>
                <input name="lang" type="text" class="form-control" required
                       value="{{ $movie["mov_lang"] }}"/>
                <label for="year">
                    Year :
                </label>
                <input name="year" value="{{ $movie["mov_year"] }}" type="number" class="form-control"
                       required min="1000" max="9999"/>
                <label for="time">
                    Run Time :
                </label>
                <input min="0" max="9999" name="time" value="{{ $movie["mov_time"] }}" type="number"
                       class="form-control"
                       required/>
                <!--
                <label for="genre">
                    Genre:
                </label>
                <input name="genre" value=" $movie['mov_genre'] }}" type="text" class="form-control"
                       placeholder="Genre Separate with comma" required/>
                <label for="director">
                    Director:
                </label>
                <input name="director" value=" $movie['mov_director'] }}" type="text" class="form-control"
                       placeholder="Director" required>
                <label for="cast">
                    Cast:
                </label>
                <input name="cast" value=" $movie['mov_cast'] }}" type="text" class="form-control"
                       placeholder="Cast List Separate with comma" required/>
                      -->
                <label for="overview">
                    Overview:
                </label>
                <textarea name="overview"  class="form-control"
                           required>{{ $movie["mov_overview"] }}</textarea>
                <br>
                <hr>
                <button type="submit" class="btn btn-outline-success"> Submit</button>
                @csrf
            </form>
        </div>
    @elseif(isset($actor))
        <div class="container">
            <form method="post" action="EditActor" class="pd-5">
                <input name="id" hidden value="{{ $actor['act_id'] }}"/>
                <label for="fname">
                    First Name :
                </label>
                <input name="fname" type="text" class="form-control" placeholder="First Name" required
                       value="{{ $actor['act_fname'] }}"/>
                <label for="lname">
                    Last Name :
                </label>
                <input name="lname" type="text" class="form-control" placeholder="Last Name" required
                       value="{{ $actor['act_lname'] }}"/>
                <label for="gender">
                    Gender :
                </label>
                <select name="gender" id="gender">
                    <option value="" disabled class="form-control">Select Gender</option>
                    <option value="M" class="form-control">Male</option>
                    <option value="F" class="form-control">Female</option>
                    <option value="H" class="form-control">Something else</option>
                </select>
                <br>
                <hr>
                <button type="submit" class="btn btn-outline-success"> Submit</button>
                @csrf
            </form>
        </div>
    @elseif(isset($director))
        <div class="container">
            <form method="post" action="EditDirector" class="pd-5">
                <input name="id" hidden value="{{ $director['dir_id'] }}"/>
                <label for="fname">
                    First Name :
                </label>
                <input name="fname" type="text" class="form-control" placeholder="First Name" required
                       value="{{ $director['dir_fname'] }}"/>

                <label for="lname">
                    Last Name :
                </label>
                <input name="lname" type="text" class="form-control" placeholder="Last Name" required
                       value="{{ $director['dir_lname'] }}"/>
                <br>
                <hr>
                <button type="submit" class="btn btn-outline-success"> Submit</button>
                @csrf
            </form>
        </div>
    @endif
@endsection
