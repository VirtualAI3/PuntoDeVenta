<?php


?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h3 class="mt-4"><?php echo $titulo; ?></h3>
            <div>
                <p>
                    <a href="<?php echo base_url(); ?>/productos/nuevo" class="btn btn-info text-white align-middle"><i class="fa-solid fa-plus"></i> Agregar</a>
                    <a href="<?php echo base_url(); ?>/productos/eliminados" class="btn btn-warning text-white align-middle"><i class="fa-solid fa-trash"></i> Eliminados</a>
                    <a href="<?php echo base_url(); ?>/productos/muestraCodigos" class="btn btn-primary align-middle"><i class="fa-solid fa-barcode"></i> Codigos de Barras</a>
                </p>
            </div>
            <table id="dataTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Existencias</th>
                        <th>Imagen</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($datos as $dato) { ?>
                        <tr>
                            <td><?php echo $dato['id']; ?></td>
                            <td><?php echo $dato['codigo']; ?></td>
                            <td><?php echo $dato['nombre']; ?></td>
                            <td><?php echo $dato['precio_venta']; ?></td>
                            <td><?php echo $dato['existencias']; ?></td>
                            <td><img src="<?php echo base_url(); ?>/images/productos/<?php echo $dato['id'];?>.jpg" alt="" class="img-responsive" width="40px"></td>
                            <td>
                                <a href="<?php echo base_url(); ?>/productos/editar/<?php echo $dato['id']; ?>" class="btn btn-warning"><i class="fa-solid fa-pencil"></i></a>
                            </td>
                            <td>
                                <a href="#" data-href="<?php echo base_url(); ?>/productos/eliminar/<?php echo $dato['id']; ?>" data-bs-toggle="modal" data-bs-target="#modal-confirma" data-placement="top" title="Elimar registro" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
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