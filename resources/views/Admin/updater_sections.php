<div class="w-3/4 flex justify-center items-center">
    <div class="w-1/2">
        <h2 class="my-6 flex justify-center text-xl font-bold"> Ingrese el Nombre de la Seccion </h2>

        <form class="w-full justify-center space-y-4 items-center flex flex-col" action="<?= LOCALHOST ?>/inventory/update/<?= $section['id'] ?>/section" method="post">
            <div class="w-full flex-1 relative">
                <input type="text" id="name-input" name="name" class="block px-2.5 pb-2.5 pt-4 w-full text-sm bg-transparent rounded-lg border-2 appearance-none text-white border-gray-600 focus:border-blue-500 focus:outline-none focus:ring-0 peer" placeholder="<?= $section['name'] ?> " autocomplete="on" />
                <!-- <label for="name-input" class="absolute text-sm text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] px-2 peer-focus:px-2 peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 bg-slate-950 peer-focus:-translate-y-4 left-1"> Nombre </label>  -->
            </div>
            <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="user">
            <option selected value="<?= array_filter($users, fn ($u) => $u['id'] === $section['user_id'])[0]['id'] ?>"><?= array_filter($users, fn ($u) => $u['id'] === $section['user_id'])[1]['username'] ?></option>
                <?php foreach ($users as $key => $user) { ?>
                    <?php if ($user['id'] != $section['user_id'] && $role['role_id'] == 2) { ?>
                    <option class="py-2 px-2 text-center" value="<?= $user['id'] ?>"> <?= $user['username'] ?> </option>
                    <?php } ?>
                <?php } ?>
            </select>
            <button class="w-full py-2 hover:bg-indigo-800 font-semibold bg-indigo-700 rounded-md uppercase" type="submit"> Enviar </button>
        </form>
    </div>
</div>