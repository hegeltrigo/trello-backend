<?php
include_once './header.php';
include_once './data/DAL/Conexion.php';
include_once './data/BLL/TelefonoBLL.php';
include_once './data/DTO/Telefono.php';
include_once './data/BLL/PersonaBLL.php';
include_once './data/DTO/Persona.php';
$id = "";
$telefonoBLL = new TelefonoBLL();
$personaBLL = new PersonaBLL();
$objTelefono = null;
if (isset($_REQUEST["id"])) {
    $id = $_REQUEST["id"];
    $objTelefono = $telefonoBLL->select($id);
}
?>
<div class="container">
    <div class="row">
        <div class="col-6 offset-3">
            <h1>Formulario Teléfono</h1>
            <form action="listaTelefonos.php" method="POST">
                <input type="hidden" name="id"
                       value="<?php echo ($objTelefono != null) ? $objTelefono->getId() : ""; ?>" />
                <input type="hidden" name="task"
                       value="<?php echo ($objTelefono != null) ? "actualizar" : "insertar"; ?>" />
                <div class="form-group">
                    <label>Teléfono:</label>
                    <input type="text" name="telefono" class="form-control" 
                           value="<?php echo ($objTelefono != null) ? $objTelefono->getTelefono() : ""; ?>"/>
                </div>
                <div class="form-group">
                    <label>Cod País:</label>
                    <input type="text" name="codPais" class="form-control" 
                           value="<?php echo ($objTelefono != null) ? $objTelefono->getCodPais() : ""; ?>"/>
                </div>
                <div class="form-group">
                    <label>Cod Ciudad:</label>
                    <input type="text" name="codCiudad" class="form-control" 
                           value="<?php echo ($objTelefono != null) ? $objTelefono->getCodCiudad() : ""; ?>"/>
                </div>
                <div class="form-group">
                    <label>Persona:</label>
                    <select class="form-control" name="persona_id">
                        <?php
                        $listaPersonas = $personaBLL->selectAll();

                        foreach ($listaPersonas as $objPersona) {
                            ?>
                            <option <?php echo ($objTelefono != null && $objTelefono->getPersona_id() == $objPersona->getId()) ? 'selected="selected"' : ""; ?>  value="<?php echo $objPersona->getId(); ?>"><?php echo $objPersona->getNombres() . " " . $objPersona->getApellidos(); ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Guardar"/>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include_once './footer.php'; ?>
 