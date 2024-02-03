<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Questionnaire;

class QuestionnaireController extends Controller
{
    public function index()
    {
        $questionnaires = Questionnaire::paginate(10);
        $title = 'Questionnaires List';
        $durationInSeconds = 5 * 60;

        return view('questionnaires.index', compact(
            'questionnaires',
            'title',
            'durationInSeconds')
        );
    }
    
    public function getQuotes($id)
    {
        $questionnaire = Questionnaire::findOrFail($id);
        $questions = $questionnaire->quotes;

        return response()->json($questions);
    }
}
