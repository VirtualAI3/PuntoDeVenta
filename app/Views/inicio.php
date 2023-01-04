<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">

            <br>
            <?php
            $month = date('m');
            switch ($month) {
                case 1:
                    $monthEs = "Enero";
                    break;
                case 2:
                    $monthEs = "Febrero";
                    break;
            }
            ?>
            <div class="row">
                <div class="col-4">
                    <div class="card text-white bg-primary">
                        <div class="card-header">
                            <i class="fa-solid fa-list"></i>
                        </div>
                        <div class="card-body">
                            <?php echo $total; ?> Total productos
                        </div>
                        <a href="<?php echo base_url(); ?>/productos" class="card-footer card-link text-white">
                            Ver detalles
                        </a>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card text-white bg-success">
                        <div class="card-header">
                            <i class="fa-solid fa-cart-shopping"></i>
                        </div>
                        <div class="card-body" id="ventas">
                            <?php echo $totalVentas['total']; ?> Ventas del dia
                        </div>
                        <a href="<?php echo base_url(); ?>/ventas" class="card-footer card-link text-white">
                            Ver detalles
                        </a>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card text-white bg-danger">
                        <div class="card-body">
                            <?php echo $minimos; ?> Productos con stock minimo
                        </div>
                        <a href="<?php echo base_url(); ?>/productos/mostrarMinimos" class="card-footer card-link text-white">
                            Ver detalles
                        </a>
                    </div>
                </div>
            </div>
            <br>
            <br>
            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa-solid fa-chart-simple"></i>
                            Ventas de la semana
                        </div>
                        <div class="card-body">
                            <div>
                                <canvas id="myChart" width="400" height="300"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa-solid fa-chart-pie"></i>
                            Ventas del mes de <?php echo $monthEs; ?>
                        </div>
                        <div class="card-body">
                            <canvas id="myPieChart" width="400" height="300"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
        const ctx = document.getElementById('myChart');
        console.log(<?php echo date('w', strtotime(date('Y-m-d'))); ?>)
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo'],
                datasets: [{
                    label: 'Numero de ventas',
                    data: [<?php echo $numVentas['ventasLu'] ?>, <?php echo $numVentas['ventasMar'] ?>, <?php echo $numVentas['ventasMie'] ?>, <?php echo $numVentas['ventasJu'] ?>, <?php echo $numVentas['ventasVi'] ?>, <?php echo $numVentas['ventasSa'] ?>, <?php echo $numVentas['ventasDo'] ?>],
                    borderWidth: 1,
                    backgroundColor: [
                        'rgba(255,99,132,0.7)',
                        'rgba(54,162,235,0.7)',
                        'rgba(255,206,86,0.7)',
                        'rgba(75,192,192,0.7)',
                        'rgba(153,102,255,0.7)',
                        'rgba(255,159,64,0.7)',
                        'rgba(25,159,64,0.4)'
                    ]
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        var gtx=document.getElementById("myPieChart");
    </script>