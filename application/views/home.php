<div id="root"></div>

<?php include 'partials/footer.php' ?>

<script src="<?= base_url('assets/js/app.js') ?>"></script>
<script>

    const app = new APP();
    app.baseUrl         = '<?= base_url() ?>';
    app.jsHooks         = [
        {file: 'components/home/homeComponents.js', type : 'text/babel'},
        {file: 'pages/home.js', type : 'text/babel'}            
    ];
    app.config = {passKey: '<?= $passKey ?>', sid: '<?= $sid ?>'}
    app.render();
    
    console.log('APP', app)

</script>