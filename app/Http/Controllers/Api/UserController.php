<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

use App\Services\UserService;

class UserController extends Controller
{

    public function __construct(
        protected UserService $userService
    ) {}


    public function index()
    {
        return User::all();
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $user = $this->userService->create($request->all());

            return response()->json(
                $user,
                201
            );
        } catch (\RuntimeException $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function show(int $id): JsonResponse
    {
        try {
            $user = $this->userService->findById($id);

            return response()->json($user);
        } catch (\DomainException $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update( $request->only( ['name'] ) );

        return response()->json($user);
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
