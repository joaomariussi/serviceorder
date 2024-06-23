<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static where(string $string, $id)
 */
class ServicosProdutosModel extends Model
{
use HasFactory;

    protected $table = 'servicos_produtos';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_servico',
        'id_cliente',
        'id_produto',
        'valor_produto',
        'nome_produto',
        'quantidade'
    ];

    public function servico(): BelongsTo
    {
        return $this->belongsTo(ServicoModel::class, 'id_servico', 'id_servico');
    }

    public function produto(): BelongsTo
    {
        return $this->belongsTo(ProdutosModel::class, 'id_produto', 'id');
    }

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(ClientesModel::class, 'id_cliente', 'id');
    }
}
