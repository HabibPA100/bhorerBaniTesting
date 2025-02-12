<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $fillable = ['thumbnail', 'splash', 'type', 'meta', 'division', 'district', 'subdistrict', 'category_1', 'category_2', 'category_3', 'headline', 'subtitle', 'content', 'date', 'reporter_id', 'category_id', 'published_at', 'status'];

    public function reporter()
    {
        return $this->belongsTo(User::class, 'reporter_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}