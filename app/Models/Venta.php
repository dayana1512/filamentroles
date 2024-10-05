<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;
    protected $fillable = ['producto_id', 'cliente_id', 'cantidad', 'precio'];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    // Reducir stock del producto tras la venta
    public static function boot()
    {
        parent::boot();
        static::created(function ($venta) {
            $producto = $venta->producto;
            $producto->stock -= $venta->cantidad;
            $producto->save();
        });
    }
}
