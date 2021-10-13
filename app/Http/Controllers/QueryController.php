<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class QueryController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function role(): JsonResponse
    {
        $query = User::with('roles')->whereIn('role_id', [1, 2])
            ->select('name', 'last_name', 'role_id')
            ->get();
        return response()->json($query, 200);
    }


    /**
     * @return JsonResponse
     */
    public function permission(): JsonResponse
    {
        $query = Permission::whereHas('roles', function ($q) {
            $q->where('role_id', 1);
        })->select('name')
            ->get();

        return response()->json($query, 200);
    }


    /**
     * @return JsonResponse
     */
    public function permission_role(): JsonResponse
    {
        $query = Role::with('user')->whereHas('permissions', function ($q) {
            $q->where('permission_id', 2);
        })->get()
            ->map(function ($row) {
                return [
                    'rol' => $row->name,
                    'usuario' => "{$row->user->name} {$row->user->last_name}"
                ];
            });

        return response()->json($query, 200);
    }
}
