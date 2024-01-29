<div class="flex justify-center items-center w-3/4">
    <div class="w-2/3 bg-slate-900 p-4 rounded-md">
        <div class="relative p-4">
            <?php if ($user['role_id'] == 1) {?>
                <a class="text-white p-2.5 border-gray-500 hover:bg-gray-400 ease hover:text-white transition duration-100 border absolute rounded-md flex right-0 top-0 w-9" href="<?= LOCALHOST ?>/inventory/<?= $section ?>/elements"><i class="fas fa-sign-out-alt"></i></a>
            <?php } else {?>
                <a class="text-white p-2.5 border-gray-500 hover:bg-gray-400 ease hover:text-white transition duration-100 border absolute rounded-md flex right-0 top-0 w-9" href="<?= LOCALHOST ?>/inventory/elements"><i class="fas fa-sign-out-alt"></i></a>
            <?php }?>
            <h2 class="my-6 flex justify-center text-lg font-bold"> Actualice los datos de: <?= $element['name'] ?> </h2>

            <form class="w-full justify-center space-y-4 items-center flex flex-col select-none" action="<?= LOCALHOST ?>/inventory/update/<?= $element['id'] ?>/element" method="post">
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
                        <input type="text" id="pro-input" name="pro" class="block px-2.5 pb-2.5 pt-4 w-full text-sm bg-transparent rounded-lg border-2 appearance-none text-white border-gray-600 focus:border-blue-500 focus:outline-none focus:ring-0 peer" placeholder=" " autocomplete="off"/>
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
                        <option class="py-4 px-2 text-center font-bold"> Seleccione </option>
                        <option class="py-4 px-2 text-center font-bold" value="0"> MALO </option>
                        <option class="py-4 px-2 text-center font-bold" value="1"> REGULAR </option>
                        <option class="py-4 px-2 text-center font-bold" value="2"> BUENO </option>
                    </select>
                </div>
                <button class="w-full py-2 hover:bg-indigo-800 font-semibold bg-indigo-700 rounded-md uppercase" type="submit"> Enviar </button>
            </form>
        </div>
    </div>
</div>