<?php 


?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h3 class="mt-4"><?php echo $titulo; ?></h3>
                <div>
                    <p>
                        <a href="<?php echo base_url(); ?>/categorias" class="btn btn-warning">categorias</a>
                    </p>
                </div>
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th></th>
                            </tr>
                        </thead>
        
                        <tbody>
                            <?php foreach($datos as $dato){?>
                                <tr>
                                    <td><?php echo $dato['id']; ?></td>
                                    <td><?php echo $dato['nombre']; ?></td>
                                    <td>
                                        <a href="<?php echo base_url(); ?>/categorias/reingresar/<?php echo $dato['id']; ?>" class=""><i class="fa-solid fa-arrow-alt-circle-up"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                
        </div>
    </main>
    