<footer class="py-4 bg-light mt-auto">
    <div class="container-fluid px-4">
        <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">Copyright &copy; Diego Apaza <?php echo date('Y'); ?> </div>
            <div>
                <a href="https://facebook.com/" target="_blank"><i class="fa-brands fa-facebook" style="font-size: 2rem;"></i></a>
                &middot;
                <a href="#">Terms &amp; Conditions</a>
            </div>
        </div>
    </div>
</footer>
</div>
</div>

<script src="<?php echo base_url(); ?>/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url(); ?>/js/scripts.js"></script>
<script src="<?php echo base_url(); ?>/js/simple-datatables@latest.js"></script>
<script src="<?php echo base_url(); ?>/js/datatables-simple-demo.js"></script>
<script src="<?php echo base_url(); ?>/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/demo/datatables-demo.js"></script>
<script>
    $('#modal-confirma').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'))
    });
</script>
<script>
    /*new simpleDatatables.DataTable('#datatablesSimple', {
        labels: {
            placeholder: "Search...",
            perPage: "Show {select} entries per page",
            noRows: "No entries to found",
            info: "Showing {start} to {end} of {rows} entries",
        },
    });*/
</script>
</body>

</html>