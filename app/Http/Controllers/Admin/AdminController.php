<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\DescriptionPage;
use App\Models\EducationJob;
use App\Models\State;
use App\Models\WebsitePage;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Test;

class AdminController extends Controller
{
    public function changeStatus(Request $request)
    {
        switch ($request->type) {
            case 'Category':
                $model = Category::class;
                break;

            case 'SubCategory':
                $model = SubCategory::class;
                break;

            case 'Description':
                $model = DescriptionPage::class;
                break;
            case 'EducationJob':
                $model = EducationJob::class;
                break;
            case 'State':
                $model = State::class;
                break;

            case 'Exam':
                $model = Exam::class;
                break;
            case 'WebsitePage':
                $model = WebsitePage::class;
                break;
            case 'Test':
                $model = Test::class;
                break;

            case 'Question':
                $model = Question::class;
                break;
            
            default:
                return response()->json(['success' => false, 'message' => 'Invalid type']);
        }

        $item = $model::find($request->id);

        if (!$item) {
            return response()->json(['success' => false]);
        }

        $item->status = $request->status;
        $item->save();
 
    return response()->json(['success' => true,"msg"=>'status updated']);
    }
}
