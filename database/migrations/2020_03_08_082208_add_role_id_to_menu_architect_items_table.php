<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRoleIdToMenuArchitectItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(config('menu_architect.table_prefix') . config('menu_architect.table_name_items'), function ($table) {
            $table->integer('role_id')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(config('menu_architect.table_prefix') . config('menu_architect.table_name_items'), function ($table) {
            $table->dropColumn('role_id');
        });
    }
}
