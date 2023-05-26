<?php

namespace App\Http\ApiV1\Modules\Sklad\Controllers;

use App\Domain\Sklad\Actions\CreateSkladAction;
use App\Domain\Sklad\Actions\DeleteSkladAction;
use App\Domain\Sklad\Actions\GetSkladAction;
use App\Domain\Sklad\Actions\GetSkladsAction;
use App\Domain\Sklad\Actions\PatchSkladAction;
use App\Domain\Sklad\Actions\ReplaceSkladAction;
use App\Models\Sklad;
use App\Http\ApiV1\Modules\Sklad\Requests\CreateSkladRequest;
use App\Http\ApiV1\Modules\Sklad\Requests\DeleteSkladRequest;
use App\Http\ApiV1\Modules\Sklad\Requests\PatchSkladRequest;
use App\Http\ApiV1\Modules\Sklad\Requests\ReplaceSkladRequest;
use App\Http\ApiV1\Modules\Sklad\Resources\SkladResource;
use App\Http\ApiV1\Modules\Sklad\Resources\SkladResource;
use App\Http\ApiV1\Modules\Sklad\Resources\SkladWithProductResource;
use Illuminate\Http\Request;

class SkladController{

    public function getSklad(Request $request, GetSkladAction $action){
        $request->merge(['id' => $request->route('id')]);
        $validated = $request->validate([
            'id' => 'integer|required|exists:sklad,id',
        ]);
        return (new SkladWithProductResource($action->execute($validated['id'])))
            ->additional(['errors' => [], 'meta' => []])
                ->response()
                    ->setStatusCode(200);
    }

    public function getSklad(Request $request, GetSkladAction $action){
        $request->merge(['count' => count(Sklad::all())]);
        $validated = $request->validate([
            'limit' => 'integer|between:0,100',
            'offset' => 'integer|lt:count',
        ]);
        $sklad = $action->execute($validated['limit'] ?? null, 
                                $validated['offset'] ?? 0);
        return (new SkladResource($sklad))
            ->additional(['errors' => [], 'meta' => []])
                ->response()
                    ->setStatusCode(200);
    }

    public function createSklad(CreateSkladRequest $request, CreateSkladAction $action){
        $body = $request->validated();
        return (new SkladResource($action->execute($body)))
            ->additional(['errors' => [], 'meta' => []])
                ->response()
                    ->setStatusCode(200);
    }

    public function deleteSklad(DeleteSkladRequest $request, DeleteSkladAction $action){
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

    public function replaceSklad(ReplaceSkladRequest $request, 
                        ReplaceSkladAction $action){
        $body = $request->validated();
        return (new SkladResource($action->execute($body)))
            ->additional(['errors' => [], 'meta' => []])
                ->response()
                    ->setStatusCode(200);
    }

    public function patchSklad(PatchSkladRequest $request, 
                        PatchSkladAction $action){
        $body = $request->validated();
        return (new SkladResource($action->execute($body)))
            ->additional(['errors' => [], 'meta' => []])
                ->response()
                    ->setStatusCode(200);
    }
}