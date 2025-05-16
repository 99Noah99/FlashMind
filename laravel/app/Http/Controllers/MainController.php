<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MainController extends Controller
{
    public function show_home()
    {
        return Inertia::render('Home');
    }

    public function download_csv($csv_file_name)
    {
        // Vérifie si le fichier existe
        if (! Storage::disk('local')->exists($csv_file_name)) {
            abort(404, 'File not found');
        }

        return Storage::download($csv_file_name, 'flashcards.csv');
    }
}
