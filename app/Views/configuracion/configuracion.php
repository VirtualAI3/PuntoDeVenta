<?php


?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h3 class="mt-4"><?php echo $titulo; ?></h3>

            <?php if (isset($validation)) { ?>
                <div class="alert alert-danger">
                    <?php echo $validation->listErrors(); ?>
                </div>
            <?php } ?>
            <form method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>/configuracion/actualizar" autocomplete="off">
                
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label for="">Nombre de la tienda</label>
                            <input type="text" class="form-control" id="tienda_nombre" name="tienda_nombre" value="<?php echo $nombre['valor']; ?>" autofocus required>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label for="">RFC</label>
                            <input type="text" class="form-control" id="tienda_rfc" name="tienda_rfc" value="<?php echo $rfc['valor']; ?>" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label for="">Telefono de la tienda</label>
                            <input type="text" class="form-control" id="tienda_telefono" name="tienda_telefono" value="<?php echo $telefono['valor']; ?>" required>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label for="">Correo de la tienda</label>
                            <input type="text" class="form-control" id="tienda_email" name="tienda_email" value="<?php echo $email['valor']; ?>" required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label for="">Direccion de la tienda</label>
                            <textarea name="tienda_direccion" id="tienda_direccion" class="form-control"  required><?php echo $direccion['valor']; ?></textarea>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label for="">Leyenda del ticket</label>
                            <textarea name="ticket_leyenda" id="ticket_leyenda" class="form-control" required><?php echo $leyenda['valor']; ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label for="">Logotipo</label><br>
                            <img src="<?php echo base_url(); ?>/images//logo-shop.png" alt="" class="img-responsive" width="200px">
                            <br>
                            <input class="form-control" type="file" name="tienda_logo" id="tienda_logo" accept="image/png">
                            <P class="small text-danger">Cargar imagen en formato png de 150x150 pixeles</P>
                        </div>
                    </div>
                </div>
                <a href="<?php echo base_url(); ?>/categorias" class="btn btn-primary">Regresar</a>

                <button type="submit" class="btn btn-success">Guardar</button>
            </form>

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