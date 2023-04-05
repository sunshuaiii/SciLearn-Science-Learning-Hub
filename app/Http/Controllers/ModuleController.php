<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Module;

class ModuleController extends Controller
{
    //
    public function index()
    {
        return view('/modules', 'modules');
    }

    public function showTopics($moduleName)
    {
        $module = Module::where('name', $moduleName)->first();
        if ($module) {
            $moduleId = $module->id;
        } else {
            // Module not found
        }
        $topics = Topic::where('module_id', $moduleId)->get();

        return view($moduleName, ['topics' => $topics]);
    }
}
