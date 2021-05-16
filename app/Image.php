<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public function demande(){
    	return $this->belongsTo(Demande::class);
    }

}
