<?php

use App\Models\User;
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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->string('nisn');
            $table->string('full_name');
            $table->enum('gender', ['male', 'female']);
            $table->string('birth_place');
            $table->date('birth_date');
            $table->string('religion');
            $table->text('address');
            $table->string('email');
            $table->string('whatsapp');
            $table->string('last_school');
            $table->text('org_experience')->nullable();
            $table->double('height');
            $table->double('weight');
            $table->text('history_illness')->nullable();
            $table->boolean('is_new');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
