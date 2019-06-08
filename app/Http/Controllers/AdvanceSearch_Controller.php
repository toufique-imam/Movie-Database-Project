<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class AdvanceSearch_Controller extends Controller
{
    public function  category_define()
    {
        $data=request()->validate([
            'category'=>'required'
        ]);
        $x=request('category');
        if($x==1){
            return View('Search.adv_movie_search');
        }else if($x==2){
            return view('Search.adv_actor_search');
        }else{
            return view('Search.adv_director_search');
        }
    }
    public function Search_movie(){
        $connect = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
        if(!$connect){
            die("Connection Failed: ".mysqli_connect_error());
        }
        $title=request('title');
        $lang=request('lang');
        $rel_from=request('rl_from');
        $rel_to=request('rl_to');
        $run_from=request('time_from');
        $run_to=request('time_to');
        $rel_from--;
        $rel_to++;
        $run_from--;
        $run_to++;
        $sql = "SELECT * FROM movie WHERE mov_title LIKE '%".$title."%' AND mov_lang LIKE '%".$lang."%' AND mov_year<".$rel_to." AND mov_year>".$rel_from." AND mov_time<".$run_to." AND mov_time>".$run_from." ORDER BY mov_year ASC";
        $res=mysqli_query($connect,$sql);
        if($res){
            $ans= mysqli_fetch_all($res,MYSQLI_ASSOC);
            mysqli_free_result($res);
            return View('Search.adv_movie_search',[
                'data'=>$ans
            ]);
         //   return $ans;
        }else{
            echo "Error_Mov: ". $sql . "<br>" .mysqli_error($connect);
        }
    }
    public function Search_actor(){
        $connect = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
        if(!$connect){
            die("Connection Failed: ".mysqli_connect_error());
        }
        $fname=request('fname');
        $lname=request('lname');
        $gender=request('gender');
        $sql="SELECT * FROM actor WHERE act_fname LIKE '%".$fname."%' AND act_lname LIKE '%".$lname."%' AND act_gender LIKE '%".$gender."%' ORDER BY act_id ASC";
        $res=mysqli_query($connect,$sql);
        if($res){
            $ans= mysqli_fetch_all($res,MYSQLI_ASSOC);
            mysqli_free_result($res);
            return View('Search.adv_actor_search',[
                'data'=>$ans
            ]);
            //   return $ans;
        }else{
            echo "Error_Mov: ". $sql . "<br>" .mysqli_error($connect);
        }
    }
    public function Search_director(){
        $connect = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
        if(!$connect){
            die("Connection Failed: ".mysqli_connect_error());
        }
        $fname=request('fname');
        $lname=request('lname');
        $sql="SELECT * FROM director WHERE dir_fname LIKE '%".$fname."%' AND dir_lname LIKE '%".$lname."%' ORDER BY dir_id ASC";
        $res=mysqli_query($connect,$sql);
        if($res){
            $ans= mysqli_fetch_all($res,MYSQLI_ASSOC);
            mysqli_free_result($res);
            return View('Search.adv_director_search',[
                'data'=>$ans
            ]);
            //   return $ans;
        }else{
            echo "Error_Mov: ". $sql . "<br>" .mysqli_error($connect);
        }
    }
}
