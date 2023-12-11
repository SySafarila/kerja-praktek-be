<?php

use App\Models\Student;
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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Student::class)->constrained()->cascadeOnDelete();
            $table->string('order_id')->unique();
            $table->string('fraud_status')->nullable();
            $table->string('transaction_id')->unique();
            $table->string('transaction_status');
            $table->string('payment_method');
            $table->string('virtual_account')->nullable();
            $table->string('bank')->nullable();
            $table->string('status_message')->nullable();
            $table->string('status_code')->nullable();
            $table->double('gross_amount');
            $table->text('link_qr_code')->nullable();
            $table->text('link_deeplink')->nullable();
            $table->text('link_get_status')->nullable();
            $table->text('link_cancel')->nullable();
            $table->text('minimarket')->nullable();
            $table->text('minimarket_payment_code')->nullable();
            $table->date('settlement_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
