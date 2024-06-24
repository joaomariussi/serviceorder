<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

/**
 * @method count()
 * @method static find($id)
 */
class ClientesModel extends Model
{
    use HasFactory;

    use Notifiable;

    protected $table = 'clientes';

    public function servico(): HasMany
    {
        return $this->hasMany(ServicoModel::class, 'id_cliente', 'id');
    }
}
