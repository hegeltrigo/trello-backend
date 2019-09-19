<?php

/**
 * Description of Persona
 *
 * @author jmacb
 */
class Persona {

    public $id;
    public $nombres;
    public $apellidos;
    public $edad;
    public $ciudad;
    public $sexo;
    public $fechaNacimiento;

    function getId() {
        return $this->id;
    }

    function getNombres() {
        return $this->nombres;
    }

    function getApellidos() {
        return $this->apellidos;
    }

    function getEdad() {
        return $this->edad;
    }

    function getCiudad() {
        return $this->ciudad;
    }

    function getSexo() {
        return $this->sexo;
    }

    function getSexoForDisplay() {
        if ($this->sexo == 0) {
            return "Masculino";
        } else {
            return "Femenino";
        }
    }

  

    function getFechaNacimiento() {
        return $this->fechaNacimiento;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNombres($nombres) {
        $this->nombres = $nombres;
    }

    function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
    }

    function setEdad($edad) {
        $this->edad = $edad;
    }

    function setCiudad($ciudad) {
        $this->ciudad = $ciudad;
    }

    function setSexo($sexo) {
        $this->sexo = $sexo;
    }

    function setFechaNacimiento($fechaNacimiento) {
        $this->fechaNacimiento = $fechaNacimiento;
    }

}
