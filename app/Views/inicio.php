<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">

            <br>

            <div class="row">
                <div class="col-4">
                    <div class="card text-white bg-primary">
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
            <div class="row">
                <div class="col-6">
                    <div>
                        <canvas id="myChart" width="400" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
        const ctx = document.getElementById('myChart');
        var ventas_domingo,ventas_lunes,ventas_martes,ventas_miercoles,ventas_jueves,ventas_viernes,ventas_sabado;
        
        var cant_ventas=<?php echo $numVentas; ?>;
        var dia=new Date();
        var diaSemana=dia.getDay();

        if (diaSemana==0){
            ventas_domingo=cant_ventas;
        }
        else if (diaSemana==1){
            ventas_lunes=cant_ventas;
        }
        else if (diaSemana==2){
            ventas_martes=cant_ventas;
        }
        else if (diaSemana==3){
            ventas_miercoles=cant_ventas;
        }
        else if (diaSemana==4){
            ventas_jueves=cant_ventas;
        }
        else if (diaSemana==5){
            ventas_viernes=cant_ventas;
        }
        else if (diaSemana==6){
            ventas_sabado=cant_ventas;
        }
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes','Sabado'],
                datasets: [{
                    label: 'Numero de ventas',
                    data: [ventas_domingo, ventas_lunes, ventas_martes, ventas_miercoles, ventas_jueves, ventas_viernes,ventas_sabado],
                    borderWidth: 1,
                    backgroundColor:[
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
    </script>