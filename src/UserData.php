<?php

namespace Projekt\Api;

use Illuminate\Database\Eloquent\Model;

class UserData extends Model {
    protected $table = 'user_data';
    public $timestamps = false;

    protected $guarded = ['id'];

}