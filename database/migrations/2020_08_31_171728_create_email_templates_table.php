<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_templates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('key', 100);
            $table->string('title', 100);
            $table->string('subject', 255);
            $table->text('html_body')->nullable();
            $table->text('text_body')->nullable();
            $table->string('attachment', 100)->nullable();
            $table->timestamps();
        });
    }
}
