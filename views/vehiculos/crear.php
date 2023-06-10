<?php
include("../../db.php");

if ($_POST) {
    $placa = isset($_POST["placa"]) ? $_POST["placa"] : "";
    $color = isset($_POST["color"]) ? $_POST["color"] : "";
    $marca = isset($_POST["marca"]) ? $_POST["marca"] : "";

    $tipodevehiculo = isset($_POST["tipodevehiculo"]) ? $_POST["tipodevehiculo"] : "";
    $conductor = isset($_POST["conductor"]) ? $_POST["conductor"] : "";
    $propietario = isset($_POST["propietario"]) ? $_POST["propietario"] : "";


    $sentencia = $conexion->prepare("INSERT INTO tbl_vehiculos VALUES (:placa, :color, :marca, :tipodevehiculo, :cedulaconductor, :cedulapropietario)");
    $sentencia->bindParam(":placa", $placa);
    $sentencia->bindParam(":color", $color);
    $sentencia->bindParam(":marca", $marca);
    $sentencia->bindParam(":tipodevehiculo", $tipodevehiculo);
    $sentencia->bindParam(":cedulaconductor", $conductor);
    $sentencia->bindParam(":cedulapropietario", $propietario);
    $sentencia->execute();

    header("Location:index.php");
}

$sentencia = $conexion->prepare("SELECT * FROM tbl_conductores");
$sentencia->execute();
$lista_tbl_conductores = $sentencia->fetchAll(PDO::FETCH_ASSOC);

$sentenciaDos = $conexion->prepare("SELECT * FROM tbl_propietarios");
$sentenciaDos->execute();
$lista_tbl_propietarios = $sentenciaDos->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include("../../templates/header.php") ?>

<br />
<div class="card">
    <div class="card-header">
        Vehículos
    </div>

    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">

            <div class="mb-3">
                <label for="placa" class="form-label">Placa:</label>

                <input type="text" maxlength="14" class="form-control" name="placa" id="placa" aria-describedby="helpId" placeholder="Placa" required>
            </div>

            <div class="mb-3">
                <label for="color" class="form-label">Color:</label>

                <input type="text" maxlength="45" class="form-control" name="color" id="color" aria-describedby="helpId" placeholder="Color" required>
            </div>

            <div class="mb-3">
                <label for="marca" class="form-label">Marca:</label>

                <input type="text" maxlength="45" class="form-control" name="marca" id="marca" aria-describedby="helpId" placeholder="Marca" required>
            </div>

            <div class="mb-3">
                <label for="tipodevehiculo" class="form-label">Tipo De Vehículo: </label>
                <select class="form-select form-select-sm" name="tipodevehiculo" id="tipodevehiculo" required>
                    <option value="particular">Particular</option>
                    <option value="publico">Publico</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="conductor" class="form-label">Conductor:</label>

                <select class="form-select form-select-sm" name="conductor" id="conductor" required>
                    <?php foreach ($lista_tbl_conductores as $conductor) { ?>
                        <option value="<?php echo $conductor["cedula"] ?>"><?php echo $conductor["primernombre"] . " " . $conductor["segundonombre"] . " " . $conductor["primerapellido"] . " " . $conductor["segundoapellido"] ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="propietario" class="form-label">Propietario:</label>

                <select class="form-select form-select-sm" name="propietario" id="propietario" required>
                    <?php foreach ($lista_tbl_propietarios as $propietario) { ?>
                        <option value="<?php echo $propietario["cedula"] ?>"><?php echo $propietario["primernombre"] . " " . $propietario["segundonombre"] . " " . $propietario["primerapellido"] . " " . $propietario["segundoapellido"] ?></option>
                    <?php } ?>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Agregar</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
        </form>
    </div>
</div>

<?php include("../../templates/footer.php") ?>