<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configs', function (Blueprint $table) {
            $table->id();
            $table->string('key');
            $table->string('label');
            $table->longText('value')->nullable();
            $table->string('type');
            $table->timestamps();
        });

        DB::table('configs')->truncate();

        DB::table('configs')->insert([
            'key' => 'hotline',
            'label' => 'Số hotline',
            'value' => null,
            'type' => 'text'
        ]);

        DB::table('configs')->insert([
            'key' => 'contract',
            'label' => 'Hợp đồng vay',
            'value' => null,
            'type' => 'ckeditor'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('configs');
    }
}
