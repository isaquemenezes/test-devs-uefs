<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class UserService
{
    public function create(array $data): User
    {
        try {
            return User::create([
                'name' => $data['name'],

            ]);
        } catch (Exception $e) {
            throw new \RuntimeException('Erro ao criar usuário: ' . $e->getMessage());
        }
    }

    public function findById(int $id): User
    {
        try {
            return User::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new \DomainException('Usuário não encontrado');
        }
    }
}
