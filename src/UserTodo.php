<?php
namespace Projekt\Api;

use Illuminate\Database\Eloquent\Model;

class UserTodo extends Model{
    protected $table = "user_todo";
    public $timestamps = false;
    protected $guarded = ['user_id']; // ki kell venni majd mert a tábázatot is módosítani kell
    protected $primaryKey = 'user_id';
}
