<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlatformLink  extends Model
{
      protected $fillable = ['user_id', 'company_name', 'company_link', 'email', 'password', 'logo'];
}
