<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuArchitectItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( config('menu_architect.table_prefix') . config('menu_architect.table_name_items') , function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('label');
            $table->string('link')->nullable();
            $table->string('route')->nullable();
            $table->string('query_string')->nullable();
            $table->unsignedBigInteger('parent_id')->default(0);
            $table->integer('sort')->default(0);
            $table->string('class')->nullable();
            $table->unsignedBigInteger('menu_id');
            $table->integer('depth')->default(0);
            $table->string('icon')->nullable();
            $table->string('color')->default(config('menu_architect.table_default_color'));
            $table->string('target')->default(config('menu_architect.table_default_target'));
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
        Schema::dropIfExists( config('menu_architect.table_prefix') . config('menu_architect.table_name_items'));
    }
}
