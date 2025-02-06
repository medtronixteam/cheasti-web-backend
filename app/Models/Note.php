<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'note_name', 'note', 'folder', 'creation_date'];
    
    // Indicate the primary key
    protected $primaryKey = 'note_id';
}
