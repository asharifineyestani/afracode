<?php

namespace App\Models;

use App\Helpers\Sh4Helper;
use App\Sh4\Sh4HasPagination;
use Illuminate\Database\Eloquent\Model;

use Auth;

class Post extends Model
{

    protected $fillable = [
        'title', 'body', 'study_time', 'media_path', 'user_id', 'count_visit'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }







}

