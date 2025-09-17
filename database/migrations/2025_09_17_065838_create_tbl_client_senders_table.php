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
        Schema::create('tbl_client_senders', function (Blueprint $table) {
            $table->id();
            // Core references
            $table->unsignedBigInteger('user_id');
            $table->unsignedTinyInteger('type');

            // Client info
            $table->string('fullname')->nullable();
            $table->string('phone', 50)->nullable();
            $table->unsignedTinyInteger('code')->nullable(); // 1,2,3
            $table->unsignedBigInteger('group_client')->nullable();
            $table->string('email')->nullable();
            $table->string('code_client')->nullable();
            $table->string('tax_code')->nullable();
            $table->dateTime('birtday')->nullable();
            $table->string('sex', 50)->nullable();
            $table->text('address')->nullable();
            $table->string('tags')->nullable();
            $table->text('notes')->nullable();

            // Indexes commonly queried
            $table->index(['user_id']);
            $table->index(['code_client']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_client_senders');
    }
};
