<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    //
   protected $fillable = [
    'group_name',
    'group_admin',
    'group_base'
];
    //table name
    protected $table ='groups';  //could be changed here

    //primary key
    public $primaryKey ='id'; //could be changed here

}
