<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class tr_registration_kupon extends Model
{
    use HasFactory;

    protected $table = 'tr_registration_kupon';
    protected $primaryKey = 'id_registration_kupon';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'id_user_registration',
        'id_kode_kupon',
        'created_by',
        'updated_by',
    ];

    public function user_registration()
    {
        return $this->belongsTo(tr_user_registration::class, 'id_user_registration', 'id_user_registration');
    }

    public function kode_kupon()
    {
        return $this->belongsTo(m_kode_kupon::class, 'id_kode_kupon', 'id_kode_kupon');
    }
}
