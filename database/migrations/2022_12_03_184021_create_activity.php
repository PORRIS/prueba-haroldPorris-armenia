<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tst_activity', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('consecutive');
            $table->string('activity_name');
            $table->integer('cultural_right_id');
            $table->integer('nac_id');
            $table->date('activity_date');
            $table->time('start_time');
            $table->time('final_hour');
            $table->integer('expertise_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('cultural_right_id')
                ->references('id')
                ->on('public.tst_cultural_rights');

            $table->foreign('nac_id')
                ->references('id')
                ->on('public.tst_nacs');

            $table->foreign('expertise_id')
                ->references('id')
                ->on('public.tst_expertises');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tst_activity');
    }
};
