<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory; // trait

    protected $fillable = ['title', 'description','image'];

    public function types()
    {
        return $this->belongsToMany(Type::class);
    }

    /*
     * + ฟังก์ชัน tags() คืนค่า ความสัมพันธ์ belongsToMany
     * + attribute tags คืนค่า collection ของ Tag ที่ผูกกับ Post นี้
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function processes()
    {
        return $this->belongsToMany(Process::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Post hasMany comments (มี s ด้วย)
     * + ฟังก์ชัน comments() คืนค่า ความสัมพันธ์ hasMany
     * + attribute comments คืนค่า Collection ของ Comment ที่ผูกกับ Post นี้
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function scopeAdvertise($query)
    {
        return $query->where('like_count', '<', 1000)
                     ->where('view_count', '>', 70000);
    }

    public function scopePopular($query, $like_count, $view_count)
    {
        return $query->where('like_count', '>=', $like_count)
                     ->where('view_count', '>=', $view_count);
    }

    public function scopeFilterTitle($query, $search)
    {
        return $query->where('title', 'LIKE', "%{$search}%"); // % wildcard
    }

    private function numberToK($value) {
        return ($value >= 1000000)
            ? round($value / 1000000, 1) . 'm'
            : (
                ($value >= 1000)
                ? round($value / 1000, 1) . 'k'
                : $value
            );
    }
}
