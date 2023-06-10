<?php
include("../../db.php");

if (isset($_GET["txtID"])) {
    $txtid = $_GET["txtID"];

    $sentencia = $conexion->prepare("DELETE FROM tbl_conductores WHERE cedula= :cedula");
    $sentencia->bindParam(":cedula", $txtid);
    $sentencia->execute();

    header("Location:index.php");
}

$sentencia = $conexion->prepare("SELECT * FROM tbl_conductores");
$sentencia->execute();
$lista_tbl_conductores = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include("../../templates/header.php") ?>

<br />
<div class="card">
    <div class="card-header">
        <a name="" id="" class="btn btn-primary" href="<?php echo $url_base ?>views/conductores/crear.php" role="button">Agregar conductor</a>
    </div>

    <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Cedula</th>
                        <th scope="col">Nombre Conductor</th>
                        <th scope="col">Dirección</th>
                        <th scope="col">Teléfono</th>
                        <th scope="col">Ciudad</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($lista_tbl_conductores as $conductor) { ?>

                        <tr class="">
                            <td scope="row"><?php echo $conductor["cedula"] ?></td>
                            <td><?php echo $conductor["primernombre"] . " " . $conductor["segundonombre"] . " " . $conductor["primerapellido"] . " " . $conductor["segundoapellido"] ?></td>
                            <td><?php echo $conductor["direccion"] ?></td>
                            <td><?php echo $conductor["telefono"] ?></td>
                            <td><?php echo $conductor["ciudad"] ?></td>
                            <td>
                                <a name="" class="btn btn-danger" href="<?php echo $url_base ?>views/conductores/index.php?txtID=<?php echo $conductor["cedula"] ?>" role="button">Eliminar</a>
                            </td>
                        </tr>

                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include("../../templates/footer.php") ?>