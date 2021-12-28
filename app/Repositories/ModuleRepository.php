<?php

namespace App\Repositories;

use App\Models\Module;

class ModuleRepository
{
    protected $entity;

    public function __construct(Module $model)
    {
        $this->entity = $model;
    }

    public function getModulesByCourseId(string $courseId)
    {
        return $this->entity
                    ->with('lessons.views')
                    ->where('course_id', $courseId)
                    ->get();
    }
}
