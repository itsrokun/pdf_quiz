@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>Uploaded PDFs</h1>
    @foreach($exams as $exam)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $exam->exam_title }}</h5>
                <p class="card-text">Director: {{ $exam->director }}</p>
                <p class="card-text">Marks: {{ $exam->marks }}</p>
                <p class="card-text">Time: {{ $exam->time }}</p>
                <a href="{{ route('viewPDF', $exam->id) }}" class="btn btn-primary">View Questions</a>
            </div>
        </div>
    @endforeach
</div>
@endsection