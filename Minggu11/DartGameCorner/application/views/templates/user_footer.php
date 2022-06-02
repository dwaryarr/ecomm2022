</main>
<footer class="py-4 bg-light mt-auto">
    <div class="container-fluid px-4">
        <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">Copyright &copy; <?= date('Y') ?> <b>Dart</b>GameCorner - All rights reserved. </div>
            <div>
                <a href="#">Privacy Policy</a>
                &middot;
                <a href="#">Terms &amp; Conditions</a>
            </div>
        </div>
    </div>
</footer>
</div>
</div>
<!-- Bootstrap -->

<script src="<?= base_url() ?>vendor/bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js"></script>

<script src="<?= base_url() ?>assets/js/scripts.js"></script>
<!-- chart -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js" crossorigin="anonymous"></script>
<!-- datatables js-->
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
<script src="<?= base_url() ?>assets/js/datatables-simple-demo.js"></script>
<!-- FontAwesome -->
<script src="<?= base_url() ?>vendor/fontawesome-6.1.1/js/all.js"></script>
<!-- SweetAlert -->
<script src="<?= base_url() ?>assets/js/sweetalert2.all.min.js"></script>
<script src="<?= base_url(); ?>assets/js/switch.js"></script>
<script>
    $('.roleaccessmenu').on('click', function() {
        const menuId = $(this).data('menu');
        const roleId = $(this).data('role');

        $.ajax({
            url: "<?= base_url('admin/roleaccess/changeaccess') ?>",
            type: 'post',
            data: {
                menuId: menuId,
                roleId: roleId
            },
            success: function() {
                document.location.href = "<?= base_url('admin/roleaccess/roleaccessmenu/') ?>" + roleId;
            }
        });
    });
</script>
</body>

</html>