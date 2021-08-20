<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseVideoQuizAnswer extends Model
{
    protected $table = 'course_video_quiz_answer';

    protected $fillable = ['courseclass_id', 'user_id', 'question_id', 'user_answer', 'answer'];

    public function coursevideoquiz()
    {
        return $this->belongsTo('App\CourseVideoQuiz','question_id','id');
    } 
}
