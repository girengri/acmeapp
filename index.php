<?php
include("db.php");

$sentencia = $conexion->prepare("
SELECT placa,marca,
(SELECT primernombre FROM tbl_conductores WHERE tbl_conductores.cedula = tbl_vehiculos.cedula_conductor LIMIT 1) AS primernombreconductor,
(SELECT segundonombre FROM tbl_conductores WHERE tbl_conductores.cedula = tbl_vehiculos.cedula_conductor LIMIT 1) AS segundonombreconductor,
(SELECT primerapellido FROM tbl_conductores WHERE tbl_conductores.cedula = tbl_vehiculos.cedula_conductor LIMIT 1) AS primerapellidoconductor,
(SELECT segundoapellido FROM tbl_conductores WHERE tbl_conductores.cedula = tbl_vehiculos.cedula_conductor LIMIT 1) AS segundoapellidoconductor,
(SELECT primernombre FROM tbl_propietarios WHERE tbl_propietarios.cedula = tbl_vehiculos.cedula_propietario LIMIT 1) AS primernombrepropietario,
(SELECT segundonombre FROM tbl_propietarios WHERE tbl_propietarios.cedula = tbl_vehiculos.cedula_propietario LIMIT 1) AS segundonombrepropietario,
(SELECT primerapellido FROM tbl_propietarios WHERE tbl_propietarios.cedula = tbl_vehiculos.cedula_propietario LIMIT 1) AS primerapellidopropietario,
(SELECT segundoapellido FROM tbl_propietarios WHERE tbl_propietarios.cedula = tbl_vehiculos.cedula_propietario LIMIT 1) AS segundoapellidopropietario
FROM tbl_vehiculos
");

$sentencia->execute();
$tbl_informes = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include("templates/header.php") ?>

<br />
<div class="card">
    <div class="card-header">
        <h4>Informe Actual De Vehículos</h4>
    </div>

    <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Placa</th>
                        <th scope="col">Marca</th>
                        <th scope="col">Nombre Del Conductor</th>
                        <th scope="col">Nombre Del Propietario</th>
                    </tr>
                </thead>

                <tbody>

                    <?php foreach ($tbl_informes as $informe) { ?>
                        <tr class="">
                            <td scope="row"><?php echo $informe["placa"] ?></td>
                            <td><?php echo $informe["marca"] ?></td>
                            <td><?php echo $informe["primernombreconductor"] . " " . $informe["segundonombreconductor"] . " " . $informe["primerapellidoconductor"] . " " . $informe["segundoapellidoconductor"] ?></td>
                            <td><?php echo $informe["primernombrepropietario"] . " " . $informe["segundonombrepropietario"] . " " . $informe["primerapellidopropietario"] . " " . $informe["segundoapellidopropietario"] ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include("templates/footer.php") ?>
