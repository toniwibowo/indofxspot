<div id="root"></div>

<?php include 'partials/dashboard-footer.php' ?>

<script src="<?= base_url('assets/js/app.js') ?>"></script>
<script src="<?= base_url('assets/vendor/datatables.net/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('assets/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('assets/vendor/moment/min/moment.min.js') ?>"></script>

<script>

    const app = new APP();
    app.baseUrl         = '<?= base_url() ?>';
    app.jsHooks         = [
        {file: 'components/dashboard/rebatesComponents.js', type : 'text/babel'},
        {file: 'pages/rebates.js', type : 'text/babel'}            
    ];
    app.sessionHooks = {isLogedIn: '<?= $isLogedIn ?>', custId: '<?= $custId ?>'}
    app.render();

</script>