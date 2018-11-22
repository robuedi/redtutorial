<?php
/**
 * Created by PhpStorm.
 * User: eduard
 * Date: 09/11/18
 * Time: 18:58
 */

namespace App\Http\Controllers\admin;


use App\LessonSection;
use App\LessonSectionOption;
use App\Http\Controllers\Controller;
use View;
use Illuminate\Support\Facades\Input;
use App\Libraries\UIMessage;
use Redirect;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Validation\Rule;
use Log;

class LessonsSectionsController extends Controller
{

    public function create($parent_id)
    {
        $new_lesson_section = new LessonSection();

        //get current max order;
        $max_order_number = LessonSection::where('lesson_id', $parent_id)->max('order_weight');
        $new_lesson_section->order_weight   = (int)$max_order_number+1;
        $new_lesson_section->lesson_id      = $parent_id;
        $new_lesson_section->is_public      = 0;
        $new_lesson_section->is_draft       = 1;
        $new_lesson_section->type           = 'text';
        $new_lesson_section->save();


        return View::make('_admin.lessons_sections.create_edit', [
            'lesson_section'        => $new_lesson_section,
        ]);
    }

    public function edit($id)
    {
        //get lesson section
        $lesson_section = LessonSection::where('id', $id)
            ->first();

        //check if exist
        if(!$lesson_section)
            abort(404);

        //get options
        $options = LessonSectionOption::where('lesson_section_id', $lesson_section->id)
                        ->orderBy('order_weight')
                        ->get();

        return View::make('_admin.lessons_sections.create_edit', [
            'lesson_section'    => $lesson_section,
            'options'           => $options,
        ]);

    }

    function update($id, Request $request)
    {
        $lesson_section = LessonSection::findOrFail($id);

        // validate
        $rules = array(
            'order_weight' => 'required',
            'type'      => [
                'required',
                Rule::in(['text', 'quiz']),
            ],
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails())
        {
            UIMessage::set('danger', $validator->messages()->all());
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }
        else
        {
            //save course
            $lesson_section->name           = $request->input('name');
            $lesson_section->content        = $request->input('content');

            //if went from quiz to text delete children options
            if($lesson_section->type === 'quiz' && $request->input('type') === 'text')
            {
                LessonSectionOption::where('lesson_section_id', $lesson_section->id)
                    ->delete();
            }

            $lesson_section->type           = $request->input('type');
            $lesson_section->options_type   = $request->input('options_type');
            $lesson_section->is_public      = $request->input('is_public') ? 1 : 0;
            $lesson_section->is_draft       = $request->input('is_draft') ? 1 : 0;
            $lesson_section->order_weight   = $request->input('order_weight');
            $lesson_section->save();

            //save options
            if($request->input('option_data'))
            {
                //delete the old options
                LessonSectionOption::where('lesson_section_id', $lesson_section->id)
                    ->delete();

                $i = 1;
                //add new options
                foreach ( $request->input('option_data.value') as $key => $value)
                {
                    $new_option = new LessonSectionOption();
                    $new_option->lesson_section_id = $lesson_section->id;
                    $new_option->value = $value;
                    $new_option->label = $request->input('option_data.label')[$key];
                    $new_option->is_valid = $request->input('option_data.is_valid')[$key];
                    $new_option->is_public = $request->input('option_data.is_public')[$key];
                    $new_option->order_weight = $i;
                    $new_option->save();

                    $i++;
                }
            }

            //send user back
            UIMessage::set('success', 'Lesson updated successfully.');
            if (Input::get('save_and_continue')) //redirect to the same page
            {
                return redirect(config('app.admin_route').'/lesson-section/'.$lesson_section->id.'/edit');
            }
            elseif (Input::get('save_and_add_new'))
                return redirect(config('app.admin_route').'/lessons-section/create/'.$lesson_section->lesson_id); // save and add new
            else
                return redirect(config('app.admin_route').'/lessons/'.$lesson_section->lesson_id.'/edit'); //redirect to listing
        }

    }

    public function destroy($id)
    {
        $lesson_section = LessonSection::where('id', $id)
            ->first();

        //check if exist
        if(!$lesson_section)
            abort(404);


        //check
        if($lesson_section->is_public === 1)
        {
            UIMessage::set('warning', 'The lesson section is public, so it is still in use.');
            return redirect()->back();
        }

        //delete any children inputs
        LessonSectionOption::where('lesson_section_id', $lesson_section->id)
            ->delete();

        //get parent id
        $parent_id = $lesson_section->lesson_id;

        //delete lesson section
        $lesson_section->delete();

        //update weight, get lessons
        $lesson_sections = LessonSection::where('lesson_id', $parent_id)
            ->orderBy('order_weight')
            ->get();

        $i = 1;
        foreach ($lesson_sections as $lesson_section)
        {
            $lesson_section->order_weight = $i;
            $lesson_section->update();
            $i++;
        }

        // still here? delete the field
        UIMessage::set('success', "Lesson section deleted successfully. Order weight updated.");

        return redirect(config('app.admin_route').'/lessons/'.$parent_id.'/edit');
    }
}