<?php 
namespace App\Imports;

use App\Models\Test;
use App\Models\Question;
use App\Models\Option;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;

class QuestionsOptionsImport implements ToCollection
{
    public array $errors = [];

    public function collection(Collection $rows)
    {
        unset($rows[0]); // header remove

        foreach ($rows as $index => $row) {

            $rowNumber = $index + 2; // Excel row number

            $validator = Validator::make($row->toArray(), [
                '0' => 'required|exists:tests,id',
                '1' => 'required|string|min:5',
                '2' => 'nullable|integer|min:1',
                '3' => 'required|string',
                '4' => 'required|string',
                '5' => 'nullable|string',
                '6' => 'nullable|string',
                '7' => 'required|integer|between:1,4',
            ]);

            if ($validator->fails()) {
                $this->errors[] = [
                    'row' => $rowNumber,
                    'errors' => $validator->errors()->all(),
                ];
                continue;
            }

            $question = Question::create([
                'test_id'        => $row[0],
                'question_text' => $row[1],
                'marks'         => $row[2] ?? 1,
                'status'        => 1,
            ]);

            $options = [
                1 => $row[3],
                2 => $row[4],
                3 => $row[5] ?? null,
                4 => $row[6] ?? null,
            ];

            foreach ($options as $i => $text) {
                if (!$text) continue;

                Option::create([
                    'question_id' => $question->id,
                    'option_text' => $text,
                    'is_correct'  => ((int)$row[7] === $i),
                ]);
            }
        }
    }
}
