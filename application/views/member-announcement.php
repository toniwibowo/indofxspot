<div id="root"></div>

<?php include 'partials/dashboard-footer.php' ?>

<script src="<?= base_url('assets/js/app.js') ?>"></script>
<script>

    const app = new APP();
    app.baseUrl         = '<?= base_url() ?>';
    app.jsHooks         = [
        {file: 'components/dashboard/announcementComponents.js', type : 'text/babel'},
        {file: 'pages/announcement.js', type : 'text/babel'}            
    ];
    app.sessionHooks = {isLogedIn: '<?= $isLogedIn ?>', custId: '<?= $custId ?>'}
    app.render();

</script>