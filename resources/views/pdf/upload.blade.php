@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>Upload PDF</h1>
    <form action="{{ route('uploadPDF') }}" method="POST" enctype="multipart/form-data">


@csrf
        <div class="mb-3">
            <label for="pdf" class="form-label">Choose PDF File</label>
            <input type="file" name="pdf" id="pdf" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
</div>
@endsection
