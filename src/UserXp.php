<?php
namespace Projekt\Api;

use Illuminate\Database\Eloquent\Model;

class UserXp extends Model{
    protected $table = "user_xp";
    public $timestamps = false;
    protected $guarded = ['user_id'];
    protected $primaryKey = 'user_id';
}