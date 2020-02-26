<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Get the environment of the server.
     */
    public function environment()
    {
        return $this->belongsTo(Environment::class);
    }

    /**
     * The databases that belong to the server.
     */
    public function databases()
    {
        return $this->belongsToMany(Database::class)->withTimestamps();
    }

    /**
     * Get the server's credential.
     */
    public function credential()
    {
        return $this->morphOne(Credential::class, 'credentailable');
    }
}
