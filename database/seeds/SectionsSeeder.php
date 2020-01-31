<?php

use App\Section;
use Illuminate\Database\Seeder;

class SectionsSeeder extends Seeder
{
    /**
     * Count of fake sections
     */
    const COUNT = 15;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = self::COUNT - Section::count();
        if ($count > 0) factory(Section::class, $count)->create();
        $this->command->info('Total sections count: ' . Section::count());
    }
}
