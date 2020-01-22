<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Todo extends Model
{
    use SoftDeletes;

    protected $fillable = [
    	'title',
    	'user_id'
    ];  // 追記
    // ここから
    public function getByUserId($id)
    {
        return $this->where('user_id', $id)->get();
    }
    // ここまで追記
}
