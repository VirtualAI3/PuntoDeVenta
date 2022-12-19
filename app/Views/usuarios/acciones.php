<?php


?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h3 class="mt-4"><?php echo $titulo; ?></h3>

            <table id="dataTable">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>IP</th>
                        <th>Evento</th>
                        <th>Detalles</th>
                        <th>Fecha y hora</th>
                    </tr>
                </thead>
                
                <tbody>
                <?php foreach ($datos as $dato) { ?>
                    <tr>
                        <td><?php echo $dato['nombre']; ?></td>
                        <td><?php echo $dato['ip']?></td>
                        <td><?php echo $dato['evento']?></td>
                        <td><?php echo $dato['detalles']?></td>
                        <td><?php echo $dato['fecha']?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>

        </div>
    </main>