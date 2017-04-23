<?php
/**
*
*/
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Lesson;
use App\Models\LessonWord;
use App\Models\Answer;

class AjaxController extends Controller
{
    public function getLesson()
    {
        if (request()->has('category_id')) {
            $category_id = request()->get('category_id');
            $lessons = Category::find($category_id)->lessons;
            $lesson_ids = [];
            $html = '<option value=""> Choose lesson </option>';
            foreach ($lessons as $lesson) {
                $lesson_ids[] = [$lesson->id, $lesson->name];
                $html .= '<option value="' . $lesson->id . '"> ' . $lesson->name . '</option>';
            }

            return response()->json(['html' => $html]);
        }
    }
    public function getLessonWord()
    {
        if (request()->has('lesson_id')) {
            $lesson_id = request()->get('lesson_id');
            $lessonWords = Lesson::find($lesson_id)->lessonWords;

            $html = '<option value=""> Choose lessonword </option>';
            foreach ($lessonWords as $lessonWord) {
                $html .= '<option value="' . $lessonWord->id . '"> ' . $lessonWord->content . '</option>';
            }

            return response()->json(['html' => $html]);
        }
    }
}
