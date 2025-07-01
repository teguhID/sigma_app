<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class m_sub_program extends Model
{
    use HasFactory;

    protected $table = 'm_sub_program';
    protected $primaryKey = 'id_sub_program';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'id_program',
        'name',
        'desc',
        'created_by',
        'updated_by',
    ];

    /**
     * Relasi ke program
     */
    public function program()
    {
        return $this->belongsTo(m_program::class, 'id_program', 'id_program');
    }
}
