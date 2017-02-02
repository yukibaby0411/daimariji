<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notices_label extends Model
{
    public function notices()
    {
        return $this->hasMany('App\Models\Notice');
    }
}
