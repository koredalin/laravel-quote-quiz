<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Questionnaire') }}
        </h2>
    </x-slot>

    <div id="quotes_container">
        <div>
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
        </div>

          <form action="{{ route('admin.questionnaires.add_one') }}" method="post">
            @csrf
            <div class="mb-10 questionnaire-group">
                <label for="title">Questionnaire Title:</label>
                <input type="text" name="title" id="title" class="questionnaire-input" required>
            </div>
            <div class="mb-10 questionnaire-group">
                <label for="mode">Questionnaire Mode:</label>
                <select name="mode" id="mode" class="questionnaire-input" required>
                    <option value="binary">Binary</option>
                    <option value="multiple_choice">Multiple Choice</option>
                </select>
            </div>
            <div class="mb-10 questionnaire-group">
                <label for="description">Questionnaire Description:</label>
                <textarea id="description" name="description" class="questionnaire-input" rows="4"></textarea>
            </div>
            @for ($i = 0; $i < 10; $i++)
                <div id="combo_select{{ $i }}" class="combo-select mb-10">
                    <label for="quote_id{{ $i }}">Select a Quote:</label>
                    <input type="text" name="quote_search[{{ $i }}]" id="quote_search{{ $i }}" class="quote-search" placeholder="Search for a Quote" />
                    <select name="quote_id[{{ $i }}]" id="quote_id{{ $i }}" class="quote-select hidden" required>
                        <option value="0" selected>Select a Quote</option>
                    </select>
                </div>
            @endfor
            <div style="text-align: center;">
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
            </div>
        </form>

        <div id="internal_links">
          <p><a href="{{ route('questionnaires') }}">Questionnaires</a></p>
          <p><a href="{{ route('home') }}">Top Scores</a></p>
        </div>
    </div>
  
    <script src="{{ asset('js/questionnaires/create_one.js') }}"></script>
</x-app-layout>
