<?php

namespace App\Http\Controllers;

class DetailsView_Controller extends Controller
{
    public function Search_Actor_Of_Movie($movie_id, $connect)
    {
        //$sql = "SELECT * FROM actor WHERE act_id IN( SELECT act_id FROM movie_cast WHERE mov_id IN ( SELECT mov_id FROM movie WHERE mov_id='" . $movie_id . "'));";
        $sql = "SELECT * FROM actor WHERE act_id IN ( SELECT act_id FROM movie_cast INNER JOIN movie on movie.mov_id=movie_cast.mov_id AND movie.mov_id='" . $movie_id . "')";
        $res = mysqli_query($connect, $sql);
        if ($res) {
            $ans = mysqli_fetch_all($res, MYSQLI_ASSOC);
            mysqli_free_result($res);
            return $ans;
        } else {
            die("Error_Act_Mov: " . $sql . "<br>" . mysqli_error($connect));
        }
    }

    public function Search_Director_Of_Movie($movie_id, $connect)
    {
        $sql = "SELECT * FROM director WHERE dir_id IN( SELECT dir_id FROM movie_direction WHERE mov_id IN ( SELECT mov_id FROM movie WHERE mov_id='" . $movie_id . "'));";
        $res = mysqli_query($connect, $sql);
        if ($res) {
            $ans = mysqli_fetch_all($res, MYSQLI_ASSOC);
            mysqli_free_result($res);
            return $ans;
        } else {
            die("Error_Dir_Mov: " . $sql . "<br>" . mysqli_error($connect));
        }
    }

    public function Search_Genre_Of_Movie($movie_id, $connect)
    {
        $sql = "SELECT * FROM genres WHERE gen_id IN( SELECT gen_id FROM movie_genres WHERE mov_id IN ( SELECT mov_id FROM movie WHERE mov_id='" . $movie_id . "'));";
        $res = mysqli_query($connect, $sql);
        if ($res) {
            $ans = mysqli_fetch_all($res, MYSQLI_ASSOC);
            mysqli_free_result($res);
            return $ans;
        } else {
            die("Error_Dir_Mov: " . $sql . "<br>" . mysqli_error($connect));
        }
    }

    public function Search_Movie_Of_Actor($act_id, $connect)
    {
        $sql = "SELECT * FROM movie WHERE mov_id IN ( SELECT mov_id FROM movie_cast WHERE act_id IN ( SELECT act_id FROM actor WHERE act_id='" . $act_id . "'));";
        $res = mysqli_query($connect, $sql);
        if ($res) {
            $ans = mysqli_fetch_all($res, MYSQLI_ASSOC);
            mysqli_free_result($res);
            return $ans;
        } else {
            die("Error_Dir_Mov: " . $sql . "<br>" . mysqli_error($connect));
        }
    }

    public function Search_Movie_Of_Director($dir_id, $connect)
    {
        $sql = "SELECT * FROM movie WHERE mov_id IN( SELECT mov_id FROM movie_direction WHERE dir_id IN ( SELECT dir_id FROM director WHERE dir_id='" . $dir_id . "'));";
        $res = mysqli_query($connect, $sql);
        if ($res) {
            $ans = mysqli_fetch_all($res, MYSQLI_ASSOC);
            mysqli_free_result($res);
            return $ans;
        } else {
            die("Error_Dir_Mov: " . $sql . "<br>" . mysqli_error($connect));
        }
    }

    public function getMovieData($movie_id, $connect)
    {
        $sql = "SELECT * FROM movie WHERE mov_id = '" . $movie_id . "'";
        $res = mysqli_query($connect, $sql);
        if ($res) {
            $ans = mysqli_fetch_all($res, MYSQLI_ASSOC);
            mysqli_free_result($res);
            $actors = $this->Search_Actor_Of_Movie($ans[0]['mov_id'], $connect);
            $ans[0]['mov_actors'] = $actors;
            $directors = $this->Search_Director_Of_Movie($ans[0]['mov_id'], $connect);
            $ans[0]['mov_directors'] = $directors;
            $genres = $this->Search_Genre_Of_Movie($ans[0]['mov_id'], $connect);
            $ans[0]['mov_genres'] = $genres;
            return $ans[0];
        } else {
            die("Error_Mov: " . $sql . "<br>" . mysqli_error($connect));
        }
    }

    public function getDirectorData($dir_id, $connect)
    {
        $sql = "SELECT * FROM director WHERE dir_id = '" . $dir_id . "'";
        $res = mysqli_query($connect, $sql);
        if ($res) {
            $ans = mysqli_fetch_all($res, MYSQLI_ASSOC);
            mysqli_free_result($res);
            $movie=$this->Search_Movie_Of_Director($ans[0]['dir_id'],$connect);
            $ans[0]['dir_movie']=$movie;
            return $ans[0];
        } else {
            die("Error_Dir: " . $sql . "<br>" . mysqli_error($connect));
        }
    }

    public function getActorData($act_id, $connect)
    {
        $sql = "SELECT * FROM actor WHERE act_id = '" . $act_id . "'";
        $res = mysqli_query($connect, $sql);
        if ($res) {
            $ans = mysqli_fetch_all($res, MYSQLI_ASSOC);
            mysqli_free_result($res);
            $movie=$this->Search_Movie_Of_Actor($ans[0]['act_id'],$connect);
            $ans[0]['act_movie']=$movie;
            return $ans[0];
        } else {
            die("Error_Mov: " . $sql . "<br>" . mysqli_error($connect));
        }
    }

    public function Details($category, $problem_id)
    {
        $connect = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
        if (!$connect) {
            die("Connection Failed: " . mysqli_connect_error());
        }
        if ($category == 1) {
            $movie = $this->getMovieData($problem_id, $connect);
            return View('Details.DetailsView',[
               'movie'=>$movie
            ]);
        } else if ($category == 2) {
            $actor = $this->getActorData($problem_id, $connect);
            return View('Details.DetailsView',[
                'actor'=>$actor
            ]);
        } else if ($category == 3) {
            $director = $this->getDirectorData($problem_id, $connect);
            return View('Details.DetailsView',[
                'director'=>$director
            ]);
        }
        else{
            return null;
        }
    }

}
