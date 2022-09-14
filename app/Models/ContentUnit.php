<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContentUnit extends Model
{
    protected $fillable = ['uri', 'title', 'url', 'published', 'abstract', 'domain'];
}
