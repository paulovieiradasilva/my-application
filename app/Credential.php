<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Credential extends Model
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];
    
    /**
     * Get the parent of the credential record.
     */
    public function credentailable()
    {
        return $this->morphTo();
    }
}
