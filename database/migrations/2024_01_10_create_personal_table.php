<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('personal', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('icNum');
            $table->string('copyIC')->nullable();
            $table->string('citizen');
            $table->enum('gender', ['male', 'female']);
            $table->date('dob');
            $table->string('pob');
            $table->text('address');
            $table->text('address2')->nullable();
            $table->string('city');
            $table->string('postcode');
            $table->string('state');
            $table->string('email');
            $table->string('phoneNum');
            $table->string('user_id');
            $table->timestamps();
            $table->softDeletes(); // This adds deleted_at column
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('personal');
    }
};
