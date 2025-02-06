<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $table = 'ticket'; // Specify the table name

    protected $primaryKey = 'ticket_id';
    protected $fillable = [
        'user_id',
        'question',
        'reply',
        'status',
    ];
    public $timestamps = true;
}
