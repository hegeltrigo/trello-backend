<?php

include_once './data/DAL/Conexion.php';
include_once './data/BLL/PersonaBLL.php';
include_once './data/DTO/Persona.php';

$personaBLL = new PersonaBLL();
$task = $_REQUEST["task"];
switch ($task) {
    case "insert":
        if (isset($_REQUEST["nombres"]) && isset($_REQUEST["apellidos"]) && isset($_REQUEST["ciudad"]) && isset($_REQUEST["edad"]) && isset($_REQUEST["fechaNacimiento"]) && isset($_REQUEST["sexo"])) {
            $nombres = $_REQUEST["nombres"];
            $apellidos = $_REQUEST["apellidos"];
            $ciudad = $_REQUEST["ciudad"];
            $edad = $_REQUEST["edad"];
            $fechaNacimiento = $_REQUEST["fechaNacimiento"];
            $sexo = $_REQUEST["sexo"];

            try {
                $id = $personaBLL->insert($nombres, $apellidos, $edad, $ciudad, $sexo, $fechaNacimiento);
//                echo $id;
                $objPersonaInsertada = $personaBLL->select($id);

                echo json_encode($objPersonaInsertada);
            } catch (Exception $exc) {
                echo $exc->getTraceAsString();
            }
        }
        break;
    case "get":
        if (isset($_REQUEST["id"])) {
            $id = $_REQUEST["id"];
            $objPersona = $personaBLL->select($id);
            echo json_encode($objPersona);
        }
        break;
    case "update":
        if (isset($_REQUEST["nombres"]) && isset($_REQUEST["apellidos"]) && isset($_REQUEST["ciudad"]) && isset($_REQUEST["edad"]) && isset($_REQUEST["fechaNacimiento"]) && isset($_REQUEST["sexo"]) && isset($_REQUEST["id"])) {
            $nombres = $_REQUEST["nombres"];
            $apellidos = $_REQUEST["apellidos"];
            $ciudad = $_REQUEST["ciudad"];
            $edad = $_REQUEST["edad"];
            $fechaNacimiento = $_REQUEST["fechaNacimiento"];
            $sexo = $_REQUEST["sexo"];
            $id = $_REQUEST["id"];

            $personaBLL->update($nombres, $apellidos, $edad, $ciudad, $sexo, $fechaNacimiento, $id);
            $objPersona = $personaBLL->select($id);
            echo json_encode($objPersona);
        }
        break;
    case "delete":
        if (isset($_REQUEST["id"])) {
            $id = $_REQUEST["id"];
            $personaBLL->delete($id);
            echo $id;
        }
        break;
}
