<?php

session_start();
include("connection_db.php");

// -------------------------------------------Función para validar inicio de sesión
function vali_login($c, $e = 0) {
    global $conexion;

    $permitir = '/^[A-Z a-z 0-9 . _ -]{1,30}$/i'; // exp reg que define tipo de entrada y tamaño
    foreach ($c as $k) {
        if ((preg_match($permitir, $_POST[$k]) == true) AND ( (!isset($_POST[$k])) OR ( !empty($_POST[$k])))) {
            //return false; // Campo permitido
            $_POST[$k] = trim(filter_input(INPUT_POST, $k));  // elimina espacios al inicio y final
            $_POST[$k] = mysqli_real_escape_string($conexion, filter_input(INPUT_POST, $k)); // escapa carcateres especiales
            $e = $e + 1;
        } else {
            return true; // uno de los caracteres no corresponde a la expresión
        }
    }
//    return $e;
}

// -------------------------------------------Función para validar inicio de sesión
// -------------------------------------------Función para validar que los campos no queden vacios
function novacio($c, $e = 0) {
    global $conexion;
    
    foreach ($c as $k) {
        if (!isset($_POST[$k]) OR ! empty($_POST[$k])) {
            //return false; // Campo permitido
            $_POST[$k] = trim($_POST[$k]);  // elimina espacios al inicio y final
            $_POST[$k] = mysqli_real_escape_string($conexion, $_POST[$k]); // escapa carcateres especiales
            $e = $e + 1;
        } else {
            return true; // uno de los caracteres no corresponde a la expresión
        }
    }
}

// -------------------------------------------Función para validar campos numericos del 1 al 9
// -------------------------------------------Función para validar campos numericos del 1 al 9
function solonumeros($c, $e = 0) {
    global $conexion;
    
    $permitir = '/^[0-9]{1,30}$/i'; // exp reg que permite solo numeros del 0 al 9
    foreach ($c as $k) {
        if ((preg_match($permitir, $_POST[$k]) == true) AND ( (!isset($_POST[$k])) OR ( !empty($_POST[$k])))) {
            //return false; // Campo permitido
            $_POST[$k] = trim($_POST[$k]);  // elimina espacios al inicio y final
            $_POST[$k] = mysqli_real_escape_string($conexion, $_POST[$k]); // escapa carcateres especiales
            $e = $e + 1;
        } else {
            return true; // uno de los caracteres no corresponde a la expresión
        }
    }
}

// -------------------------------------------Función para validar campos numericos del 1 al 9
// -------------------------------------------Función para validar campos letras
function sololetras($c, $e = 0) {
    global $conexion;
    
    $permitir = '/^[a-z A-Z]*$/i'; // exp reg que define permite cualquier letra mayuscula o minuscula
    foreach ($c as $k) {
        if ((preg_match($permitir, $_POST[$k]) == true) AND ( (!isset($_POST[$k])) OR ( !empty($_POST[$k])))) {
            //return false; // Campo permitido
            $_POST[$k] = trim($_POST[$k]);  // elimina espacios al inicio y final
            $_POST[$k] = mysqli_real_escape_string($conexion, $_POST[$k]); // escapa carcateres especiales
            $e = $e + 1;
        } else {
            return true; // uno de los caracteres no corresponde a la expresión
        }
    }
}

// -------------------------------------------Función para validar campos letras
?>