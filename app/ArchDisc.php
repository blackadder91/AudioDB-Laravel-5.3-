<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArchDisc extends Model
{
    public function releases()
    {
        return $this->belongsToMany('App\Release', 'archive')->withPivot(['flags', 'notes', 'file_format_id']);
    }

    public function getShortTitle()
    {
        if (preg_match("/_([0-9]+)/", $this->title, $matches) == 1) {
            return $matches[1];
        }

        return $this->title;
    }

}
