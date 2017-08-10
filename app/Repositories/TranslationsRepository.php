<?php

namespace App\Repositories;

use App\Translation;

class TranslationsRepository implements TranslationsRepositoryInterface {
    protected $translation;

    public function __construct(Translation $translation)
    {
        $this->translation = $translation;
    }

    public function save($translation) {
        $this->translation->isValidate = 1;
        //$translation->save();
    }
}