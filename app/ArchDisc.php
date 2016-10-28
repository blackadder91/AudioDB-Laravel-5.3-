<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArchDisc extends Model
{
    public function releases()
    {
        return $this->belongsToMany('App\Release', 'archive')->withPivot(['flags', 'notes', 'file_format_id']);
    }
}
