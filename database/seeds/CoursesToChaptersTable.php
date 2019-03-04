<?php

use Illuminate\Database\Seeder;

class CoursesToChaptersTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('chapters')->truncate();
        $chapters = \App\Course::whereNotNull('parent_id')->get();

        foreach($chapters as $chapter)
        {
            $new_chapter = new \App\Chapter();
            $new_chapter->id = $chapter->id;
            $new_chapter->parent_id = $chapter->parent_id;
            $new_chapter->name = $chapter->name;
            $new_chapter->description = $chapter->description;
            $new_chapter->order_weight = $chapter->order_weight;
            $new_chapter->is_public = $chapter->is_public;
            $new_chapter->is_draft = $chapter->is_draft;
            $new_chapter->slug = $chapter->slug;
            $new_chapter->save();
        }


        $this->command->error('Migration finished');
    }
}
