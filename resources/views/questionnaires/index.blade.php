@extends('layouts.quiz')

@section('title', $title)

@section('content')
    <ul class="list-disc pl-5">
        @foreach ($questionnaires as $questionnaire)
            <li class="mb-2">{{ $questionnaire->title }}</li>
        @endforeach
    </ul>

    {{ $questionnaires->links() }}
@endsection
