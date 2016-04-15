<?php
namespace App\Models;

class Express extends EloquentModel
{
    // 表名
    public $table = 'express';
    public $timestamps = false;

    public function lst(){
    	$columns = array('com','company');
    	$list = self::all($columns)->toArray();
    	return $list;
    }
}