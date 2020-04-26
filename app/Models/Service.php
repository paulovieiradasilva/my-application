<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description', 'start', 'application_id'];

    /**
     * Get the application of the service.
     */
    public function application()
    {
        return $this->belongsTo(Application::class);
    }

}
