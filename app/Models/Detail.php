<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['application_id', 'type', 'content', 'environment_id'];

    /**
     * Get the detail of the application.
     */
    public function application()
    {
        return $this->belongsTo(Application::class);
    }

    /**
     * Get the detail of the environment.
     */
    public function environment()
    {
        return $this->belongsTo(Environment::class);
    }
}
