<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spaces', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\User::class, 'creator_id');
            $table->string('name');
            $table->string('profile_photo_path', 2048)->nullable();
            $table->string('visibility')->default('public');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->timestamps();
            
        });
        if(config('database.default') === 'pgsql') {
            $DB = config('app.aliases.DB');
            $DB::statement('CREATE INDEX spaces_searchable_index ON spaces USING GIST (searchable)');
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spaces');
    }
}
