<div class="md:w-3/4 select-none">
    <div class="w-full h-screen flex font-extrabold">
        <section class="m-auto p-4 flex justify-center items-center bg-slate-800 rounded-md flex-col">
            <div class="w-full mb-2 text-left">
                <span class="hover:underline">
                    <?php
                    if ( 0 != $turn) { 
                        echo "Buenas tardes"; 
                    }
                    else { 
                        echo "Buenos dias"; 
                    }?>
                </span>

            </div>
            <div class="w-full text-left">
                <span class=""> Hola <?= ucfirst($user['username']) ?> Tú eres, <?= ucfirst($role['name']) ?></span>
            </div>
            <div class="w-full text-left">
                <span>
                    Tu turno es <?= $turn ?>
                </span>
            </div>
        </section>
    </div>
</div>