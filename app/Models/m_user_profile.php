<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class m_user_profile extends Model
{
    use HasFactory;

    protected $table = 'm_user_profile';
    protected $primaryKey = 'id_user_profile';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'id_user',
        'nama',
        'jurusan_kampus_favorit',
        'jam_belajar_favorit',
        'sosmed',
        'no_wa',
        'nama_akun_zoom',
        'email',
        'created_by',
        'updated_by',
    ];

    /**
     * Relasi ke user registration
     */
    public function user()
    {
        return $this->hasMany(User::class, 'id_user', 'id');
    }
}
