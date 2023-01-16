<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('item');
            $table->decimal('weight', 2, 2);
            $table->string('status');
            $table->unsignedBigInteger('branch_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('employee_id');
            $table->dateTime('date_placed');
            $table->dateTime('date_completed')->nullable();
            $table->foreign('branch_id')
                  ->references('id')
                  ->on('branchs')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->foreign('category_id')
                  ->references('id')
                  ->on('categories')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->foreign('employee_id')
                  ->references('id')
                  ->on('employees')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
