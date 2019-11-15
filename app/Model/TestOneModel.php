<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/9/17 0017
 * Time: 10:25
 */
namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TestOneModel extends Model{
    use SoftDeletes;
    protected $table = 'test_one';
    protected $fillable = [];
}
