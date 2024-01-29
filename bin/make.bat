@echo off

set thing=%1
set name=%2
if defined thing (
    if "%thing%" == "controller" (
        if defined name (
            (
                echo ^<?php
                echo:
                echo namespace App\Controllers;
                echo:
                echo class %name%Controller extends Controller {
                echo:
                echo:
                echo:
                echo }
            ) > app/controllers/%name%Controller.php
        ) else (
            echo Debes introducir un nombre al %thing%
        )
    ) else (
        echo Debes introducir un objeto Controlador/Modelo/Vista
    )
)else (
    echo Debes introducir un objeto Controlador/Modelo/Vista
)