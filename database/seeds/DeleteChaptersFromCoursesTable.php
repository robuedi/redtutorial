<?php

use Illuminate\Database\Seeder;

class DeleteChaptersFromCoursesTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //delete chapters from courses
        \App\Course::whereNotNull('parent_id')->delete();
    }
}
