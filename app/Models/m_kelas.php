<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class m_kelas extends Model
{
    use HasFactory;

    protected $table = 'm_kelas';
    protected $primaryKey = 'id_kelas';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'name',
        'desc',
        'created_by',
        'updated_by',
    ];
}
