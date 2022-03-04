<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePsiProjectTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('psi_project_types', function (Blueprint $table) {
            $table->bigInteger('prj_type_id');
            $table->string('prj_type_name', 255);
            $table->bigInteger('region_id');
            $table->tinyInteger('synched', 3);
            $table->dateTime('sync_date', 0);
            $table->dateTime('date_encoded', 0);
            $table->dateTime('last_updated', 0);
            $table->string('encoder', 255);
            $table->string('updater', 255);
            $table->text('section_ids');
            $table->string('prj_image', 255);
            $table->text('doctype_ids', 255);
            $table->text('doctype_names', 255);
            $table->text('section_names', 255);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('psi_project_types');
    }
}
