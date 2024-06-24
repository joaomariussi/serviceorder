<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method count()
 * @method static find($id)
 */
class ServicoModel extends Model
{
    use HasFactory;

    protected $table = 'servicos';

    protected $fillable = [
        'id_cliente',
        'nome_carro',
        'marca',
        'modelo',
        'ano',
        'placa',
        'valor_mao_de_obra',
        'valor_total',
        'created_at',
        'updated_at'
    ];

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(ClientesModel::class, 'id_cliente', 'id');
    }

    public function produtos(): HasMany
    {
        return $this->hasMany(ServicosProdutosModel::class, 'id_servico', 'id');
    }

}
