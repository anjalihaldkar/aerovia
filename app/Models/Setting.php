<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['phone', 'email', 'address', 'fb', 'linkedin', 'instagram', 'whatsapp'];
}
