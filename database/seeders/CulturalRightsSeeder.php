<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CulturalRightsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('public.tst_cultural_rights')->insert([
            ["description"=>'IDENTIDAD Y PATRIMONIOS CULTURALES'],
            ["description"=>'REFERENCIAS A COMUNIDADES CULTURALES'],
            ["description"=>'ACCESO Y PARTICIPACIÓN EN LA VIDA CULTURAL'],
            ["description"=>'EDUCACIÓN Y FORMACIÓN'],
            ["description"=>'INFORMACIÓN Y COMUNICACIÓN'],
            ["description"=>'COOPERACIÓN CULTURAL']

        ]);
    }
}
