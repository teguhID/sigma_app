<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class m_program_duration extends Model
{
    use HasFactory;

    protected $table = 'm_program_duration';
    protected $primaryKey = 'id_program_duration';
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
    public function config_durations()
    {
        return $this->hasMany(m_config_program_duration::class, 'id_program_duration', 'id_program_duration');
    }
}
