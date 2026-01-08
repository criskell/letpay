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
        Schema::table('payments', function (Blueprint $table) {
            $table->string('idempotency_key')->unique();
            $table->renameColumn('amount_in_cents', 'grow_amount_in_cents');
            $table->integer('net_amount_in_cents');
            $table->enum('status', ['PENDING', 'APPROVED', 'FAILED']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->removeColumn('status');
            $table->removeColumn('net_amount_in_cents');
            $table->renameColumn('grow_amount_in_cents', 'net_amount_in_cents');
            $table->removeColumn('idempotency_key');
        });
    }
};
