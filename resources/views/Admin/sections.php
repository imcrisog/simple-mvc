<div x-data="{ open: false }" class="md:flex relative my-8 justify-center items-center space-x-4 overflow-y-auto w-full md:w-3/4">

    <div class="w-full md:w-4/5 flex justify-center items-center flex-col space-y-4">
        <div id="full" :class="{'opacity-20': open }"  class="bg-slate-900 w-full py-6 grid place-items-center relative overflow-x-auto shadow-md sm:rounded-lg">

            <div class="flex items-center justify-between w-full mb-6 pb-6 pt-2 border-b px-4 border-slate-900">
                <h1 class="text-center font-semibold text-xl"> Tabla de Secciones </h1>

                <button @click="open = true" class="bg-indigo-600 hover:bg-indigo-500 font-bold text-white py-1.5 rounded-md px-2 text-xl">
                    <span class="px-2 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                            height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24" />
                                <circle class="fill-gray-200" cx="9" cy="15" r="6" />
                                <path
                                    d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z"
                                    class="fill-gray-300" opacity="0.3" />
                            </g>
                        </svg>

                        Crear Seccion
                    </span>
                </button>
            </div>

            <table class="table table-bordered table-checkable kt_datatable text-center">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Administrador</th>
                        <th class="w-1/4">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($sections as $key => $section) { ?>
                    <tr>
                        <td><?= $section['id'] ?></td>
                        <td><?= $section['name'] ?></td>
                        <td><?= current(array_filter($users, fn ($u) => $u['id'] === $section['user_id']))['username'] ?></td>
                        <td class="flex space-x-2 items-center md:py-8"> 
                            <button title="Eliminar" type="button" class="text-red-500 p-1.5 border-red-500 hover:bg-red-500 ease hover:text-white transition duration-100 border rounded-md" onclick="adv('<?= $section['name'] ?>', <?= $section['id'] ?>)"> <i class="fas fa-trash"></i> </button>
                            <a title="Editar" class="text-blue-500 p-1.5 border-blue-500 hover:bg-blue-500 ease hover:text-white transition duration-100 border rounded-md" href="<?= LOCALHOST ?>/inventory/update/<?= $section['id'] ?>/section"> <i class="fas fa-pen"></i> </a> 
                            <a title="Elementos" class="text-white p-1.5 border-white hover:bg-white ease hover:text-black transition duration-100 border rounded-md" href="<?= LOCALHOST ?>/inventory/<?= $section['id'] ?>/elements"> <i class="fas fa-search"></i> </a>
                            <a title="Prestamos" class="text-white p-1.5 border-gray-400 hover:bg-gray-500 ease hover:text-black transition duration-100 border rounded-md" href="<?= LOCALHOST ?>/inventory/<?= $section['id'] ?>/leandings"> <i class="fas fa-tasks"></i> </a> 
                        </td>
                    </tr> 
                    <?php } ?>
                </tbody>
            </table>     
        </div>

        <div class="hidden bg-slate-900 h-auto rounded-md border-white border p-10 w-5/12 justify-center items-center" id="deletable">
            <h1 class="w-full text-center font-bold text-xl"> ¿Esta seguro de eliminar este seccion? </h1>
            <div> "<span class="font-extrabold text-2xl text-red-500" id="section"></span>" </div>
            <p class="text-center max-w-md text-gray-400 font-semibold"> Los datos no se recuperaran si elimina la seccion, asi como los prestamos, elementos y usuarios. </p>

            <a class="w-2/3 text-center px-4 py-1 font-bold my-4 bg-red-500 hover:bg-red-600" id="confirmdelete"> Eliminar </a>
            <button class="px-4 py-1 w-2/3 text-center border border-gray-400 font-bold hover:bg-gray-500" onclick="advremove()"> Cancelar </button>
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
            <div class="flex justify-between items-center w-full">
                <h2 class="my-6 flex justify-center text-xl font-bold"> Ingrese el Nombre de la Sección </h2>
                <button @click="open = false" class="p-2.5 m-3 border-slate-700 hover:bg-gray-500 ease text-white transition duration-100 border absolute px-4 top-0 right-0 rounded-md"><i class="fas fa-times"></i></button>
            </div>

            <form class="w-full justify-center space-y-7 items-center flex flex-col" action="<?= LOCALHOST ?>/inventory/create/section" method="post">
                <div class="w-1/2 flex-1 relative">
                    <input type="text" id="name-input" name="name" class="block px-2.5 pb-2.5 pt-4 w-full text-sm bg-transparent rounded-lg border-2 appearance-none text-white border-gray-600 focus:border-blue-500 focus:outline-none focus:ring-0 peer" placeholder=" " autocomplete="off" />
                    <label for="name-input" class="absolute text-sm text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] px-2 peer-focus:px-2 peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 bg-slate-900 peer-focus:-translate-y-4 left-1"> Nombre </label> 
                </div>
                <div class="w-2/3">
                    <span class="text-lg font-semibold mb-2"> Usuario Supervisor a asignar: </span>
                    <select class="bg-gray-50 border py-2 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="supervisor">
                        <?php foreach ($superusers as $key => $user) { ?>
                        <?php if ($user["rol"] == "supervisor")  { ?>
                        <option class="py-4 px-2 text-center font-bold" value="<?= $user['id'] ?>"> <?= $user['username'] ?> (<?=$user['dni']?>)</option>
                        <?php } ?>
                        <?php } ?>
                    </select>
                </div>
                <div class="w-2/3">
                    <span class="text-lg font-semibold mb-2"> Usuario Prestamista a asignar: </span>
                    <select class="bg-gray-50 border py-2 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="prestamist">
                        <?php foreach ($prestusers as $key => $user) { ?>
                        <?php if ($user["rol"] == "prestamista")  { ?>
                        <option class="py-4 px-2 text-center font-bold" value="<?= $user['id'] ?>"> <?= $user['username'] ?> (<?=$user['dni']?>) </option>
                        <?php } ?>
                        <?php } ?>
                    </select>
                </div>

                <!-- <div class="w-2/3 pb-8">
                    <label for="custom"> Personalizar Seccion </label>
                    <select class="bg-gray-50 border py-2 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="custom">
                        <option value="false"> No Personalizar </option>
                        <option value="true"> Personalizar </option>
                    </select>
                </div> -->

                <button class="w-full py-2 hover:bg-indigo-500 font-semibold bg-indigo-700 rounded-md uppercase" type="submit"> Enviar </button>
            </form>
        </div>
    </div>
    

    <script>
        function adv(name, id) {
            const adv = document.getElementById('deletable')
            document.getElementById('full').classList.add('opacity-20')
            document.getElementById('section').innerText = name
            document.getElementById('confirmdelete').setAttribute('href', '<?= LOCALHOST ?>/inventory/delete/' + id + '/section')

            adv.classList.remove('hidden')
            adv.classList.add('absolute', 'flex', 'flex-col')
        }

        function advremove() {
            const adv = document.getElementById('deletable')
            document.getElementById('full').classList.remove('opacity-20')

            adv.classList.remove('absolute', 'flex', 'flex-col')
            adv.classList.add('hidden')
        }
    </script>
</div>
