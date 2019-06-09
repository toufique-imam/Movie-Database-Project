<?php

namespace App\Http\Controllers;

class Delete_Entity_Controller extends Controller
{
    //7 function define category
    //8 delete(movie/actor/director)
    //delete actor "DELETE FROM `actor` WHERE `actor`.`act_id` = \'5cfc214da2053\'"
    //delete director "DELETE FROM `director` WHERE `director`.`dir_id` = \'5cfc214e4e04e\'"
    //delete genres "DELETE FROM `genres` WHERE `genres`.`gen_id` = \'5cfc214de4136\'"
    //delete movie 'DELETE FROM `movie` WHERE `movie`.`mov_id` = \'5cfc214d90980\'"
    public function DeleteData($category, $problem_id)
    {
        $connect = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
        if (!$connect) {
            die("Connection Failed: " . mysqli_connect_error());
        }
        $sql = "";
        if ($category == 1) {
            $sql = "DELETE FROM `movie` WHERE `movie`.`mov_id` = '" . $problem_id . "'";
        } else if ($category == 2) {
            $sql = "DELETE FROM `actor` WHERE `actor`.`act_id` = '" . $problem_id . "'";
        } else if ($category == 3) {
            $sql = "DELETE FROM `director` WHERE `director`.`dir_id` = '" . $problem_id . "'";
        }

        $res = mysqli_query($connect, $sql);
        if ($res) {
            echo "Deleted";
            mysqli_close($connect);
            return redirect('/');
        } else {
            die("Error: " . $sql . "<br>" . mysqli_error($connect));
        }
    }
}
