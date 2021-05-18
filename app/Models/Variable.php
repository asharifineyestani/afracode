<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Variable extends Model
{
    //

    protected $fillable = ['value'];




    public function scopeGetValue($query, $key)
    {
        if ($query->where('key', $key)->first())
            return $query->where('key', $key)->first()->value;
        else
            return null;
    }


}
