<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageModel extends Model
{
    use HasFactory;

    protected $table = 'message_field';

    protected $fillable = ['image', 'json', 'text'];
    
    public $timestamps = false;
}