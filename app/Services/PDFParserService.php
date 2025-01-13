<?php

namespace App\Services;

use Smalot\PdfParser\Parser;
use App\Models\QuizQuestion;

class PDFParserService
{
    protected $parser;

    public function __construct()
    {
        $this->parser = new Parser();
    }

    public function extractText($filePath)
    {
        $pdf = $this->parser->parseFile($filePath);
        $text = $pdf->getText();

        return $this->parseQuestions($text);
    }

    protected function parseQuestions($text)
    {
        $lines = explode("\n", $text);
        $questions = [];
        $current = null;

        foreach ($lines as $line) {
            $line = trim($line);

            if (preg_match('/^\d+\./', $line)) { // New question
                if ($current) {
                    $questions[] = $current;
                }
                $current = ['question' => $line, 'options' => [], 'answer' => '', 'solution' => ''];
            } elseif (preg_match('/^[কখগঘ]\./u', $line)) { // Options (ক, খ, গ, ঘ)
                $current['options'][] = $line;
            } elseif (preg_match('/উত্তরঃ/u', $line)) { // Answer
                $current['answer'] = $line;
            } elseif ($current) { // Solution or extra content
                $current['solution'] .= $line . " ";
            }
        }

        if ($current) {
            $questions[] = $current;
        }

        return $questions;
    }

    public function storeQuestions(array $questions, int $quizId)
    {
        foreach ($questions as $data) {
            QuizQuestion::create([
                'quiz_id' => $quizId,
                'question' => $data['question'],
                'option_k' => $data['options'][0] ?? null,
                'option_kh' => $data['options'][1] ?? null,
                'option_g' => $data['options'][2] ?? null,
                'option_gh' => $data['options'][3] ?? null,
                'answer' => $data['answer'],
                'solution' => $data['solution'],
            ]);
        }
    }
}