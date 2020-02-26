<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Database extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * The servers that belong to the database.
     */
    public function servers()
    {
        return $this->belongsToMany(Server::class)->withTimestamps();
    }

    /**
     * Get the database's credential.
     */
    public function credential()
    {
        return $this->morphOne(Credential::class, 'credentailable');
    }
}
