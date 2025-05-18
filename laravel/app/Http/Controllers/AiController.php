<?php

namespace App\Http\Controllers;

use Prism\Prism\Prism;
use Prism\Prism\Enums\Provider;
use Prism\Prism\Schema\ObjectSchema;
use Prism\Prism\Schema\ArraySchema;
use Prism\Prism\Schema\StringSchema;
use Inertia\Inertia;

//services
use App\Services\CsvMakerService;


use Illuminate\Http\Request;

class AiController extends Controller
{

    public function __construct(private CsvMakerService $csv_maker_service) {}

    public function generate(Request $request)
    {

        // Valider les données du formulaire
        $request->validate(
            [
                'value' => 'required|string',
            ],
            [
                'value.required' => 'Le texte est requis.',
                'value.string' => 'Le texte doit être une chaîne de caractères.',
            ]
        );


        // Récupérer les données envoyées depuis le formulaire
        $text = $request->value;
        $type = $request->type;
        $nombre = 10;

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
            ->withClientOptions(['timeout' => 1000])
            ->asStructured();

        $csv_file_name = $this->csv_maker_service->make_csv_from_aijson($ai_response);

        // Transmettre les données au composant React
        return Inertia::render('Home', [
            'response_csv_file_name' => $csv_file_name,
        ]);
    }
}
