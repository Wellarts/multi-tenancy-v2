<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = ['name','anexo_rg'];

    public function members() {

        return $this->belongsToMany(User::class);

    }

    public function Paciente() {

        return $this->belongsToMany(Paciente::class);

    }

    public function Encaminhamento() {

        return $this->belongsToMany(Encaminhamento::class);

    }
    public function TipoEncaminhamento() {

        return $this->belongsToMany(TipoEncaminhamento::class);

    }





}
