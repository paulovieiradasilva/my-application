<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'opening_hours', 'on_duty', 'description'];

    /**
     * Get all of the contacts for the provider.
     */
    public function contacts()
    {
        return $this->morphMany(Contact::class, 'contactable');
    }
}
