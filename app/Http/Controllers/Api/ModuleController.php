<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ModuleResource;
use App\Repositories\ModuleRepository;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    protected $repository;

    public function __construct(ModuleRepository $moduleRepository)
    {
        $this->repository = $moduleRepository;
    }

    public function index($courseId)
    {
        $modules = $this->repository->getModulesByCourseId($courseId);

        return ModuleResource::collection($modules);
    }

}
