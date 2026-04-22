<?php
namespace App\Services;
use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Validation\ValidationException;

class ProductService
{
    public function __construct(private ProductRepository $productRepository) {}

    /**
     * Listar todos los productos.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all() { return $this->productRepository->all(); }

    /**
     * Obtener producto por ID.
     * @param int $id
     * @return Product
     */
    public function find(int $id) { return $this->productRepository->find($id); }

    /**
     * Crear producto.
     * @param array $data
     * @return Product
     */
    public function create(array $data): Product { return $this->productRepository->create($data); }

    /**
     * Actualizar producto.
     * @param int $id
     * @param array $data
     * @return Product
     */
    public function update(int $id, array $data): Product { return $this->productRepository->update($id, $data); }

    /**
     * Eliminar producto.
     * @param int $id
     * @return bool
     */
    public function delete(int $id) { return $this->productRepository->delete($id); }

    /**
     * Comprar producto, descuenta inventario.
     * @param int $productId
     * @param int $quantity
     * @return Product
     * @throws ValidationException
     */
    public function purchase(int $productId, int $quantity): Product
    {
        $product = $this->productRepository->find($productId);

        if ($product->stock < $quantity) {
            throw ValidationException::withMessages([
                'quantity' => "Stock insuficiente. Disponible: {$product->stock}",
            ]);
        }

        return $this->productRepository->update($productId, [
            'stock' => $product->stock - $quantity,
        ]);
    }
}