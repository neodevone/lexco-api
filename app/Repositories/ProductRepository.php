<?php
namespace App\Repositories;
use App\Models\Product;

class ProductRepository
{
    /**
     * Obtener todos los productos.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all() { return Product::all(); }

    /**
     * Buscar producto por ID.
     * @param int $id
     * @return Product
     */
    public function find(int $id) { return Product::findOrFail($id); }

    /**
     * Crear producto.
     * @param array $data
     * @return Product
     */
    public function create(array $data) { return Product::create($data); }

    /**
     * Actualizar producto.
     * @param int $id
     * @param array $data
     * @return Product
     */
    public function update(int $id, array $data)
    {
        $product = Product::findOrFail($id);
        $product->update($data);
        return $product;
    }

    /**
     * Eliminar producto.
     * @param int $id
     * @return bool
     */
    public function delete(int $id)
    {
        return Product::findOrFail($id)->delete();
    }
}