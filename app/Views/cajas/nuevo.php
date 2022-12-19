<?php


?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h3 class="mt-4"><?php echo $titulo; ?></h3>

            <?php if (isset($validation)) {?>
            <div class="alert alert-danger">
            <?php echo $validation->listErrors(); ?>
            </div>
            <?php } ?>
            <form method="POST" action="<?php echo base_url(); ?>/cajas/insertar" autocomplete="off">
            <?php csrf_field(); ?>
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label for="">Numero de caja</label>
                            <input type="text" class="form-control" id="numero_caja" name="numero_caja" value="<?php echo set_value('numero_caja');?>" autofocus required>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label for="">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo set_value('nombre');?>" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label for="">Folio</label>
                            <input type="text" class="form-control" id="folio" name="folio" value="<?php echo set_value('folio');?>" required>
                        </div>
                        
                    </div>
                </div>
                <a href="<?php echo base_url(); ?>/cajas" class="btn btn-primary">Regresar</a>
                <button type="submit" class="btn btn-success">Guardar</button>
            </form>
        </div>
    </main>