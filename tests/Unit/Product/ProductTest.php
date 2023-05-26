<?php

use App\Models\Product;
use Illuminate\Support\Facades\DB;

uses(Tests\TestCase::class);

//GET
test('get product', function(){
    $product = new Product;
    $product->name = 'TestProduct';
    $product->short_description = 'Test';
    $product->actual_price = 10000;
    $product->sklad_id = 1;
    $product->save();

    $response = $this->getJson("/api/v1/products/{$product->id}");

    $data = [
        'data' => [
            'id' => $product->id,
            'name' => $product->name,
            'short_description' => $product->short_description,
            'actual_price' => $product->actual_price,
        ],
        'errors' => [],
        'meta' => []
    ];
    $response->assertStatus(200)->assertJson($data);

    $id = ($response['data'])['id'];
    Product::destroy($id);
});

test('cant get product', function(){

    $id = Product::latest()->first()->id + 100;

    $response = $this->getJson("/api/v1/products/{$id}");
    $response->assertStatus(400);
});

//CREATE
test('create product', function(){
    $body = [
        'name' => 'UnitTest',
        'short_description' => 'UnitTest',
        'actual_price' => 1000,
        'sklad_id' => 1,
    ];
    $response = $this->postJson('/api/v1/products', $body);
    $response->assertStatus(200);
    $this->assertDatabaseHas('products', $body);

    $id = ($response['data'])['id'];
    Product::destroy($id);
});

test('cant create product without required fiels', function(){
    $body = [
        'name' => 'UnitTest',
        'short_description' => 'UnitTest',
        'actual_price' => 1000,
    ];
    $response = $this->postJson('/api/v1/products', $body);
    $response->assertStatus(400);
});

//REPLACE

test('replace product', function(){
    $product = new Product;
    $oldData = [
        'name' => 'UnitTest',
        'short_description' => 'UnitTest',
        'actual_price' => 1000,
        'sklad_id' => 1,
    ];
    $product->fill($oldData);
    $product->save();

    $newData = [
        'name' => 'newUnitTest',
        'short_description' => 'newUnitTest',
        'actual_price' => 1500,
        'sklad_id' => 1,
    ];

    $response = $this->putJson("/api/v1/products/{$product->id}", $newData);
    $newData['id'] = $product->id;


    $response->assertStatus(200);
    $this->assertEquals($response['data'], $newData);
    $this->assertDatabaseHas('products', $newData);

    Product::destroy($product->id);
});

//PATCH

test('patch product', function(){
    $product = new Product;
    $oldData = [
        'name' => 'UnitTest',
        'short_description' => 'UnitTest',
        'actual_price' => 1000,
        'sklad_id' => 1,
    ];
    $product->fill($oldData);
    $product->save();

    $body = [
        'actual_price' => 990,
        'discount' => 0
    ];

    $newData = [
        'name' => 'UnitTest',
        'short_description' => 'UnitTest',
        'actual_price' => 990,
        'sklad_id' => 1,
    ];

    $response = $this->patchJson("/api/v1/products/{$product->id}", $body);
    $newData['id'] = $product->id;

    $response->assertStatus(200);
    $this->assertEquals($response['data'], $newData);
    $this->assertDatabaseHas('products', $newData);

    Product::destroy($product->id);
});

//DELETE
test('delete product', function(){
    $product = new Product;
    $data = [
        'name' => 'UnitTest',
        'short_description' => 'UnitTest',
        'actual_price' => 1000,
        'sklad_id' => 1,
    ];
    $product->fill($data);
    $product->save();

    $response = $this->deleteJson("/api/v1/products/{$product->id}");
    $data['id'] = $product->id;

    $response->assertStatus(200);
    $this->assertEquals(null, Product::find($product->id));
});