<?php

namespace App\Controllers;

use App\Models\Element;
use App\Models\Leanding;
use App\Models\Section;
use App\Models\SectionUser;
use App\Models\RoleUser;

class PrestController extends Controller {

    public function show_leandings($user) 
    {
        $element = new Element();
        $section = new Section();
        $ldg = new Leanding();
        $su = new SectionUser();
        $rolable = new RoleUser();

        $prestamists = $su->where("type", "prestamist")->get();

        $prestamist = array_filter($prestamists, function ($pre) use ($user) {
            return $pre['user_id'] == $user['id'];
        })[0];

        $mysec = $section->find((int) $prestamist['section_id']);
        $mysecid = $mysec['id'];

        if (empty($prestamist)) {
            return redirect("/inventory/$mysecid/leandings");
        }
        
        $leandings = $ldg->where('section_id', $mysec['id'])->get();
        $elements = $element->where("section_id", $mysec['id'])->get();
        $ur = $rolable->where("user_id", $user['id'])->first();

        return view("Leandings.index", [
            'title' => 'Prestamos',
            'leandings' => $leandings,
            'section' => $mysec,
            'elements' => $elements,
            'role_user' => $ur
        ]);
    }

    public function show_create_leanding($user) 
    {
        $id = intval(round($_POST["element"]));
        $elementa = new Element();
        $element = $elementa->find($id);
        $role = new RoleUser();
        $section = $_POST['section'];

        $roleuser = $role->where('user_id', $user['id'])->first();

        if (empty($element)) {
            if ($roleuser['role_id'] == 1) {
                return backWithError("/inventory/$section/leandings", "El elemento no existe");
            }
            return backWithError("/inventory/leandings", "El elemento no existe");
        }

        if ($element['section_id'] != $_POST['section']) {
            return backWithError("/inventory/leandings", "El elemento es inaccesible");
        }

        return view('Leandings.create', [
            'title' => 'Prestamo',
            'element' => $element,
            'section' => $section
        ]);
    }

    public function create_leandings($user)
    {   
        $role = new RoleUser();
        $roleuser = $role->where('user_id', $user['id'])->first();
        $section = $_POST['section'];
        $vals = validator(['name', 'course', 'dni']);
        if ($vals && $roleuser['role_id'] == 1) return backWithError("/inventory/$section/leandings", $vals);
        if ($vals) return backWithError("/inventory/leandings", $vals);
        
        $id = intval(round($_POST["element"]));
        $elementa = new Element();
        $element = $elementa->find($id);
        $allLeandings = new Leanding();
        $allLeandings = $allLeandings->where('element_id', $id)->get();
        $counta = count($allLeandings); 
        
        if (intval($element['cantidad']) <= $counta) { 
            if ($roleuser['role_id'] == 1) {
                return backWithError("/inventory/$section/leandings", "ya no quedan unidades existentes");
            }

            return backWithError('/inventory/leandings', "Ya no quedan unidades existentes");
        }
        
        $leanding = new Leanding();
        $leanding->create([
            'name' => $_POST['name'],
            'state' => 0, // 0 = Activo - 1 = Cerrado
            'course' => $_POST['course'],
            'dni' => $_POST['dni'],
            'details' => $_POST['details'],
            'section_id' => $_POST['section'],
            'element_id' => $_POST['element']
        ]);

        successmsg("Prestamo creado correctamente!");
        
        $userole = $role->where("user_id", $user['id'])->first();
        
        if ($userole['role_id'] == 1) {
            $section = $_POST['section'];
            return redirect("/inventory/$section/leandings");
        }

        return redirect("/inventory/leandings");
    }

    public function update_leanding($id, $user) 
    {
        $leanding = new Leanding();
        $findldg = $leanding->find($id);
        $role = new RoleUser();
        $roleuser = $role->where('user_id', $user['id'])->first();
        $section = new Section();

        if (!$findldg) return backWithError("/inventory/leandings", "No se encontro el prestamo a actualizar");

        $leanding->update($id, [
            'state' => !$findldg['state']
        ]);
        
        successmsg("Prestamo actualizado correctamente!");
        
        if ($roleuser['role_id'] == 1){
            $sectionable = $section->where("owner_id", $user['id'])->first();
            $findSection = $sectionable['id'];

            return redirect("/inventory/$findSection/leandings");
        }

        return redirect("/inventory/leandings");
    }

    public function delete_leanding($id, $user) {
        $leanding = new Leanding();
        $ldg = $leanding->find($id);
        $role = new RoleUser();
        $userole = $role->where("user_id", $user['id'])->first();
        $section = $ldg['section_id'];

        if(!$ldg) {
            if ($userole['role_id'] == 1) {
                return backWithError("/inventory/$section/leandings", 'El prestamo no existe');
            }
            return backWithError("/inventory/leandings", 'El prestamo no existe');
        }

        $leanding->delete($id);

        successmsg("Prestamo eliminado correctamente!");

        if ($userole['role_id'] == 1) {
            return redirect("/inventory/$section/leandings");
        }

        redirect('/inventory/leandings');
    }

    public function show_close_leandings($user)
    {
        return "oal";
        $element = new Element();
        $section = new Section();
        $ldg = new Leanding();
        $su = new SectionUser();
        $role = new RoleUser();
        $userole = $role->where("user_id", $user['id'])->first();
        $sectionable = $section->where("prest_id", $user['id'])->first();

        /* 
        Error en la Vista dada por los prestamistas
        http://localhost/inveico/public/inventory/closed/leandings
        Returna http://localhost/inveico/public/profile
        */
        $sus = $su->where('user_id', $user['id'])->first();
        $mysec = $section->find($sus['section_id']);
        
        $leandings = $ldg->where('section_id', $sectionable['id']);
        $elements = $element->where("section_id", $sectionable['id'])->get();

        $closedldg = $leandings->where("state", 1)->get();

        return view("Leandings.closedldg", [
            'title' => 'Prestamos cerrados',
            'leandings' => $closedldg,
            'section' => $mysec,
            'role' => $userole,
            'elements' => $elements
        ]);
    }
}