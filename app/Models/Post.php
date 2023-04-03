<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
   //table name
    protected $table ='posts';  //could be changed here
   
  //primary key
    public $primaryKey ='id'; //could be changed here 

  //timestaamps
    //they are created by default but one can specify here
    public $timestamos= true;
    

}
