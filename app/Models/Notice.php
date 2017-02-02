<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    public function notices_label()
    {
        return $this->belongsTo('App\Models\notices_label', 'notices_labels_id');
    }
}
