<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    use HasFactory;

    protected $fillable = ['priority', 'content', 'advertiser_name', 'advertiser_contact', 'start_date', 'end_date', 'placement', 'image', 'video', 'link', 'status'];
}
