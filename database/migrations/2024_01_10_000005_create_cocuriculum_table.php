<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cocuriculum', function (Blueprint $table) {
            $table->id();
            $table->string('cocuId');
            $table->string('cocuName');
            $table->string('cocuType');
            $table->string('represent');
            $table->string('role');
            $table->string('icNum');
            $table->string('copyCertLocation')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cocuriculum');
    }
};
