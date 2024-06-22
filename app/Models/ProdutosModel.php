<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method count()
 */
class ProdutosModel extends Model
{
    use HasFactory;

    protected $table = 'produtos';

    public function pedido(): HasMany
    {
        return $this->hasMany(ServicosProdutosModel::class, 'id_produto', 'id');
    }

}
