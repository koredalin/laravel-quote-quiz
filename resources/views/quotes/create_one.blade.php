<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Quote') }}
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
        <form method="POST" action="{{ route('quotes.add_one') }}">
            @csrf
            <div class="form-group">
                <label for="question">Question:</label>
                <input type="text" class="form-control" id="question" name="question" required>
            </div>
            <div class="form-group">
                <label for="mode">Mode:</label>
                <select class="form-control" id="mode" name="mode" required>
                    <option value="binary">Binary</option>
                    <option value="multiple_choice">Multiple Choice</option>
                </select>
            </div>
            <div class="form-group">
                <label for="answer_a">Answer A:</label>
                <input type="text" class="form-control" id="answer_a" name="answer_a">
            </div>
            <div class="form-group">
                <label for="answer_b">Answer B:</label>
                <input type="text" class="form-control" id="answer_b" name="answer_b">
            </div>
            <div class="form-group">
                <label for="answer_c">Answer C:</label>
                <input type="text" class="form-control" id="answer_c" name="answer_c">
            </div>
            <div class="form-group">
                <label for="right_answer">Your Answer:</label>
                <select class="form-control" id="right_answer" name="right_answer" required>
                    <option value="">Plese, select</option>
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Create Quote</button>
        </form>

        <div id="internal_links">
          <p><a href="{{ route('questionnaires') }}">Questionnaires</a></p>
          <p><a href="{{ route('home') }}">Top Scores</a></p>
        </div>
    </div>
  
    <script src="{{ asset('js/quotes/create_one.js') }}"></script>
</x-app-layout>
