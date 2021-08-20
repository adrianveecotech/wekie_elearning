<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CourseVideoQuiz;

class CourseVideoQuizController extends Controller
{
    public function post(Request $request, $id)
    {
        $video_quiz = new CourseVideoQuiz();
        $video_quiz->courseclass_id = $id;
        $video_quiz->question = $request->question;
        $video_quiz->a = $request->A;
        $video_quiz->b = $request->B;
        $video_quiz->c = $request->C;
        $video_quiz->d = $request->D;
        $video_quiz->answer = $request->correctanswer;
        $video_quiz->timeframe = $request->timeframe;
        $video_quiz->save();

        return back()->with('success', 'Video quiz question added !');
    }

    public function update(Request $request,$id)
    {
        $video_quiz = CourseVideoQuiz::find($id);
        $video_quiz->question = $request->question;
        $video_quiz->a = $request->A;
        $video_quiz->b = $request->B;
        $video_quiz->c = $request->C;
        $video_quiz->d = $request->D;
        $video_quiz->answer = $request->correctanswer;
        $video_quiz->timeframe = $request->timeframe;
        $video_quiz->save();

        return back()->with('success', 'Video quiz question edited !');


    }

    public function delete($id)
    {
        $video_quiz = CourseVideoQuiz::findorfail($id);
        $video_quiz->delete();

        return back()->with('deleted', 'Video quiz question deleted !');
    }
}
