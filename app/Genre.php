<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    public function artists()
    {
        return $this->hasMany('App\Recording');
    }

    public function recordings()
    {
        return $this->hasMany('App\Recording');
    }

    public function parent()
    {
        return $this->belongsTo('App\Genre', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('App\Genre', 'parent_id');
    }

    public function images()
    {
        return $this->morphMany('App\Image', 'imageable');
    }

    /* convert current genre branch to array */
    public static function to_array_all()
    {
        $a = [];
        $gs = Genre::where('parent_id', '=', 0)
            ->orderBy('title', 'ASC')
            ->get();

        foreach($gs as $g) {
            $a[] = $g->to_array();
        }

        return $a;
    }
    public function to_array($m = null)
    {
        $a = [];
        $pId = 0;

        if ($m == null) {
            $m = $this;
            $pId = $this->id;
            array_push($a, $pId);

            if ($m->children->count() > 0) {
                $a[$pId] = [];
                $aa = $this->to_array($m->children);
                $a[$pId] = $aa;
            }
        } else {
            foreach ($m as $mm) {
                $pId = $mm->id;
                array_push($a, $pId);


                if ($mm->children->count() > 0) {
                    $a[$pId] = [];
                    $aa = $this->to_array($mm->children);
                    $a[$pId] = $aa;
                }
            }
        }
        return $a;
    }

    public static function to_html_all()
    {
        $a = self::to_array_all();

    }
}
