<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

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
    case "insert_card":
    
        if (isset($_REQUEST["title"]) && isset($_REQUEST["description"]) && isset($_REQUEST["end_date"]) && isset($_REQUEST["list_id"]) && isset($_REQUEST["archived"]) ) {
            $title = $_REQUEST["title"];
            $description = $_REQUEST["description"];    
            $end_date = $_REQUEST["end_date"];  
            $list_id = $_REQUEST["list_id"];  
            $archived = $_REQUEST["archived"];  

  
            try {
                $id = $cardBLL->insert($title, $description, $end_date, $list_id, $archived);
                $objCardInsertada = $cardBLL->select($id);
                
                echo json_encode($objCardInsertada);
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
    case "search":
        $text = $_REQUEST["search"];
        $cards = $cardBLL->search($text);
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
    case "get_card":
        if (isset($_REQUEST["id"])) {
            $id = $_REQUEST["id"];
            try{
                $objCard = $cardBLL->select($id);
                if($objCard == NULL){
                    echo json_encode("no existe lista con id ". $id ."");  
                }
                else{
                    echo json_encode($objCard);    
                }
            } catch (Exception $exc) {
                echo $exc->getTraceAsString();
            }
            
        }
        else{
            echo json_encode("No existe id en los paramentros");
        }
        break;  
    case "update_card":

        if (isset($_REQUEST["title"]) && isset($_REQUEST["description"]) && isset($_REQUEST["end_date"]) && isset($_REQUEST["archived"]) && isset($_REQUEST["list_id"])) 
        {
            $title = $_REQUEST["title"];
            $description = $_REQUEST["description"];
            $end_date = $_REQUEST["end_date"];
            $list_id = $_REQUEST["list_id"];
            $archived = $_REQUEST["archived"];
            $id = $_REQUEST["id"];

            try{
                $card = $cardBLL->update($title, $description, $end_date, $list_id, $archived, $id);
                $objcardModificada = $cardBLL->select($id);
                echo json_encode($objcardModificada);
            }catch(Exception $e){
                echo $e;
            }
        }
        else{
            echo "que pacho";
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

    case "move":

        if (isset($_REQUEST["list_id"]) && isset($_REQUEST["id"])) 
        {
            $list_id = $_REQUEST["list_id"];
            $id = $_REQUEST["id"];
            try{
                $card = $cardBLL->move($list_id, $id);
                $objCardModificada = $cardBLL->select($id);
                echo json_encode($objCardModificada);
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
    case "delete_card":
        if (isset($_REQUEST["id"])) {
            $id = $_REQUEST["id"];
            $cardBLL->delete($id);
            echo $id;
        }
        else{
            echo json_encode("que pacho");
        }
        break;
}
