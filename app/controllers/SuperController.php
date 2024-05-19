<?php

namespace App\Controllers;

use App\Models\Element;
use App\Models\User;
use App\Models\RoleUser;
use App\Models\Section;
use Dompdf\Dompdf;

class SuperController extends Controller {

    public function show_elements($user) 
    {
        $sectionable = new Section();
        $element = new Element();
        $elements = $element->all()->get();

        $section = $sectionable->where("user_id", $user['id'])->first();

        if (empty($section)) {
            return var_dump("No estas en ninguna seccion"); 
        }

        return view("Admin.elements", [
            'title' => 'Elementos',
            'elements' => $elements,
            'section' => $section,
            'user' => $user
        ]);
    }

    public function show_element($id, $usera) {
        $element = new Element();
        $user = new User();
        $section = new Section();

        $e = $element->find($id);
        $sectionable = $section->find($e['section_id']);
        $findUser = $user->find($sectionable['user_id']);

        return view("Admin.show_element", [
            'title' => 'Ver elemento',
            'element' => $e,
            'user' => $usera,
            'section' => $sectionable,
            'supervisor' => $findUser
        ]);
    }

    public function pdf_elements($id) 
    {
        $element = new Element();
        $sectionable = new Section();

        $section = $sectionable->find($id);
        $name = $section['name'];
        $elements = $element->where("section_id", $section['id'])->get();

        ob_start();
        include "../resources/views/Pdf/index.php";
        $view = ob_get_clean();

        $dompdf = new Dompdf();
        $dompdf->loadHtml($view);
        
        $dompdf->setPaper('A3','landscape');
        $dompdf->render();
        $dompdf->stream("Inventario-EICO-Elementos-$name");
    }

    public function create_element($user) 
    {
        $vals = validator(['name', 'cantidad', 'caracteristicas', 'estado', 'marca', 'procedencia']);
        if ($vals) return backWithError("/inventory/elements", $vals);
        
        $element = new Element();
        $role = new RoleUser();
        $section = $_POST['section'];

        if (isset($_POST['data'])) {
            $final = json_encode($_POST['data']);
        }

        $element->create([
            'name' => strip_tags($_POST['name']),
            'cantidad' => strip_tags($_POST['cantidad']),
            'caracteristicas' => strip_tags($_POST["caracteristicas"]),
            'marca' => strip_tags($_POST["marca"]),
            'procedencia' => strip_tags($_POST["procedencia"]),
            'observaciones' => strip_tags($_POST["obs"]),
            'added_at' => $_POST['added_at'],
            'estado' => $_POST['estado'],
            'data' => isset($_POST['data']) ? $final : "",
            'section_id' => $section
        ]);

        $userole = $role->where("user_id", $user['id'])->first();

        if ($userole['role_id'] == 1) {
            return redirect("/inventory/$section/elements");
        }

        return redirect("/inventory/elements");
    }

    public function updater_element($id, $user)
    {
        $element = new Element();
        $findElement = $element->find($id);
        $role = new RoleUser();
        $section = $findElement['section_id'];

        $userole = $role->where('user_id', $user['id'])->first();

        if (!$findElement) return backWithError("/inventory/elements", "No se encontro el elemento a actualizar");

        return view('Admin.updater_elements', [
            'title' => 'Actualizar elemento',
            'element' => $findElement,
            'user' => $userole,
            'section' => $section
        ]);
    }

    public function update_element($id, $user) 
    {
        $element = new Element();
        $role = new RoleUser();
        $findElement = $element->find($id);

        $element->update($id, [
            'name' => empty($_POST['name']) ? $findElement['name'] : $_POST['name'],
            'cantidad' => empty($_POST['cantidad']) ? $findElement['cantidad'] : $_POST['cantidad'],
            'caracteristicas' => empty($_POST['caracteristicas']) ? $findElement['caracteristicas'] : $_POST['caracteristicas'],
            'marca' => empty($_POST['marca']) ? $findElement['marca'] : $_POST['marca'],
            'procedencia' => empty($_POST['pro']) ? $findElement['procedencia'] : $_POST['pro'],
            'observaciones' => empty($_POST['obs']) ? $findElement['observaciones'] : $_POST['obs'],
            'added_at' => empty($_POST['added_at']) ? $findElement['added_at'] : $_POST['added_at'],
            'estado' => $_POST['estado'] == "Seleccione" ? $findElement['estado'] : $_POST['estado']
        ]);

        $userole = $role->where("user_id", $user['id'])->first();
        if ($userole['role_id'] == 1) {
            $section = $findElement['section_id'];
            return redirect("/inventory/$section/elements");
        }

        return redirect("/inventory/elements");
    }

    public function delete_element($id, $user)
    {
        $element = new Element();
        $role = new RoleUser();
        $findElement = $element->find($id);

        if (!$findElement) return backWithError("/inventory/elements", "El Elemento no existe");

        $element->delete($id);

        $userole = $role->where("user_id", $user['id'])->first();

        if ($userole['role_id'] == 1) {
            $section = $findElement['section_id'];
            return redirect("/inventory/$section/elements");
        }

        return redirect("/inventory/elements");
    }

    public function create_pdf() {}

}
