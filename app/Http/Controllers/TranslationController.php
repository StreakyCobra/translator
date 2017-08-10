<?php

namespace App\Http\Controllers;

use App\Repositories\TranslationsRepositoryInterface;
use Illuminate\Http\Request;
use App\Translation;
use App\Langage;

class TranslationController extends Controller
{
    protected $translationRepository;
    const EN = 'English';
    const FR = 'French';

    public function __construct(TranslationsRepositoryInterface $postRepository)
    {
        $this->translationRepository = $postRepository;
    }

    public function home() {
        // Load the page to show the translation
        if(Translation::all()->count() > 0 && Langage::all()->count() > 0) {
            $english = Translation::inRandomOrder()->where('idLangage', Langage::where('langage', self::EN)
                ->first()
                ->getAttributeValue('id'))
                ->where('isValidate', 0)
                ->first();
            $translation = Translation::where('key', $english->getAttributeValue('key'))
                ->where('idLangage', Langage::where('langage', self::FR)
                    ->first()
                    ->getAttributeValue('id'))
                ->first();
            return view('home/home')->with('english', $english)->with('translation', $translation);
        } else
            return view('home/home');
    }

    public function valid(Request $request) {

        switch($request->submit) {
            case 'Validate':
                $this->validateTranslation($request);
                break;
            case 'Modify':
                $this->modify($request);
                break;
        }

        return back();
    }

    private function modify(Request $request) {
        // Modify the translation
        $english = $this->getTranslation($request->english, self::EN);
        $french = $this->getTranslationByEnglish($english, self::FR);

        $french->translation = $request->french;
        $french->time = date('Y-m-d H:i:s');
        $french->save();
    }

    private function validateTranslation(Request $request) {
        // Validate the translation
        $french = $this->getTranslation($request->french, self::FR);
        $french->isValidate = 1;
        $french->time = date('Y-m-d H:i:s');
        $french->save();
    }

    private function getTranslation($text, $langage) {
        return Translation::where('translation', $text)
            ->where('idLangage', Langage::where('langage', $langage)
                ->first()
                ->getAttributeValue('id'))
            ->firstOrFail();
    }

    private function getTranslationByEnglish($english, $langage) {
        return Translation::where('key', $english->getAttributeValue('key'))
            ->where('idLangage', Langage::where('langage', $langage)
                ->firstOrFail()
                ->getAttributeValue('id'))
            ->firstOrFail();
    }
}
