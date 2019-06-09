<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class Edit_Entity_Controller extends Controller
{
    //9 function define category
    //10 edit (movie,actor,director)
    public function EditData($category, $problem_id)
    {
        $connect = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
        if (!$connect) {
            die("Connection Failed: " . mysqli_connect_error());
        }
        if ($category == 1) {
            $mov_data=$this->find_movie($problem_id,$connect);
            //dd($mov_data);
            mysqli_close($connect);
            return View('Edit.EditView',[
               'movie'=>$mov_data[0]
            ]);
        } else if ($category == 2) {
            $act_data=$this->find_actor($problem_id,$connect);
            mysqli_close($connect);
            return View('Edit.EditView',[
               'actor'=>$act_data[0]
            ]);
        } else if ($category == 3) {
            $dir_data=$this->find_director($problem_id,$connect);
            mysqli_close($connect);
            return View('Edit.EditView',[
               'director'=>$dir_data[0]
            ]);
        }
    }

    public function find_movie($mov_id, $connect)
    {
        $sql = "SELECT * FROM movie WHERE mov_id = '" . $mov_id . "'";
        $res = mysqli_query($connect, $sql);
        if ($res) {
            $ans = mysqli_fetch_all($res, MYSQLI_ASSOC);
            mysqli_free_result($res);
            return $ans;
        } else {
            die("Error_Mov: " . $sql . "<br>" . mysqli_error($connect));
        }
    }
    public function find_actor($act_id, $connect)
    {
        $sql = "SELECT * FROM actor WHERE act_id = '" . $act_id . "'";
        $res = mysqli_query($connect, $sql);
        if ($res) {
            $ans = mysqli_fetch_all($res, MYSQLI_ASSOC);
            mysqli_free_result($res);
            return $ans;
        } else {
            die("Error_Mov: " . $sql . "<br>" . mysqli_error($connect));
        }
    }
    public function find_director($dir_id, $connect)
    {
        $sql = "SELECT * FROM director WHERE dir_id = '" . $dir_id . "'";
        $res = mysqli_query($connect, $sql);
        if ($res) {
            $ans = mysqli_fetch_all($res, MYSQLI_ASSOC);
            mysqli_free_result($res);
            return $ans;
        } else {
            die("Error_Mov: " . $sql . "<br>" . mysqli_error($connect));
        }
    }

    public function EditMovie(){
        $connect = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
        if (!$connect) {
            die("Connection Failed: " . mysqli_connect_error());
        }
        $mov_title = request('title');
        $mov_overview = request('overview');
        $mov_year = request('year');
        $mov_lang = request('lang');
        $mov_time = request('time');
        $mov_id = request('id');
        $sql="UPDATE `movie` SET `mov_title` = '".$mov_title."', `mov_year` = '".$mov_year."', `mov_time` = '".$mov_time."', `mov_lang` = '".$mov_lang."', `mov_overview` = '".$mov_overview."' WHERE `movie`.`mov_id` = '".$mov_id."'";
       // dd($sql,$mov_title,$mov_overview,$mov_id,$mov_lang,$mov_time,$mov_year);
       // $sql="UPDATE `movie` SET `mov_title` = '".$mov_title."', `mov_year` = '".$mov_year."', `mov_time` = '".$mov_time."', `mov_lang` = '".$mov_lang."', `mov_overview` = '".$mov_overview."' WHERE `movie`.`mov_id` = '".$mov_id."'";
        $res = mysqli_query($connect, $sql);
        if ($res) {
            echo "Movie Edited";
            mysqli_close($connect);
            return redirect('/');
        } else {
            die("Error: " . $sql . "<br>" . mysqli_error($connect));
        }
    }
    public function EditActor(){
        $connect = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
        if (!$connect) {
            die("Connection Failed: " . mysqli_connect_error());
        }
        $act_fname = request('fname');
        $act_lname = request('lname');
        $act_gender = request('gender');
        $act_id=request('id');
        $query="UPDATE `actor` SET `act_fname` = '".$act_fname."', `act_lname` = '".$act_lname."', `act_gender` = '".$act_gender."' WHERE `actor`.`act_id` = '".$act_id."'";
        $res = mysqli_query($connect, $query);
        if ($res) {
           echo "Actor Edited";
           mysqli_close($connect);
           return redirect('/');
        } else {
            die("Error: " . $query . "<br>" . mysqli_error($connect));
        }
    }
    public function EditDirector(){
        $connect = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
        if (!$connect) {
            die("Connection Failed: " . mysqli_connect_error());
        }
        $dir_fname = request('fname');
        $dir_lname = request('lname');
        $dir_id=request('id');
        $query="UPDATE `director` SET `dir_fname` = '".$dir_fname."', `dir_lname` = '".$dir_lname."' WHERE `director`.`dir_id` = '".$dir_id."'";
        $res = mysqli_query($connect, $query);
        if ($res) {
            echo "Director Edited";
            mysqli_close($connect);
            return redirect('/');
        } else {
            die("Error: " . $query . "<br>" . mysqli_error($connect));
        }
    }
}
