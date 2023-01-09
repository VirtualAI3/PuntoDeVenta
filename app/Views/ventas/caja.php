<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <?php $idVentaTmp = uniqid(); ?>
            <br>
            <form action="<?php echo base_url(); ?>/ventas/guarda" id="form_venta" name="form_venta" class="form-horizontal" method="POST" autocomplete="off">
                <input type="hidden" name="id_venta" id="id_venta" value="<?php echo $idVentaTmp; ?>">

                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="ui-widget">
                                <label for="">Cliente: </label>
                                <input type="hidden" name="id_cliente" id="id_cliente" value="1">
                                <input type="text" class="form-control" id="cliente" name="cliente" placeholder="Escribe el nombre del cliente" value="Publico en general" onkeyup="" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="">Forma de pago: </label>
                            <select name="forma_pago" id="forma_pago" class="form-select" required>
                                <option value="001">Efectivo</option>
                                <option value="002">Tarjeta</option>
                                <option value="003">Transferencia</option>
                            </select>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <input type="hidden" name="id_producto" id="id_producto">

                            <label for="">Codigo de barras: </label>

                            <input type="text" class="form-control" id="codigo" placeholder="Escribe el codigo y enter" onkeyup="agregarProducto(event,this.value,1,'<?php echo $idVentaTmp; ?>')" name="codigo" autofocus>

                        </div>
                        <div class="col-sm-2">
                            <label for="codigo" id="resultado_error" style="color: red;"></label>
                        </div>
                        <div class="col-12 col-sm-4">
                            <br>
                            <label for="" style="font-weight:bold; font-size:30px; text-align:center;">Total $</label>
                            <input type="text" id="total" name="total" size="7" readonly="true" value="0.00" style="font-weight:bold; font-size:30px; text-align:center;">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-sm-4 col-4">
                            <br>
                            <button type="button" id="completa_venta" class="btn btn-success">Completar venta</button>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">

                    <table id="tablaProductos" class="table table-hover table-sm table-striped table-responsive tablaProductos" width="100%">
                        <thead class="table-dark">
                            <th>#</th>
                            <th>Codigo</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Total</th>
                            <th width="1%"></th>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </form>
        </div>
    </main>
    <!-- Modal -->
    <div class="modal fade" id="modal-confirma-caja" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Alerta</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Debe agregar un producto</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Ok</button>
                    <!--<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <a class="btn btn-danger btn-ok">Si</a>-->
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function() {
            $("#cliente").autocomplete({
                source: "<?php echo base_url(); ?>/clientes/autocompleteData",
                minLength: 3,
                select: function(event, ui) {
                    event.preventDefault();
                    $("#id_cliente").val(ui.item.id);
                    $("#cliente").val(ui.item.value);
                }
            });
        });
        $(function() {
            $("#codigo").autocomplete({
                source: "<?php echo base_url(); ?>/productos/autocompleteData",
                minLength: 3,
                select: function(event, ui) {
                    event.preventDefault();
                    $("#codigo").val(ui.item.value);
                    setTimeout(
                        function() {
                            e = jQuery.Event("keypress");
                            e.which = 13;
                            agregarProducto(e, ui.item.id, 1, '<?php echo $idVentaTmp; ?>');
                        }
                    )
                }
            });
        });

        function agregarProducto(e, id_producto, cantidad, id_venta) {

            let enterKey = 13;
            if (codigo != '') {
                if (e.which == enterKey) {
                    if (id_producto != null && id_producto != 0 && cantidad > 0) {

                        $.ajax({
                            url: '<?php echo base_url(); ?>/TemporalCompra/insertar_venta/' + id_producto + '/' + cantidad + '/' + id_venta,
                            success: function(resultado) {
                                if (resultado == 0) {

                                } else {

                                    var resultado = JSON.parse(resultado);
                                    if (resultado.error == '') {
                                        $("#tablaProductos tbody").empty();
                                        $("#tablaProductos tbody").append(resultado.datos);
                                        $("#total").val(resultado.total);

                                        $('#id_producto').val('');
                                        $('#codigo').val('');
                                        $('#nombre').val('');
                                        $('#cantidad').val('');
                                        $('#precio_compra').val('');
                                        $('#subtotal').val('');
                                    }
                                }
                            }
                        });

                    }
                }
            }

        }

        function eliminarProducto(id_producto, id_venta) {

            $.ajax({
                url: '<?php echo base_url(); ?>/TemporalCompra/eliminar/' + id_producto + '/' + id_venta,
                success: function(resultado) {
                    if (resultado == 0) {
                        $(tagCodigo).val('');
                    } else {
                        var resultado = JSON.parse(resultado);

                        $("#tablaProductos tbody").empty();
                        $("#tablaProductos tbody").append(resultado.datos);
                        $("#total").val(resultado.total);
                    }
                }
            });
        }
        $(function() {
            $("#completa_venta").click(function() {
                let nFilas = $("#tablaProductos tr").length;
                if (nFilas < 2) {
                    $('#modal-confirma-caja').modal('show');
                } else {
                    $("#form_venta").submit();
                }
            });
        });
    </script>