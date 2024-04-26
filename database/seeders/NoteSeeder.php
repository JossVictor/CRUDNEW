<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Note;

class NoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $note = new Note();
        $note->title = "Primer nota";
        $note->content = "Nota a traves de seeder";
        $note->category_id = 1;
        $note->active = true;
        $note->save();
    }
}
