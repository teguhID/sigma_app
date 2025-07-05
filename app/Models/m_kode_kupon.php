<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class m_kode_kupon extends Model
{
    use HasFactory;

    protected $table = 'm_kode_kupon';
    protected $primaryKey = 'id_kode_kupon';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'name',
        'kode',
        'persentase_diskon',
        'desc',
        'created_by',
        'updated_by',
    ];
}
