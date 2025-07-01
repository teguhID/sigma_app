<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class m_config_program_duration extends Model
{
    use HasFactory;

    protected $table = 'm_config_program_duration';
    protected $primaryKey = 'id_config_program_duration';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'id_program',
        'id_sub_program',
        'id_program_duration',
        'harga',
        'tanggal_mulai',
        'tanggal_selesai',
        'created_by',
        'updated_by',
    ];

    /**
     * Relasi ke Program
     */
    public function program()
    {
        return $this->belongsTo(m_program::class, 'id_program', 'id_program');
    }

    /**
     * Relasi ke Program
     */
    public function subProgram()
    {
        return $this->belongsTo(m_sub_program::class, 'id_sub_program', 'id_sub_program');
    }

    /**
     * Relasi ke Program Duration
     */
    public function programDuration()
    {
        return $this->belongsTo(m_program_duration::class, 'id_program_duration', 'id_program_duration');
    }
}
