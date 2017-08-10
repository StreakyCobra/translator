<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportRequest;
use App\Translation;
use donatj\Ini\Builder;
use Illuminate\Filesystem\Filesystem;

use App\Langage;
use Illuminate\Http\Request;

class AdministrationController extends Controller
{
    public function admin() {
        $langages = Langage::getAllLangagesOrderByLang();
        return view('administration/administration')->with('langages', $langages);
    }

    public function import(ImportRequest $request) {
        // Get the file and parse them
        $file = new Filesystem();
        $array = parse_ini_string($file->get($request->file('import')->getRealPath()),
            false,
            INI_SCANNER_RAW);

        // Crate langage if not exist
        if(!$lang = $this->checkIfLangExist($request->langage)) {
            $lang = new Langage;
            $lang->langage = $request->langage;
            $lang->save();
        }

        // Create enteries in translation table
        foreach($array as $key => $value) {
            $this->saveTranslation($value, $key, $lang);
        }

        // Display admin page
        $langages = Langage::getAllLangagesOrderByLang();
        return view('administration/administration')->with('langages', $langages);
    }

    private function checkIfLangExist($lang) {
        $lang = Langage::where('langage', $lang)->first();

        if($lang) {
            $lang->delete();
        }

        return false;
    }

    private function saveTranslation($value, $key, $lang) {
        $translation = new Translation;
        $translation->key = $key;
        $translation->translation = $value;
        $translation->time = date('Y-m-d H:i:s');
        $translation->isValidate = 0;
        $translation->langage()->associate($lang);
        $translation->save();
    }

    public function export(Request $request) {
        // Select all translation in the langage
        $lang = Langage::where('id', $request->langage)->first();
        $translations = Translation::all()->where('idLangage', $lang->getAttributeValue('id'))->toArray();

        $array = array();
        foreach($translations as $t) {
            $array[$t['key']] = $t['translation'];
        }

        // Write the ini file into the Download folder
        $writer = new Builder();
        $result = $writer->generate($array);
        header('Content-disposition: attachment; filename=' . $lang->langage . '.ini');
        header('Content-type: text/plain');
        echo $result;
    }
}
