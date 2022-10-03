<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class post extends Model
{

    protected $table = 'posts';

    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = array('title','body','user_id');

    protected $hidden = ['created_at','updated_at'];

    public function comments()
    {
        return $this->hasMany('App\Models\comment','post_id')->orderBy('id', 'desc');
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
