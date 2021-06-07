<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Resources\CurrencyResource;
use App\Models\Currency;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Routing\Controller;

class CurrencyRateController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
       $data = Currency::all();

       return CurrencyResource::collection($data);
    }

    public function show(Currency $currency): CurrencyResource
    {
        return new CurrencyResource($currency);
    }
}
