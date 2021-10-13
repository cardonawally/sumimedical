<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;

class PermissionsController extends Controller
{
    /**
     * @return Response
     */
    public function index(): Response
    {
        $permisos = Permission::all();

        return Inertia::render('Applications/Permissions',[
            'permisos' => $permisos
        ]);

    }


    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        try {
            Permission::create($request->all());
            $permisos = Permission::all();
            return response()->json($permisos,'200');
        }catch (Exception $ex){
            return response()->json($ex->getMessage(), 500);
        }
    }
}
