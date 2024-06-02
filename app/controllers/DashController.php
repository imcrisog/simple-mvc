<?php

namespace App\Controllers;

use App\Models\Role;
use App\Models\RoleUser;
use App\Models\Section;
use App\Models\SectionUser;
use App\Models\User;
use App\Models\Element;
use App\Models\Leanding;

class DashController extends Controller {

    public function index($user)
    {
        return "Hola " . $user['username'];
    }

    public function show_sections($usero) 
    {
        $section = new Section();
        $userable = new User();
        $su = new SectionUser();

        $prestamists = $su->where("type", "prestamist")->get();
        $supervisors = $su->where("type", "supervisor")->get();

        $sections = $section->where("owner_id", $usero['id'])->get();
        $users = $userable->allWithMM('roles', true, ['name', 'rol'])->get();

        $prestusers = array_filter($users, function ($user) use ($prestamists) {
            return 
                $user['rol'] == "prestamista" && 
                gettype(array_search($user['id'], array_column($prestamists, 'user_id'))) == 'boolean';
        });

        $superusers = array_filter($users, function ($user) use ($supervisors) {
            return 
                $user['rol'] == "supervisor" && 
                gettype(array_search($user['id'], array_column($supervisors, 'user_id'))) == 'boolean';
        });

        if (count($prestusers) == 0) {
            warningmsg("No hay prestamistas disponibles.");
        }

        if (count($superusers) == 0) {
            warningmsg("No hay supervisores disponibles.");
        }

        return view('Admin.sections', [
            'title' => 'Secciones',
            'sections' => $sections,
            'users' => $users,
            'prestusers' => $prestusers,
            'superusers' => $superusers
        ]);
    }

    public function create_section($user) 
    {
        $vals = validator(['name', 'supervisor', 'prestamist']);
        if ($vals) return backWithError("/inventory/sections", $vals);

        $section = new Section();
        $su = new SectionUser();

        $newSection = $section->create([
            'name' => strip_tags($_POST['name']),
            'user_id' => $_POST['supervisor'],
            'owner_id' => $user['id']
        ]);

        $su->create([
            'section_id' => $newSection['id'],
            'user_id' => $_POST['supervisor'],
            'type' => 'supervisor' 
        ]);

        $su->create([
            'section_id' => $newSection['id'],
            'user_id' => $_POST['prestamist'],
            'type' => 'prestamist'
        ]);

        if ($_POST['custom'] == "true") {
            return view("Admin.customization", [
                'section' => $newSection
            ]);
        }

        successmsg("Seccion creada correctamente");
        return redirect("/inventory/sections");
    }

    public function custom_section()
    {   
        $section = new Section();

        if (!isset($_POST['columns']) || count($_POST['columns']) == 0) {
            errormsg("Debes ingresar al menos una columna personalizada");
            $newSection = $section->find($_POST['section']);
            return view("Admin.customization", [
                'section' => $newSection
            ]);
        }

        $cols = [];
        
        foreach ($_POST['columns'] as $col) {
            if (isset($col['data']) && !empty($col['data']) && !in_array($col['data'], $cols)) {
                array_push($cols, $col['data']);
            }
        }

        if (count($cols) == 0) {
            errormsg("Debes ingresar al menos una columna personalizada");
            $newSection = $section->find($_POST['section']);
            return view("Admin.customization", [
                'section' => $newSection
            ]);
        }

        $section->update($_POST['section'], [
            'model' => json_encode($cols)
        ]);

        successmsg("Se personalizo correctamente la seccion");
        return redirect("/inventory/sections");
    }

    public function updater_section($id) 
    {
        $userable = new User();
        $users = $userable->allWithoutMMU()->get();

        $section = new Section();
        $findSection = $section->find($id);

        if (!$findSection) return backWithError("/inventory/sections", "No se encontro la seccion a actualizar");

        return view('Admin.updater_sections', [
            'title' => 'Actualiza ' . $findSection['name'],
            'section' => $findSection,
            'users' => $users
        ]);
    }

    public function update_section($id) 
    {
        $vals = validator(['name']);
        if ($vals) return backWithError("/inventory/sections", $vals);
           
        $section = new Section();
        $findSection = $section->find($id);

        if (!$findSection) return backWithError("/inventory/sections", "No se encontro la seccion a actualizar");

        $section->update($id, [
            'name' => $_POST['name'] ??= $findSection['name'],
        ]);

        return redirect("/inventory/sections");
    }

    public function delete_section($id) 
    {
        $section = new Section();
        $leanding = new Leanding();
        $sectionUser = new SectionUser();
        $findSection = $section->find($id);
        
        if (!$findSection) return backWithError("/inventory/sections", "La seccion no existe");

        $userSectionFound = $sectionUser->where('section_id', $findSection['id'])->get();
        
        $sectionUser->delete($userSectionFound[0]['id']);
        $sectionUser->delete($userSectionFound[1]['id']);

        $leandings = $leanding->where('section_id', $findSection['id'])->get();

        foreach ($leandings as $lean) {
            $leanding->delete($lean['id']);
        }

        $section->delete($findSection['id']);

        successmsg("Se elimino correctamente la Seccion");

        return redirect("/inventory/sections");
    }

    public function create_user() {
        $vals = validator(['name', 'dni', 'turno', 'password']);
        if ($vals) return backWithError("/inventory/users", $vals);

        $user = new User();

        $newUser = $user->create([
            'username' => strip_tags($_POST["name"]),
            'email' => "anonymous@eico.edu.ar",
            'dni' => $_POST["dni"],
            'turn' => $_POST["turno"],
            'password' => $_POST["password"] 
        ]);

        $role = new RoleUser();
        $role->create([
            'role_id' => $_POST["role"],
            'user_id' => $newUser["id"]
        ]);

        successmsg("Se creo el usuario correctamente");

        return redirect("/inventory/users");
    }

    public function show_users($user) 
    {
        $role = new Role();
        $section = new Section();
        $usere = new User();
        $users = $usere->allWithMM("roles", true, ['name', 'rol'])->get();
        $roles = $role->all()->get();

        $sections = $section->all()->get();

        return view("Admin.users", [
            'title' => 'Usuarios',
            'users' => $users,
            'roles' => $roles,
            "sections" => $sections,
            "me" => $user
        ]);
    }

    public function updater_user($id)
    {
        $userable = new User();
        $rolable = new Role();
        $rolables = new RoleUser();

        $userFind = $userable->find($id);
        $ur = $rolables->where("user_id", $userFind['id'])->first();
        $rol = $rolable->find($ur['role_id']);
        $roles = $rolable->all()->get();

        return view("Admin.updater_user", [
            'title' => "Actualiza " . $userFind['username'],
            "user" => $userFind,
            'rol' => $rol,
            "roles" => $roles
        ]);
    }

    public function update_user($id) 
    {
        $userable = new User();
        $rolable = new RoleUser();
        $findUser = $userable->find($id);

        if (!$findUser) return backWithError("/inventory/users", "No se encontro el usuario a actualizar");

        $ur = $rolable->where("user_id", $findUser['id'])->first();

        $userable->update($findUser['id'], [
            'username' => empty($_POST['username']) ? $findUser["username"] : $_POST['username'],
        ]);

        $rolable->update($ur['id'], [
            "role_id" => $_POST['role'],
        ]);

        return redirect("/inventory/users");
    }

    public function update_user_password() {}

    public function delete_user($id) 
    {
        $user = new User();
        $ur = new RoleUser();
        $findUser = $user->find($id);

        if (!$findUser) return backWithError("/inventory/users", "El usuario no existe");

        $urol = $ur->where("user_id", $findUser['id'])->first();
        $ur->delete($urol['id']);
        $user->delete($findUser['id']);

        successmsg("Se elimino correctamente al usuario");
        return redirect("/inventory/users");
    }

    public function elements_admin($id, $user)
    {
        $section = new Section();
        $element = new Element();
        $rolable = new RoleUser();
        $elements = $element->where("section_id", $id)->get();
        
        $findSection = $section->find($id);

        if ($findSection['owner_id'] != $user['id']) {
            return backWithError("/inventory/sections", "La seccion no existe");
        }

        $ur = $rolable->where("user_id", $user['id'])->first();

        return view("Admin.elements", [
            'title' => 'Elementos',
            'elements' => $elements,
            'section' => $findSection,
            'user' => $user,
            'role_user' => $ur
        ]);
    }

    public function leandings_admin($id, $user)
    {
        $element = new Element();
        $section = new Section();
        $ldg = new Leanding();
        $rolable = new RoleUser();

        $findSection = $section->find($id);

        $leandings = $ldg->where('section_id', $findSection['id'])->get();
        $elements = $element->where("section_id", $findSection['id'])->get();

        $ur = $rolable->where("user_id", $user['id'])->first();

        return view("Leandings.index", [
            'title' => 'Prestamos',
            'leandings' => $leandings,
            'section' => $findSection,
            'elements' => $elements,
            'role_user' => $ur
        ]);
    }

    public function closedldg_admin($id, $user)
    {
        $element = new Element();
        $section = new Section();
        $ldg = new Leanding();
        $su = new SectionUser();
        $role = new RoleUser();
        $userole = $role->where("user_id", $user['id'])->first();
        
        if (empty($sectionable)) {
            $sectionable = $section->find($id);
        }
        
        $findSection = $section->find($sectionable['id']);
        $sus = $su->where('user_id', $user['id'])->first();
        
        $leandings = $ldg->where('section_id', $sectionable['id']);
        $elements = $element->where("section_id", $sectionable['id'])->get();

        $closedldg = $leandings->where("state", 1)->get();

        return view("Leandings.closedldg", [
            'title' => 'Prestamos cerrados',
            'leandings' => $closedldg,
            'section' => $sectionable,
            'role' => $userole,
            'elements' => $elements
        ]);
    }
}
