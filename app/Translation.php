<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = ['id',
        'translation',
        'time',
        'isValidate'];

    public function langage() {
        return $this->belongsTo('\App\Langage', 'idLangage');
    }
}
