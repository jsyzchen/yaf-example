<?php
/**
 * Created by PhpStorm.
 * User: chenchen
 * Date: 15/11/27
 * Time: 16:02
 */
namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class User extends EloquentModel
{
    // 表名
    public $table = 'user';
}