<?php

namespace App\Http\Controllers;

use Dotenv\Util\Str;
use Inertia\Inertia;

use Prism\Prism\Prism;
use Prism\Prism\Enums\Provider;
use Prism\Prism\Schema\ObjectSchema;
use Prism\Prism\Schema\ArraySchema;
use Prism\Prism\Schema\StringSchema;


use Illuminate\Http\Request;

class AiController extends Controller
{

    public function generate(Request $request)
    {
        // Récupérer les données envoyées depuis le formulaire
        $text = $request->value;
        $type = $request->type;
        $nombre = 20;

        $prompt = "Voici un texte à analyser : " . $text . ". Génère " . $nombre . " de flashcards. C'est-à-dire " . $nombre . " questions et leurs " . $nombre . " réponses correspondantes.";


        $schema = new ObjectSchema(
            name: 'flashcards',
            description: 'Génération de flashcards à partir d\'un texte',
            properties: [
                new ArraySchema('questions', 'Liste des questions', new StringSchema('question', 'Une question')),
                new ArraySchema('reponses', 'Liste des réponses', new StringSchema('reponse', 'Une réponse')),
            ],
            requiredFields: ['questions', 'reponses']
        );


        $ai_response = Prism::structured()
            ->using(Provider::Ollama, 'FlashCardGenerator')
            ->withSchema($schema)
            ->withPrompt($prompt)
            ->withClientOptions(['timeout' => 100000])
            // Removed 'withProviderOptions' as it is undefined
            ->asStructured();

        dd($ai_response);



        // // Transmettre les données au composant React
        // return Inertia::render('Home', [
        //     'response_csv_file' => 'tu as réussi !!!',
        // ]);
    }
}
