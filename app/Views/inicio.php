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
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card text-white shadow-lg p-2 mb-3 rounded border-start border-bottom-0 border-end-0 border-top-0 border-primary border-5 div-hover-blue">
                        <a href="<?php echo base_url(); ?>/productos" class="card-link text-black text-decoration-none align-middle">
                            <div class="card-body" id="ventas">
                                <div class="card-title fs-6 text-primary fw-bold">
                                    Total productos
                                </div>
                                <div class="float-start ps-1">
                                    <?php echo $total; ?>
                                </div>
                                <div style="font-size: 3rem;" class="float-end pb-0 translate-middle">
                                    <i class="fa-solid fa-shop text-muted"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card text-white shadow-lg p-2 mb-3 rounded border-start border-bottom-0 border-end-0 border-top-0 border-success border-5 div-hover-green">
                        <a href="<?php echo base_url(); ?>/ventas" class="card-link text-black text-decoration-none align-middle">
                            <div class="card-body" id="ventas">
                                <div class="card-title fs-6 text-success fw-bold">
                                    VENTAS DEL DIA
                                </div>
                                <div class="float-start ps-1">
                                    <?php if ($totalVentas['total'] == 0) {
                                        echo "0.00";
                                    } else {
                                        echo $totalVentas['total'];
                                    }
                                    ?>
                                </div>
                                <div style="font-size: 3rem;" class="float-end pb-0 translate-middle">
                                    <i class="fa-solid fa-sack-dollar text-muted"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card text-white shadow-lg p-2 mb-3 rounded border-start border-bottom-0 border-end-0 border-top-0 border-danger border-5 div-hover-danger">
                        <a href="<?php echo base_url(); ?>/productos/mostrarMinimos" class="card-link text-black text-decoration-none align-middle">
                            <div class="card-body" id="ventas">
                                <div class="card-title fs-6 text-danger fw-bold">
                                    Productos con stock minimo
                                </div>
                                <div class="float-start ps-1">
                                    <?php echo $minimos; ?>
                                </div>
                                <div style="font-size: 3rem;" class="float-end pb-0 translate-middle">
                                    <i class="fa-solid fa-clipboard-list text-muted"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <br>
            <br>
            <div class="row">
                <div class="col-12 col-lg-6 pb-2">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa-solid fa-chart-simple"></i>
                            Ventas de la semana
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="myChart" width="400" height="300"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 pb-2">
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
        var myChart=new Chart(ctx, {
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
            maintainAspectRatio: false,
            responsive: true,
            options: {
                
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins:{
                    legend: {
                        display: false,
                    }
                }
            }
        });
        var gtx = document.getElementById("myPieChart");
    </script>