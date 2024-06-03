<div class="w-full h-screen">
    <div class="flex w-full p-2 text-xl justify-left">
        <div class="flex w-fit my-auto text-center items-center gap-x-1 font-extrabold ">
            <img class="w-[2.5rem]" src="<?= LOCALHOST ?>/img/eico.png" alt="EICO N°1">
            <span>INVEICO</span>
        </div>
        <div class="flex px-8 items-center text-center flex-row font-medium gap-x-2 [&>*]:rounded-full [&>*]:p-2 [&>*]:px-4 [&>*]:duration-300">
            <!-- REGISTER FOR DEVELOPER ENVIROMENT ONLY -->
            <div class="hover:bg-slate-800 transform">
                <a href="<?= LOCALHOST ?>/register">Register</a>
            </div>
            <div class="hover:bg-slate-800 transform">
                <a href="<?= LOCALHOST ?>/login">Login</a>
            </div>
            <div class="hover:bg-slate-800 transform">
                <a href="<?= LOCALHOST ?>/profile">Profile</a>
            </div>
        </div>
    </div>  
</div>


<!--
<?php if (count($users) > 0) { ?>
<table border="1">
    <thead>
        <th> ID </th>
        <th> Username </th>
        <th> Email </th>
        <th> Password </th>
        <th> Rol </th>
    </thead>
    <tbody>
        <?php foreach ($users as $key => $user) { ?>
        <tr>
            <td> <?= strip_tags($user['id']) ?> </td>
            <td> <?= strip_tags($user['username']) ?> </td>
            <td> <?= strip_tags($user['email']) ?> </td>
            <td> <?= strip_tags($user['password']) ?> </td>
            <td> <?= strip_tags($user['role']) ?> </td>
        </tr>
        <?php } ?>
    </tbody>
</table>
<?php } else { ?>
<h1> No hay usuarios </h1>
<?php } ?>
-->