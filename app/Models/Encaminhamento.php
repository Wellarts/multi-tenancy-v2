<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Encaminhamento  extends Model
{
    use HasFactory;

    protected $fillable = [
            'paciente_id',
            'tipoEncaminhamento_id',
            'team_id',
            'status',
            'anexos',
            'descricao',
    ];

    public function Team() {
        return $this->belongsToMany(Team::class);
    }

    public function Paciente() {
        return $this->belongsTo(Paciente::class);
    }

    public function tipoEncaminhamento() {
        return $this->belongsTo(TipoEncaminhamento::class, 'tipoEncaminhamento_id');
    }

    protected $casts = [
        'anexos' => 'array',
    ];
}
