<?php

$id_compra = uniqid();
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <form method="POST" id="form_compra" name="form_compra" action="<?php echo base_url(); ?>/compras/guarda" autocomplete="off">
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <input type="hidden" name="id_producto" id="id_producto">
                            <input type="hidden" name="id_compra" id="id_compra" value="<?php  echo $id_compra; ?>">
                            <label for="">Codigo</label>

                            <input type="text" class="form-control" id="codigo" placeholder="Escribe el codigo y enter" onkeyup="buscarProducto(event,this,this.value)" name="codigo" autofocus>
                            <label for="codigo" id="resultado_error" style="color: red;"></label>
                        </div>
                        <div class="col-12 col-sm-4">
                            <label for="">Nombre del producto</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" disabled>
                        </div>
                        <div class="col-12 col-sm-4">
                            <label for="">Cantidad</label>
                            <input type="text" class="form-control" id="cantidad" name="cantidad" onkeyup="CantidadSub(event,this.value);">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <label for="">Precio de compra</label>
                            <input type="text" class="form-control" id="precio_compra" name="precio_compra" disabled>
                        </div>
                        <div class="col-12 col-sm-4">
                            <label for="">Subtotal</label>
                            <input type="text" class="form-control" id="subtotal" name="subtotal" disabled>
                        </div>
                        <div class="col-12 col-sm-4">
                            <label for=""><br>&nbsp;</label>
                            <button id="agregar_producto" type="button" class="btn btn-primary" name="agregar_producto" onclick="agregarProducto(id_producto.value,cantidad.value,'<?php echo $id_compra; ?>')">Agregar producto</button>
                        </div>
                    </div>
                </div>
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
                <div class="row">
                    <div class="col-12 col-lg-6 col-sm-6 offset-md-6">
                        <label for="" style="font-weight:bold; font-size:30px; text-align:center;">Total $</label>
                        <input type="text" id="total" name="total" size="7" readonly="true" value="0.00" style="font-weight:bold; font-size:30px; text-align:center;">
                        <button type="button" id="completa_compra" class="btn btn-success">Completar compra</button>
                    </div>
                </div>
            </form>
        </div>
    </main>
    <script>
        $(document).ready(function() {
            $("#completa_compra").click(function(){
                let nFila=$("#tablaProductos tr").length;
                if(nFila<2){

                } else {
                    $("#form_compra").submit();
                }
            });
        });

        function buscarProducto(e, tagCodigo, codigo) {
            var enterKey = 13;
            if (codigo != '') {
                if (e.which == enterKey) {
                    $.ajax({
                        url: '<?php echo base_url(); ?>/productos/buscarPorCodigo/' + codigo,
                        dataType: 'json',
                        success: function(resultado) {
                            if (resultado == 0) {
                                $(tagCodigo).val('');
                            } else {
                                $(tagCodigo).removeClass('has-error');

                                $('#resultado_error').html(resultado.error);

                                if (resultado.existe) {
                                    $('#id_producto').val(resultado.datos.id);
                                    $('#nombre').val(resultado.datos.nombre);
                                    $('#cantidad').val(1);
                                    $('#precio_compra').val(resultado.datos.precio_compra);
                                    $('#subtotal').val(resultado.datos.precio_compra);
                                    $('#cantidad').focus();
                                } else {
                                    $('#id_producto').val('');
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

        function CantidadSub(e, cantidad) {
            var enterKey = 13;
            if (cantidad != '') {
                if (e.which == enterKey) {
                    var subtotal;
                    var precio = $('#precio_compra').val();
                    subtotal = cantidad * precio;
                    $('#subtotal').val(subtotal.toFixed(2));
                }
            }
        }

        function agregarProducto(id_producto, cantidad, id_compra) {

            if (id_producto != null && id_producto != 0 && cantidad > 0) {

                $.ajax({
                    url: '<?php echo base_url(); ?>/TemporalCompra/insertar/' + id_producto + '/' + cantidad + '/' + id_compra,
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

        function eliminarProducto(id_producto, id_compra) {

            $.ajax({
                url: '<?php echo base_url(); ?>/TemporalCompra/eliminar/' + id_producto + '/' + id_compra,
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
    </script>