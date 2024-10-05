<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;
    protected $fillable = ['proveedor_id', 'producto_id', 'cantidad', 'precio'];

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

//funcion para incrementar el stock
    public static function boot()
    {
        parent::boot();
        static::created(function ($compra) {
            $producto = $compra->producto;
            $producto->stock += $compra->cantidad;
            $producto->save();
        });
    }
}
