@extends('layouts.app')

@section('content')
    <h2>Uploaded PDFs</h2>

    <ul>
        @foreach($exams as $exam)
            <li>
                <strong>{{ $exam->exam_title }}</strong>
                <a href="{{ route('viewPDF', $exam->id) }}">View Details</a>
            </li>
        @endforeach
    </ul>
@endsection