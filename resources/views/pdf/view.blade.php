@extends('layouts.app')

@section('content')
    <h2>{{ $exam->exam_title }}</h2>
    <p><strong>Director:</strong> {{ $exam->director }}</p>
    <p><strong>Marks:</strong> {{ $exam->marks }}</p>
    <p><strong>Time:</strong> {{ $exam->time }}</p>

    <h3>Questions</h3>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Question</th>
                <th>Options</th>
                <th>Answer</th>
                <th>Solution</th>
            </tr>
        </thead>
        <tbody>
            @foreach($questions as $q)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $q->question_text }}</td>
                    <td>
                        A. {{ $q->option_a }}<br>
                        B. {{ $q->option_b }}<br>
                        C. {{ $q->option_c }}<br>
                        D. {{ $q->option_d }}
                    </td>
                    <td>{{ $q->correct_option }}</td>
                    <td>{{ $q->solution }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
