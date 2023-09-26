<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\TransactionType;
use App\Models\TransactionOperationType;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Log;
use App\Models\Compte;
use App\Models\Approvisionnement;

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
            $table->text('motif')->nullable();
            $table->double('montant');
            $table->boolean('deleted')->default(false);
            $table->foreignIdFor(TransactionType::class);
            $table->foreignIdFor(TransactionOperationType::class);
            $table->foreignIdFor(Log::class);
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Compte::class)->nullable();
            $table->timestamps();
        });

        Schema::dropIfExists('users');
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->integer('type_admin')->default(1);
            $table->boolean('first_type')->default(true);
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
            $table->foreignIdFor(Transaction::class)->nullable();
            $table->timestamps();
        });

        Schema::dropIfExists('comptes');
        Schema::create('comptes', function (Blueprint $table) {
            $table->id();
            $table->string('type_compte');
            $table->float('solde');
            $table->timestamps();
        });

        Schema::dropIfExists('approvisionnements');
        Schema::create('approvisionnements', function (Blueprint $table) {
            $table->id();
            $table->float('montant');
            $table->foreignIdFor(Compte::class);
            $table->foreignIdFor(User::class);
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
