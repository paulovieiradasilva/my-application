<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];
    
    /**
     * Get the parent of the contact record.
     */
    public function contactable()
    {
        return $this->morphTo();
    }

}
