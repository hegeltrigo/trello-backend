<?php


include_once './data/DAL/Conexion.php';

include_once './data/BLL/CardBLL.php';
include_once './data/DTO/Card.php';



class ListaBLL {

    public function selectAll() {
        $listaListas = array();

        $objConexion = new Connection();

        $res = $objConexion->query("
            SELECT id, name, description
            FROM lists
        ");

        while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
            $cardBLL = new CardBLL();
            $cards = $cardBLL->selectByListId($row["id"]);
            $lista = $this->rowToDto($row, $cards);
            $listaListas[] = $lista;
        }

        return $listaListas;
    }

    public function select($id) {
        $objConexion = new Connection();
        $res = $objConexion->queryWithParams("
            SELECT id, name, description
            FROM lists
            WHERE id = :varId
        ", array(
            ":varId" => $id
        ));
        if ($res->rowCount() == 0) {
            return null;
        }
        $row = $res->fetch(PDO::FETCH_ASSOC);
        $objLista = $this->rowToDto($row);
        return $objLista;
    }

    public function insert($name, $description) {
        $objConexion = new Connection();
        $objConexion->queryWithParams("
            INSERT INTO lists (name, description)
            VALUES (:varName, :varDescription)
        ", array(
            ":varName" => $name,
            ":varDescription" => $description         
        ));
        return $objConexion->getLastInsertedId();
    }

    public function update($name, $description, $id) {
        $objConexion = new Connection();
        $objConexion->queryWithParams("
            UPDATE lists
            SET name = :varName,
                description = :varDescription
            WHERE id = :varId
        ", array(
            ":varName" => $name,
            ":varDescription" => $description,
            ":varId" => $id
        ));
    }

    public function delete($id) {
        $objConexion = new Connection();
        $objConexion->queryWithParams("
            DELETE FROM lists
            WHERE id = :varId
        ", array(
            ":varId" => $id
        ));
    }
    
    public function rowToDto($row, $cards) {
        $objLista = new Lista();
        $objLista->setId($row["id"]);
        $objLista->setName($row["name"]);
        $objLista->setDescription($row["description"]);
        $objLista->setCards($cards);
        return $objLista;
    }

}

?>