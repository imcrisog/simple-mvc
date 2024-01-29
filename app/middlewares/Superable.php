<?php

namespace App\Middlewares;

use App\Models\Role;
use App\Models\RoleUser;
use Nowakowskir\JWT\TokenEncoded;
use Nowakowskir\JWT\JWT;
use App\Models\User;
use Exception;

class Superable {

    /**
     * Activador de Middleware
     *
     * Verifica si el usuario es Supervisor o no, segun este permite continuar.
     *
     * @return App\Models\User
     * @throws ValidateToken
     **/
    public function handle()
    {
        global $user, $role;

        if (!isset($_COOKIE['X-TOKEN'])) {
            return header("Location: " . LOCALHOST . "/login");
        }

        $tokenEncoded = new TokenEncoded($_COOKIE['X-TOKEN']);

        try {
            if (!$tokenEncoded->validate(SECRET_KEY, JWT::ALGORITHM_HS256, 500)) {
                return header("Location: " . LOCALHOST . "/login");    
            }
        } catch (Exception $e) {
            return header("Location: " . LOCALHOST . "/login");
        }

        $id = $tokenEncoded->decode()->getPayload()['payload_key'];

        $user = new User();
        $user = $user->find($id);

        if (!$user) {
            return header("Location: " . LOCALHOST . "/login");
        }

        $rolable = new RoleUser();
        $userRole = $rolable->where('user_id', $user['id'])->first();
        $roleable = new Role();
        $role = $roleable->find($userRole['role_id']);

        if ($userRole['role_id'] == 3) {
            return header("Location: " . LOCALHOST . "/profile");
        }

        return $user;
    }

}