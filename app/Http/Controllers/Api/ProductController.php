<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use SimpleXMLElement;

class ProductController extends Controller
{

    //    UNIVERSAL RESPONSE HANDLER
    private function respond($data, $status = 200)
    {
        $accept = request()->header('Accept');

        // Default JSON response
        if ($accept !== 'application/xml') {
            return response()->json($data, $status);
        }

        // XML Response
        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><response></response>');
        $this->arrayToXml($data, $xml);

        return response($xml->asXML(), $status)
            ->header('Content-Type', 'application/xml');
    }

    //    ARRAY / OBJECT TO XML
    private function arrayToXml($data, &$xml)
    {
        // Convert Model / Collection to array
        if (is_object($data)) {
            $data = $data->toArray();
        }

        foreach ($data as $key => $value) {

            // Convert child objects to array
            if (is_object($value)) {
                $value = $value->toArray();
            }

            // If value is an array (nested or list)
            if (is_array($value)) {

                // Check if LIST (multiple items)
                if (array_keys($value) === range(0, count($value) - 1)) {

                    foreach ($value as $item) {
                        // Singular name: products → product
                        $nodeName = rtrim($key, 's');
                        $child = $xml->addChild($nodeName);
                        $this->arrayToXml($item, $child);
                    }

                } else {
                    // Single object
                    $child = $xml->addChild($key);
                    $this->arrayToXml($value, $child);
                }

            } else {
                $xml->addChild($key, htmlspecialchars((string) $value));
            }
        }
    }

    //    GET ALL PRODUCTS
    public function index()
    {
        return $this->respond([
            'products' => Product::all()
        ]);
    }

    //    CREATE PRODUCT
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'category'    => 'required|string|max:255',
        ]);

        $product = Product::create($validated);

        return $this->respond([
            'message' => 'Product created successfully',
            'product' => $product
        ], 201);
    }

    //    VIEW SINGLE PRODUCT
    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return $this->respond(['error' => 'Product not found'], 404);
        }

        return $this->respond([
            'product' => $product
        ]);
    }

    //    UPDATE PRODUCT
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return $this->respond(['error' => 'Product not found'], 404);
        }

        $validated = $request->validate([
            'name'        => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'sometimes|required|numeric|min:0',
            'category'    => 'sometimes|required|string|max:255',
        ]);

        $product->update($validated);

        return $this->respond([
            'message' => 'Product updated',
            'product' => $product
        ]);
    }


    //    DELETE PRODUCT
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return $this->respond(['error' => 'Product not found'], 404);
        }

        $product->delete();

        return $this->respond([
            'message' => 'Product deleted'
        ]);
    }
}
