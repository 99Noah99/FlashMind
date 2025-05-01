<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

use Illuminate\Http\Request;

class AiController extends Controller
{
    public function generate(Request $request)
    {
        // Récupérer les données envoyées depuis le formulaire
        $input = $request->input('value');

        // Transmettre les données au composant React
        return Inertia::render('Home', [
            'response' => 'tu as réussi !!!',
        ]);
    }
}
