<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RBCNew extends Model
{
    use HasFactory;

    protected $table = 'rbc_news';

    protected $fillable = [
        'name',
        'short_description',
        'public_date',
        'author',
        'image'
    ];
}
