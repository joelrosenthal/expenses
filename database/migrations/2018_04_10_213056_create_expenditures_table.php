<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpendituresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenditures',
            function (Blueprint $table) {
                $table->increments('id');
                $table->dateTime('datetime');
                $table->string('location');
                $table->decimal('amount', 10, 2);
                $table->unsignedInteger('source_id');
                $table->integer('subcategory_id');
                $table->text('comments')->nullable();
                $table->softDeletes();
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
        Schema::dropIfExists('expenditures');
    }
}
