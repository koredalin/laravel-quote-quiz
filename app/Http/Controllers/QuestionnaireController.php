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

        return view('questionnaires.index', compact('questionnaires', 'title'));
    }
    
    public function getQuotes($id)
    {
        $questionnaire = Questionnaire::findOrFail($id);
        $questions = $questionnaire->quotes; // Предполагаме, че имате релация 'questions' в модела Questionnaire

        return response()->json($questions);
    }
}
