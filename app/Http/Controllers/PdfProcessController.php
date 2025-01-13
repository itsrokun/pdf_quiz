<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Smalot\PdfParser\Parser;

class PdfProcessController extends Controller
{
    /**
     * Process the uploaded PDF to extract MCQ questions.
     */
    public function processPdfFile(Request $request)
    {
        // Validate that the file exists in storage and is a PDF
        $request->validate([
            'pdf_file' => 'required|mimes:pdf|max:10240',
        ]);

        $file = $request->file('pdf_file');
        $path = $file->storeAs('uploads', $file->getClientOriginalName(), 'public');

        // Parse the PDF
        $parser = new Parser();
        $pdf = $parser->parseFile(storage_path('app/public/' . $path));
        $text = $pdf->getText();

        // Send the extracted text back to the view for further handling
        return view('pdf.process-pdf', compact('text', 'path'));
    }
}
