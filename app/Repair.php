<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Repair extends Model
{
    //
    protected $table = 'repairs';
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
