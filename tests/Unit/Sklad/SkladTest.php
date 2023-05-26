<?php

use App\Models\Sklad;
use Illuminate\Support\Facades\DB;

uses(Tests\TestCase::class);

//GET
test('get sklad', function(){
    $sklad = new Sklad;
    $data = [
        'name' => 'UnitTest',
        'short_description' => 'UnitTest',
        'availability' => 'UnitTest',
    ];
    $sklad->fill($data);
    $sklad->save();

    $response = $this->getJson("/api/v1/sklad/{$sklad->id}");

    $expectedData = [
        'data' => [
            'id' => $sklad->id,
            'name' => $sklad->name,
            'short_description' => $sklad->short_description,
            'availability' => $sklad->availability,
        ],
        'errors' => [],
        'meta' => []
    ];
    $response->assertStatus(200)->assertJson($expectedData);

    $id = ($response['data'])['id'];
    Sklad::destroy($id);
});

test('cant get sklad', function(){
    $id = Sklad::latest()->first()->id + 100;

    $response = $this->getJson("/api/v1/sklad/{$id}");
    $response->assertStatus(400);
});

//CREATE
test('create sklad', function(){
    $body = [
        'name' => 'UnitTest',
        'short_description' => 'UnitTest',
    ];
    $response = $this->postJson('/api/v1/sklad', $body);
    $response->assertStatus(200);
    $this->assertDatabaseHas('sklad', $body);

    $id = ($response['data'])['id'];
    Sklad::destroy($id);
});

test('cant create sklad without required fiels', function(){
    $body = [
        'name' => 'UnitTest',
    ];
    $response = $this->postJson('/api/v1/sklad', $body);
    $response->assertStatus(400);
});

//REPLACE
test('replace sklad', function(){
    $sklad = new Sklad;
    $data = [
        'name' => 'UnitTest',
        'short_description' => 'UnitTest',
        'seller' => 'Test',
    ];
    $sklad->fill($data);
    $sklad->save();

    $newData = [
        'name' => 'newUnitTest',
        'short_description' => 'newUnitTest',
        'seller' => 'newTestSeller',
    ];

    $response = $this->putJson("/api/v1/sklad/{$sklad->id}", $newData);
    $newData['id'] = $sklad->id;
    $newData['description'] = null;

    $response->assertStatus(200);
    $this->assertEquals($response['data'], $newData);
    $this->assertDatabaseHas('sklad', $newData);

    Sklad::destroy($sklad->id);
});

//PATCH
test('patch sklad', function(){
    $sklad = new Sklad;
    $data = [
        'name' => 'UnitTest',
        'short_description' => 'UnitTest',
        'seller' => 'Test',
    ];
    $sklad->fill($data);
    $sklad->save();

    $body = [
        'short_description' => 'newUnitTest',
    ];

    $newData = [
        'name' => 'UnitTest',
        'short_description' => 'newUnitTest',
        'seller' => 'Test',
    ];

    $response = $this->patchJson("/api/v1/sklad/{$sklad->id}", $body);
    $newData['id'] = $sklad->id;
    $newData['description'] = null;

    $response->assertStatus(200);
    $this->assertEquals($response['data'], $newData);
    $this->assertDatabaseHas('sklad', $newData);

    Sklad::destroy($sklad->id);
});

//DELETE
test('delete sklad', function(){
    $sklad = new Sklad;
    $data = [
        'name' => 'UnitTest',
        'short_description' => 'UnitTest',
        'seller' => 'Test',
    ];
    $sklad->fill($data);
    $sklad->save();

    $response = $this->deleteJson("/api/v1/sklad/{$sklad->id}");
    $data['id'] = $sklad->id;

    $response->assertStatus(200);
    $this->assertEquals(null, Sklad::find($sklad->id));
});