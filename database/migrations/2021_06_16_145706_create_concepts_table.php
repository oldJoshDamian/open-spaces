<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConceptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('concepts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Space::class);
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('code')->nullable();
            $table->timestamps();
        });
        if(config('database.default') === 'pgsql') {
            $DB = config('app.aliases.DB');
            $DB::statement('ALTER TABLE concepts ADD searchable tsvector NULL');
            $DB::statement('CREATE INDEX concepts_searchable_index ON concepts USING GIST (searchable)');
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('concepts');
    }
}
