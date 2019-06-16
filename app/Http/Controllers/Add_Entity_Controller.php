<?php

namespace App\Http\Controllers;

class Add_Entity_Controller extends Controller
{
    // 1 function define category
    public function category_define()
    {
        $data = request()->validate([
            'category' => 'required'
        ]);
        $x = request('category');
        if ($x == 1) {
            return View('Add.add_movie');
        } else if ($x == 2) {
            return view('Add.add_actor');
        } else {
            return view('Add.add_director');
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
        if(strlen($tmp)) {
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
    //2 function add (movie/actor/director)
    //function separate each actor and check them whether they are already added if not then add same with genre and director
    public function AddMovie()
    {
        $connect = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
        if (!$connect) {
            die("Connection Failed: " . mysqli_connect_error());
        }
        $mov_title = request('title');
        $mov_overview = request('overview');
        $mov_year = request('year');
        $mov_lang = request('lang');
        $mov_time = request('time');
        $genre = request('genre');
        $cast = request('cast');
        $director = request('director');
        $mov_id = uniqid();
        $query = "INSERT INTO movie(mov_id,mov_title,mov_year,mov_time,mov_lang,mov_overview) values ( '" . $mov_id . "' , '" . $mov_title . "' , " . $mov_year . " , " . $mov_time . " , '" . $mov_lang . "' , '" . $mov_overview . "')";
        $res = mysqli_query($connect, $query);
        if ($res) {
            echo "NEW Movie ADDED";
        } else {
            die("Error: " . $query . "<br>" . mysqli_error($connect));
        }
        $this->AddMovieCast($cast, $mov_id,$connect);
        $this->AddMovieGenre($genre, $mov_id,$connect);
        $this->AddMovieDir($director, $mov_id,$connect);
        mysqli_close($connect);
        return redirect('Add');
    }

    public function AddMovieCast(string $xd, string $mov_id,$connect)
    {
        $ara = $this->comma_separator($xd);
        for ($i = 0; $i < sizeof($ara); $i += 2) {
            $id = $this->HasActor($ara[$i], $ara[$i + 1], 'M',$connect);
            if ($id == "-1") {
                $id = $this->AddActorM($ara[$i], $ara[$i + 1], 'M',$connect);
            }
            $sql = "INSERT INTO movie_cast (act_id,mov_id) values('" . $id . "' , '" . $mov_id . "')";
            $res = mysqli_query($connect, $sql);
            if (!$res) {
                die("Error: " . $sql . "<br>" . mysqli_error($connect));
            }
        }
    }

    public function AddMovieGenre(string $xd, string $mov_id,$connect)
    {
        $ara = $this->comma_separator($xd);
        for ($i = 0; $i < sizeof($ara); $i++) {
            $id = $this->HasGenre($ara[$i],$connect);
            if ($id == "-1") {
                $id = $this->AddGenre($ara[$i],$connect);
            }
            $sql = "INSERT INTO movie_genres (mov_id,gen_id) values('" . $mov_id . "' , '" . $id . "')";
            $res = mysqli_query($connect, $sql);
            if (!$res) {
                die("Error: " . $sql . "<br>" . mysqli_error($connect));
            }
        }
    }

    public function AddMovieDir(string $xd, string $mov_id,$connect)
    {
        $ara = $this->comma_separator($xd);
        for ($i = 0; $i < sizeof($ara); $i += 2) {
            $id = $this->HasDirector($ara[$i], $ara[$i + 1],$connect);
            if ($id == "-1") {
                $id = $this->AddDirectorM($ara[$i], $ara[$i + 1],$connect);
            }
            $sql = "INSERT INTO movie_direction (dir_id,mov_id) values('" . $id . "' , '" . $mov_id . "')";
            $res = mysqli_query($connect, $sql);
            if (!$res) {
                die("Error: " . $sql . "<br>" . mysqli_error($connect));
            }
        }
    }

    public function HasActor(string $act_fname,string $act_lname,string  $act_gender,$connect)
    {
        $sql = "SELECT * FROM actor WHERE act_fname ='" . $act_fname . "' AND act_lname ='" . $act_lname . "' AND act_gender = '" . $act_gender . "' ORDER BY act_id ASC";
        $res = mysqli_query($connect, $sql);
        if ($res) {
            $ans = mysqli_fetch_all($res, MYSQLI_ASSOC);
            mysqli_free_result($res);
            if (sizeof($ans) > 0)
                return $ans[0]['act_id'];
            else return "-1";
        } else {
            echo "Error_ACT: " . $sql . "<br>" . mysqli_error($connect);
        }
        return "-1";
    }

    public function HasDirector(string $dir_fname,string $dir_lname,$connect)
    {
        $sql = "SELECT * FROM director WHERE dir_fname = '" . $dir_fname . "' AND dir_lname = '" . $dir_lname . "' ORDER BY dir_id ASC";
        $res = mysqli_query($connect, $sql);
        if ($res) {
            $ans = mysqli_fetch_all($res, MYSQLI_ASSOC);
            mysqli_free_result($res);
            if (sizeof($ans) > 0)
                return $ans[0]['dir_id'];
            else return "-1";
        } else {
            echo "Error_Dir: " . $sql . "<br>" . mysqli_error($connect);
        }
        return "-1";
    }

    public function HasGenre(string $gen_title,$connect)
    {
        $sql = "SELECT * FROM genres WHERE gen_title='" . $gen_title . "'";
        $res = mysqli_query($connect, $sql);
        if ($res) {
            $ans = mysqli_fetch_all($res, MYSQLI_ASSOC);
            mysqli_free_result($res);
            if (sizeof($ans) > 0)
                return $ans[0]['gen_id'];
            else return "-1";
        } else {
            echo "Error_Dir: " . $sql . "<br>" . mysqli_error($connect);
        }
        return "-1";
    }

    public function AddGenre(string $gen_title,$connect)
    {
        $hasgen = $this->HasGenre($gen_title,$connect);
        if ($hasgen != "-1") return $hasgen;
        $id = uniqid();
        $query = "INSERT INTO genres (gen_id,gen_title) values('" . $id . "', '" . $gen_title . "')";
        $res = mysqli_query($connect, $query);
        if ($res) {
            //echo "NEW Genre ADDED";
        } else {
            die("Error: " . $query . "<br>" . mysqli_error($connect));
        }
        return $id;
    }

    public function AddActor()
    {
        $act_fname = request('fname');
        $act_lname = request('lname');
        $act_gender = request('gender');
        $connect = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
        if (!$connect) {
            die("Connection Failed: " . mysqli_connect_error());
        }

        $hasid = $this->HasActor($act_fname, $act_lname, $act_gender,$connect);
        if ($hasid != "-1") return $hasid;
        $id = uniqid();
        $query = "INSERT INTO actor (act_id,act_fname,act_lname,act_gender) values('" . $id . "', '" . $act_fname . "','" . $act_lname . "','" . $act_gender . "')";
        $res = mysqli_query($connect, $query);
        if ($res) {
            echo "NEW Actor ADDED";
            mysqli_close($connect);
            return redirect('Add');
        } else {
            die("Error: " . $query . "<br>" . mysqli_error($connect));
        }
    }
    public function AddActorM(string $act_fname,string $act_lname,string $act_gender,$connect)
    {
        $id = uniqid();
        $query = "INSERT INTO actor (act_id,act_fname,act_lname,act_gender) values('" . $id . "', '" . $act_fname . "','" . $act_lname . "','" . $act_gender . "')";
        $res = mysqli_query($connect, $query);
        if ($res) {
            //echo "NEW Actor ADDED";
        } else {
            die("Error: " . $query . "<br>" . mysqli_error($connect));
        }
        return $id;
    }

    public function AddDirector()
    {
        $dir_fname = request('fname');
        $dir_lname = request('lname');
        $connect = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
        if (!$connect) {
            die("Connection Failed: " . mysqli_connect_error());
        }

        $hasid = $this->HasDirector($dir_fname, $dir_lname,$connect);
        if ($hasid != "-1") return $hasid;
        $id = uniqid();
        $query = "INSERT INTO director (dir_id,dir_fname,dir_lname) values('" . $id . "', '" . $dir_fname . "','" . $dir_lname . "')";
        $res = mysqli_query($connect, $query);
        if ($res) {
            echo "NEW Director ADDED";
        } else {
            die( "Error: " . $query . "<br>" . mysqli_error($connect));
        }
        mysqli_close($connect);
        return redirect('Add');
    }
    public function AddDirectorM(string $dir_fname,string $dir_lname,$connect)
    {
        $id = uniqid();
        $query = "INSERT INTO director (dir_id,dir_fname,dir_lname) values('" . $id . "', '" . $dir_fname . "','" . $dir_lname . "')";
        $res = mysqli_query($connect, $query);
        if ($res) {
            //echo "NEW Director ADDED";
        } else {
            die( "Error: " . $query . "<br>" . mysqli_error($connect));
        }
        return $id;
    }
}
