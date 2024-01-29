<div x-data="{ open: false, searcher: false }" class="md:flex relative my-8 justify-center items-center space-x-4 overflow-y-auto w-full md:w-3/4">

    <div class="w-full md:w-4/5 flex justify-center items-center flex-col space-y-4">

        <div :class="{'opacity-20': open }" x-on:click.away="searcher = false" class="w-full relative" 
            x-data='{ 
                <?php echo "items: " . json_encode($elements) ?>,
                search: "", 
                get searchResults () {
                    return this.items.filter(i => i.name.toLowerCase().startsWith(this.search.toLowerCase()) && i.section_id == <?php echo $section['id'] ?> )
                } 
            }'
        >

            <div class="flex items-center">
                <svg class="w-10 mr-5 h-10 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
                <input x-on:click="searcher = true" x-model="search" type="search" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Buscar... Laptop, Destornillador...">
            </div>

            <ul x-show="searcher" class="absolute w-full z-50 mt-3">
                <template x-for="item in searchResults">
                    <a x-bind:href="'<?= LOCALHOST ?>/inventory/show/' + item.id + '/element'">
                        <li class="bg-slate-800 md:hover:scale-105 duration-100 transition rounded-md my-2 py-2 text-center text-gray-200 font-bold" x-text="item.name"></li>
                    </a>
                </template>
            </ul>
        </div>

        <div :class="{'opacity-20': open, 'opacity-10': searcher }"  class="bg-slate-900 w-full py-6 grid place-items-center relative overflow-x-auto shadow-md sm:rounded-lg">

            <div class="flex items-center justify-between w-full mb-6 pb-6 pt-2 border-b px-4 border-slate-900">
                <h1 class="text-center font-semibold text-xl"> Tabla de Elementos (<?= $section['name']; ?>) </h1>

                <div class="flex space-x-6">
                    <button @click="open = true" class="flex bg-indigo-600 hover:bg-indigo-500 font-bold text-white py-1.5 rounded-md px-2 text-xl">
                        <span class="px-2 flex items-center">
                            <svg class="mr-1.5" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <circle class="fill-gray-200" cx="9" cy="15" r="6" />
                                    <path
                                        d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z"
                                        class="fill-gray-300" opacity="0.3" />
                                </g>
                            </svg>

                            Crear
                        </span>
                    </button>

                    <a href="<?= LOCALHOST ?>/inventory/show/<?= $section['id'] ?>/elements" class="flex bg-red-600 hover:bg-red-500 font-bold text-white py-1.5 rounded-md px-2 text-xl">
                        <span class="px-2 flex items-center">
                            <svg class="mr-1.5" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <circle class="fill-gray-200" cx="9" cy="15" r="6" />
                                    <path
                                        d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z"
                                        class="fill-gray-300" opacity="0.3" />
                                </g>
                            </svg>

                            PDF
                        </span>
                    </a>
                </div>
            </div>

            <!-- text-green-500 (Don't remove this) -->
            <table class="table table-bordered table-checkable kt_datatable">
                <thead>
                    <tr>
                        <th class="w-1/5">ID</th>
                        <th class="w-1/5">Nombre</th>
                        <th class="w-1/5">Estado</th>
                        <th class="w-1/5">Cantidad</th>
                        <?php if ($section['model'] != "") { ?>
                        <?php foreach (json_decode($section['model']) as $model) { ?>
                        <th> <?= $model ?> </th>
                        <?php } ?>
                        <?php } ?>
                        <th class="w-1/5">Acciones</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php foreach ($elements as $key => $element) { ?>
                    <?php if ($element["section_id"] == $section['id'] || $role['role_id'] == 1) { ?>
                    <tr class="bg-white dark:bg-gray-900 dark:border-gray-700">
                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"><?= $element['id'] ?></td>
                        <td class="px-6 py-4"><?= $element['name'] ?></td>
                        <td class="px-6 py-4"><?= $element['estado'] ?></td>
                        <td class="px-6 py-4"><?= $element['cantidad'] ?></td>
                        <?php if ($section['model'] != "") { ?>
                        <?php foreach (json_decode($section['model']) as $model) { ?>
                        <td class="px-6 py-4"><?= json_decode($element['data'])->{$model} ?></td>
                        <?php } ?>
                        <?php } ?>
                        <td class="px-6 py-4 flex space-x-2 items-center">
                            <a class="text-red-500 p-1.5 border-red-500 hover:bg-red-500 ease hover:text-white transition duration-100 border rounded-md" href="<?= LOCALHOST ?>/inventory/delete/<?= $element['id'] ?>/element"> <i class="fas fa-trash"></i> </a> 
                            <a class="text-blue-500 p-1.5 border-blue-500 hover:bg-blue-500 ease hover:text-white transition duration-100 border rounded-md" href="<?= LOCALHOST ?>/inventory/update/<?= $element['id'] ?>/element"> <i class="fas fa-pen"></i> </a> 
                            <a class="text-white p-1.5 border-white hover:bg-white ease hover:text-black transition duration-100 border rounded-md" href="<?= LOCALHOST ?>/inventory/show/<?= $element['id'] ?>/element"> <i class="fas fa-eye"></i> </a> 
                        </td>
                    </tr> 
                    <?php } ?>
                    <?php } ?>
                </tbody>
            </table>  
        </div>
    </div>

    <div x-show="open" @click.outside="open = false"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-90"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-90" class="bg-slate-900 h-auto z-50 rounded-md border-gray-400 border px-3 py-2 absolute w-2/3 flex justify-center items-center" style="display: none;">
        <div class="w-full flex h-full justify-between flex-col">
            <div class="flex justify-between items-center w-full">
                <h2 class="my-6 flex justify-center text-xl font-bold"> Ingrese el Nombre del Elemento </h2>
                <button @click="open = false" class="p-2.5 m-3 border-slate-700 hover:bg-gray-500 ease text-white transition duration-100 border absolute px-4 top-0 right-0 rounded-md"><i class="fas fa-times"></i></button>
            </div>

            <form x-data="{ part: 0 }" class="w-full justify-center space-y-4 items-center flex flex-col select-none" action="<?= LOCALHOST ?>/inventory/create/element" method="post">
                <div x-show="part == 0" class="justify-center space-y-4 items-center flex flex-col select-none">
                    <div class="w-1/2 flex-1 relative">
                        <input type="text" id="name-input" name="name" class="block px-2.5 pb-2.5 pt-4 w-full text-sm bg-transparent rounded-lg border-2 appearance-none text-white border-gray-600 focus:border-blue-500 focus:outline-none focus:ring-0 peer" placeholder=" " autocomplete="off" />
                        <label for="name-input" class="absolute text-sm text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] px-2 peer-focus:px-2 peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 bg-slate-900 peer-focus:-translate-y-4 left-1"> Nombre </label> 
                    </div>
                    <div class="w-1/3 flex-1 relative">
                        <input type="number" id="cantidad-input" name="cantidad" class="block px-2.5 pb-2.5 pt-4 w-full text-sm bg-transparent rounded-lg border-2 appearance-none text-white border-gray-600 focus:border-blue-500 focus:outline-none focus:ring-0 peer" placeholder=" " autocomplete="off"/>
                        <label for="cantidad-input" class="absolute text-sm text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] px-2 peer-focus:px-2 peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 bg-slate-900 peer-focus:-translate-y-4 left-1"> Cantidad </label> 
                    </div>
                    <div class="w-2/3 flex-1 relative">
                        <input type="text" id="caracteristicas-input" name="caracteristicas" class="block px-2.5 pb-2.5 pt-4 w-full text-sm bg-transparent rounded-lg border-2 appearance-none text-white border-gray-600 focus:border-blue-500 focus:outline-none focus:ring-0 peer" placeholder=" " autocomplete="off"/>
                        <label for="caracteristicas-input" class="absolute text-sm text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] px-2 peer-focus:px-2 peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 bg-slate-900 peer-focus:-translate-y-4 left-1"> Caracteristicas </label> 
                    </div>
                    <div class="flex flex-row">
                        <div class="w-1/2 flex-row relative mx-2">
                            <input type="text" id="marca-input" name="marca" class="block px-2.5 pb-2.5 pt-4 w-full text-sm bg-transparent rounded-lg border-2 appearance-none text-white border-gray-600 focus:border-blue-500 focus:outline-none focus:ring-0 peer" placeholder=" " autocomplete="off"/>
                            <label for="marca-input" class="mx-2 absolute text-sm text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] px-2 peer-focus:px-2 peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 bg-slate-900 peer-focus:-translate-y-4 left-1"> Marca </label> 
                        </div>
                        <div class="w-1/2 flex-row relative">
                            <input type="text" id="pro-input" name="procedencia" class="block px-2.5 pb-2.5 pt-4 w-full text-sm bg-transparent rounded-lg border-2 appearance-none text-white border-gray-600 focus:border-blue-500 focus:outline-none focus:ring-0 peer" placeholder=" " autocomplete="off"/>
                            <label for="pro-input" class="absolute text-sm text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] px-2 peer-focus:px-2 peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 bg-slate-900 peer-focus:-translate-y-4 left-1"> Procedencia </label> 
                        </div>
                    </div>
                    <div class="w-2/3 flex-1 relative">
                        <input type="text" id="obs-input" name="obs" class="block px-2.5 pb-2.5 pt-4 w-full text-sm bg-transparent rounded-lg border-2 appearance-none text-white border-gray-600 focus:border-blue-500 focus:outline-none focus:ring-0 peer" placeholder=" " autocomplete="off"/>
                        <label for="obs-input" class="absolute text-sm text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] px-2 peer-focus:px-2 peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 bg-slate-900 peer-focus:-translate-y-4 left-1"> Observaciones </label> 
                    </div>
                    <div class="w-2/3 flex-1 relative">
                        <input type="date" id="date-input" name="added_at" class="block px-2.5 pb-2.5 pt-4 w-full text-sm bg-transparent rounded-lg border-2 appearance-none text-white border-gray-600 focus:border-blue-500 focus:outline-none focus:ring-0 peer" placeholder=" " autocomplete="off"/>
                        <label for="date-input" class="absolute text-sm text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] px-2 peer-focus:px-2 peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 bg-slate-900 peer-focus:-translate-y-4 left-1"> Fecha de Adicion </label> 
                    </div>

                    <div class="w-full">
                        <span class="text-lg font-semibold mb-2"> Estado: </span>
                        <select class="bg-gray-50 border py-2 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="estado">
                            <option class="py-4 px-2 text-center font-bold" value="0"> MALO </option>
                            <option class="py-4 px-2 text-center font-bold" value="1"> REGULAR </option>
                            <option class="py-4 px-2 text-center font-bold" value="2"> BUENO </option>
                        </select>
                    </div>
                </div>

                <div x-show="part == 1" style="display: none;" class="justify-center space-y-4 items-center flex flex-col select-none">
                <?php if ($section['model'] != "") { ?>
                <?php foreach (json_decode($section['model']) as $model) { ?>
                    <div class="w-2/3 flex-1 relative">
                        <input type="text" id="<?= $model ?>-input" name="data[<?= $model ?>]" class="block px-2.5 pb-2.5 pt-4 w-full text-sm bg-transparent rounded-lg border-2 appearance-none text-white border-gray-600 focus:border-blue-500 focus:outline-none focus:ring-0 peer" placeholder=" " autocomplete="off"/>
                        <label for="<?= $model ?>-input" class="absolute text-sm text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] px-2 peer-focus:px-2 peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 bg-slate-900 peer-focus:-translate-y-4 left-1"> <?= $model ?> </label> 
                    </div>
                <?php } ?>
                <?php } ?>
                </div>

                <input type="hidden" name="section" value="<?= $section['id'] ?>">
                <div x-show="part == 1" class="flex w-full space-x-2">
                    <button type="button" x-on:click="part--" class="w-1/2 py-2 hover:bg-indigo-500 font-semibold bg-indigo-700 rounded-md uppercase"> Volver </button>
                    <button class="w-1/2 py-2 hover:bg-indigo-500 font-semibold bg-indigo-700 rounded-md uppercase" type="submit"> Enviar </button>
                </div>
                <button type="button" x-show="part == 0" x-on:click="part++" class="w-full py-2 hover:bg-indigo-500 font-semibold bg-indigo-700 rounded-md uppercase"> Continuar </button>
            </form>
        </div>
    </div>
    
    <?php if ($role_user['role_id'] == 1) { ?>
        <a  href="<?= LOCALHOST ?>/inventory/sections" class="absolute p-2.5 m-3 border-slate-700 hover:bg-gray-500 ease text-white transition duration-100 border px-4 top-0 right-0 rounded-md"><i class="fas fa-times"></i></a>
    <?php }?>
        
    </div>