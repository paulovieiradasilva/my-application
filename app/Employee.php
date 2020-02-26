<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Get all of the contacts for the employee.
     */
    public function contacts()
    {
        return $this->morphToMany(Contact::class, 'contactable');
    }
}
