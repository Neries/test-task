<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Employee extends Model
{
    public $timestamps = false;
    protected $guarded = [];

    /**
     * Return all subordinates
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children() {
        return $this->hasMany(static::class, 'chief_id')->orderBy('id', 'asc');
    }

}
