 <div class="bg-zinc-900 p-10 h-screen flex justify-center md:justify-end items-center text-white w-full">

    <div>
        <form class="w-full flex flex-wrap justify-center gap-4" action="<?= LOCALHOST ?>/register" method="post">
            <div class="w-full flex-1 relative md:my-6">
                <input type="text" id="username-input" name="username" class="block px-2.5 pb-2.5 pt-4 text-sm bg-transparent rounded-lg border-2 appearance-none text-white border-gray-600 focus:border-blue-500 focus:outline-none focus:ring-0 peer" placeholder=" " autocomplete="off" />
                <label for="username-input" class="absolute text-sm text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] px-2 peer-focus:px-2 peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 bg-zinc-900 peer-focus:-translate-y-4 left-1"> Username </label>
            </div>
            <div class="w-full flex-1 relative md:my-6">
                <input type="text" id="email-input" name="email" class="block px-2.5 pb-2.5 pt-4 text-sm bg-transparent rounded-lg border-2 appearance-none text-white border-gray-600 focus:border-blue-500 focus:outline-none focus:ring-0 peer" placeholder=" " autocomplete="off" />
                <label for="email-input" class="absolute text-sm text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] px-2 peer-focus:px-2 peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 bg-zinc-900 peer-focus:-translate-y-4 left-1"> Email </label>
            </div>
            <div class="w-full flex-1 relative md:my-6">
                <input type="number" id="dni-input" name="dni" class="block px-2.5 pb-2.5 pt-4 text-sm bg-transparent rounded-lg border-2 appearance-none text-white border-gray-600 focus:border-blue-500 focus:outline-none focus:ring-0 peer" placeholder=" " autocomplete="off" />
                <label for="dni-input" class="absolute text-sm text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] px-2 peer-focus:px-2 peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 bg-zinc-900 peer-focus:-translate-y-4 left-1"> DNI </label>
            </div>
            <div class="w-full flex-1 relative md:my-6">
                <input type="password" id="password-input" name="password" class="block px-2.5 pb-2.5 pt-4 text-sm bg-transparent rounded-lg border-2 appearance-none text-white border-gray-600 focus:border-blue-500 focus:outline-none focus:ring-0 peer" placeholder=" " autocomplete="off" />
                <label for="password-input" class="absolute text-sm text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] px-2 peer-focus:px-2 peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 bg-zinc-900 peer-focus:-translate-y-4 left-1"> Password </label>
            </div>
            <button class="w-full py-2 hover:bg-indigo-800 font-semibold bg-indigo-700 rounded-md uppercase" type="submit"> Enviar </button>
            <a class="text-indigo-500 underline underline-offset-2" href="<?= LOCALHOST ?>/login"> Login </a>
        </form>
    </div>

</div>