<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProxyCheck\StoreRequest;
use App\Http\Resources\ProxyIpResource;
use App\Jobs\ProxyCheckerJob;
use App\Models\ProxyIp;
use App\Services\LoaderService;
use App\Services\ProxyCheckerService;
use Illuminate\Http\Request;

class ProxyCheckerController extends Controller
{

    public function index()
    {
        $proxyIps = ProxyIpResource::collection(ProxyIp::all())->resolve();
        return inertia('ProxyChecker/Index', compact('proxyIps'));
    }

    public function create()
    {
        return inertia('ProxyChecker/Create');
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        $loader = LoaderService::create();
//        Запуск в jobs
//        ProxyCheckerJob::dispatch($data, $loader);

        // Запуск в сервис
        ProxyCheckerService::process($data, $loader);

        return response()->json([
            'message' => 'Проверка началась'
        ]);
    }
}
