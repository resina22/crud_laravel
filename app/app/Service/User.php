<?php

namespace App\Service;

use App\Models\User as ModelUser;
use App\Repository\User as RepositoryUser;
use Illuminate\Support\Facades\Hash;
use Throwable;

class User
{
    private $name;
    private $email;
    private $password;

    public function __construct(
        string $name = null,
        string $email = null,
        string $password = null
    )
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    public function list(): ?array
    {
        $repository = new RepositoryUser(new ModelUser());
        return $repository->list()->toArray();
    }

    public function find(int $id): ?ModelUser
    {
        $repository = new RepositoryUser(new ModelUser());
        return $repository->findById($id);
    }

    public function new(): array
    {
        $params = $this->prepare();
        try {
            if($this->findByEmail()) {
                return $this->response(false, 'Email já cadastrado');
            }

            $repository = new RepositoryUser(new ModelUser());
            $created = $repository->create($params)->exists();
            $message = $created ? 'Salvo com sucesso' : 'Erro ao salvar';
            return $this->response($created, $message);
        } catch(Throwable $t) {
            return $this->response(false, 'Dados inválidos');
        }
    }

    public function update(int $id): array
    {
        try {
            $updated = ModelUser::where([
                'id' => $id
            ])->update($this->prepare());

            $message = $updated ? 'Salvo com sucesso' : 'Usuário não cadastrado';
            return $this->response($updated, $message);
        } catch(Throwable $t) {
            return $this->response(false, 'Dados inválidos');
        }
    }

    public function findByEmail(string $email = null): ?ModelUser
    {
        $email = $email ?? $this->email;
        $repository = new RepositoryUser(new ModelUser());
        return ($repository)->findByEmail($this->email);
    }

    public function delete(int $id): ?array
    {
        try {
            $repository = new RepositoryUser(new ModelUser());
            $deleted = ($repository)->delete($id);
            $message = $deleted ? 'Usuário removido com sucesso' : 'Erro ao remover usuário';

            return $this->response($deleted, $message);
        } catch(Throwable $t) {
            return $this->response(false, 'Dados inválidos');
        }
    }

    private function response(bool $success, string $message = null): array
    {
        return [
            'success' => $success,
            'message' => $message,
        ];
    }

    private function prepare(): array
    {
        return array_filter([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);
    }
}
