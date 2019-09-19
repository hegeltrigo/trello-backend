<?php

class PersonaBLL {

    public function selectAll() {
        $listaPersonas = array();

        $objConexion = new Connection();
        $res = $objConexion->query("
            CALL sp_Persona_SelectAll()
        ");

        while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
            $persona = $this->rowToDto($row);
            $listaPersonas[] = $persona;
        }
        return $listaPersonas;
    }

    public function select($id) {
        $objConexion = new Connection();
        $res = $objConexion->queryWithParams("
            CALL sp_Persona_Select(:varId)
        ", array(
            ":varId" => $id
        ));
        if ($res->rowCount() == 0) {
            return null;
        }
        $row = $res->fetch(PDO::FETCH_ASSOC);
        $objPersona = $this->rowToDto($row);
        return $objPersona;
    }

    public function insert($nombres, $apellidos, $edad, $ciudad, $sexo, $fechaNacimiento) {
        $objConexion = new Connection();
        $res = $objConexion->queryWithParams("
            CALL sp_Persona_Insert(:varNombres, :varApellidos, :varEdad, :varCiudad, :varSexo, :varFechaNacimiento)
        ", array(
            ":varNombres" => $nombres,
            ":varApellidos" => $apellidos,
            ":varEdad" => $edad,
            ":varCiudad" => $ciudad,
            ":varSexo" => $sexo,
            ":varFechaNacimiento" => $fechaNacimiento
        ));
        if ($res->rowCount() == 0) {
            return null;
        }
        $row = $res->fetch(PDO::FETCH_ASSOC);
        return $row["ultimoId"];
    }

    public function update($nombres, $apellidos, $edad, $ciudad, $sexo, $fechaNacimiento, $id) {
        $objConexion = new Connection();
        $objConexion->queryWithParams("
            CALL sp_Persona_Update(:varNombres, :varApellidos, :varEdad, :varCiudad, :varSexo, :varFechaNacimiento, :varId)
        ", array(
            ":varNombres" => $nombres,
            ":varApellidos" => $apellidos,
            ":varEdad" => $edad,
            ":varCiudad" => $ciudad,
            ":varSexo" => $sexo,
            ":varFechaNacimiento" => $fechaNacimiento,
            ":varId" => $id
        ));
    }

    public function delete($id) {
        $objConexion = new Connection();
        $objConexion->queryWithParams("
            CALL sp_Persona_Delete(:varId)
        ", array(
            ":varId" => $id
        ));
    }

    public function rowToDto($row) {
        $objPersona = new Persona();
        $objPersona->setId($row["id"]);
        $objPersona->setNombres($row["nombres"]);
        $objPersona->setApellidos($row["apellidos"]);
        $objPersona->setEdad($row["edad"]);
        $objPersona->setFechaNacimiento($row["fechaNacimiento"]);
        $objPersona->setCiudad($row["ciudad"]);
        $objPersona->setSexo($row["sexo"]);
        return $objPersona;
    }

}

?>