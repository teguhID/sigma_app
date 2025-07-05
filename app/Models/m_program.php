<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class m_program extends Model
{
    use HasFactory;

    protected $table = 'm_program';
    protected $primaryKey = 'id_program';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'name',
        'desc',
        'created_by',
        'updated_by',
    ];

    /**
     * Relasi ke config program duration
     */
    public function config_program_durations()
    {
        return $this->hasMany(m_config_program_duration::class, 'id_program', 'id_program');
    }

    /**
     * Relasi ke sub program
     */
    public function sub_programs()
    {
        return $this->hasMany(m_sub_program::class, 'id_program', 'id_program');
    }
}
