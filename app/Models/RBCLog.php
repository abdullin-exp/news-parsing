<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RBCLog extends Model
{
    use HasFactory;

    protected $table = 'rbc_logs';

    protected $fillable = [
        'date',
        'request_method',
        'request_url',
        'response_http_code',
        'response_body',
        'request_time',
    ];
}
