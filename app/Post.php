<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $fillable = [ //新增的欄位名稱
        'title',
        'content',
        'user_id',
        'views',
        'admin'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
