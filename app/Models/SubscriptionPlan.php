<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionPlan extends Model
{
    use HasFactory;

    protected $fillable = [
    'name', 'price', 'description', 'invoices', 'notes', 'planner_scheduler',
    'editor_software', 'auto_content', 'multiple_platform_link', 'automation_cloud_data',
    'auto_scheduler', 'admin_owner', 'automation', 'package_id',
];
}
