<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    protected $table='comments';

    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = array('body', 'post_id', 'user_id');

    protected $hidden = ['created_at', 'updated_at'];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
