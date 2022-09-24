<?php

use App\Models\Company;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            
            
            $table->id();
            $table->longText('image')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->nullable();
            $table->string('phone');
            $table->string('status')->nullable();
            $table->foreignIdFor(User::class)->constraint()->onDelete('cascade')->nullable();
            $table->foreignIdFor(Company::class)->constraint()->onDelete('cascade')->nullable();
            $table->string('email2')->nullable();
            $table->string('mobile')->nullable();
            $table->string('address1')->nullable();
            $table->string('address2')->nullable();
            
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
        Schema::dropIfExists('contacts');
    }
};
