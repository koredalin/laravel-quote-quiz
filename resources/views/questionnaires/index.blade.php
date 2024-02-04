@extends('layouts.quiz')

@section('title', $title)

@section('content')
<h1 class="text-2xl font-bold mb-4 text-center">@yield('title')</h1>
<br>

<script>
    const durationInSeconds = {{$durationInSeconds}};</script>

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
        <input type="text" placeholder="Name" name="name" class="mb-4">
        <input type="text" placeholder="Last name" name="surname" class="mb-4">
        <input type="email" placeholder="Email" name="email" class="mb-4">
        <a type="button" href="javascript:void(0)" onclick="startTimer()" id="timer_start_button" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded">Timer Start</a>
        <div id="timer">{{ date('H:i:s', $durationInSeconds) }}</div>
        <div id="questions_container" class="hidden"></div>
        <a type="button" id="submit" href="javascript:void(0)" onclick="submit()" class="hidden mt-4 px-4 py-2 bg-blue-500 text-white rounded">Submit</a>
      </form>

      <div id="unanswer_questions_number" class="hidden darkred">The number of unanswered questions is <span id="unanswer_questions_number_val"></span>.</div>
      <div>
        <a type="button" href="javascript:void(0)" onclick="reset()" id="reset_button" class="hidden mt-4 px-4 py-2 bg-blue-500 text-white rounded">Reset</a>
      </div>

      <div>
        <button href="javascript:void(0)" onclick="closeModal()" class="mt-3 text-indigo-600 hover:text-indigo-900">Close</button>
      </div>
    </div>
  </div>
</div>

<div id="internal_links">
  <p><a href="/">Home - Top Scores</a></p>
</div>
@endsection
