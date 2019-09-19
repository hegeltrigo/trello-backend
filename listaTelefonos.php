
<?php
include_once './header.php';
include_once './data/DAL/Conexion.php';
include_once './data/BLL/TelefonoBLL.php';
include_once './data/DTO/Telefono.php';
include_once './data/BLL/PersonaBLL.php';
include_once './data/DTO/Persona.php';

$personaBLL = new TelefonoBLL();
$task = "";
if(isset($_REQUEST["task"])){
    $task = $_REQUEST["task"];
}
switch ($task) {
    case "insertar":
        if (isset($_REQUEST["telefono"]) && isset($_REQUEST["codPais"]) && isset($_REQUEST["codCiudad"]) && isset($_REQUEST["persona_id"])) {
            $telefono = $_REQUEST["telefono"];
            $codPais = $_REQUEST["codPais"];
            $codCiudad = $_REQUEST["codCiudad"];
            $persona_id = $_REQUEST["persona_id"];

            $personaBLL->insert($telefono, $codPais, $codCiudad, $persona_id);
        }
        break;
    case "actualizar":
        if (isset($_REQUEST["telefono"]) && isset($_REQUEST["codPais"]) && isset($_REQUEST["codCiudad"]) && isset($_REQUEST["persona_id"]) && isset($_REQUEST["id"])) {
            $telefono = $_REQUEST["telefono"];
            $codPais = $_REQUEST["codPais"];
            $codCiudad = $_REQUEST["codCiudad"];
            $persona_id = $_REQUEST["persona_id"];
            $id = $_REQUEST["id"];

            $personaBLL->update($telefono, $codPais, $codCiudad, $persona_id, $id);
        }
        break;
    case "eliminar":
        if(isset($_REQUEST["id"])){
            $id = $_REQUEST["id"];
            $personaBLL->delete($id);
        }
        break;
}


$listaTelefonos = $personaBLL->selectAll();
?>
<div class="container">
    <a href="formTelefono.php">Insertar</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Telefono</th>
                <th>Cod Pais</th>
                <th>Cod Ciudad</th>
                <th>Persona</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($listaTelefonos as $objTelefono) {
                ?>
                <tr>
                    <td><?php echo $objTelefono->getId(); ?></td>
                    <td><?php echo $objTelefono->getTelefono(); ?></td>
                    <td><?php echo $objTelefono->getCodPais(); ?></td>
                    <td><?php echo $objTelefono->getCodCiudad(); ?></td>
                    <td><?php echo $objTelefono->getPersonaForDisplay(); ?></td>
                    <td><a href="formTelefono.php?id=<?php echo $objTelefono->getId(); ?>" class="btn btn-primary">Editar</a></td>
                    <td><a onclick="return confirm('Está seguro que desea eliminar?')" href="listaTelefonos.php?id=<?php echo $objTelefono->getId(); ?>&task=eliminar" class="btn btn-danger">Eliminar</a></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>
<?php
include_once './footer.php';
?>
