<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class m_role extends Model
{
    use HasFactory;

    protected $table = 'm_role';
    protected $primaryKey = 'id_role';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'name',
        'desc',
        'created_by',
        'updated_by',
    ];
}
