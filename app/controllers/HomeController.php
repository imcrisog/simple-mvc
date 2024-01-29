<?php

namespace App\Controllers;

use App\Models\RoleUser;
use App\Models\User;
use Nowakowskir\JWT\JWT;
use Nowakowskir\JWT\TokenDecoded;

class HomeController extends Controller {

    public function index()
    {
        $users = new User();
        $users = $users->allWithMM('roles', true, ["name", "role"])->get();

        return $this->view('home', [
            'title' => 'Home',
            'users' => $users
        ]);
    }

    public function register()
    {
        return $this->view('Auth.register');
    }

    public function storeregister()
    {
        $vals = $this->validator(['username', 'email', 'dni', 'password']);
        if ($vals) return $this->backWithError("/register", $vals);

        $user = new User();

        $findUser = $user->where("email", strip_tags($_POST["email"]))->first();
        $findDni = $user->where("dni", strip_tags($_POST["dni"]))->first();

        if (!empty($findUser) || !empty($findDni)) return $this->backWithError("/register", "El usuario ya existe");

        $newUser = $user->create([
            'username' => strip_tags($_POST['username']),
            'email' => strip_tags($_POST['email']),
            'password' => strip_tags($_POST['password']),
            'dni' => $_POST['dni']
        ]);

        $role = new RoleUser();
        $role->create([
            'role_id' => 2,
            'user_id' => $newUser['id']
        ]);

        $tokenDecoded = new TokenDecoded(['payload_key' => $newUser['id']], ['header_key' => SECRET_HD_KEY], ['nbf' => time() + time() + 60 * 60 * 24]);
        $token = $tokenDecoded->encode(SECRET_KEY, JWT::ALGORITHM_HS256)->toString();

        setcookie("X-TOKEN", $token, time() + 60 * 60 * 24 * 7, "/", null, true, true);

        $this->successmsg("Registro de sesion Correctamente");

        return header("Location: " . LOCALHOST . "/profile");
    }

    public function login()
    {
        return $this->view('Auth.login', [
            'title' => 'Login'
        ]);
    }

    public function storelogin()
    {
        $vals = $this->validator(['dni', 'password']);
        if ($vals) return $this->backWithError("/login", $vals);

        $user = new User();
        $dni = strip_tags($_POST['dni']);
        $findUser = $user->where('dni', $dni)->first();

        if (!$findUser) return $this->backWithError("/login", "Usuario no existe");

        if (!password_verify(strip_tags($_POST['password']), $findUser['password'])) {
            return $this->backWithError("/login", "Contraseña incorrecta");
        }

        $tokenDecoded = new TokenDecoded(['payload_key' => $findUser['id']], ['header_key' => SECRET_HD_KEY], ['exp' => time() + 2], ['nbf' => time() + 2]);
        $token = $tokenDecoded->encode(SECRET_KEY, JWT::ALGORITHM_HS256)->toString();

        $this->successmsg("Iniciaste sesion Correctamente");

        setcookie("X-TOKEN", $token, time() + 60 * 60 * 24 * 7, "/", null, true, true);

        return header("Location: " . LOCALHOST . "/profile");
    }

    public function profile($user)
    {
        return $this->view('Auth.profile', [
            'title' => 'Tu perfil',
            'user' => $user
        ]);
    }

    public function logout()
    {
        unset($_COOKIE['X-TOKEN']); 
        setcookie('X-TOKEN', null, -1, '/');

        $this->successmsg("Cerraste sesion Correctamente");

        return header("Location: " . LOCALHOST . "/login");
    }

    public function password()
    {
        return $this->view('Auth.password', [
            'title' => 'Cambiar contraseña'
        ]);
    }

    public function update_password($user)
    {
        $vals = $this->validator(['opassword', 'newpassword']);
        if ($vals) return $this->backWithError("/password", $vals);

        if (!password_verify(strip_tags($_POST['opassword']), $user['password'])) {
            $this->backWithError("/password", "Contraseña incorrecta.");
        }

        $u = new User();
        
        $newPassword = password_hash(strip_tags($_POST['newpassword']), PASSWORD_BCRYPT);

        if (password_verify(strip_tags($_POST['opassword']), $newPassword)) {
            $this->backWithError("/password", "La contraseña es la misma.");
        }

        $u->update($user['id'], [
            'password' => $newPassword
        ]);

        $this->successmsg("Contraseña actualizada correctamente.");
        return $this->redirect("/profile");
    }

    public function notfound()
    {
        return $this->view('Errors.404', [
            'title' => 'Pagina no Encontrada'
        ]);
    }

}