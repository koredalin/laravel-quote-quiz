<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Въпросници</title>
</head>
<body>
    <h1>Въпросници</h1>
    <ul>
        @foreach ($questionnaires as $questionnaire)
            <li>{{ $questionnaire->title }}</li> <!-- Показва заглавието на въпросника -->
        @endforeach
    </ul>

    {{ $questionnaires->links() }} <!-- Показва линковете за пагинация -->
</body>
</html>