<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class Add_Entity_Controller extends Controller
{
    // 1 function define category
    public function  category_define()
    {
        $data=request()->validate([
            'category'=>'required'
        ]);
        $x=request('category');
        if($x==1){
            return View('Add.add_movie');
        }else if($x==2){
            return view('Add.add_actor');
        }else{
            return view('Add.add_director');
        }
    }
    public function comma_separator(string $xd){

    }
    //2 function add (movie/actor/director)
    //todo 10 function separate each actor and check them whether they are already added if not then add same with genre and director
    public function AddMovie(){
        $connect = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
        if (!$connect) {
            die("Connection Failed: " . mysqli_connect_error());
        }
        $mov_title=request('title');
        $mov_overview=request('overview');
        $mov_year=request('year');
        $mov_lang=request('lang');
        $mov_time=request('time');
        $genre=request('genre');
        $cast=request('cast');
        $director=request('director');
        $mov_id=uniqid();
        $query = "INSERT INTO movie(mov_id,mov_title,mov_year,mov_time,mov_lang,mov_overview) values ( '" . $mov_id . "' , '" . $mov_title . "' , " . $mov_year . " , " . $mov_time . " , '" . $mov_lang . "' , '" . $mov_overview . "')";
        $res = mysqli_query($connect, $query);
        if ($res) {
            echo "NEW Movie ADDED";
        } else {
            die( "Error: " . $query . "<br>" . mysqli_error($connect));
        }
        mysqli_close($connect);

    }
    public function AddActor(){
        $connect = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
        if(!$connect){
            die("Connection Failed: ".mysqli_connect_error());
        }
        $act_fname=request('fname');
        $act_lname=request('lname');
        $act_gender=request('gender');
        $id=uniqid();
        $query="INSERT INTO actor (act_id,act_fname,act_lname,act_gender) values('".$id."', '".$act_fname."','".$act_lname."','".$act_gender."')";
        $res=mysqli_query($connect,$query);
        if($res){
            echo "NEW Actor ADDED";

        }else{
            echo "Error: ". $query . "<br>" .mysqli_error($connect);
        }
        mysqli_close($connect);
    }
    public  function AddDirector(){
        $connect = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
        if(!$connect){
            die("Connection Failed: ".mysqli_connect_error());
        }
        $id=uniqid();
        $dir_fname=request('fname');
        $dir_lname=request('lname');
        //echo $dir_fname . $dir_lname;
        $query="INSERT INTO director (dir_id,dir_fname,dir_lname) values('".$id."', '".$dir_fname."','".$dir_lname."')";
        $res=mysqli_query($connect,$query);
        if($res){
            echo "NEW Director ADDED";

        }else{
            echo "Error: ". $query . "<br>" .mysqli_error($connect);
        }
        mysqli_close($connect);
    }
}
