<?php
include("../../db.php");

if (isset($_GET["txtID"])) {
    $txtid = $_GET["txtID"];

    $sentencia = $conexion->prepare("DELETE FROM tbl_propietarios WHERE cedula= :cedula");
    $sentencia->bindParam(":cedula", $txtid);
    $sentencia->execute();

    header("Location:index.php");
}

$sentencia = $conexion->prepare("SELECT * FROM tbl_propietarios");
$sentencia->execute();
$lista_tbl_propietarios = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include("../../templates/header.php") ?>

<br />
<div class="card">
    <div class="card-header">
        <a name="" id="" class="btn btn-primary" href="<?php echo $url_base ?>views/propietarios/crear.php" role="button">Agregar propietario</a>
    </div>

    <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Cedula</th>
                        <th scope="col">Nombre Del Propietario</th>
                        <th scope="col">Dirección</th>
                        <th scope="col">Teléfono</th>
                        <th scope="col">Ciudad</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>

                <tbody>

                    <?php foreach ($lista_tbl_propietarios as $propietario) { ?>

                        <tr class="">
                            <td scope="row"><?php echo $propietario["cedula"] ?></td>
                            <td><?php echo $propietario["primernombre"] . " " . $propietario["segundonombre"] . " " . $propietario["primerapellido"] . " " . $propietario["segundoapellido"] ?></td>
                            <td><?php echo $propietario["direccion"] ?></td>
                            <td><?php echo $propietario["telefono"] ?></td>
                            <td><?php echo $propietario["ciudad"] ?></td>
                            <td>
                                <a name="" class="btn btn-danger" href="<?php echo $url_base ?>views/propietarios/index.php?txtID=<?php echo $propietario["cedula"] ?>" role="button">Eliminar</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include("../../templates/footer.php") ?>