<?php

namespace App\Models;

use CodeIgniter\Model;

class SugarModel extends Model
{
    protected $table = 'sugar_readings';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'level', 'recorded_at', 'notes', 'updated_at'];
}