<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sibling_applicant', function (Blueprint $table) {
            $table->id();
            $table->string('siblingName');
            $table->date('siblingDOB');
            $table->integer('siblingAge');
            $table->string('occupation')->nullable();
            $table->string('emp_ins')->nullable();
            $table->string('icNum');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sibling_applicant');
    }
};
