<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDosenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dosen', function (Blueprint $table) {
            $table->bigIncrements('iddosen');
            $table->integer('id_dosen');
            $table->string('nip_dosen');
            $table->string('nidn');
            $table->string('nidn_simpeg');
            $table->string('qr_code');
            $table->string('nama');
            $table->string('gelar_depan');
            $table->string('gelar_belakang');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->float('IP');
            $table->enum('kelamin');
            $table->enum('status_data');
            $table->enum('status_rev_luar');
            $table->string('author_id');
            $table->integer('id_jenis_kelamin');
            $table->integer('id_jabatan_fungsional');
            $table->integer('id_jabatan_struktural');
            $table->integer('id_status_pegawai');
            $table->integer('id_gol_ruang');
            $table->integer('id_status_henti');
            $table->integer('id_status_kawin');
            $table->integer('id_status_studi');
            $table->integer('id_unit');
            $table->integer('id_sub_unit');
            $table->integer('id_prodi_homebase');
            $table->string('file_foto_url');
            $table->integer('file_foto_size');
            $table->string('file_foto_type');
            $table->string('telp');
            $table->string('email');
            $table->integer('id_jurusan');
            $table->string('update_data');
            $table->text('alamat');
            $table->string('password');
            $table->string('password_asli');
            $table->timestamps('tanggal_chrontab');
            $table->integer('hindex');
            $table->datetime('date_hindex');
            $table->string('pendidikan');
            $table->integer('id_jenis_staf');
            $table->string('id_sinta');
            $table->integer('id_pendidikan_tertinggi');
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dosen');
    }
}
