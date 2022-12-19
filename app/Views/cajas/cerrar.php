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
            <form method="POST" action="<?php echo base_url(); ?>/cajas/cerrar" autocomplete="off">
                <input type="hidden" name="id_arqueo" id="id_arqueo" value="<?php echo $arqueo['id']; ?>">
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label for="">Numero de caja</label>
                            <input type="text" class="form-control" id="numero_caja" name="numero_caja" value="<?php echo set_value('numero_caja', $caja['numero_caja']); ?>" autofocus required>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label for="">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo set_value('nombre', $session->nombre); ?>" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label for="">Monto inicial</label>
                            <input type="text" class="form-control" id="monto_inicial" name="monto_inicial" value="<?php echo $arqueo['monto_inicial']; ?>" required>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label for="">Monto final</label>
                            <input type="text" class="form-control" id="monto_final" name="monto_final" value="<?php ?>" required>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label for="">Fecha</label>
                            <input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo date('Y-m-d'); ?>" required>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label for="">Hora</label>
                            <input type="text" class="form-control" id="hora" name="hora" value="<?php echo date('H:i:s'); ?>" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label for="">Monto de ventas</label>
                            <input type="text" class="form-control" id="total_ventas" name="total_ventas" value="<?php echo $monto['total']; ?>" required>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label for="">Total de ventas</label>
                            <input type="text" class="form-control" id="no_ventas" name="no_ventas" value="<?php  ?>" required>
                        </div>
                    </div>
                </div>
                <a href="<?php echo base_url(); ?>/cajas" class="btn btn-primary">Regresar</a>
                <button type="submit" class="btn btn-success">Guardar</button>
            </form>
        </div>
    </main>