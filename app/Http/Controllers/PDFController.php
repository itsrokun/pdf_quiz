<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\Question;

class PDFController extends Controller
{
    /**
     * Display the PDF upload form.
     */
    public function showUploadForm()
    {
        return view('pdf.upload'); // Returns the view located at resources/views/pdf/upload.blade.php
    }

    /**
     * Handle the uploaded PDF.
     */
    public function uploadPDF(Request $request)
    {
        // Validate that the file is a PDF and does not exceed 10MB
        $request->validate([
            'pdf' => 'required|mimes:pdf|max:10240',
        ]);

        // Handle the file upload
        $file = $request->file('pdf');
        $path = $file->storeAs('uploads/pdfs', $file->getClientOriginalName(), 'public');

        // Parse and process PDF content
        $content = file_get_contents(storage_path('app/public/' . $path));

        // Extract metadata like Director, Marks, and Time
        preg_match('/Director:\s*(.*?)\s*Marks:\s*(\d+)\s*Time:\s*(\d+)/su', $content, $meta);

        // Create an exam record
        $exam = Exam::create([
            'pdf_name' => $file->getClientOriginalName(),
            'exam_title' => 'Mixed Exam',
            'director' => $meta[1] ?? null,
            'marks' => $meta[2] ?? null,
            'time' => isset($meta[3]) ? $meta[3] . ' min' : null, // Ensure proper time handling
        ]);

        // Extract all questions from the PDF content
        preg_match_all('/(\d+)\.\s(.*?)\sক\.(.*?)\sখ\.(.*?)\sগ\.(.*?)\sঘ\.(.*?)\sউত্তরঃ\s(.*?)\sসমাধানঃ\s(.*?)(?=\d+\.|\z)/su', $content, $questions, PREG_SET_ORDER);

        // Create question records
        foreach ($questions as $q) {
            Question::create([
                'exam_id' => $exam->id,
                'question_text' => $q[2],
                'option_a' => $q[3],
                'option_b' => $q[4],
                'option_c' => $q[5],
                'option_d' => $q[6],
                'correct_option' => $q[7],
                'solution' => $q[8],
            ]);
        }

        // Redirect back to the upload form with success message
        return redirect()->route('uploadForm')->with('success', 'PDF uploaded successfully. File stored at: ' . $path);
    }

    /**
     * List all uploaded PDFs (Exams).
     */
    public function listPDFs()
    {
        // Fetch all exams (PDFs)
        $exams = Exam::all();
        return view('list_pdfs', compact('exams'));
    }

    /**
     * View a specific exam's PDF and associated questions.
     */
    public function viewPDF($id)
    {
        // Fetch the exam and associated questions
        $exam = Exam::findOrFail($id);
        $questions = Question::where('exam_id', $exam->id)->get();
        return view('view_pdf', compact('exam', 'questions'));
    }
}