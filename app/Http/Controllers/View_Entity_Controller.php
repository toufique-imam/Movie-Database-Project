<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Switch_;

class View_Entity_Controller extends Controller
{
    //todo create view
    public function Search(){
        $connect = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
        if(!$connect){
            die("Connection Failed: ".mysqli_connect_error());
        }
        $search_string=request('search_str');
        $search_cat=request('search_cat');
        $search_string=$this->process_str($search_string);
        if($search_cat==0){
            $movie=$this->fetch_movie($search_string,$connect);
            $actor=$this->fetch_actor($search_string,$connect);
            $director=$this->fetch_director($search_string,$connect);
            return View('Search.search_res',[
               'movies'=>$movie,
               'actors'=>$actor,
               'directors'=>$director
            ]);
        }else if($search_cat==1){
            $movie=$this->fetch_movie($search_string,$connect);
            $actor=Array();
            $director=Array();
            return View('Search.search_res',[
                'movies'=>$movie,
                'actors'=>$actor,
                'directors'=>$director
            ]);
        }else if($search_cat==2){
            $actor=$this->fetch_actor($search_string,$connect);
            $movie=Array();
            $director=Array();
            return View('Search.search_res',[
                'movies'=>$movie,
                'actors'=>$actor,
                'directors'=>$director
            ]);
        }else{
            $director=$this->fetch_director($search_string,$connect);
            $movie=Array();
            $actor=Array();
            return View('Search.search_res',[
                'movies'=>$movie,
                'actors'=>$actor,
                'directors'=>$director
            ]);
        }
    }
    public function process_str($search_str){
        for($i=0;$i<strlen($search_str);$i++){
            if($search_str[$i]==' ')$search_str[$i]='%';
        }
        return $search_str;
    }
    public function fetch_movie($search_str,$connect){
        $sql = "SELECT * FROM movie WHERE mov_title LIKE '%".$search_str."%' ORDER BY mov_year ASC";
        $res=mysqli_query($connect,$sql);
        if($res){
            $ans= mysqli_fetch_all($res,MYSQLI_ASSOC);
            mysqli_free_result($res);
            return $ans;
        }else{
            echo "Error_Mov: ". $sql . "<br>" .mysqli_error($connect);
        }
        return Array();
    }
    public function fetch_actor($search_str,$connect){
        $sql="SELECT * FROM actor WHERE act_fname LIKE '%".$search_str."%' OR act_lname LIKE '%".$search_str."%' ORDER BY act_id ASC";
        $res=mysqli_query($connect,$sql);
        if($res){
            $ans= mysqli_fetch_all($res,MYSQLI_ASSOC);
            mysqli_free_result($res);
            return $ans;
        }else{
            echo "Error_ACT: ". $sql . "<br>" .mysqli_error($connect);
        }
        return Array();
    }
    public function fetch_director($search_str,$connect){
        $sql="SELECT * FROM director WHERE dir_fname LIKE '%".$search_str."%' OR dir_lname LIKE '%".$search_str."%' ORDER BY dir_id ASC";
        $res=mysqli_query($connect,$sql);
        if($res){
            $ans= mysqli_fetch_all($res,MYSQLI_ASSOC);
            mysqli_free_result($res);
            return $ans;
        }else{
            echo "Error_Dir: ". $sql . "<br>" .mysqli_error($connect);
        }
        return Array();
    }
}
