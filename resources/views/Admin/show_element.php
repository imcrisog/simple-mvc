<div class="m-10 space-y-6 md:w-full flex justify-center items-center">
    <div class="w-1/3">
        <div class="bg-gray-900 rounded-md font-bold h-auto w-auto">
            
            <div class="px-8 py-5 relative text-lg">
                <span class="justify-start text-xl mx-2"><?= $element['name']?> ID: <?= $element['id']?></span>
                <div class="m-5">
                    <?php if ($user['id'] == 1) {?>
                        <a class="m-2 text-white p-2.5 border-gray-500 hover:bg-gray-400 ease hover:text-white transition duration-100 border absolute rounded-md flex right-0 top-0 w-9" href="<?= LOCALHOST ?>/inventory/<?= $section['id']?>/elements"><i class="fas fa-sign-out-alt"></i></a> 
                    <?php } else {?>
                        <a class="m-2 text-white p-2.5 border-gray-500 hover:bg-gray-400 ease hover:text-white transition duration-100 border absolute rounded-md flex right-0 top-0 w-9" href="<?= LOCALHOST ?>/inventory/elements"><i class="fas fa-sign-out-alt"></i></a> 
                    <?php }?>
                </div>
                <div class="p-2 w-full h-auto flex flex-col text-center items-center border-white">
                    <span>Marca: <?= $element['marca']?></span>
                    <span>Cantidad: <?= $element['cantidad']?></span>
                    <span>Fecha de Adición: [ <?= substr($element['added_at'], 0, 10)?> ]</span>
                    <span>Creado: [ <?= substr($element['created_at'], 0, 10)?> ] </span>
                    <span>Actualizado: [ <?= substr($element['updated_at'], 0, 10) ?> ]</span>
                    <span> Supervisor a Cargo: <p class="font-extrabold"><?= $supervisor['username'] ?></p> </span>
                </div>
                <div class="text-center">
                    <span>
                        Codigo de barras del elemento
                    </span>
                </div>
            </div>
            <div class="bg-white flex justify-center py-3">
                <?php
                    $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
                    $code = str_pad($element["id"], 6, '0', STR_PAD_LEFT);
                ?>
        
                <img src="data:image/png;base64,<?php echo base64_encode($generator->getBarcode($code, $generator::TYPE_CODE_128)); ?>">        
            </div>
        </div>
    </div>
</div>