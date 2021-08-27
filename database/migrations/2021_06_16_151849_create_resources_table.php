<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resources', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->string('title')->nullable()->default('Untitled Resource');
            $table->integer('resourceable_id')->nullable();
            $table->string('resourceable_type')->nullable();
            $table->integer('resourceful_id')->nullable();
            $table->string('resourceful_type')->nullable();
            $table->timestamps();
            
            if(config('database.default') === 'pgsql') {
                $DB = config('app.aliases.DB');
                $DB::statement('CREATE INDEX resources_searchable_index ON resources USING GIST (searchable)');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resources');
    }
}
