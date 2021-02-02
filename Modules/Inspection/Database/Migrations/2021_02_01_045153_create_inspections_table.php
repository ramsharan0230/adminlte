<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInspectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inspections', function (Blueprint $table) {
            $table->id();
            $table->string('location')->nullable();
            $table->string('start_date')->nullable();
            $table->text('findings', 10000)->nullable();
            $table->text('pca', 10000)->nullable();
            $table->string('accountibility')->nullable();
            $table->string('closing_date')->nullable();
            $table->boolean('status', 0, 1)->default(1);
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->boolean('approvedBy_hygiene', 0, 1)->default(0);
            $table->boolean('approvedBy_siteman', 0, 1)->default(0);
            $table->boolean('approvedBy_opman', 0, 1)->default(0);
            $table->boolean('approvedBy_sropman', 0, 1)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inspections');
    }
}
