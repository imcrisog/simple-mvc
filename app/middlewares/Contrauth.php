<?php

namespace App\Middlewares;

use Nowakowskir\JWT\TokenEncoded;
use Nowakowskir\JWT\JWT;
use App\Models\User;
use Exception;


class Contrauth {

    /**
     * Activador de Middleware
     *
     * Verifica que el usuario este autenticado, segun este permite continuar.
     *
     * @return header
     **/
    public function handle()
    {
        if (isset($_COOKIE['X-TOKEN'])) {
            $tokenEncoded = new TokenEncoded($_COOKIE['X-TOKEN']);

            try {
                if (!$tokenEncoded->validate(SECRET_KEY, JWT::ALGORITHM_HS256, 500)) {
                    return;    
                }
            } catch (Exception $e) {
                return;
            }

            $id = $tokenEncoded->decode()->getPayload()['payload_key'];

            $user = new User();
            $user = $user->find($id);

            if (!$user) {
                return;
            }

            return header("Location: " . LOCALHOST . "/profile");
        }

        return;
    }

}