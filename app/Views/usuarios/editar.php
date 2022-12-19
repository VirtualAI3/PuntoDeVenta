
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h3 class="mt-4"><?php echo $titulo; ?></h3>
            <?php if (isset($validation)) {?>
            <div class="alert alert-danger">
            <?php echo $validation->listErrors(); ?>
            </div>
            <?php } ?>
            <form method="POST" action="<?php echo base_url(); ?>/usuarios/actualizar" autocomplete="off">
                <input type="hidden" value="<?php echo $datos['id']; ?>" name="id">
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label for="">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $datos['nombre']; ?>" autofocus required>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label for="">Caja</label>
                            <select class="form-control" name="id_caja" id="id_caja" required>
                                <option value="">Seleccionar caja</option>
                                <?php foreach($cajas as $caja) {?>
                                    <option value="<?php echo $caja['id']; ?>" <?php if($caja['id']==$datos['id_caja']){echo 'selected';} ?>
                                    <?php echo set_select('id_unidad',$caja['id']) ?>
                                    ><?php echo $caja['nombre']; ?></option>
                                <?php }?>
                            </select>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label for="">Rol</label>
                            <select class="form-control" name="id_rol" id="id_rol" required>
                                <option value="">Seleccionar rol</option>
                                <?php foreach($roles as $rol) {?>
                                    <option value="<?php echo $rol['id']; ?>" <?php if($rol['id']==$datos['id_rol']){echo 'selected';} ?>
                                    <?php echo set_select('id_categoria',$rol['id']) ?>
                                    ><?php echo $rol['nombre']; ?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>

                </div>
                <a href="<?php echo base_url(); ?>/usuarios" class="btn btn-primary">Regresar</a>
                <button type="submit" class="btn btn-success">Guardar</button>
            </form>
        </div>
    </main>