<?php

namespace App\Http\Controllers;

class AdvanceSearch_Controller extends Controller
{
    public function category_define()
    {
        $data = request()->validate([
            'category' => 'required'
        ]);
        $x = request('category');
        if ($x == 1) {
            return View('Search.adv_movie_search');
        } else if ($x == 2) {
            return view('Search.adv_actor_search');
        } else {
            return view('Search.adv_director_search');
        }
    }

    public function comma_separator(string $xd)
    {
        $tmp = "";
        $ans = Array();
        $idx = 0;
        for ($i = 0; $i < strlen($xd); $i++) {
            if ($xd[$i] == ',' || $xd[$i] == '/' || $xd[$i] == '|') {
                if (strlen($tmp) == 0) continue;
                else {
                    $name1 = "";
                    $j = 0;
                    for (; $j < strlen($tmp); $j++) {
                        if ($tmp[$j] == ' ') break;
                        $name1 = $name1 . $tmp[$j];
                    }
                    $name2 = "";
                    for (; $j < strlen($tmp); $j++) {
                        $name2 = $name2 . $tmp[$j];
                    }
                    $tmp = "";
                    array_push($ans, $name1);
                    array_push($ans, $name2);
                    $idx++;
                }
            } else {
                $tmp = $tmp . $xd[$i];
            }
        }
        if (strlen($tmp)) {
            $name1 = "";
            $j = 0;
            for (; $j < strlen($tmp); $j++) {
                if ($tmp[$j] == ' ') break;
                $name1 = $name1 . $tmp[$j];
            }
            $name2 = "";
            for (; $j < strlen($tmp); $j++) {
                $name2 = $name2 . $tmp[$j];
            }
            array_push($ans, $name1);
            array_push($ans, $name2);
        }
        return $ans;
    }

    public function Search_Actor_Of_Movie($movie_id, $connect)
    {
        $sql = "SELECT * FROM actor WHERE act_id IN( SELECT act_id FROM movie_cast WHERE mov_id IN ( SELECT mov_id FROM movie WHERE mov_id='" . $movie_id . "'));";
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

    public function Search_movie()
    {
        $connect = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
        if (!$connect) {
            die("Connection Failed: " . mysqli_connect_error());
        }
        $title = request('title');
        $lang = request('lang');
        $rel_from = request('rl_from');
        $rel_to = request('rl_to');
        $run_from = request('time_from');
        $run_to = request('time_to');
        $rel_from--;
        $rel_to++;
        $run_from--;
        $run_to++;
        $sql = "SELECT * FROM movie WHERE mov_title LIKE '%" . $title . "%' AND mov_lang LIKE '%" . $lang . "%' AND mov_year<" . $rel_to . " AND mov_year>" . $rel_from . " AND mov_time<" . $run_to . " AND mov_time>" . $run_from . " ORDER BY mov_year ASC";
        $res = mysqli_query($connect, $sql);
        if ($res) {
            $ans = mysqli_fetch_all($res, MYSQLI_ASSOC);
            mysqli_free_result($res);
            return View('Search.adv_movie_search', [
                'data' => $ans
            ]);
        } else {
            die("Error_Mov: " . $sql . "<br>" . mysqli_error($connect));
        }
    }

    public function Search_actor()
    {
        $connect = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
        if (!$connect) {
            die("Connection Failed: " . mysqli_connect_error());
        }
        $fname = request('fname');
        $lname = request('lname');
        $gender = request('gender');
        $sql = "SELECT * FROM actor WHERE act_fname LIKE '%" . $fname . "%' AND act_lname LIKE '%" . $lname . "%' AND act_gender LIKE '%" . $gender . "%' ORDER BY act_id ASC";
        $res = mysqli_query($connect, $sql);
        if ($res) {
            $ans = mysqli_fetch_all($res, MYSQLI_ASSOC);
            mysqli_free_result($res);
            return View('Search.adv_actor_search', [
                'data' => $ans
            ]);
            //   return $ans;
        } else {
            die("Error_Mov: " . $sql . "<br>" . mysqli_error($connect));
        }
    }

    public function Search_director()
    {
        $connect = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
        if (!$connect) {
            die("Connection Failed: " . mysqli_connect_error());
        }
        $fname = request('fname');
        $lname = request('lname');
        $sql = "SELECT * FROM director WHERE dir_fname LIKE '%" . $fname . "%' AND dir_lname LIKE '%" . $lname . "%' ORDER BY dir_id ASC";
        $res = mysqli_query($connect, $sql);
        if ($res) {
            $ans = mysqli_fetch_all($res, MYSQLI_ASSOC);
            mysqli_free_result($res);
            return View('Search.adv_director_search', [
                'data' => $ans
            ]);
            //   return $ans;
        } else {
            die("Error_Mov: " . $sql . "<br>" . mysqli_error($connect));
        }
    }

}
