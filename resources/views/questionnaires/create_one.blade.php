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
            <div>
                <label for="name">Questionnaire Name:</label>
                <input type="text" name="name" id="name" required>
            </div>
            <div>
                <label for="mode">Questionnaire Mode:</label>
                <select name="mode" id="mode" required>
                    <option value="binary">Binary</option>
                    <option value="multiple_choice">Multiple Choice</option>
                </select>
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
            <div>
                <button type="submit">Submit</button>
            </div>
        </form>

        <div id="internal_links">
          <p><a href="{{ route('questionnaires') }}">Questionnaires</a></p>
          <p><a href="{{ route('home') }}">Top Scores</a></p>
        </div>
    </div>
  
    <script src="{{ asset('js/questionnaires/create_one.js') }}"></script>
</x-app-layout>
