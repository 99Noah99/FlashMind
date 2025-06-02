<?php

namespace App\Http\Controllers;

use Prism\Prism\Prism;
use Prism\Prism\Enums\Provider;
use Prism\Prism\Schema\ObjectSchema;
use Prism\Prism\Schema\ArraySchema;
use Prism\Prism\Schema\StringSchema;
use Inertia\Inertia;
use Smalot\PdfParser\Parser;

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
                'number' => 'required|integer|min:1|max:100',
                'type' => 'required|in:texte,pdf',
            ],
            [
                'value.required' => 'Le texte est requis.',
                'value.string' => 'Le texte doit être une chaîne de caractères.',

                'number.required' => 'Le nombre de flashcards est requis.',
                'number.integer' => 'Le nombre de flashcards doit être un entier.',
                'number.min' => 'Le nombre de flashcards doit être au moins 1.',
                'number.max' => 'Le nombre de flashcards ne peut pas dépasser 100.',

                'type.required' => 'Le type de contenu est requis.',
                'type.in' => 'Le type de contenu doit être soit "text" soit "pdf".',
            ]
        );

        // Récupérer les données envoyées depuis le formulaire
        $nombre = $request->number;
        $type = $request->type;

        //Si le type est PDF, on parse le contenu du fichier
        if ($type === 'pdf') {
            $file = $request->value;
            $parser = new Parser();
            $pdf = $parser->parseFile($file);
            $text = $pdf->getText();
        } elseif ($type === 'texte') {
            // Si le type est texte, on utilise le texte tel quel
            $text = $request->value;
        } else {
            return response()->json(['error' => 'Type de contenu non supporté'], 400);
        }

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
