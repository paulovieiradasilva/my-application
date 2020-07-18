<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'type', 'tower_id'];

    /**
     * Get the tower of the employee.
     */
    public function tower()
    {
        return $this->belongsTo(Tower::class);
    }

    /**
     * Get all of the contacts for the employee.
     */
    public function contacts()
    {
        return $this->morphMany(Contact::class, 'contactable');
    }
}
