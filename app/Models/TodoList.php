<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TodoList extends Model
{
    use HasFactory;

    protected $table = 'todo_lists';
 protected $primaryKey = 'todo_id';
    protected $fillable = [
        'user_id',
        'categories',
        'task',
        'due_date',
        'due_time',
        'reminder',
        'repeat_daily',
        'is_completed',
    ];
}
