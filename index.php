<?php
include("db.php");

$sentencia = $conexion->prepare("SELECT marca, color, 
tbl_conductores.primernombre AS primernombreconductor, tbl_conductores.segundonombre AS segundonombreconductor, 
tbl_conductores.primerapellido AS primerapellidoconductor, tbl_conductores.segundoapellido AS segundoapellidoconductor,
tbl_propietarios.primernombre AS primernombrepropietario, tbl_propietarios.segundonombre AS segundonombrepropietario, 
tbl_propietarios.primerapellido AS primerapellidopropietario, tbl_propietarios.segundoapellido AS segundoapellidopropietario
FROM tbl_vehiculos
INNER JOIN tbl_conductores, tbl_propietarios
WHERE tbl_vehiculos.cedula_conductor=tbl_conductores.cedula
AND tbl_vehiculos.cedula_propietario=tbl_propietarios.cedula;
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
                            <td scope="row"><?php echo $informe["marca"] ?></td>
                            <td><?php echo $informe["color"] ?></td>
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