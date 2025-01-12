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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->enum('type', [
                \App\Enum\ExpenseType::RENT_MORTGAGE->value,
                \App\Enum\ExpenseType::PROPERTY_TAXES->value,
                \App\Enum\ExpenseType::HOME_INSURANCE->value,
                \App\Enum\ExpenseType::ELECTRICITY->value,
                \App\Enum\ExpenseType::WATER->value,
                \App\Enum\ExpenseType::GAS->value,
                \App\Enum\ExpenseType::INTERNET_PHONE->value,
                \App\Enum\ExpenseType::CAR_PAYMENT->value,
                \App\Enum\ExpenseType::GASOLINE_FUEL->value,
                \App\Enum\ExpenseType::PUBLIC_TRANSPORTATION->value,
                \App\Enum\ExpenseType::CAR_INSURANCE->value,
                \App\Enum\ExpenseType::GROCERIES->value,
                \App\Enum\ExpenseType::DINING_OUT->value,
                \App\Enum\ExpenseType::HEALTH_INSURANCE->value,
                \App\Enum\ExpenseType::DOCTOR_VISITS->value,
                \App\Enum\ExpenseType::PRESCRIPTIONS->value,
                \App\Enum\ExpenseType::HAIRCUTS_STYLING->value,
                \App\Enum\ExpenseType::TOILETRIES->value,
                \App\Enum\ExpenseType::STUDENT_LOANS->value,
                \App\Enum\ExpenseType::CREDIT_CARD_BILLS->value,
                \App\Enum\ExpenseType::STREAMING_SERVICES->value,
                \App\Enum\ExpenseType::HOBBIES->value,
                \App\Enum\ExpenseType::APPAREL->value,
                \App\Enum\ExpenseType::EMERGENCY_FUND->value,
                \App\Enum\ExpenseType::RETIREMENT_SAVINGS->value,
            ]);
            $table->decimal('amount', 15, 2);
            $table->text('description')->nullable();
            $table->date('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
