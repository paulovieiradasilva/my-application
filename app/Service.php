<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Get the application of the service.
     */
    public function application()
    {
        return $this->belongsTo(Application::class);
    }

    /**
     * Get the server's credential.
     */
    public function credential()
    {
        return $this->morphOne(Credential::class, 'credentailable');
    }
}
