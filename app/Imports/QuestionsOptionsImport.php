<?php

namespace App\Imports;

use App\Models\Test;
use App\Models\Question;
use App\Models\Option;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class QuestionsOptionsImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        unset($rows[0]); // remove header

        foreach ($rows as $row) {

            // Validate Test exists
            $test = Test::find($row[0]);
            if (!$test) {
                continue;
            }

            // Create Question
            $question = Question::create([
                'test_id' => $row[0],
                'question_text' => $row[1],
                'marks' => $row[2] ?? 1,
                'status' => 'active',
            ]);

            // Options
            $options = [
                1 => $row[3],
                2 => $row[4],
                3 => $row[5],
                4 => $row[6],
            ];

            foreach ($options as $index => $text) {
                if (!$text) continue;

                Option::create([
                    'question_id' => $question->id,
                    'option_text' => $text,
                    'is_correct' => ($row[7] == $index) ? 1 : 0,
                ]);
            }
        }
    }
}
