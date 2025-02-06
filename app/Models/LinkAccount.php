<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LinkAccount extends Model
{
    use HasFactory;
    protected $guarded=['link_account_id'];
    protected $primaryKey = 'link_account_id';
}
