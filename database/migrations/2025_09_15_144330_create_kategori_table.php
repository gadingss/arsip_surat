<?php

// database/migrations/xxxx_xx_xx_create_kategori_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKategoriTable extends Migration
{
    public function up()
    {
        Schema::create('kategori', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kategori', 100);
            $table->timestamps();
        });

        // seed default kategori
        DB::table('kategori')->insert([
            ['nama_kategori'=>'Undangan','created_at'=>now(),'updated_at'=>now()],
            ['nama_kategori'=>'Pengumuman','created_at'=>now(),'updated_at'=>now()],
            ['nama_kategori'=>'Nota Dinas','created_at'=>now(),'updated_at'=>now()],
            ['nama_kategori'=>'Pemberitahuan','created_at'=>now(),'updated_at'=>now()],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('kategori');
    }
}
