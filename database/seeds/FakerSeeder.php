<?php

use Illuminate\Database\Seeder;
use App\Course;
use App\Lesson;

class FakerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //secure seeder running
        $this->command->error('You are about to erase all courses, chapters and lessons!');


        if ($this->command->confirm('Do you wish to continue?'))
        {
            $courses = ['PHP', 'SOLID Principles', 'Design patterns', 'SQL', 'JavaScript'];
            $chapter_symbols = ['fas fa-search', 'fas fa-boxes', 'fas fa-align-left', ' fas fa-balance-scale', 'fas fa-cogs', 'fas fa-adjust', 'fas fa-atom'];
            $chapters_range = count($chapter_symbols);
//            $chapters = ['Beginner', 'Intermediary', 'Advanced', 'Extra'];
            $lessons_range = 55;

            $faker = Faker\Factory::create();

            DB::table('courses')->truncate();
            DB::table('lessons')->truncate();
            foreach($courses as $index => $course_name)
            {
                $course                 = new Course();
                $course->name           = $course_name;
                $course->description    = $faker->text(300);
                $course->order_weight   = $index+1;
                $course->is_public      = 1;
                $course->is_draft       = $faker->randomElement(array (0, !$course->is_public));
                $course->slug           = preg_replace('/^-+|-+$/', '', strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $course->name)));
                $course->created_at     = $faker->dateTimeThisYear($max = 'now', $timezone = null);
                $course->updated_at     = $course->created_at;

                $course->save();


                for ($i = 0; $i < rand(4, $chapters_range); $i++)
                {

                    $chapter                 = new Course();
                    $chapter->parent_id      = $course->id;
                    $chapter->name           = rtrim($faker->sentence($nbWords = 1, $variableNbWords = true), '.');
                    $chapter->description    = $faker->text(600);
                    $chapter->order_weight   = $i+1;
                    $chapter->is_public      = $course->is_public ? $faker->randomElement(array (1, 1, 0, 1, 1, 1)) : 0;
                    $chapter->is_draft       = $faker->randomElement(array (0, !$chapter->is_public));
                    $chapter->slug           = preg_replace('/^-+|-+$/', '', strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $chapter->name)));
                    $chapter->symbol_class   = $chapter_symbols[$i];
                    $chapter->created_at     = $faker->dateTimeThisYear($max = 'now', $timezone = null);
                    $chapter->updated_at     = $course->created_at;

                    $chapter->save();


                    for ($j = 0; $j < rand(2, $lessons_range); $j++)
                    {

                        $lesson                 = new Lesson();
                        $lesson->parent_id      = $chapter->id;
                        $lesson->name           = rtrim($faker->sentence($nbWords = 1, $variableNbWords = true), '.');
                        $lesson->description    = $faker->text(600);
                        $lesson->content        = $faker->text(1200);
                        $lesson->order_weight   = $j+1;
                        $lesson->is_public      = $chapter->is_public ? $faker->randomElement(array (1, 0, 1, 0, 1)) : 0;
                        $lesson->is_draft       = $faker->randomElement(array (0, !$lesson->is_public));
                        $lesson->slug           = preg_replace('/^-+|-+$/', '', strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $lesson->name)));
                        $lesson->created_at     = $faker->dateTimeThisYear($max = 'now', $timezone = null);
                        $lesson->updated_at     = $lesson->created_at;

                        $lesson->save();

                    }
                }
            }


        }
    }
}
