<div class="md:flex relative my-8 justify-center items-center space-x-4 overflow-y-auto w-full md:w-3/4">
    <div class="flex justify-center bg-slate-900 w-1/2 h-auto rounded-md p-4">
        <form class="w-full justify-center space-y-7 items-center flex flex-col select-none" action="<?= LOCALHOST ?>/inventory/leandings" method="post">
            <div class="flex flex-col w-full">
                <h2 class="text-start font-bold text-lg">Prestamo para el Elemento:</h2>
                <p class="text-center font-bold text-lg"> <?= $element['name'] ?> - <?= $element['cantidad'] ?> </p> 
            </div>
            <div class="w-2/3 flex-1 relative">
                <input type="text" id="name-input" name="name" class="block px-2.5 pb-2.5 pt-4 w-full text-sm bg-transparent rounded-lg border-2 appearance-none text-white border-gray-600 focus:border-blue-500 focus:outline-none focus:ring-0 peer" placeholder=" " autocomplete="off" />
                <label for="name-input" class="absolute text-sm text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] px-2 peer-focus:px-2 peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 bg-slate-900 peer-focus:-translate-y-4 left-1"> Nombre </label> 
            </div>
            <div class="w-2/3 flex-1 relative">
                <input type="text" id="course-input" name="course" class="block px-2.5 pb-2.5 pt-4 w-full text-sm bg-transparent rounded-lg border-2 appearance-none text-white border-gray-600 focus:border-blue-500 focus:outline-none focus:ring-0 peer" placeholder=" " autocomplete="off" />
                <label for="course-input" class="absolute text-sm text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] px-2 peer-focus:px-2 peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 bg-slate-900 peer-focus:-translate-y-4 left-1"> Curso </label> 
            </div>
            <div class="w-2/3 flex-1 relative">
                <input type="number" id="dni-input" name="dni" class="block px-2.5 pb-2.5 pt-4 w-full text-sm bg-transparent rounded-lg border-2 appearance-none text-white border-gray-600 focus:border-blue-500 focus:outline-none focus:ring-0 peer" placeholder=" " autocomplete="off" />
                <label for="dni-input" class="absolute text-sm text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] px-2 peer-focus:px-2 peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 bg-slate-900 peer-focus:-translate-y-4 left-1"> DNI </label> 
            </div>
            <div class="w-3/4 flex-1 relative">
                <input type="text" id="detail-input" name="details" class="block px-2.5 pb-2.5 pt-4 w-full text-sm bg-transparent rounded-lg border-2 appearance-none text-white border-gray-600 focus:border-blue-500 focus:outline-none focus:ring-0 peer" placeholder=" " autocomplete="off" />
                <label for="detail-input" class="absolute text-sm text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] px-2 peer-focus:px-2 peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 bg-slate-900 peer-focus:-translate-y-4 left-1"> Detalles </label> 
            </div>
            <input type="hidden" name="section" value="<?= $section ?>">
            <input type="hidden" name="element" value="<?= $element['id'] ?>">

            <button class="w-full py-2 hover:bg-indigo-500 font-semibold bg-indigo-700 rounded-md uppercase" type="submit"> Enviar </button>
        </form>
    </div>
</div>