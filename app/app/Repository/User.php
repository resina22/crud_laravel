<?php
namespace App\Repository;

use App\Models\User as ModelUser;
use Illuminate\Database\Eloquent\Collection;

class User
{
    private $modelUser;

    public function __construct(
        ModelUser $modelUser
    )
    {
        $this->modelUser = $modelUser;
    }

    public function create(array $values): ?ModelUser
    {
        return $this->modelUser->create($values);
    }

    public function list(): ?Collection
    {
        return $this->modelUser->all();
    }

    public function findById(int $id): ?ModelUser
    {
        return $this->modelUser->where('id', $id)->first();
    }

    public function findByEmail(string $email): ?ModelUser
    {
        return $this->modelUser->where('email', $email)->first();
    }

    public function delete(int $id): ?bool
    {
        return $this->modelUser->where('id', $id)->delete();
    }
}
