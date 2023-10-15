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
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('department_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('code')->nullable();
            $table->string('name');
            $table->float('school_hours', 4, 2)->default(0);
            $table->boolean('is_mandatory')->default(0);
            $table->float('price', 5, 2)->default(0);
            $table->string('guide', 255)->nullable();
            $table->foreignId('speciality_id')->nullable()->constrained()->onDelete('cascade');
            $table->boolean('is_collective')->default(1);
            $table->integer('student_ratio')->nullable()->default(0);
            $table->boolean('is_active')->default(1);
            $table->timestamps();
            $table->timestamp('archived_at')->nullable(); // Nuevo campo para la fecha de archivo
            $table->foreignId('school_year_id')->constrained()->onDelete('cascade'); // Nuevo campo para indicar el año escolar
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};
