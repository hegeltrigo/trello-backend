<?php

/**
 * Description of Telefono
 *
 * @author jmacb
 */
class Telefono {

    private $id;
    private $telefono;
    private $codPais;
    private $codCiudad;
    private $persona_id;

    function getId() {
        return $this->id;
    }

    function setId($id) {
        $this->id = $id;
    }

    function getTelefono() {
        return $this->telefono;
    }

    function getCodPais() {
        return $this->codPais;
    }

    function getCodCiudad() {
        return $this->codCiudad;
    }

    function getPersona_id() {
        return $this->persona_id;
    }

    function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    function setCodPais($codPais) {
        $this->codPais = $codPais;
    }

    function setCodCiudad($codCiudad) {
        $this->codCiudad = $codCiudad;
    }

    function setPersona_id($persona_id) {
        $this->persona_id = $persona_id;
    }
  function getPersonaForDisplay() {
        $personaBLL = new PersonaBLL();
        $objPersona = $personaBLL->select($this->persona_id);
        return $objPersona->getNombres() . " " . $objPersona->getApellidos();
    }
}
