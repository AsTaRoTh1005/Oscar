<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'pedidos';

    protected $primaryKey = 'id_pedido';
    // Campos que se pueden llenar masivamente
    protected $fillable = [
        'id_usuario',
        'fecha_pedido',
        'total',
        'estado',
    ];

    public function detalles()
    {
        return $this->hasMany(DetallePedido::class, 'id_pedido');
    }

    // Relación con Usuario
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
}