<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class tr_user_registration extends Model
{
    use HasFactory;

    protected $table = 'tr_user_registration';
    protected $primaryKey = 'id_user_registration';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_user_registration',
        'id_user',
        'id_user_profile',
        'id_kelas',
        'id_program',
        'id_sub_program',
        'id_program_duration',
        'id_status_bayar',
        'kode_voucher',
        'total_biaya',
        'payment_deadline',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by',
    ];

    /**
     * Relasi ke User User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    /**
     * Relasi ke User Profile
     */
    public function user_profile()
    {
        return $this->belongsTo(m_user_profile::class, 'id_user_profile', 'id_user_profile');
    }

    /**
     * Relasi ke Kelas
     */
    public function kelas()
    {
        return $this->belongsTo(m_kelas::class, 'id_kelas', 'id_kelas');
    }

    /**
     * Relasi ke Program
     */
    public function program()
    {
        return $this->belongsTo(m_program::class, 'id_program', 'id_program');
    }

    /**
     * Relasi ke Sub Program
     */
    public function sub_program()
    {
        return $this->belongsTo(m_sub_program::class, 'id_sub_program', 'id_sub_program');
    }

    /**
     * Relasi ke Program Duration
     */
    public function program_duration()
    {
        return $this->belongsTo(m_program_duration::class, 'id_program_duration', 'id_program_duration');
    }

    /**
     * Relasi ke Program Duration
     */
    public function status_bayar()
    {
        return $this->belongsTo(m_status_bayar::class, 'id_status_bayar', 'id_status_bayar');
    }

    /**
     * Relasi ke Kode Voucher
     */
    public function kode_kupon()
    {
        return $this->hasMany(tr_registration_kupon::class, 'id_user_registration', 'id_user_registration');
    }
}
