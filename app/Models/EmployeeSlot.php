<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeSlot extends Model
{
    use HasFactory;

    // Specify the table name explicitly
    protected $table = 'employee_slot';

    // If your primary key is not 'id', specify it here
    protected $primaryKey = 'id';

    // If you don’t want Laravel to manage timestamps automatically
    public $timestamps = true;

    // Add fillable columns if you want to mass assign
    protected $fillable = [
        'employee_id',
        'slot_id',
    ];
}
