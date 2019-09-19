
<?php
include_once './header.php';
include_once './data/DAL/Conexion.php';
include_once './data/BLL/PersonaBLL.php';
include_once './data/DTO/Persona.php';

$personaBLL = new PersonaBLL();


$listaPersonas = $personaBLL->selectAll();
?>
<div class="container">
    <div class="form-group mt-4">
        <a class="btn btn-primary" href="javascript:void(0)" id="btnInsertarPersona">Insertar</a>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="formPersonaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Formulario Persona</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="hdnTask" value="insert"/>
                    <input type="hidden" id="hdnId"/>
                    <div class="form-group">
                        <label>Nombre:</label>
                        <input type="text" id="txtNombre" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label>Apellido:</label>
                        <input type="text" id="txtApellido" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label>Ciudad:</label>
                        <input type="text" id="txtCiudad" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label>Fecha de Nacimiento:</label>
                        <input type="date" id="txtFechaNacimiento" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label>Sexo:</label>
                        <select class="form-control" id="lstSexo">
                            <option value="0">Masculino</option>
                            <option value="1">Femenino</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Edad:</label>
                        <input type="number" id="txtEdad" class="form-control"/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button id="btnGuardarPersona" type="button" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </div>
        </div>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Ciudad</th>
                <th>Edad</th>
                <th>Fecha de Nacimiento</th>
                <th>Sexo</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($listaPersonas as $objPersona) {
                ?>
                <tr id="tr<?php echo $objPersona->getId(); ?>">
                    <td><?php echo $objPersona->getId(); ?></td>
                    <td><?php echo $objPersona->getNombres(); ?></td>
                    <td><?php echo $objPersona->getApellidos(); ?></td>
                    <td><?php echo $objPersona->getCiudad(); ?></td>
                    <td><?php echo $objPersona->getEdad(); ?></td>
                    <td><?php echo $objPersona->getFechaNacimiento(); ?></td>
                    <td><?php echo $objPersona->getSexoForDisplay(); ?></td>
                    <td><a href="javascript:void(0)" data-id="<?php echo $objPersona->getId() ?>" class="btn btn-primary btnEditar">Editar</a></td>
                    <td><a href="javascript:void(0)" data-id="<?php echo $objPersona->getId(); ?>" class="btn btn-danger btnEliminar">Eliminar</a></td>
                </tr>
                <?php
            }
            ?>
            <tr style="display: none" id="itemPersona">
                <td>[ID]</td>
                <td>[NOMBRES]</td>
                <td>[APELLIDOS]</td>
                <td>[CIUDAD]</td>
                <td>[EDAD]</td>
                <td>[FECHANACIMIENTO]</td>
                <td>[SEXO]</td>
                <td><a href="javascript:void(0)" data-id="[ID_1]" class="btn btn-primary btnEditar">Editar</a></td>
                <td><a href="javascript:void(0)" data-id="[ID_2]" class="btn btn-danger btnEliminar">Eliminar</a></td>
            </tr>
        </tbody>
    </table>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#btnInsertarPersona').on('click', function () {
            $('#hdnTask').val('insert');
            $('#hdnId').val('');
            limpiarCampos();
            $('#formPersonaModal').modal('show');
            return false;
        });
        $(document).on('click', '.btnEliminar', function () {
            var res = confirm('Está seguro que desea eliminar?');
            if (!res) {
                return false;
            }
            var id = $(this).data('id');
            var parametros = {
                id: id,
                task: 'delete'
            };
            $.ajax({
                url: "ajaxPersona.php",
                type: 'POST',
                data: parametros,
                success: function (data) {
                    var id = data;
                    $('#tr' + id).remove();
                },
                error: function (data) {
                    console.log(data);
                }
            });
        });
        $(document).on('click', '.btnEditar', function () {
            var id = $(this).data('id');
            var parametros = {
                id: id,
                task: 'get'
            };
            $.ajax({
                url: "ajaxPersona.php",
                type: 'POST',
                data: parametros,
                success: function (data) {
                    var objPersona = JSON.parse(data);

                    $('#txtNombre').val(objPersona.nombres);
                    $('#txtApellido').val(objPersona.apellidos);
                    $('#txtCiudad').val(objPersona.ciudad);
                    $('#txtEdad').val(objPersona.edad);
                    $('#txtFechaNacimiento').val(objPersona.fechaNacimiento);
                    $('#lstSexo').val(objPersona.sexo.toString());
                    $('#hdnId').val(objPersona.id);
                    $('#hdnTask').val('update');
                    $('#formPersonaModal').modal('show');
                },
                error: function (data) {
                    console.log(data);
                }
            });
            return false;
        });
        $('#btnGuardarPersona').on('click', function () {
            var objPersona = {
                nombres: $('#txtNombre').val(),
                apellidos: $('#txtApellido').val(),
                ciudad: $('#txtCiudad').val(),
                edad: $('#txtEdad').val(),
                sexo: $('#lstSexo').val(),
                fechaNacimiento: $('#txtFechaNacimiento').val(),
                task: $('#hdnTask').val(),
                id: $('#hdnId').val()
            };
            if (objPersona.task == "update") {
                llamarActualizar(objPersona);
            } else {
                llamarInsertar(objPersona);
            }

            return false;
        });

    });
    function llamarActualizar(parametros) {
        $.ajax({
            url: "ajaxPersona.php",
            type: 'POST',
            data: parametros,
            success: function (data) {
                var objPersona = JSON.parse(data);
                console.log(objPersona);
                var trActualizar = $('#tr' + objPersona.id);
                $('#formPersonaModal').modal('hide');
                var itemPersona = $('#itemPersona').html();
                itemPersona = itemPersona.replace('[ID]', objPersona.id);
                itemPersona = itemPersona.replace('[ID_1]', objPersona.id);
                itemPersona = itemPersona.replace('[ID_2]', objPersona.id);
                itemPersona = itemPersona.replace('[NOMBRES]', objPersona.nombres);
                itemPersona = itemPersona.replace('[APELLIDOS]', objPersona.apellidos);
                itemPersona = itemPersona.replace('[CIUDAD]', objPersona.ciudad);
                itemPersona = itemPersona.replace('[EDAD]', objPersona.edad);
                itemPersona = itemPersona.replace('[FECHANACIMIENTO]', objPersona.fechaNacimiento);
                itemPersona = itemPersona.replace('[SEXO]', objPersona.sexo == 1 ? "Femenino" : "Masculino");
                trActualizar.html(itemPersona);
                limpiarCampos();
            },
            error: function (data) {
                console.log(data);
            }
        });
    }
    function llamarInsertar(parametros) {
        $.ajax({
            url: "ajaxPersona.php",
            type: 'POST',
            data: parametros,
            success: function (data) {
                var objPersona = JSON.parse(data);
                console.log(objPersona);
                $('#formPersonaModal').modal('hide');
                var itemPersona = $('#itemPersona').html();
                itemPersona = itemPersona.replace('[ID]', objPersona.id);
                itemPersona = itemPersona.replace('[ID_1]', objPersona.id);
                itemPersona = itemPersona.replace('[ID_2]', objPersona.id);
                itemPersona = itemPersona.replace('[NOMBRES]', objPersona.nombres);
                itemPersona = itemPersona.replace('[APELLIDOS]', objPersona.apellidos);
                itemPersona = itemPersona.replace('[CIUDAD]', objPersona.ciudad);
                itemPersona = itemPersona.replace('[EDAD]', objPersona.edad);
                itemPersona = itemPersona.replace('[FECHANACIMIENTO]', objPersona.fechaNacimiento);
                itemPersona = itemPersona.replace('[SEXO]', objPersona.sexo == 1 ? "Femenino" : "Masculino");
                var nuevoRow = $('<tr></tr>').html(itemPersona);
                $('table').find('tbody').append(nuevoRow);
                limpiarCampos();
            },
            error: function (data) {
                console.log(data);
            }
        });
    }
    function limpiarCampos() {
        $('#txtNombre').val('');
        $('#txtApellido').val('');
        $('#txtEdad').val('');
        $('#txtCiudad').val('');
        $('#txtFechaNacimiento').val('');
        $('#lstSexo').val('0');
    }
</script>
<?php
include_once './footer.php';
?>
