<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NacsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('public.tst_nacs')->insert([
            ["description"=>'ALCALÁ'],
            ["description"=>'ANDALUCÍA'],
            ["description"=>'ANSERMANUEVO'],
            ["description"=>'ARGELIA'],
            ["description"=>'BOLÍVAR'],
            ["description"=>'BUENAVENTURA'],
            ["description"=>'BUGA']

        ]);
    }
}
