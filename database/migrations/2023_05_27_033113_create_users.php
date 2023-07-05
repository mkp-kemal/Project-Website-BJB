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
        Schema::create('users', function (Blueprint $table) {
            $table->increments("id_user");
            $table->string("username")->unique();
            $table->string("name");
            $table->string("email")->unique();
            $table->string("address");
            $table->string("password");
            $table->string("contact");
            $table->string("credit_number")->unique();
            $table->string("account_number")->unique();
            $table->string("type_account");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
