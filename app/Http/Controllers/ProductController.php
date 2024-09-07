<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::query()->get();

        return response()->json([
            'data' => $products
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        Product::query()->create($request->validated());

        return response()->json([], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::query()->findOr($id, function () {
            return response()->json([
                'message' => 'sorry, we can`t find the product'
            ], Response::HTTP_NOT_FOUND);
        });

        return response()->json([
            'data' => $product
        ], Response::HTTP_CREATED);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {
        $product = Product::query()->findOr($id, function () {
            return response()->json([
                'message' => 'sorry, we can`t find the product'
            ], Response::HTTP_NOT_FOUND);
        });

        $product->update($request->validated());

        return response()->json([], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::query()->findOr($id, function () {
            return response()->json([
                'message' => 'sorry, we can`t find the product'
            ], Response::HTTP_NOT_FOUND);
        });

        $product->delete();

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
