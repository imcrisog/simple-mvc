<div x-data="{ open: false, pop: false }" class="md:flex relative justify-center items-center w-full md:w-3/4 overflow-y-auto">
    <div :class="{'opacity-20': open }" class="text-lg justify-center w-4/5">
        <div class="p-4 bg-slate-900 rounded-md w-full">
            <div class="flex items-center justify-between w-full pt-2 border-b border-slate-900">
                <h1 class="text-center font-bold text-2xl"> Prestamos Cerrados </h1>
            </div>
            <h1 class="text-xl my-4 font-semibold"> Estas en: <spa class="font-bold"> <?= $section['name'] ?> </span> </h1>
            <div class="w-full">
                <table class="table table-bordered table-checkable kt_datatable">
                    <thead>
                        <tr>
                            <th class="w-1/4">Consignatario</th>
                            <th class="w-1/4">Curso</th>
                            <th class="w-1/4">Elemento</th>
                            <th class="w-1/4">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php foreach ($leandings as $key => $lean) { ?>
                        <?php if ($lean['state'] == 1) { ?>
                        <?php ?>
                        <tr class="bg-white dark:bg-gray-900 dark:border-gray-700 align-middle">
                            <td class="px-6 py-4"><?= $lean['name'] ?></td>
                            <td class="px-6 py-4"><?= $lean['course'] ?></td>
                            <?php
                                if (current(array_filter($elements, fn ($e) => $e['id'] == $lean['element_id']))) {
                                    $choclo = current(array_filter($elements, fn ($e) => $e['id'] == $lean['element_id']))['name'];
                                } else {
                                    $choclo = 'No se encontro al usuario';
                                }
                            ?>
                            <td class="px-6 py-4"><?= $choclo ?></td>
                            <td class="px-6 py-4 flex space-x-2 items-center md:py-8">
                                <a class="text-red-500 p-1.5 border-red-500 hover:bg-red-500 ease hover:text-white transition duration-100 border rounded-md" href="<?= LOCALHOST ?>/inventory/delete/<?= $lean['id'] ?>/leanding"> <i class="fas fa-trash"></i> </a>
                                <a class="text-blue-500 p-1.5 border-blue-500 hover:bg-blue-500 ease hover:text-white transition duration-100 border rounded-md" href="<?= LOCALHOST ?>/inventory/update/<?= $lean['id'] ?>/leanding"> <i class="fas fa-pen"></i> </a> 
                            </td> 
                        </tr> 
                        <?php } ?>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>
    <div x-show="open" @click.outside="open = false"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-90"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-90" class="bg-slate-900 z-50 h-auto rounded-md border-white border px-3 py-2 absolute w-2/3 flex justify-center items-center" style="display: none;">
        <div class="w-full flex h-full justify-between flex-col">
            <div class="flex items-center w-full">
                <h2 class="my-6 flex justify-center text-xl font-bold"> Nuevo Prestamo</h2>
                <button @click="open = false" class="p-2.5 m-3 border-slate-700 hover:bg-gray-500 ease text-white transition duration-100 border absolute px-4 top-0 right-0 rounded-md"><i class="fas fa-times"></i></button>
            </div>
            <form action="<?= LOCALHOST ?>/inventory/create/leandings" method="post" class="flex flex-col space-y-4">
                <div class="w-full flex justify-center">
                    <div class="w-1/2 relative">
                        <input type="number" id="element-input" name="element" onmouseover="this.focus();" class="w-full px-2.5 pb-2.5 pt-4 text-sm bg-transparent rounded-lg border-2 appearance-none text-white border-gray-600 focus:border-blue-500 focus:outline-none focus:ring-0 peer" placeholder="" autocomplete="off" />
                        <label for="element-input" class="absolute text-sm text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] px-2 peer-focus:px-2 peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 bg-slate-900 peer-focus:-translate-y-4 left-1"> Codigo de barras </label> 
                    </div>
                </div>
                <input type="hidden" name="section" value="<?= $section['id'] ?>">
                <button class="w-full py-2 hover:bg-indigo-500 font-semibold bg-indigo-700 rounded-md uppercase" type="submit"> Enviar </button>
            </form>
        </div>
    </div>
    
    <button id="backbutton" class="absolute p-2.5 m-3 border-slate-700 hover:bg-gray-500 ease text-white transition duration-100 border px-4 top-0 right-0 rounded-md"><i class="fas fa-times"></i></button>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
    const botonVolver = document.getElementById("backbutton");

    backbutton.addEventListener("click", function () {
        window.history.back();
    });
});
</script>