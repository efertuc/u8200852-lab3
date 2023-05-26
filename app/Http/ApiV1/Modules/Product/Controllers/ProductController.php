<?php

namespace App\Http\ApiV1\Modules\Product\Controllers;

use App\Domain\Product\Actions\CreateProductAction;
use App\Domain\Product\Actions\DeleteProductAction;
use App\Domain\Product\Actions\GetProductAction;
use App\Domain\Product\Actions\GetProductsAction;
use App\Domain\Product\Actions\PatchProductAction;
use App\Domain\Product\Actions\ReplaceProductAction;
use App\Models\Product;
use App\Http\ApiV1\Modules\Product\Requests\CreateProductRequest;
use App\Http\ApiV1\Modules\Product\Requests\DeleteProductRequest;
use App\Http\ApiV1\Modules\Product\Requests\PatchProductRequest;
use App\Http\ApiV1\Modules\Product\Requests\ReplaceProductRequest;
use App\Http\ApiV1\Modules\Product\Resources\ProductResource;
use App\Http\ApiV1\Modules\Product\Resources\ProductsResource;
use Illuminate\Http\Request;

class ProductController{

    public function getProduct(Request $request, GetProductAction $action){
        $request->merge(['id' => $request->route('id')]);
        $validated = $request->validate([
            'id' => 'integer|required|exists:products,id',
        ]);
        return (new ProductResource($action->execute($validated['id'])))
            ->additional(['errors' => [], 'meta' => []])
                ->response()
                    ->setStatusCode(200);
    }

    public function getProducts(Request $request, GetProductsAction $action){
        $request->merge(['count' => count(Product::all())]);
        $validated = $request->validate([
            'limit' => 'integer|between:0,100',
            'offset' => 'integer|lt:count',
        ]);
        $products = $action->execute($validated['limit'] ?? null, 
                                $validated['offset'] ?? 0);
        return (new ProductsResource($products))
            ->additional(['errors' => [], 'meta' => []])
                ->response()
                    ->setStatusCode(200);
    }

    public function createProduct(CreateProductRequest $request, CreateProductAction $action){
        $body = $request->validated();
        return (new ProductResource($action->execute($body)))
            ->additional(['errors' => [], 'meta' => []])
                ->response()
                    ->setStatusCode(200);
    }

    public function deleteProduct(DeleteProductRequest $request, DeleteProductAction $action){
        $body = $request->validated();
        $action->execute($body['id']);
        return response()->json([
            'data' => '',
            'errors' => '',
            'meta' => [
                'message' => 'deleted'
            ]
        ], 200);
    }

    public function replaceProduct(ReplaceProductRequest $request, 
                        ReplaceProductAction $action){
        $body = $request->validated();
        return (new ProductResource($action->execute($body)))
            ->additional(['errors' => [], 'meta' => []])
                ->response()
                    ->setStatusCode(200);
    }

    public function patchProduct(PatchProductRequest $request, 
                        PatchProductAction $action){
        $body = $request->validated();
        return (new ProductResource($action->execute($body)))
            ->additional(['errors' => [], 'meta' => []])
                ->response()
                    ->setStatusCode(200);
    }
}