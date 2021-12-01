<?php
namespace Projekt\Api;

use Illuminate\Database\Eloquent\Model;

class UserIcon extends Model {
    protected $table = 'user_icon';
    public $timestamps = false;

    protected $guarded = ['user_id'];
    protected $primaryKey = 'user_id';

}