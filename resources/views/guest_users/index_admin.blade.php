<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Guest Users List') }}
        </h2>
    </x-slot>

    <div id="guest_users_container">
        <div id="top_scores">
            <h1>@yield('title')</h1>
            <h2>Top Scores</h2>
            <table id="top_scores_table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Total Score</th>
                        <th class="th-unaswered-questions">Total number of unanswered questions</th>
                        <th class="th-submit-date">Quiz Submit Date/Time</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($results as $result)
                        <tr>
                            <td>{{ $result->name }}</td>
                            <td>{{ $result->surname }}</td>
                            <td>{{ $result->email }}</td>
                            <td class="text-right">{{ $result->total_score }}</td>
                            <td class="text-right">{{ $result->unanswered_questions }}</td>
                            <td>{{ $result->submit_time_utc }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $results->links() }}
        </div>

        <div id="internal_links">
          <p><a href="{{ route('home') }}">Top Scores</a></p>
          <p><a href="{{ route('questionnaires') }}">Questionnaires List</a></p>
        </div>
    </div>
</x-app-layout>
