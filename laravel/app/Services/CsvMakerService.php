<?php

namespace App\Services;

class CsvMakerService
{

    public function make_csv_from_aijson($json)
    {
        $json_decoded = json_decode($json);

        $json_response = json_decode($json_decoded->response);

        $csv_file = fopen('flashcards.csv', 'w');

        if ($csv_file === false) {
            throw new \Exception('Failed to open file for writing');
        }

        foreach ($json_response->questions as $index => $question) {
            $response = $json_response->responses[$index] ?? '';
            fputcsv($csv_file, [$question, $response]);
        }

        fclose($csv_file);

        return;
    }
}
