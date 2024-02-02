@extends('layouts.quiz')

@section('title', $title)

@section('content')
    <ul class="list-disc pl-5">
        @foreach ($questionnaires as $questionnaire)
            <li><a href="javascript:void(0)" onclick="loadQuestions({{ $questionnaire->id }})">{{ $questionnaire->title }}</a></li>
            <!--<li class="mb-2"><a href="javascript:void(0)" onclick="loadQuestions({{ $questionnaire->title }})">{{ $questionnaire->title }}</a></li>-->
        @endforeach
    </ul>

    {{ $questionnaires->links() }}
    
    
    <!-- Modal window. -->
    <div id="modal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full" x-data="{ open: false }">
        <div class="relative top-20 mx-auto p-5 border w-3/4 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Questionnaire</h3>
                
                <form id="quizForm" class="mt-2">
                    <input type="text" placeholder="Име" name="name" class="mb-4">
                    <input type="text" placeholder="Фамилия" name="last_name" class="mb-4">
                    <input type="email" placeholder="Email" name="email" class="mb-4">
                    <div id="questionsContainer"></div>
                    <button type="submit" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded">Timer Start</button>
                </form>
                
                <button @click="open = false" class="mt-3 text-indigo-600 hover:text-indigo-900">Close</button>
            </div>
        </div>
    </div>
    
@endsection
