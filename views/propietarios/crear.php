<?php
include("../../db.php");

if ($_POST) {

    $cedula = isset($_POST["cedula"]) ? $_POST["cedula"] : "";
    $primernombre = isset($_POST["primernombre"]) ? $_POST["primernombre"] : "";
    $segundonombre = isset($_POST["segundonombre"]) ? $_POST["segundonombre"] : "";
    $primerapellido = isset($_POST["primerapellido"]) ? $_POST["primerapellido"] : "";
    $segundoapellido = isset($_POST["segundoapellido"]) ? $_POST["segundoapellido"] : "";
    $direccion = isset($_POST["direccion"]) ? $_POST["direccion"] : "";
    $telefono = isset($_POST["telefono"]) ? $_POST["telefono"] : "";
    $ciudad = isset($_POST["ciudad"]) ? $_POST["ciudad"] : "";

    $sentencia = $conexion->prepare("INSERT INTO tbl_propietarios VALUES (:cedula, :primernombre, :segundonombre, :primerapellido, :segundoapellido, :direccion, :telefono, :ciudad)");
    $sentencia->bindParam(":cedula", $cedula);
    $sentencia->bindParam(":primernombre", $primernombre);
    $sentencia->bindParam(":segundonombre", $segundonombre);
    $sentencia->bindParam(":primerapellido", $primerapellido);
    $sentencia->bindParam(":segundoapellido", $segundoapellido);
    $sentencia->bindParam(":direccion", $direccion);
    $sentencia->bindParam(":telefono", $telefono);
    $sentencia->bindParam(":ciudad", $ciudad);
    $sentencia->execute();

    header("Location:index.php");
}
?>

<?php include("../../templates/header.php") ?>

<br />
<div class="card">
    <div class="card-header">
        Propietarios
    </div>

    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">

            <div class="mb-3">
                <label for="cedula" class="form-label">Cedula:</label>

                <input type="number" min="1111" max="999999999999" class="form-control" name="cedula" id="cedula" aria-describedby="helpId" placeholder="Escriba el numero de la cedula sin puntos y sin comas." required>
            </div>

            <div class="mb-3">
                <label for="primernombre" class="form-label">Primer Nombre:</label>

                <input type="text" maxlength="45" class="form-control" name="primernombre" id="primernombre" aria-describedby="helpId" placeholder="Primer nombre" required>
            </div>

            <div class="mb-3">
                <label for="segundonombre" class="form-label">Segundo Nombre:</label>

                <input type="text" maxlength="45" class="form-control" name="segundonombre" id="segundonombre" aria-describedby="helpId" placeholder="Segundo nombre">
            </div>

            <div class="mb-3">
                <label for="primerapellido" class="form-label">Primer Apellido:</label>

                <input type="text" maxlength="45" class="form-control" name="primerapellido" id="primerapellido" aria-describedby="helpId" placeholder="Primer apellido" required>
            </div>

            <div class="mb-3">
                <label for="segundoapellido" class="form-label">Segundo Apellido:</label>

                <input type="text" maxlength="45" class="form-control" name="segundoapellido" id="segundoapellido" aria-describedby="helpId" placeholder="Segundo Apellido">
            </div>

            <div class="mb-3">
                <label for="direccion" class="form-label">Dirección:</label>

                <input type="text" maxlength="45" class="form-control" name="direccion" id="direccion" aria-describedby="helpId" placeholder="Direccion" required>
            </div>

            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono:</label>

                <input type="number" min="1111" max="999999999999" class="form-control" name="telefono" id="telefono" aria-describedby="helpId" placeholder="Escriba el número del teléfono (celular o fijo) sin indicativos." required>
            </div>

            <div class="mb-3">
                <label for="ciudad" class="form-label">Ciudad:</label>

                <input type="text" maxlength="45" class="form-control" name="ciudad" id="ciudad" aria-describedby="helpId" placeholder="Ciudad" required>
            </div>

            <button type="submit" class="btn btn-success">Agregar</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
        </form>
    </div>
</div>

<?php include("../../templates/footer.php") ?>