<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Quiz Questions</title>
</head>
<body>
    <h1>Quiz Questions</h1>
    @foreach ($questions as $question)
        <div>
            <p><strong>Question:</strong> {{ $question->question }}</p>
            <p>ক. {{ $question->option_k }}</p>
            <p>খ. {{ $question->option_kh }}</p>
            <p>গ. {{ $question->option_g }}</p>
            <p>ঘ. {{ $question->option_gh }}</p>
            <p><strong>Answer:</strong> {{ $question->answer }}</p>
            <p><strong>Solution:</strong> {!! nl2br($question->solution) !!}</p>
        </div>
        <hr>
    @endforeach
</body>
</html>
