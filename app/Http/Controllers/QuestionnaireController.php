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
        $validationArray = [
            'title' => 'required|string|max:255',
            'mode' => 'required|in:'.Quote::MODE_BINARY.','.Quote::MODE_MULTIPLE_CHOICE,
            'description' => 'nullable',
            'quote_id' => 'required|array',
            'quote_id.*' => 'exists:quotes,id',
        ];
        $validator = ValidatorFacade::make($request->all(), $validationArray);
        
        $isSqlSuccess = true;
        $sqlResultMessage = '';
        try {
            if (!$validator->fails()) {
                $questionnaire = new Questionnaire();
                $questionnaire->title = $request->title;
                $questionnaire->mode = $request->mode;
                $questionnaire->description = $request->description;
                $questionnaire->save();
                
                $questionnaire->quotes()->attach($request->quote_id);
                $questionnaire->save();
            }
        } catch(\Exception $e) {
            $sqlResultMessage = $e->getMessage();
            $isSqlSuccess = false;
        }

        if (!$validator->fails() && $isSqlSuccess) {
            session()->flash('message', 'The questionnaire was created successfully.');
            return redirect('/admin/questionnaires/create_one')->with('success', 'Quote created successfully');
        }

        session()->flash('message', 'Only the description field is optional. Please, fill all the rest.');

        return redirect('/admin/questionnaires/create_one')->with('fail', 'No questionnaire created. Please, fill correct data.');
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
