<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'actors';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'fakename', 'date', 'gender', 'oscars', 'nominated'];

    public function movies() {
        return $this->hasMany(Movie::class);
    }
    
}
