<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_branches', function (Blueprint $table) {
            $table->id();
            $table->string('itemcode', 30);
            $table->string('branch', 30);
            $table->date('expdate')->nullable();
            $table->string('status', 3)->default('000');
            $table->decimal('qty', 8, 0)->default('0');
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
        Schema::dropIfExists('item_branches');
    }
}
