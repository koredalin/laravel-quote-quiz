@extends('layouts.quiz')

@section('title', $title)

@section('content')

<div>
    @if (Route::has('login'))
        <div class="fixed top-0 profile-right px-6 py-4 sm:block">
            @auth
                <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                @endif
            @endauth
        </div>
    @endif
</div>

<div id="top_scores">
    <h1>@yield('title')</h1>
    <h2>Top Scores</h2>
    <table id="top_scores_table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Total Score</th>
                <th>Time Used</th>
                <th class="th-unaswered-questions">Total number of unanswered questions</th>
                <th class="th-submit-date">Quiz Submit Date/Time</th>
            </tr>
        </thead>
        <tbody>
            @foreach($results as $result)
                <tr>
                    <td>{{ $result->name }}</td>
                    <td>{{ $result->email }}</td>
                    <td class="text-right">{{ $result->total_score }}</td>
                    <td>{{ gmdate("H:i:s", $result->duration) }}</td>
                    <td class="text-right">{{ $result->unanswered_questions }}</td>
                    <td>{{ $result->submit_time_utc }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $results->links() }}
</div>

<div id="internal_links">
  <p><a href="/questionnaires">Questionnaires</a></p>
</div>
@endsection