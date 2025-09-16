<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	public function up(): void
	{
		Schema::create('orders', function (Blueprint $table) {
			$table->id();
			$table->string('client_sender');
			$table->string('client_receiver');
			$table->text('note_receiver')->nullable();
			$table->text('note_sender')->nullable();
			$table->unsignedBigInteger('id_hanghoa');
			$table->decimal('price', 12, 2)->default(0);
			$table->decimal('discount', 12, 2)->default(0);
			$table->string('status', 50)->default('pending');
			$table->text('ghichu_donhang')->nullable();
			$table->string('codebill')->unique();
			$table->unsignedBigInteger('manager_warehouse');
			$table->unsignedBigInteger('warehouse');
			$table->unsignedBigInteger('id_partner')->nullable();
			$table->string('staff');
			$table->timestamp('created_date')->nullable();
			$table->json('tags')->nullable();
			$table->timestamps();

			// Foreign keys
			$table->foreign('warehouse')->references('id')->on('tpl_warehouses');
			$table->foreign('manager_warehouse')->references('id')->on('tpl_warehouse_management');
		});
	}

	public function down(): void
	{
		Schema::dropIfExists('orders');
	}
};


