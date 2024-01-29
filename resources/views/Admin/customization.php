<div class="md:flex my-8 justify-center items-center overflow-y-auto w-full md:w-3/4">
    <div class="w-full h-full flex flex-col text-center justify-center font-semibold items-center m-auto">
        <div class="bg-slate-900 p-6 rounded-md w-1/2">

            <h1 class="text-2xl font-bold"> Personalizar tu Seccion </h1>
    
            <form action="<?= LOCALHOST ?>/inventory/create/custom" method="post" class="repeater w-full">
                <h5 class="">
                    Añade las columnas que desees
                </h5>
                <div class="my-5">
                    <div data-repeater-list="columns" class="flex flex-col space-y-3">
                        <div data-repeater-item="1" class="flex items-center flex-row">
                            <div class="w-3/4 mx-auto flex text-center">
                                <div class="w-full relative">
                                    <input type="text" name="data" class="block px-2.5 pb-2.5 pt-4 w-full text-sm bg-transparent rounded-lg border-2 appearance-none text-white border-gray-600 focus:border-blue-500 focus:outline-none focus:ring-0 peer" placeholder="Nombre" autocomplete="off" />
                                </div>
                                <div class="my-auto mx-2">
                                    <a data-repeater-delete="" class="text-red-500 p-3 border-red-500 cursor-pointer hover:bg-red-500 ease hover:text-white transition duration-100 border rounded-md">
                                        <i class="fas fa-trash"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex space-x-4 items-center justify-center">
                    <div>
                        <div>
                            <a data-repeater-create="" class="cursor-pointer py-2 px-2 border-blue-500 hover:bg-blue-500 ease hover:text-white transition duration-100 border rounded-md">
                                <i class="la la-plus"></i>Añadir columna</a>
                        </div>
                    </div>
        
                    <input type="hidden" name="section" value="<?= $section['id'] ?>">
        
                    <button class="py-2 px-4 m-2 border-blue-500 hover:bg-blue-500 ease hover:text-white transition duration-100 border rounded-md" type="submit"> Enviar </button>
                </div>
            </form>
        </div>
    </div>
</div>