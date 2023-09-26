<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\TransactionType;
use App\Models\TransactionOperationType;
use App\Models\Transactions;
use App\Models\User;
use App\Models\Log;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        Schema::dropIfExists('transaction_types');
        Schema::create('transaction_types', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->timestamps();
        });

        Schema::dropIfExists('transaction_operation_types');
        Schema::create('transaction_operation_types', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->timestamps();
        });

        Schema::dropIfExists('transactions');
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('numero');
            $table->double('montant');
            $table->foreignIdFor(TransactionType::class);
            $table->foreignIdFor(TransactionOperationType::class);
            $table->foreignIdFor(Log::class);
            $table->timestamps();
        });

        Schema::dropIfExists('users');
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->integer('type_admin')->default(0);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::dropIfExists('logs');
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->string('type_activite');
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Transactions::class)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
