<?php

/**
 * Description of Lista
 *
 * @author hegeltrigo
 */
class Card {

    public $title;
    public $description;
    public $end_date;
    public $list_id;
    public $archived;
    public $id;


    function getId() {
        return $this->id;
    }

    function setId($id) {
        $this->id = $id;
    }

    function getTitle() {
        return $this->title;
    }

    function setTitle($title) {
        $this->title = $title;
    }

    function getDescription() {
        return $this->description;
    }

    function setDescription($description) {
        $this->description = $description;
    }

    function getListId() {
        return $this->list_id;
    }

    function setListId($list_id) {
        $this->list_id = $list_id;
    }

    function getEndDate() {
        return $this->end_date;
    }

    function setEndDate($end_date) {
        $this->end_date = $end_date;
    }

    function getArchived() {
        return $this->archived;
    }

    function setArchived($archived) {
        $this->archived = $archived;
    }

    

}
