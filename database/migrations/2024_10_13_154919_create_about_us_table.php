<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('about_us', function (Blueprint $table) {
            $table->id();
            $table->string('sub_title');
            $table->text('description');
            $table->string('services_image');
            $table->text('service_1_desc');
            $table->text('service_2_desc');
            $table->text('service_3_desc');
            $table->text('packages_numbers_desc');
            $table->integer('packages_numbers_number');
            $table->text('clients_numbers_desc');
            $table->integer('clients_numbers_number');
            $table->text('apps_numbers_desc');
            $table->integer('apps_numbers_number');
            $table->text('info_1');
            $table->text('info_2');
            $table->text('completeness');
            $table->text('control');
            $table->text('proficiency');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_us');
    }
};
