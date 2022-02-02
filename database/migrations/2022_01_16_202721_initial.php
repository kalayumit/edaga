<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Initial extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        //
        Schema::create('lookup_types', function (Blueprint $table) {
            $table->string('id', 36)->primary();
            $table->string('code');
            $table->string('name');
            $table->string('local_name');
            $table->integer('order')->default(0);
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
        //
        //
        Schema::create('lookups', function (Blueprint $table) {
            $table->string('id', 36)->primary();
            $table->string('code');
            $table->string('name');
            $table->string('local_name');
            $table->integer('order')->default(0);
            $table->string('lookup_type_id', 36);
            $table->boolean('status')->default(1);
            $table->boolean('is_default')->default(0);
            $table->timestamps();
            
            $table->foreign('lookup_type_id')->references('id')->on('lookup_types');
        });
        Schema::create('customers', function (Blueprint $table) {
            $table->string('id', 36)->primary();
            $table->string('name', 50);
            $table->string('email', 20);
            $table->string('telephone', 20);
            $table->string('address', 100);
            $table->string('account', 50);
            $table->string('group_id', 36);
            $table->boolean('status')->default(1);
            $table->timestamps();
            
            $table->foreign('group_id')->references('id')->on('lookups');
        });
        //
        //
        Schema::create('roles', function (Blueprint $table) {
            $table->string('id', 36)->primary();
            $table->string('name');
            $table->timestamps();
        });
        //
        //
        Schema::create('users', function (Blueprint $table) {
            $table->string('id', 36)->primary();
            $table->string('full_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('photo')->nullable();
            $table->boolean('status')->default(true);
            $table->rememberToken();
            $table->timestamps();
        });
        //
        //
        Schema::create('user_roles', function (Blueprint $table) {
            $table->string('id', 36)->primary();
            $table->string('user_id', 36);
            $table->string('role_id', 36);
            
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('role_id')->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
        Schema::dropIfExists('roles');
        Schema::dropIfExists('customers');
        Schema::dropIfExists('user_roles');
        Schema::dropIfExists('users');
        Schema::dropIfExists('lookups');
        Schema::dropIfExists('lookup_types');
    }
}
