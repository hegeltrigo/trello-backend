<?php

class TelefonoBLL {

    public function selectAll() {
        $listaTelefonos = array();

        $objConexion = new Connection();
        $res = $objConexion->query("
            CALL sp_Telefono_SelectAll()
        ");

        while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
            $persona = $this->rowToDto($row);
            $listaTelefonos[] = $persona;
        }
        return $listaTelefonos;
    }

    public function select($id) {
        $objConexion = new Connection();
        $res = $objConexion->queryWithParams("
            CALL sp_Telefono_Select(:varId)
        ", array(
            ":varId" => $id
        ));
        if ($res->rowCount() == 0) {
            return null;
        }
        $row = $res->fetch(PDO::FETCH_ASSOC);
        $objTelefono = $this->rowToDto($row);
        return $objTelefono;
    }

    public function insert($telefono, $codPais, $codCiudad, $persona_id) {
        $objConexion = new Connection();
        $res = $objConexion->queryWithParams("
            CALL sp_Telefono_Insert(:varTelefono, :varCodPais, :varCodCiudad, :varPersona_id)
        ", array(
            ":varTelefono" => $telefono,
            ":varCodPais" => $codPais,
            ":varCodCiudad" => $codCiudad,
            ":varPersona_id" => $persona_id
        ));
        if ($res->rowCount() == 0) {
            return null;
        }
        $row = $res->fetch(PDO::FETCH_ASSOC);
        return $row["ultimoId"];
    }

    public function update($telefono, $codPais, $codCiudad, $persona_id, $id) {
        $objConexion = new Connection();
        $objConexion->queryWithParams("
            CALL sp_Telefono_Update(:varTelefono, :varCodPais, :varCodCiudad, :varPersona_id, :varId)
        ", array(
            ":varTelefono" => $telefono,
            ":varCodPais" => $codPais,
            ":varCodCiudad" => $codCiudad,
            ":varPersona_id" => $persona_id,
            ":varId" => $id
        ));
    }

    public function delete($id) {
        $objConexion = new Connection();
        $objConexion->queryWithParams("
            CALL sp_Telefono_Delete(:varId)
        ", array(
            ":varId" => $id
        ));
    }

    public function rowToDto($row) {
        $objTelefono = new Telefono();
        $objTelefono->setId($row["id"]);
        $objTelefono->setTelefono($row["telefono"]);
        $objTelefono->setCodPais($row["codPais"]);
        $objTelefono->setCodCiudad($row["codCiudad"]);
        $objTelefono->setPersona_id($row["persona_id"]);
        return $objTelefono;
    }

}

?>