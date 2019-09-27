<?php

class CardBLL {

    public function selectAll() {
        $listaCard = array();

        $objConexion = new Connection();

        $res = $objConexion->query("
            SELECT id, title, description, end_date, list_id, archived
            FROM cards
        ");

        while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
            $cards = $this->rowToDto($row);
            $listaCards[] = $cards;
        }
        return $listaCards;
    }

    public function search($text) {
        $listaCards = array();

        $objConexion = new Connection();

        $res = $objConexion->queryWithParams("
            SELECT id, title, description, end_date, list_id, archived
            FROM cards
            WHERE title like :varText
        ", array(
            ":varText" => $text . '%'
        ));

        while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
            $cards = $this->rowToDto($row);
            $listaCards[] = $cards;
        }
        return $listaCards;
    }

    public function selectByListId($list_id) {
        $listaCards = array();

        $objConexion = new Connection();

        $res = $objConexion->queryWithParams("
            SELECT id, title, description, end_date, list_id, archived
            FROM cards
            WHERE list_id = :varListId  and archived = :varArchived
        ", array(
            ":varListId" => $list_id,
            ":varArchived" => 0
        ));

        while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
            $cards = $this->rowToDto($row);
            $listaCards[] = $cards;
        }
        return $listaCards;
    }

    public function select($id) {
        $objConexion = new Connection();
        $res = $objConexion->queryWithParams("
            SELECT id, title, description, end_date, list_id, archived
            FROM cards
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

    public function insert($title, $description, $end_date, $list_id, $archived) {
        $objConexion = new Connection();
        $objConexion->queryWithParams("
            INSERT INTO cards (title, description, end_date, list_id, archived)
            VALUES (:varTitle, :varDescription, :varEndDate, :varListId, :varArchived)
        ", array(
            ":varTitle" => $title,
            ":varDescription" => $description,
            ":varEndDate" => $end_date,
            ":varListId" => $list_id,
            ":varArchived" => $archived        
        ));
        return $objConexion->getLastInsertedId();
    }

    public function update($title, $description, $end_date, $list_id, $archived, $id) {
        $objConexion = new Connection();
        $objConexion->queryWithParams("
            UPDATE cards
            SET title = :varTitle,
                description = :varDescription,
                end_date = :varEndDate,
                list_id = :varListId,
                archived = :varArchived
            WHERE id = :varId
        ", array(
            ":varTitle" => $title,
            ":varDescription" => $description,
            ":varEndDate" => $end_date,
            ":varListId" => $list_id,
            ":varArchived" => $archived,
            ":varId" => $id,
        ));
    }

    public function move($list_id, $id) {
        $objConexion = new Connection();
        $objConexion->queryWithParams("
            UPDATE cards
            SET list_id = :varListId
            WHERE id = :varId
        ", array(
            ":varListId" => $list_id,
            ":varId" => $id,
        ));
    }

    public function delete($id) {
        $objConexion = new Connection();
        $objConexion->queryWithParams("
            DELETE FROM cards
            WHERE id = :varId
        ", array(
            ":varId" => $id
        ));
    }
    
    public function rowToDto($row) {
        $objCard = new Card();
        $objCard->setId($row["id"]);
        $objCard->setTitle($row["title"]);
        $objCard->setDescription($row["description"]);
        $objCard->setEndDate($row["end_date"]);
        $objCard->setListId($row["list_id"]);
        $objCard->setArchived($row["archived"]);

        return $objCard;
    }

}

?>