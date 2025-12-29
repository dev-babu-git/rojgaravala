<?php

namespace App\Imports;

use App\Models\Question;
use App\Models\Option;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;

class QuestionsImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        unset($rows[0]); // Remove header row

        foreach ($rows as $row) {

            $question = Question::create([
                'test_id' => $row[0],
                'question_text' => $row[1],
                'marks' => 1,
                'status' => 'active',
            ]);

            $options = [
                'A' => $row[2],
                'B' => $row[3],
                'C' => $row[4],
                'D' => $row[5],
            ];

            foreach ($options as $key => $text) {
                Option::create([
                    'question_id' => $question->id,
                    'option_text' => $text,
                    'is_correct' => ($row[6] == $key),
                ]);
            }
        }
    }
}
