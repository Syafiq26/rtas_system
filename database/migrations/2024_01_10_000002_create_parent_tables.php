<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('father_applicant', function (Blueprint $table) {
            $table->id();
            $table->string('fatherName');
            $table->string('fatherIC')->unique();
            $table->string('citizen');
            $table->date('fatherDOB');
            $table->string('fatherPOB');
            $table->integer('fatherAge');
            $table->string('copyIC')->nullable();
            $table->string('occupation');
            $table->string('fatherPhone');
            $table->string('fatherEmployer');
            $table->string('addressEmployer');
            $table->string('postcode');
            $table->string('fatherEmail')->unique();
            $table->decimal('fatherIncome', 10, 2);
            $table->string('copySalaryLocation')->nullable();
            $table->string('icNum');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('mother_applicant', function (Blueprint $table) {
            $table->id();
            $table->string('motherName');
            $table->string('motherIC')->unique();
            $table->string('citizen');
            $table->date('motherDOB');
            $table->string('motherPOB');
            $table->integer('motherAge');
            $table->string('copyIC')->nullable();
            $table->string('occupation');
            $table->string('motherPhone');
            $table->string('motherEmployer');
            $table->string('addressEmployer');
            $table->string('postcode');
            $table->string('motherEmail')->unique();
            $table->decimal('motherIncome', 10, 2);
            $table->string('copySalaryLocation')->nullable();
            $table->string('icNum');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('father_applicant');
        Schema::dropIfExists('mother_applicant');
    }
};
