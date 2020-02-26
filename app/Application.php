<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Get the provider of the application.
     */
    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    /**
     * Get the application of the service.
     */
    public function server()
    {
        return $this->belongsTo(Server::class);
    }

    /**
     * Get the environment through the server.
     */
    public function environment()
    {
        return $this->hasOneThrough(Environment::class, Server::class);
    }

    /**
     * Get the services for the application.
     */
    public function services()
    {
        return $this->hasMany(Service::class);
    }

    /**
     * Get the integrations for the application.
     */
    public function integrations()
    {
        return $this->hasMany(Integration::class);
    }

    /**
     * Get the application's credential.
     */
    public function credential()
    {
        return $this->morphOne(Credential::class, 'credentailable');
    }
}
