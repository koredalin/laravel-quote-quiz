<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Questionnaire;
use App\Models\Quote;
use Illuminate\Support\Facades\Validator as ValidatorFacade;
use Illuminate\Validation\Validator;
use App\Models\GuestUser;
use DateTime;
use App\Helpers\DateTimeHelper;

class QuestionnaireController extends Controller
{
    public const QUESTIONS_PER_QUESTIONNAIRE = 10;
    
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
    
    public function getQuotes(int $id)
    {
        $questionnaire = Questionnaire::findOrFail($id);
        $questions = $questionnaire->quotes;

        return response()->json($questions);
    }

    public function submitQuiz(int $id, Request $request)
    {
        // Input POST request data.
        $data = $request->all();
        
        $validator = $this->validateSubmitQuiz($id, $request);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $this->saveGuestUser($id, $request);

        return response()->json([
            'message' => 'Quiz submitted successfully',
            'id' => $id,
            'data' => json_encode($data),
        ]);
    }

    public function createOne()
    {
        return view('questionnaires.create_one');
    }

    public function addOne(Request $request)
    {
//        print_r($request->all()); exit;
        $validationArray = [
            'name' => 'required|string|max:255',
            'mode' => 'required|in:'.Quote::MODE_BINARY.','.Quote::MODE_MULTIPLE_CHOICE,
            'description' => 'nullable',
            'quote_search' => 'required|array',
            'quote_search.*' => 'exists:quotes,question',
            'quote_ids' => 'required|array',
            'quote_ids.*' => 'exists:quotes,id',
        ];
//        for ($i = 0; $i < self::QUESTIONS_PER_QUESTIONNAIRE; $i++) {
//            $validationArray['quote_search'.$i] = 'required|exists:quotes,question';
//            $validationArray['quote_id'.$i] = 'required|integer|exists:quotes,id';
//        }
        $validatedData = $request->validate($validationArray);

        // New Questionnaire creation.
//        $questionnaire = Questionnaire::create([
//            'name' => $request->input('name'),
//        ]);
        $questionnaire = new Questionnaire();
        $questionnaire->name = $validatedData['name'];
        $questionnaire->mode = $validatedData['mode'];
        $questionnaire->description = $validatedData['description'];
        $questionnaire->quotes()->attach($validatedData['quote_ids']);
        $questionnaire->save();
        
        session()->flash('message', 'The questionnaire was created successfully.');

        return redirect('/admin/questionnaires/create_one')->with('success', 'Quote created successfully');
    }

    private function validateSubmitQuiz(int $questionnaireId, Request $request): Validator
    {
        $questionnaire = Questionnaire::find($questionnaireId);
        
        $quotesFieldNames = [];
        $answerOptions = '';
        if (!empty($questionnaire) && !empty($questionnaire->quotes)) {
            foreach ($questionnaire->quotes as $quote) {
                $quotesFieldNames[] = 'quote_answer' . $quote->id;
            }
            $answerOptions = $questionnaire->mode === Quote::MODE_BINARY
                ? implode(',', Quote::MODE_BINARY_OPTIONS)
                : implode(',', Quote::MODE_MULTIPLE_CHOICE_OPTIONS);
        }
        
        $validatorFields = [];
        $validatorFields['name'] = 'required';
        $validatorFields['surname'] = 'required';
        $validatorFields['email'] = 'required|email';
        $validatorFields['time_elapsed'] = 'required|integer';
        $validatorFields['total_score'] = 'required|integer';
        $validatorFields['unanswered_questions_count'] = 'required|integer';
        $validatorFields['submit_time'] = 'required';
        foreach ($quotesFieldNames as $fieldName) {
            $validatorFields[$fieldName] = 'nullable|in:' . $answerOptions;
        }
        
        $validator = ValidatorFacade::make($request->all(), $validatorFields);
        $validator->after(function ($validator) use ($quotesFieldNames) {
            if (empty($quotesFieldNames)) {
                $validator->errors()->add('questionnaire_id', 'No such questionnaire found!');
            }
        });
        
        return $validator;
    }
    
    private function saveGuestUser(int $questionnaireId, Request $request): void
    {
        $guestUser = new GuestUser;
        $guestUser->name = $request->name;
        $guestUser->surname = $request->surname;
        $guestUser->email = $request->email;
        $guestUser->total_score = $request->total_score;
        $guestUser->unanswered_questions = $request->unanswered_questions_count;
        $guestUser->duration = $request->time_elapsed;
        $guestUser->questionnaire_id = $questionnaireId;
        $guestUser->submit_time_utc = new DateTime($request->submit_time_utc);
        $guestUser->created_at = DateTimeHelper::dateTimeNow();
        $guestUser->updated_at = DateTimeHelper::dateTimeNow();
        $guestUser->save();
    }
}
