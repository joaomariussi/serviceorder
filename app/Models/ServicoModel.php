<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ServicoModel extends Model
{
    use HasFactory;

    protected $table = 'servicos';

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(ClientesModel::class, 'id_cliente', 'id');
    }

}
