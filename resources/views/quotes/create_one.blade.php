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
        <form method="POST" action="{{ route('quotes.add_one') }}" class="max-w-sm mx-auto">
            @csrf
            <div class="mb-5">
                <label for="question" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Question:</label>
                <textarea  rows="3" class="quote-input form-control" id="question" name="question" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required></textarea>
            </div>
            <div class="mb-5">
                <label for="mode" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mode:</label>
                <select class="quote-input form-control" id="mode" name="mode" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required>
                    <option value="binary">Binary</option>
                    <option value="multiple_choice">Multiple Choice</option>
                </select>
            </div>
            <div class="mb-5">
                <label for="answer_a" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Answer A:</label>
                <input type="text" class="quote-input form-control" id="answer_a" name="answer_a" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light">
            </div>
            <div class="mb-5">
                <label for="answer_b" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Answer B:</label>
                <input type="text" class="quote-input form-control" id="answer_b" name="answer_b" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light">
            </div>
            <div class="mb-5">
                <label for="answer_c" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Answer C:</label>
                <input type="text" class="quote-input form-control" id="answer_c" name="answer_c" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light">
            </div>
            <div class="mb-5">
                <label for="right_answer" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">The Right Answer:</label>
                <select class="quote-input form-control" id="right_answer" name="right_answer" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required>
                    <option value="">Plese, select an answer.</option>
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                </select>
            </div>
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Create Quote</button>
        </form>

        <div id="internal_links">
          <p><a href="{{ route('home') }}">Top Scores</a></p>
          <p><a href="{{ route('questionnaires') }}">Questionnaires List</a></p>
        </div>
    </div>
  
    <script src="{{ asset('js/quotes/create_one.js') }}"></script>
</x-app-layout>
