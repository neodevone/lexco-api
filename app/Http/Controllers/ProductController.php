<?php
namespace App\Http\Controllers;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Requests\PurchaseRequest;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    public function __construct(private ProductService $productService) {}

    /**
     * Listar todos los productos.
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json($this->productService->all());
    }

    /**
     * Obtener producto por ID.
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        return response()->json($this->productService->find($id));
    }

    /**
     * Crear producto.
     * @param StoreProductRequest $request
     * @return JsonResponse
     */
    public function store(StoreProductRequest $request): JsonResponse
    {
        $product = $this->productService->create($request->validated());
        return response()->json($product, 201);
    }

    /**
     * Actualizar producto.
     * @param UpdateProductRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateProductRequest $request, int $id): JsonResponse
    {
        $product = $this->productService->update($id, $request->validated());
        return response()->json($product);
    }

    /**
     * Eliminar producto.
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $this->productService->delete($id);
        return response()->json(['message' => 'Producto eliminado']);
    }

    /**
     * Comprar producto.
     * @param PurchaseRequest $request
     * @return JsonResponse
     */
    public function purchase(PurchaseRequest $request): JsonResponse
    {
        $product = $this->productService->purchase(
            $request->product_id,
            $request->quantity
        );
        return response()->json([
            'message' => 'Compra realizada exitosamente',
            'product' => $product,
        ]);
    }
}