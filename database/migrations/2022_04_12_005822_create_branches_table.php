<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branch', function (Blueprint $table) {
            $table->id(); 
            $table->string('branch',30);
            $table->string('name',30);
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->unique('branch')->references('branch_id')->on('user_branch')->onDelete('cascade')->references('branch')->on('serial')->onDelete('cascade');
            
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
        Schema::dropIfExists('branch');
    }
}
