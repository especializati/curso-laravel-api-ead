<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSupport;
use App\Http\Resources\SupportResource;
use App\Repositories\SupportRepository;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    protected $repository;

    public function __construct(SupportRepository $supportRepository)
    {
        $this->repository = $supportRepository;
    }

    public function index(Request $request)
    {
        $supports = $this->repository->getSupports($request->all());

        return SupportResource::collection($supports);
    }

    public function store(StoreSupport $request)
    {
        $support = $this->repository
                        ->createNewSupport($request->validated());

        return new SupportResource($support);
    }

    public function mySupports(Request $request)
    {
        $supports = $this->repository->getMySupports($request->all());

        return SupportResource::collection($supports);
    }
}
