<?php


?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h3 class="mt-4"><?php echo $titulo; ?></h3>
            <div>
                <p>
                    
                    <a href="<?php echo base_url(); ?>/unidades/eliminados" class="btn btn-warning">Eliminados</a>
                </p>
            </div>
            <table id="dataTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Folio</th>
                        <th>Total</th>
                        <th>Fecha</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($compras as $compra) { ?>
                        <tr>
                            <td><?php echo $compra['id']; ?></td>
                            <td><?php echo $compra['folio']; ?></td>
                            <td><?php echo $compra['total']; ?></td>
                            <td><?php echo $compra['fecha_alta']; ?></td>
                            <td>
                                <a href="<?php echo base_url(); ?>/compras/muestraCompraPdf/<?php echo $compra['id']; ?>" class="btn btn-primary"><i class="fa-solid fa-file-alt"></i></a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

        </div>
    </main>

    <!-- Modal -->
    <div class="modal fade" id="modal-confirma" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar registro</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>¿Desea eliminar este registro?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <a class="btn btn-danger btn-ok">Si</a>
                </div>
            </div>
        </div>
    </div>