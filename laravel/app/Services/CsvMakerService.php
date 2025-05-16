<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class CsvMakerService
{

    public function make_csv_from_aijson($json)
    {
        $json_decoded = json_decode($json->text);
        if (!$json_decoded) {
            throw new \Exception('JSON principal invalide');
        }

        $file_name = 'flashcards.csv'; // nom du fichier
        $file_path = Storage::disk('local')->path($file_name); // récupére le chemin du fichier
        $csv_file = fopen($file_path, 'w'); // ouvre le fichier (au chemin spécifier) si il existe ou le crée

        if ($csv_file === false) {
            throw new \Exception('Failed to open file for writing');
        }

        //Vérifie si le JSON contient les clés 'questions' et 'reponses'
        if (!isset($json_decoded->questions) || !isset($json_decoded->reponses)) {
            throw new \Exception('JSON invalide : les clés "questions" ou "reponses" sont manquantes');
        }

        foreach ($json_decoded->questions as $index => $question) {
            $reponse = $json_decoded->reponses[$index] ?? '';
            fputcsv($csv_file, [$question, $reponse]);
        }

        fclose($csv_file);

        return $file_name;
    }
}
