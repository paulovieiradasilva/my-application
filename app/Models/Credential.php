<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Credential extends Model
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['username', 'password'];

    /**
     * Get the parent of the credential record.
     */
    public function credentialable()
    {
        return $this->morphTo();
    }
}
