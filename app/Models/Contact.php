<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['email', 'phone', 'cellphone', 'site', 'contactable_type', 'contactable_id'];

    /**
     * Get the parent of the contact record.
     */
    public function contactable()
    {
        return $this->morphTo();
    }

}
