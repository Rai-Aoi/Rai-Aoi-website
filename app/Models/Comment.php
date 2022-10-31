<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Comment belongsTo 1 post (ไม่มี s)
     * + ฟังก์ชัน post() คืนค่า ความสัมพันธ์ belongsTo
     * + attribute post คืนค่า object ของ Post ที่ผูกกับ Comment นั้น
     */
    public function post()
    {
       return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
