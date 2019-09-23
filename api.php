<?php

include_once './data/DAL/Conexion.php';
include_once './data/BLL/ListaBLL.php';
include_once './data/DTO/Lista.php';

include_once './data/BLL/CardBLL.php';
include_once './data/DTO/Card.php';


$listaBLL = new ListaBLL();
$cardBLL = new CardBLL();

$task = $_REQUEST["task"];

switch ($task) {
    case "insert":
    
        if (isset($_REQUEST["name"]) && isset($_REQUEST["description"])) {
            $name = $_REQUEST["name"];
            $description = $_REQUEST["description"];      
            try {
                $id = $listaBLL->insert($name, $description);
                $objListaInsertada = $listaBLL->select($id);
                
                echo json_encode($objListaInsertada);
            } catch (Exception $exc) {
                echo $exc->getTraceAsString();
            }
        }
        else{
            echo "Hubo un error";
        }

        break;
    case "get_all":
        $listas = $listaBLL->selectAll();
        echo json_encode($listas);

        break;
    case "get_all_cards":
        $cards = $cardBLL->selectAll();
        echo json_encode($cards);
        break;    
    case "get":
        if (isset($_REQUEST["id"])) {
            $id = $_REQUEST["id"];
            try{
                $objLista = $listaBLL->select($id);
                if($objLista == NULL){
                    echo json_encode("no existe lista con id ". $id ."");  
                }
                else{
                    echo json_encode($objLista);    
                }
            } catch (Exception $exc) {
                echo $exc->getTraceAsString();
            }
            
        }
        else{
            echo json_encode("No existe id en los paramentros");
        }
        break;

    case "update":

        if (isset($_REQUEST["name"]) && isset($_REQUEST["description"]) && isset($_REQUEST["id"])) 
        {
            $name = $_REQUEST["name"];
            $description = $_REQUEST["description"];
            $id = $_REQUEST["id"];

            try{
                $lista = $listaBLL->update($name, $description, $id);
                $objListaModificada = $listaBLL->select($id);
                echo json_encode($objListaModificada);
            }catch(Exception $e){
                echo $e;
            }
        }
        else{
            echo "que pacho";
        }
        break;
    case "delete":
        if (isset($_REQUEST["id"])) {
            $id = $_REQUEST["id"];
            $listaBLL->delete($id);
            echo $id;
        }
        else{
            echo json_encode("que pacho");
        }
        break;
}
