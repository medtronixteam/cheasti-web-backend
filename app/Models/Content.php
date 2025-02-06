<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Content extends Model
{
    use HasFactory,SoftDeletes;

    protected $primaryKey = 'video_id'; // Specify 'video_id' as the primary key

    protected $guarded = ['video_id'];
    protected $casts = [
        'platforms' => 'array',
        'scheduled_at' => 'datetime',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'category');
    }


}
