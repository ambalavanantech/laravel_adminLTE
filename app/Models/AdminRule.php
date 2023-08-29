<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminRule extends Model
{
    use HasFactory;
    protected $table = 'admin_rules';
    protected $fillable = [
        'admin_id',	
        'module',	
        'view_access',
        'edit_access',
        'full_access',	
        'created_at',	
        'updated_at'
    ];
    
}
