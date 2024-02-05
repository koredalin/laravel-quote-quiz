<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quote;

class QuoteController extends Controller
{
    public function createOne()
    {
        return view('quotes.create_one');
    }

    public function addOne(Request $request)
    {
        $validatedData = $request->validate([
            'question' => 'required|string',
            'mode' => 'required|in:binary,multiple_choice',
            'answer_a' => 'nullable|string',
            'answer_b' => 'nullable|string',
            'answer_c' => 'nullable|string',
            'right_answer' => 'required|in:0,1,A,B,C',
        ]);

        $quote = new Quote();
        $quote->question = $validatedData['question'];
        $quote->mode = $validatedData['mode'];
        $quote->answer_a = $validatedData['answer_a'];
        $quote->answer_b = $validatedData['answer_b'];
        $quote->answer_c = $validatedData['answer_c'];
        $quote->right_answer = $validatedData['right_answer'];
        $quote->save();

        session()->flash('message', 'The quote was created successfully.');

        return redirect('/quotes/create_one')->with('success', 'Quote created successfully');
    }

    public function search(string $mode, string $text, Request $request)
    {
        $searchText = trim($text);

        $quotes = Quote::where('mode', $mode)
            ->where('question', 'LIKE', '%' . $searchText . '%')
            ->take(20)
            ->get();

        return response()->json(['quotes' => $quotes]);
    }
}
