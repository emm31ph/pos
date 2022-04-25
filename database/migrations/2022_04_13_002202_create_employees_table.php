<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->integer('branch_id');
            $table->string('emp_number', 30);
            $table->string('lastname', 50);
            $table->string('firstname', 50);
            $table->string('middlename', 50)->nullable();
            $table->string('suffix', 50)->nullable();
            $table->date('birthdate')->nullable();
            $table->string('email', 50)->nullable();
            $table->string('mobile', 50)->nullable();
            $table->string('religion', 30)->nullable();
            $table->string('civilstatus', 6)->nullable();
            $table->string('gender', 6)->nullable();
            $table->string('status', 6)->nullable();
            $table->string('emptype', 6)->nullable();
            $table->string('image')->nullable();
            $table->date('datehired')->nullable()->comment('date hired');
            $table->string('position', 6)->nullable()->comment('position');
            $table->string('department', 6)->nullable()->comment('department');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
            $table->unique('emp_number');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
