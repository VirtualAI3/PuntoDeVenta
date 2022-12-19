<?php


?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h3 class="mt-4"><?php echo $titulo; ?></h3>
            <form method="POST" id="form_permisos" name="form_permisos" action="<?php echo base_url(); ?>/roles/guardaPermisos">

                <input type="hidden" name="id_rol" value="<?php echo $id_rol; ?>">
                
                    <?php foreach ($permisos as $permiso) { ?>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="<?php echo $permiso['id']; ?>" name="permisos[]" id="<?php echo $permiso['nombre'] ?>" <?php if (isset($asignado[$permiso['id']])){ echo 'checked';}                                                                                                                                             ?>>
                            <label class="form-check-label" for="<?php echo $permiso['nombre'] ?>">
                                <?php echo $permiso['nombre'] ?>
                            </label>
                        </div>

                    <?php } ?>
                
                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
        </div>
    </main>

    <!-- Modal -->