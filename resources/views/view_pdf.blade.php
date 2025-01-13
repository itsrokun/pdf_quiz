@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>{{ $exam->exam_title }}</h1>
    <p><strong>Director:</strong> {{ $exam->director }}</p>
    <p><strong>Marks:</strong> {{ $exam->marks }}</p>
    <p><strong>Time:</strong> {{ $exam->time }}</p>

    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>Question</th>
                <th>Options</th>
                <th>Correct Answer</th>
                <th>Solution</th>
            </tr>
        </thead>
        <tbody>
            @foreach($questions as $question)
                <tr>
                    <td>{{ $question->question_text }}</td>
                    <td>
                        <ul>
                            <li>ক. {{ $question->option_a }}</li>
                            <li>খ. {{ $question->option_b }}</li>
                            <li>গ. {{ $question->option_c }}</li>
                            <li>ঘ. {{ $question->option_d }}</li>
                        </ul>
                    </td>
                    <td>{{ $question->correct_option }}</td>
                    <td>{{ $question->solution }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection