<?php

use App\Models\PetBreed;
use App\Models\PetSpecies;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->foreignIdFor(User::class)->nullable();
            $table->foreignIdFor(PetBreed::class)->nullable();
            $table->string('pet_breed')->nullable();
            $table->foreignIdFor(PetSpecies::class);
            $table->string('gender');
            $table->longText('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pets');
    }
};
