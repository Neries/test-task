<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'id',
        'chief_id',
    ];
    public function children() {
        return $this->hasMany(static::class, 'chief_id')->orderBy('id', 'asc');
    }

}
