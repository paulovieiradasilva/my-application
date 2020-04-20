<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Database extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'sgdb', 'port', 'server_id'];

    /**
     * Get the environment of the server.
     */
    public function server()
    {
        return $this->belongsTo(Server::class);
    }

    /**
     * Get the server's credential.
     */
    public function credential()
    {
        return $this->morphOne(Credential::class, 'credentialable');
    }
}
