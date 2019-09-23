<?php

/**
 * Description of Lista
 *
 * @author hegeltrigo
 */
class Lista {

    public $id;
    public $name;
    public $description;
    public $cards = array();

    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function getDescription() {
        return $this->description;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setDescription($description) {
        $this->description = $description;
    }

    public function getCards() {
        return $this->cards;
    }

    function setCards($cards) {
        $this->cards = $cards;
    }

}
