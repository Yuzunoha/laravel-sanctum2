<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserService implements UserServiceInterface
{
    protected $userRepository;
    protected $utilService;

    public function __construct(
        UserRepositoryInterface $userRepository,
        UtilServiceInterface    $utilService
    ) {
        $this->userRepository = $userRepository;
        $this->utilService    = $utilService;
    }

    public function create(string $name, string $email, string $password): ?User
    {
        /* emailチェック */
        if ($this->userRepository->selectByEmail($email)->count()) {
            $this->utilService->throwHttpResponseException("email ${email} は既に登録されています。");
        }

        /* hash化 */
        $hash = Hash::make($password);

        return $this->userRepository->create($name, $email, $hash);
    }
}
