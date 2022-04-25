<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('itemcode', 30)->unique();
            $table->string('fulltitle', 100);
            $table->string('fulldesc')->nullable();
            $table->string('barcode', 100)->nullable();
            $table->string('category', 6)->nullable();
            $table->string('status', 3)->default('000');
            $table->string('uom', 6)->nullable();
            $table->integer('size')->default(0);
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
        Schema::dropIfExists('items');
    }
}
