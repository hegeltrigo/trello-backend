<?php
include_once './header.php';
include_once './data/DAL/Conexion.php';
include_once './data/BLL/PersonaBLL.php';
include_once './data/DTO/Persona.php';
$id = "";
$personaBLL = new PersonaBLL();
$objPersona = null;
if (isset($_REQUEST["id"])) {
    $id = $_REQUEST["id"];
    $objPersona = $personaBLL->select($id);
}
?>
<div class="container">
    <div class="row">
        <div class="col-6 offset-3">
            <h1>Formulario Persona</h1>
            <form action="index.php" method="POST">
                <input type="hidden" name="id"
                       value="<?php echo ($objPersona != null) ? $objPersona->getId() : ""; ?>" />
                <input type="hidden" name="task"
                       value="<?php echo ($objPersona != null) ? "actualizar" : "insertar"; ?>" />
                <div class="form-group">
                    <label>Nombre:</label>
                    <input type="text" name="nombres" class="form-control" 
                           value="<?php echo ($objPersona != null) ? $objPersona->getNombres() : ""; ?>"/>
                </div>
                <div class="form-group">
                    <label>Apellido:</label>
                    <input type="text" name="apellidos" class="form-control" 
                           value="<?php echo ($objPersona != null) ? $objPersona->getApellidos() : ""; ?>"/>
                </div>
                <div class="form-group">
                    <label>Ciudad:</label>
                    <input type="text" name="ciudad" class="form-control" 
                           value="<?php echo ($objPersona != null) ? $objPersona->getCiudad() : ""; ?>"/>
                </div>
                <div class="form-group">
                    <label>Sexo:</label>
                    <select class="form-control" name="sexo">
                        <option value="0" <?php echo ($objPersona != null && $objPersona->getSexo() == 0) ? 'selected="selected"' : ""; ?>>Masculino</option>
                        <option value="1" <?php echo ($objPersona != null && $objPersona->getSexo() == 1) ? 'selected="selected"' : ""; ?>>Femenino</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Edad:</label>
                    <input type="number" name="edad" class="form-control" value="<?php echo ($objPersona != null) ? $objPersona->getEdad() : ""; ?>"/>
                </div>
                <div class="form-group">
                    <label>Fecha de Nacimiento:</label>
                    <input type="date" name="fechaNacimiento" class="form-control" value="<?php echo ($objPersona != null) ? $objPersona->getFechaNacimiento() : ""; ?>"/>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Guardar"/>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include_once './footer.php'; ?>
 