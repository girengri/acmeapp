<?php
include("../../db.php");

if (isset($_GET["txtID"])) {
    $txtid = $_GET["txtID"];

    $sentencia = $conexion->prepare("DELETE FROM tbl_vehiculos WHERE placa= :placa");
    $sentencia->bindParam(":placa", $txtid);
    $sentencia->execute();

    header("Location:index.php");
}

$sentencia = $conexion->prepare("
SELECT placa, color, marca, tipodevehiculo ,
tbl_conductores.primernombre AS nombreconductor,  
tbl_conductores.primerapellido AS apellidoconductor,
tbl_propietarios.primernombre AS nombrepropietario,
tbl_propietarios.primerapellido AS apellidopropietario 
FROM tbl_vehiculos
INNER JOIN  tbl_conductores, tbl_propietarios
WHERE cedula_conductor = tbl_conductores.cedula
AND cedula_propietario = tbl_propietarios.cedula
");
$sentencia->execute();
$lista_tbl_vehiculos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include("../../templates/header.php") ?>

<br />
<div class="card">
    <div class="card-header">
        <a name="" id="" class="btn btn-primary" href="<?php echo $url_base ?>views/vehiculos/crear.php" role="button">Agregar vehículo</a>
    </div>

    <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Placa</th>
                        <th scope="col">Color</th>
                        <th scope="col">Marca</th>
                        <th scope="col">Tipo De Vehículo</th>
                        <th scope="col">Conductor</th>
                        <th scope="col">Propietario</th>
                    </tr>
                </thead>

                <tbody>

                    <?php foreach ($lista_tbl_vehiculos as $vehiculo) { ?>

                        <tr class="">
                            <td scope="row"><?php echo $vehiculo["placa"] ?></td>
                            <td><?php echo $vehiculo["color"] ?></td>
                            <td><?php echo $vehiculo["marca"] ?></td>
                            <td><?php echo $vehiculo["tipodevehiculo"] ?></td>
                            <td><?php echo $vehiculo["nombreconductor"] . " " . $vehiculo["apellidoconductor"] ?></td>
                            <td><?php echo  $vehiculo["nombrepropietario"] . " " . $vehiculo["apellidopropietario"] ?></td>
                            <td>
                                <a name="" class="btn btn-danger" href="<?php echo $url_base ?>views/vehiculos/index.php?txtID=<?php echo $vehiculo["placa"] ?>" role="button">Eliminar</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include("../../templates/footer.php") ?>
