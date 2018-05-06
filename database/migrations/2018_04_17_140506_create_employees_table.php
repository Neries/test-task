<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('last_name', 100);
            $table->string('first_name', 100);
            $table->string('patronymic', 100);
            $table->string('position', 255);
            $table->timestamp('employment_date');
            $table->decimal('salary',10,2);
            $table->integer('chief_id')->nullable()->default(null);
            $table->string('avatar', 255)->nullable()->default(null);
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
