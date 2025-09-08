<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{
    use HasFactory;

    protected $table = 'slots'; // table name

    protected $fillable = [
        'name',       // e.g., Morning, Evening
        'start_time', // e.g., 09:00:00
        'end_time',   // e.g., 17:00:00
    ];

    /**
     * Slot has many attendances
     */
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    /**
     * Optional: Many-to-Many relation with employees (if assigned)
     */
    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'employee_slot', 'slot_id', 'employee_id');
    }
}
