<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Paciente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'data_nascimento',
        'endereco',
        'anexo_rg',
        'profissão',
        'telefone',
        'cor',
        'obs',
    ];

    public function Team() {
        return $this->belongsToMany(Team::class);
    }

    public function Encaminhamento() {
        return $this->hasMany(Encaminhamento::class);
    }

}
