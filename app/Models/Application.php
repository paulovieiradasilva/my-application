<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'start',
        'platform',
        'type',
        'directory_app',
        'uri_internet',
        'uri_intranet',
        'tower_id',
        'provider_id'
    ];

    /**
     * Get the provider of the application.
     */
    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    /**
     * Get the tower of the application.
     */
    public function tower()
    {
        return $this->belongsTo(Tower::class);
    }

    /**
     * Get the servers for the application.
     */
    public function servers()
    {
        return $this->belongsToMany(Server::class);
    }

    /**
     * Get the users for the application.
     */
    public function employees()
    {
        return $this->belongsToMany(Employee::class);
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
     * Get the server's credential.
     */
    public function credential()
    {
        return $this->morphOne(Credential::class, 'credentialable');
    }
}
