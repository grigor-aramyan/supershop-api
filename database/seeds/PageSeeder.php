<?php

use Illuminate\Database\Seeder;

use App\PageSchema;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PageSchema::create([ 'page_id' => 1, 'name' => 'example-1' ]);
        PageSchema::create([ 'page_id' => 1, 'name' => 'example-2' ]);
        PageSchema::create([ 'page_id' => 1, 'name' => 'example-3' ]);
    }
}
