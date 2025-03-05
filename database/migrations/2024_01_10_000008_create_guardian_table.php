<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('guardian', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('ic');
            $table->string('citizen');
            $table->string('gender');
            $table->string('relation');
            $table->date('dob');
            $table->string('pob');
            $table->integer('age');
            $table->string('occupation');
            $table->string('phoneNum');
            $table->string('empName');
            $table->text('empAddress');
            $table->string('postcode');
            $table->string('email');
            $table->decimal('income', 10, 2);
            $table->string('copyIC')->nullable();
            $table->string('copySalaryLocation')->nullable();
            $table->string('icNum');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('guardian');
    }
};
