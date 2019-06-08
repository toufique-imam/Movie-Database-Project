<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class Database_Driver
{
    public function create_connect()
    {
        $connect = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
        if (!$connect) {
            die("Connection Failed: " . mysqli_connect_error());
        }
        return $connect;
    }

    public function Add_Movie($mov_title, $mov_overview, $mov_year, $mov_lang, $mov_time)
    {
        $mov_id = uniqid();
        $connect = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
        if (!$connect) {
            die("Connection Failed: " . mysqli_connect_error());
        }
        $query = "INSERT INTO movie(mov_id,mov_title,mov_year,mov_time,mov_lang,mov_overview) values ( '" . $mov_id . "' , '" . $mov_title . "' , " . $mov_year . " , " . $mov_time . " , '" . $mov_lang . "' , '" . $mov_overview . "')";
        $res = mysqli_query($connect, $query);
        if ($res) {
            echo "NEW Movie ADDED";
        } else {
            die( "Error: " . $query . "<br>" . mysqli_error($connect));
        }
        mysqli_close($connect);
    }
    public function Add_Actor($act_fname,$act_lname,$act_gender){
        $id=uniqid();
        $connect = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
        if (!$connect) {
            die("Connection Failed: " . mysqli_connect_error());
        }
        $query="INSERT INTO actor (act_id,act_fname,act_lname,act_gender) values('".$id."', '".$act_fname."','".$act_lname."','".$act_gender."')";
        $res=mysqli_query($connect,$query);
        if($res){
            echo "NEW Actor ADDED";
        }else{
            die("Error: ". $query . "<br>" .mysqli_error($connect));
        }
        mysqli_close($connect);
    }
    public function Add_Director($dir_fname,$dir_lname){
        $connect = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
        if (!$connect) {
            die("Connection Failed: " . mysqli_connect_error());
        }
        $id=uniqid();
        $query="INSERT INTO director (dir_id,dir_fname,dir_lname) values('".$id."', '".$dir_fname."','".$dir_lname."')";
        $res=mysqli_query($connect,$query);
        if($res){
            echo "NEW Director ADDED";
        }else{
            die("Error: ". $query . "<br>" .mysqli_error($connect));
        }
        mysqli_close($connect);
    }
}
