<div class="p-10 h-screen flex justify-center items-center text-white w-3/4">

    <div>
        <form class="w-full flex flex-wrap justify-center gap-4" action="<?= LOCALHOST ?>/password" method="post">
            <div class="w-full flex-1 relative">
                <input type="password" id="opassword-input" name="opassword" class="block px-2.5 pb-2.5 pt-4 text-sm bg-transparent rounded-lg border-2 appearance-none text-white border-gray-600 focus:border-blue-500 focus:outline-none focus:ring-0 peer" placeholder=" " autocomplete="off" />
                <label for="opassword-input" class="absolute text-sm text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] px-2 peer-focus:px-2 peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 bg-slate-950 peer-focus:-translate-y-4 left-1"> Antigua Contraseña </label>
            </div>
            <div class="w-full flex-1 relative">
                <input type="password" id="password-input" name="newpassword" class="block px-2.5 pb-2.5 pt-4 text-sm bg-transparent rounded-lg border-2 appearance-none text-white border-gray-600 focus:border-blue-500 focus:outline-none focus:ring-0 peer" placeholder=" " autocomplete="off" />
                <label for="password-input" class="absolute text-sm text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] px-2 peer-focus:px-2 peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 bg-slate-950 peer-focus:-translate-y-4 left-1"> Nueva Contraseña </label>
            </div>
            <button class="w-full py-2 hover:bg-indigo-800 font-semibold bg-indigo-700 rounded-md uppercase" type="submit"> CAMBIAR </button>
            
            <a class="text-indigo-500 underline underline-offset-2" href="<?= LOCALHOST ?>/profile"> Cancelar </a>
        </form>
    </div>

</div>