<?php
/**
 * Created by PhpStorm.
 * User: Danie
 * Date: 09.08.2017
 * Time: 14:23
 */

namespace App\Repositories;

use App\Langage;


class LangageRepository implements LangageRepositoryInterface
{
    protected $langage;

    public function __construct(Langage $lang)
    {
        $this->langage = $lang;
    }

    public function store($inputs) {
        $this->langage->create($inputs);
    }

    public function destroy(Langage $lang) {
        $lang->delete();
    }
}