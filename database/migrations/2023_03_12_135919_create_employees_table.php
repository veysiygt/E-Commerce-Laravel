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
            $table->bigIncrements('id')->from(111000)->unique();
            $table->integer('role_id')->default(2);
            $table->string('name');
            $table->string('surname');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('telephone')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('img')->nullable();
            $table->string('identity_number')->unique();
            $table->string('mother_name')->nullable();
            $table->string('father_name')->nullable();
            $table->enum('gender', ['male', 'female']);
            $table->string('place_of_birth');
            $table->date('birth_date');
            $table->string('address');
            $table->string('api_token', 80)->unique()->nullable()->default(null);
            $table->rememberToken();
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
        Schema::dropIfExists('employees');
    }
}
