<?php

use Illuminate\Database\Seeder;

class ThemeConfigurationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //secure seeder running
        $this->command->error('You are about to erase configurations table!');


        if ($this->command->confirm('Do you wish to continue?'))
        {

        }
    }
}
