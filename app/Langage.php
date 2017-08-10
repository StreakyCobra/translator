<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Langage extends Model
{
    public $timestamps = false;
    protected $fillable = ['id',
        'langage'];

    public function translations() {
        return $this->hasMany('\App\Translation');
    }

    public static function getAllLangagesOrderByLang() {
        return Langage::orderBy('langage')->get();
    }
}
