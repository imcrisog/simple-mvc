<?php
    error_reporting(E_ERROR | E_WARNING | E_PARSE);  
    session_start(); 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?= isset($title) ? $title : 'Pagina' ?> </title>
    <!-- <script src="https://cdn.tailwindcss.com/"></script> --> 
    <link href="<?= LOCALHOST ?>/css/index.css?<?= time() ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <link href="<?= LOCALHOST ?>/css/style.bundle.css?v=<?= time() ?>" rel="stylesheet" type="text/css" />
    <link href="<?= LOCALHOST ?>/css/custom.css?v=<?= time() ?>" rel="stylesheet" type="text/css" />
    <script src="<?= LOCALHOST ?>/js/fontsicons.js" crossorigin="anonymous"></script>
    <script defer src="<?= LOCALHOST ?>/js/alpinejs.js"></script>
</head>
<body class="bg-gray-950 w-full text-white">

    <div class="flex justify-center">
        <?php if (isset($_SESSION["msg"])) { ?>
            <div x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-90" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" class="bg-gray-900 fixed z-50 w-1/2 top-5 mt-5 flex p-4 <?= $_SESSION["msg"][1] == "s" ? "border-green-800 text-green-400" : ($_SESSION["msg"][1] == "w" ? "border-yellow-800 text-yellow-400" : "border-red-800 text-red-400") ?> border-t-4" role="alert">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                <div class="ml-3 text-sm font-bold">
                    <?= $_SESSION["msg"][0] ?>
                </div>
            </div>
        <?php unset($_SESSION['msg']); } ?>
    </div>

    <div class="flex">

        <?php if (isset($GLOBALS['user'])) { ?>
            <aside class="hidden sticky top-0 bottom-0 w-72 md:block rounded-r-md overflow-y-auto bg-slate-900 h-screen">
            <div class="flex flex-col justify-between mx-2 my-4">
                <span class="uppercase my-6 text-center font-bold text-white">Inveico</span>

                <?php if ($GLOBALS['role']['id'] == 1) { ?>
                <div class="space-y-3 mb-8">
                    <label class="px-2 uppercase text-sm font-bold text-indigo-400"> administrador </label>

                    <a class="group flex items-center rounded-md py-2 px-2 hover:bg-slate-950" href="<?= LOCALHOST ?>/inventory/sections">
                        <svg class="text-indigo-500" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <polygon points="0 0 24 0 24 24 0 24" />
                                <path class="fill-gray-200 group-hover:fill-indigo-500 font-bold "
                                    d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z"
                                    fill="#000000" fill-rule="nonzero" />
                                <path class="fill-gray-200 group-hover:fill-indigo-500"
                                    d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z"
                                    fill="#000000" opacity="0.3" />
                            </g>
                        </svg>

                        <span class="mx-2 text-sm font-bold "> Secciones </span>
                    </a>

                    <a class="group flex items-center rounded-md py-2 px-2 hover:bg-slate-950" href="<?= LOCALHOST ?>/inventory/users">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                            viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24" />
                                <rect class="fill-gray-200 group-hover:fill-indigo-500 font-bold " fill="#000000" x="4" y="4" width="7"
                                    height="7" rx="1.5" />
                                <path class="fill-gray-200 group-hover:fill-indigo-500 font-bold "
                                    d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z"
                                    fill="#000000" opacity="0.3" />
                            </g>
                        </svg>

                        <span class="mx-2 text-sm font-bold "> Usuarios </span>
                    </a>
                </div>
                <?php } ?>

                <?php if ($GLOBALS['role']['id'] == 2) { ?>
                <div class="space-y-3 my-8">
                    <label class="px-2 uppercase text-sm font-bold  text-indigo-400"> supervisor </label>

                    <a class="group flex items-center rounded-md py-2 px-2 hover:bg-slate-950" href="<?= LOCALHOST ?>/inventory/elements">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                            viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24" />
                                <rect class="fill-gray-200 group-hover:fill-indigo-500 font-bold " fill="#000000" x="4" y="4" width="7"
                                    height="7" rx="1.5" />
                                <path class="fill-gray-200 group-hover:fill-indigo-500 font-bold "
                                    d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z"
                                    fill="#000000" opacity="0.3" />
                            </g>
                        </svg>

                        <span class="mx-2 text-sm font-bold "> Elementos </span>
                    </a>
                </div>
                <?php } ?>

                <?php if ($GLOBALS['role']['id'] == 3) { ?>
                <div class="space-y-3 mb-8">
                    <label class="px-2 uppercase text-sm font-bold  text-indigo-400"> prestamista </label>

                    <a class="group flex items-center rounded-md py-2 px-2 hover:bg-slate-950" href="<?= LOCALHOST ?>/inventory/leandings">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                            viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24" />
                                <rect class="fill-gray-200 group-hover:fill-indigo-500 font-bold " fill="#000000" x="4" y="4" width="7"
                                    height="7" rx="1.5" />
                                <path class="fill-gray-200 group-hover:fill-indigo-500 font-bold "
                                    d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z"
                                    fill="#000000" opacity="0.3" />
                            </g>
                        </svg>

                        <span class="mx-2 text-sm font-bold "> Prestamos </span>
                    </a>
                </div>
                <?php } ?>

                <div class="space-y-3 mb-8">
                    <label class="px-2 uppercase text-sm font-bold  text-indigo-400"> Sitio </label>

                    <a class="group flex items-center rounded-md py-2 px-2 hover:bg-slate-950" href="<?= LOCALHOST ?>/password">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                            viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24" />
                                <rect class="fill-gray-200 group-hover:fill-indigo-500 font-bold " fill="#000000" x="4" y="4" width="7"
                                    height="7" rx="1.5" />
                                <path class="fill-gray-200 group-hover:fill-indigo-500 font-bold "
                                    d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z"
                                    fill="#000000" opacity="0.3" />
                            </g>
                        </svg>

                        <span class="mx-2 text-sm font-bold "> Contraseña </span>
                    </a>

                    <a class="group flex items-center rounded-md py-2 px-2 hover:bg-slate-950" href="<?= LOCALHOST ?>/logout">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                            viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24" />
                                <rect class="fill-gray-200 group-hover:fill-indigo-500 font-bold " fill="#000000" x="4" y="4" width="7"
                                    height="7" rx="1.5" />
                                <path class="fill-gray-200 group-hover:fill-indigo-500 font-bold "
                                    d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z"
                                    fill="#000000" opacity="0.3" />
                            </g>
                        </svg>

                        <span class="mx-2 text-sm font-bold "> Cerrar Sesion </span>
                    </a>
                </div>

                <!--
                <div class="space-y-3">
                    <label class="px-2 uppercase text-sm font-bold  text-indigo-400"> etc </label>

                    <a class="group flex items-center rounded-md py-2 px-2 hover:bg-slate-950" href="">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink"
                            width="24px" height="24px"
                            viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1"
                                fill="none" fill-rule="evenodd">
                                <rect x="0" y="0"
                                    width="24" height="24" />
                                <path class="fill-gray-200 group-hover:fill-indigo-500 font-bold "
                                    d="M5,5 L5,15 C5,15.5948613 5.25970314,16.1290656 5.6719139,16.4954176 C5.71978107,16.5379595 5.76682388,16.5788906 5.81365532,16.6178662 C5.82524933,16.6294602 15,7.45470952 15,7.45470952 C15,6.9962515 15,6.17801499 15,5 L5,5 Z M5,3 L15,3 C16.1045695,3 17,3.8954305 17,5 L17,15 C17,17.209139 15.209139,19 13,19 L7,19 C4.790861,19 3,17.209139 3,15 L3,5 C3,3.8954305 3.8954305,3 5,3 Z"
                                    fill="#000000" fill-rule="nonzero"
                                    transform="translate(10.000000, 11.000000) rotate(-315.000000) translate(-10.000000, -11.000000)" />
                                <path class="fill-gray-200 group-hover:fill-indigo-500 font-bold "
                                    d="M20,22 C21.6568542,22 23,20.6568542 23,19 C23,17.8954305 22,16.2287638 20,14 C18,16.2287638 17,17.8954305 17,19 C17,20.6568542 18.3431458,22 20,22 Z"
                                    fill="#000000" opacity="0.3" />
                            </g>
                        </svg>

                        <span class="mx-2 text-sm font-bold "> Reportes </span>
                    </a>

                    <a class="group flex items-center rounded-md py-2 px-2 hover:bg-slate-950" href="">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                            viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24" />
                                <rect class="fill-gray-200 group-hover:fill-indigo-500 font-bold " fill="#000000" x="4" y="4" width="7"
                                    height="7" rx="1.5" />
                                <path class="fill-gray-200 group-hover:fill-indigo-500 font-bold "
                                    d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z"
                                    fill="#000000" opacity="0.3" />
                            </g>
                        </svg>

                        <span class="mx-2 text-sm font-bold "> Plataforma </span>
                    </a>
                </div>
            </div>
            -->

            <div class="bottom-2 flex bg-slate-950 py-3 sticky w-full justify-center items-center space-x-3">
                <span class="px-4 py-2 bg-zinc-700 text-center rounded-md"><?= $GLOBALS['user']['username'][0] ?></span>
                <span class="font-bold "><?= ucfirst($GLOBALS['role']['name']) ?></span>
            </div>
        </aside>
        <?php } ?>

        <?php include($child) ?>
    </div>

    <script src="<?= LOCALHOST ?>/js/plugins/plugins.bundle.js"></script>
    <script src="<?= LOCALHOST ?>/js/scripts.bundle.js"></script>
    <script src="<?= LOCALHOST ?>/js/datatable/datatables.bundle.js?v=<?= time() ?>"></script>
    <script src="<?= LOCALHOST ?>/js/datatable/basic.js?v=<?= time() ?>"></script>
    <script src="<?= LOCALHOST ?>/js/app.js"></script>
</body>
</html>