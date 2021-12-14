<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JawabanVerifikasiUser extends Model
{
    use HasFactory;
    protected $table = 'jawaban_verifikasi_user';

    public function user() {
        return $this->belongsTo(User::class);
    }
}
