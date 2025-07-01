<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class m_status_bayar extends Model
{
    use HasFactory;

    protected $table = 'm_status_bayar';
    protected $primaryKey = 'id_status_bayar';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'name',
        'desc',
        'created_by',
        'updated_by',
    ];

    /**
     * Relasi ke user registration
     */
    public function userRegistration()
    {
        return $this->hasMany(m_config_program_duration::class, 'id_program', 'id_program');
    }
}
