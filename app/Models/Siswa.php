<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $table = 'siswa';
    protected $primaryKey = 'nis';
    // jika id atau primary key bukan auto increment, maka definisikan
    public $incrementing = false;
    // jika primary key bukan bilangan bulat, maka definisikan
    protected $keyType = 'string';
    // Jika tabel tidak memeiliki coloum craet_at dan update_at, kalian harus mendefinisikan properti $timestamps pada model kalian dengan nilai false
    public $timestamps = false;

    protected $fillable = [
        'nis',
        'nama',
        'jk',
        'alamat',
        'tmp_lahir',
        'tgl_lahir',
        'telepon',
        'id_jurusan',
        'nilai'
    ];
}
