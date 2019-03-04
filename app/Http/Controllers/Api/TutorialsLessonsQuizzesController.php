<?php
/**
 * Created by PhpStorm.
 * User: eduard
 * Date: 14/11/18
 * Time: 18:39
 */

namespace App\Http\Controllers\Api;

use Validator;
use App\LessonSection;
use Illuminate\Support\Facades\Input;
use DB;
use Illuminate\Http\Request;

class TutorialsLessonsQuizzesController
{
    public function validateQuiz(string $course_slug, string $chapter_slug, string $lesson_slug, int $quiz_id, Request $request)
    {
        $api_response = [
            'status'    => 'error',
            'response'  => [
                'message' => 'Something went wrong',
                'action'  => ''
            ]
        ];

        // validate
        $rules = array(
            'response'        => 'required',
        );

        $validator = Validator::make(Input::all(), $rules);

        //check if options selected
        if ($validator->fails())
        {
            $api_response = [
                'status'    => 'success',
                'response'  => [
                    'message' => 'Please choose an option',
                    'action'  => 'no_pass'
                ]
            ];

            return json_encode($api_response);
        }
        else
        {
            //get the lesson
            $lesson = DB::table('courses as co')
                ->join('chapters as ch', 'co.id', '=', 'ch.parent_id')
                ->join('lessons as le', 'ch.id', '=', 'le.parent_id')
                ->where('co.slug', $course_slug)
                ->where('ch.slug', $chapter_slug)
                ->where('le.slug', $lesson_slug)
                ->where('co.is_public', 1)
                ->where('ch.is_public', 1)
                ->where('le.is_public', 1)
                ->selectRaw('le.id as lesson_id, le.name as lesson_name, le.description as lesson_description')
                ->first();

            //return that there is a problem
            if(!$lesson)
            {
                $api_response = [
                    'status'    => 'error',
                    'response'  => [
                        'message' => 'Lesson not found',
                        'action'  => ''
                    ]
                ];

                return json_encode($api_response);
            }

            //get lesson valid options
            $options = LessonSection::join('lessons_sections_options', 'lessons_sections.id', '=', 'lessons_sections_options.lesson_section_id')
                                            ->where('lessons_sections.lesson_id', $lesson->lesson_id)
                                            ->where('lessons_sections.id', $quiz_id)
                                            ->where('lessons_sections.type', 'quiz')
                                            ->where('lessons_sections.is_public', 1)
                                            ->where('lessons_sections_options.is_public', 1)
                                            ->select('value', 'is_valid')->get();

            //return that there is a problem
            if(!$options)
            {
                $api_response = [
                    'status'    => 'error',
                    'response'  => [
                        'message' => 'Options - quiz not found',
                        'action'  => '',
                    ]
                ];
                return json_encode($api_response);
            }

            //get the valid responses
            $correct_response = [];
            foreach ($options as $option)
            {
                if($option->is_valid)
                {
                    $correct_response[] = $option->value;
                }
            }

            //check response
            if($correct_response == $request->input('response'))
            {
                $api_response = [
                    'status'    => 'success',
                    'response'  => [
                        'message' => 'Correct answer',
                        'action'  => 'pass',
                    ]
                ];
            }
            else
            {
                $api_response = [
                    'status'    => 'success',
                    'response'  => [
                        'message' => 'Incorrect answer',
                        'action'  => 'no_pass',
                    ]
                ];
            }

            return json_encode($api_response);

        }
    }
}