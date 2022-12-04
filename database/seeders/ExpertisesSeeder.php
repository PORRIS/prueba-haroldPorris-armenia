<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExpertisesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('public.tst_expertises')->insert([
            ["description"=>'ARTES PLÁSTICAS'],
            ["description"=>'TEATRO'],
            ["description"=>'MÚSICA'],
            ["description"=>'DANZA'],
            ["description"=>'COCINA TRADICIONAL'],
            ["description"=>'JUEGOS TRADICIONALES'],
            ["description"=>'PROMOCIÓN DE LECTURA']

        ]);
    }
}
