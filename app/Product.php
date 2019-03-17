<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [ //Atributos que podem ser preenchidos por formulario
        'nome', 'valor', 'descricao'
    ];
}
