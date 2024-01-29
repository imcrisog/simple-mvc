<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title> Inveico </title>
</head>
<body style="width: 100%;">

    <?php $img = "data:image/png;base64," . base64_encode(file_get_contents("../public/img/eico.png")); ?>

    <div style="margin-bottom: 150px;">
        <img style="float: left;" height="85px" src="<?= $img ?>">
        <h1 style="float: right;"> Inveico (<?= $name ?>) </h1>
    </div>

    <table style="margin: auto" border="1">
        <thead>
            <tr> 
                <th style='padding: 10px 25px;'> ID </th> 
                <th style='padding: 10px 25px;'> Maquina-Herramienta </th> 
                <th style='padding: 10px 25px;'> Cantidad </th> 
                <th style='padding: 10px 25px;'> Fecha </th> 
                <th style='padding: 10px 25px;'> Caracteristicas </th> 
                <th style='padding: 10px 25px;'> Marca </th> 
                <th style='padding: 10px 25px;'> Estado </th> 
                <th style='padding: 10px 25px;'> Baja </th>
                <th style='padding: 10px 25px;'> Procedencia </th>
                <th style='padding: 10px 25px;'> Observaciones </th> 
                <?php if ($section['model'] != "") { ?>
                <?php foreach (json_decode($section['model']) as $model) { ?>
                <th style='padding: 10px 25px;'> <?= $model ?> </th>
                <?php } ?>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($elements as $key => $element) { ?>
        <tr style='text-align: center;'>;
            <td>  <?= $element['id'] ?> </td>
            <td>  <?= $element['name'] ?> </td>
            <td>  <?= $element['cantidad'] ?> </td>
            <td style='padding: 2px 7px'>  <?= $element['created_at'] ?> </td>
            <td>  <?= $element['caracteristicas'] ?> </td>
            <td>  <?= $element['marca'] ?> </td>
            <td>  <?= ($element['estado'] == 0 ? "Malo" : ($element['estado'] == 1 ? "Regular" : "Bueno")) ?> </td>
            <td></td>
            <td>  <?= $element['procedencia'] ?>  </td>
            <td style='padding: 2px 7px'>  <?= $element['observaciones'] ?> </td>
            <?php if ($section['model'] != "") { ?>
            <?php foreach (json_decode($section['model']) as $model) { ?>
            <td style='padding: 2px 7px'><?= json_decode($element['data'])->{$model} ?></td>
            <?php } ?>
            <?php } ?>
        </tr>
        <?php } ?>
        </tbody>
    </table>
        
</body>
</html>