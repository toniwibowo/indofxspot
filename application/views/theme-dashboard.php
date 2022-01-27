<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <?php include 'partials/headerStyle.php' ?>

    <link rel="stylesheet" href="<?= base_url('assets/css/dashboard/style.css') ?>">

    <link href="<?= base_url('assets/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/vendor/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') ?>" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="<?= base_url('assets/vendor/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') ?>" rel="stylesheet" type="text/css" />

</head>
<body>
    
<div class="wrapper">


<div class="sidebar" id="sidebar">
    <div class="mb-3 p-3 d-none d-sm-block">
        <a href="./" class="logo"><img src="<?= base_url('assets/') ?>images/logo.png" alt="" class="img-fluid"></a>
    </div>
    <?php 
    $menus = array(
        array('icon' => base_url().'assets/images/icon-overview.png', 'title' => 'Overview', 'url' => './dashboard'),
        array('icon' => base_url().'assets/images/icon-profile.png', 'title' => 'Profile', 'url' => './profile'),
        array('icon' => base_url().'assets/images/icon-brokers.png', 'title' => 'Brokers', 'url' => './broker'),
        array('icon' => base_url().'assets/images/icon-rebates.png', 'title' => 'Rebates', 'url' => './rebates'),
        array('icon' => base_url().'assets/images/icon-deposit.png', 'title' => 'Payment Method', 'url' => './payment'),
        array('icon' => base_url().'assets/images/icon-announcement.png', 'title' => 'Annoucement', 'url' => './announcement'),
    );
    ?>
    <div class="inner">
        <ul class="menus">
            <?php foreach ($menus as $menu) {
                echo "<li><a href='{$menu['url']}'><img src='{$menu['icon']}'>{$menu['title']}</a></li>";
            } ?>
        </ul>
    </div>
</div><!--end:sidebar--> 

<div class="inpage">


<?php if (isset($_GET['alt']) == 1) : ?>

<section class="header header-alt">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 col-12 d-flex align-items-center">
                <a href="#!" class="logo"><img src="<?= base_url('assets/') ?>images/logo.png" alt="" class="img-fluid"></a>
            </div>
            <div class="col-md-9 col-12 d-flex align-items-center justify-content-end">
                
                <button class="mm-trigger trigger btn btn-sm" data-target="#sidebar"><i class="fas fa-fw fa-bars fa-2x"></i></button>
                <button class="ms-trigger trigger btn btn-sm" data-target="#ms-bar-alt"><i class="fas fa-fw fa-search"></i></button>
                <form action="" method="post" class="search">
                    <div class="input-group">
                        <input class="input form-control" name="dt_search" id="dt_search" value="" placeholder="Search for...">
                        <button class="input-group-text" id="dt_search"><i class="fas fa-fw fa-search"></i></button>
                    </div>
                </form>
                <div class="notif-wrap d-flex align-items-center px-2">
                    <a href="#!" class="notif px-2 py-1 mx-1">
                        <i class="fas fa-fw fa-lg fa-bell"></i>
                        <span class="shadow-sm">390</span>
                    </a>
                    <a href="#!" class="notif px-2 py-1 mx-1">
                        <i class="fas fa-fw fa-lg fa-envelope"></i>
                        <span class="shadow-sm">1</span>
                    </a>
                </div>
                <div class="mini-profile d-block">
                    <a href="#!" class="mini-profile-pic border-start px-2 trigger" data-target="#profile-menu-2" onclick="return false">
                        <span class="mx-1">Douglass McGee</span>
                        <img src="<?= base_url() ?>assets/images/profile-pic.png" alt="" height="30">
                    </a>
                    <div id="profile-menu-2" class="profile-menu shadow-sm trigger-hide">
                        <ul>
                            <li><a href="#!">Profile</a></li>
                            <li><a href="#!" class="text-danger">Logout</a></li>
                        </ul>
                    </div><!--end:profile-menu-->
                </div>

            </div>
        </div>
        <div id="ms-bar-alt" class="trigger-hide">
            <div class="row">
                <div class="col">
                    <form action="" method="post" class="mini-search mt-3">
                        <div class="input-group">
                            <input class="input form-control" name="dt_search" id="dt_search" value="" placeholder="Search for...">
                            <button class="input-group-text" id="dt_search"><i class="fas fa-fw fa-search"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div><!--end:ms-bar-->
    </div>
</section><!--end:header-alt-->

<?php else : ?>

<section class="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-7 col-md-7">
                <img src="<?= base_url('assets/') ?>images/logo.png" alt="" class="img-fluid ms-5 d-block d-sm-none">
                <div class="d-none d-md-block">
                    <div class="d-flex align-items-top">
                        <div class="text-start me-4">
                            <small class="d-block">Auto Rebate:</small>
                            <div class="custom-checkbox">
                                <input type="checkbox" id="cus-cbox" class="cus-cbox">
                                <label for="cus-cbox"><span>On</span><span>Off</span></label>
                            </div><!--end:custom-checkbox-->
                        </div>

                        <div class="text-end me-4" id="rebateBalance"></div>

                        <div class="text-center py-1 mx-3">
                            <a href="<?= site_url('member/broker') ?>" class="btn btn-sm btn-primary mx-2">Add Trading Account</a>
                        </div>
                    </div>
                </div>
            </div><!--end:col-7-->
            <?php
              $firstName  = $this->session->userdata('firstName') != null ? $this->session->userdata('firstName') : '';
              $lastName   = $this->session->userdata('lastName') != null ? $this->session->userdata('lastName') : '';  
            ?>
            <div class="col-5 col-md-5 d-flex align-items-center justify-content-end">
                <button class="mm-trigger trigger btn btn-sm" data-target="#sidebar"><i class="fas fa-fw fa-bars fa-2x"></i></button>
                <button class="ms-trigger trigger btn btn-sm" data-target="#ms-bar"><i class="fas fa-fw fa-bars"></i></button>
                <div class="mini-profile d-block">
                    <a href="#!" class="mini-profile-pic px-2 trigger" data-target="#profile-menu-1" onclick="return false">
                        <span class="mx-1"><?= $firstName .' '.$lastName ?></span>
                        <img src="<?= base_url() ?>assets/images/profile-pic.png" alt="" height="30">
                    </a>
                    <div id="profile-menu-1" class="profile-menu shadow-sm trigger-hide">
                        <ul>
                            <li><a href="<?= site_url('member/profile') ?>">Profile</a></li>
                            <li><a href="#!" class="text-danger" onclick="logoutHandler(this); return false">Logout</a></li>
                        </ul>
                    </div><!--end:profile-menu-->
                </div>
            </div>
        </div>
        <div id="ms-bar" class="trigger-hide d-block d-sm-none">
            <div class="row pt-3 d-flex align-items-top">
                <div class="col-4 text-start">
                    <small class="d-block">Auto Rebate:</small>
                    <div class="custom-checkbox">
                        <input type="checkbox" id="cus-cbox" class="cus-cbox">
                        <label for="cus-cbox"><span>On</span><span>Off</span></label>
                    </div><!--end:custom-checkbox-->
                </div>
                <div class="col-8 text-start">
                    <small class="d-block">Rebate Balance:</small>
                    <b class="position-relative text-primary d-inline-block pe-1 mt-1"><i class="fas fa-fw fa-money-bill-wave-alt mx-1"></i> $182.30 <a href="#!" class="position-absolute text-secondary ps-1"><small class="fas fa-fw fa-exclamation-circle"></small></a></b>
                </div>
                <div class="col-12 d-grid mt-2">
                    <a href="#!" class="btn btn-sm btn-primary"><small>Add Trading Account</small></a>
                </div>
            </div>
        </div><!--end:ms-bar-->
    </div>
</section><!--end:header-->

<?php endif; ?>

<?= $contents ?>

<script type="text/babel">
    
    async function logoutHandler(e) {

        const doLogout = await fetch('<?= site_url('api/users/logout') ?>');
        const response = await doLogout.json()

        if (doLogout.status === 200) {
        if (response.status === 'Success') {
            window.location.href = '<?= site_url() ?>'
        }
        }


    }

    const RebateBalance = () => {

        const{useEffect, useState} = React

        const[rbtBalance, setRbtBalance] = useState(0)

        const postRebateBalance = async () => {
            const queryRebate = await fetch('<?= site_url("api/rebates/getDataRebates") ?>')
            const response = await queryRebate.json()

            if (queryRebate.status === 200) {
                if (response.status === 'Success') {
                    console.log('wallet', response.data);
                    if (response.data.length > 0) {
                        let numOfRebateBalance = 0;
                        response.data.forEach((item,i) => {
                            const lotVolume = parseFloat(item['amount']) * parseFloat(item['acc_amount'])
                            numOfRebateBalance += lotVolume
                            rebateCountingUpdate(item['wallet_id'])
                        })

                        const dtRbtBalance = new Object()
                        dtRbtBalance['customer_id'] = '<?= $this->session->userdata('custId') ?>'
                        dtRbtBalance['rbt_balance'] = numOfRebateBalance
                        dtRbtBalance['rbt_date'] = '<?= date('Y-m-d H:i:s') ?>'

                        updateRebateBalance(dtRbtBalance)
                    }
                }
            }
        }

        const updateRebateBalance = async (data) => {
            const postRebateBalance = await fetch('<?= site_url('api/rebates/rebateBalance') ?>', {
                headers:{
                    'Content-Type':'application/json'
                },
                method:'POST',
                body: JSON.stringify(data)
            })
        }

        const rebateCountingUpdate = async (walletId) => {
            const dataSubmit = {'wallet_id': walletId}
            const postCountingStatus = await fetch('<?= site_url('api/rebates/countingUpdate') ?>', {
                headers:{
                    'Content-Type':'application/json'
                },
                method:'POST',
                body: JSON.stringify(dataSubmit)
            })
            const response = await postCountingStatus.json()

            if (postCountingStatus.status === 200) {
                console.log(response);
            }else{
                console.log(response);
            }
        }

        const getRebateBalance = async () => {
            const queryRebateBalance = await fetch('<?= site_url('api/rebates/getRebateBalance') ?>')
            const response = await queryRebateBalance.json()
            if (queryRebateBalance.status === 200) {
                if (response.status === 'Success') {
                    setRbtBalance(response.data['rbt_balance'])
                }
            }
        }

        useEffect(() => {
            postRebateBalance()
            getRebateBalance()
        }, [])
        
        return(
            <div>
                <small className="d-block">Rebate Balance:</small>
                <b className="position-relative text-primary  d-inline-block pe-2 pt-1">
                    <i className="fas fa-fw fa-money-bill-wave-alt mx-1"></i> ${rbtBalance} 
                    <a href="#!" className="position-absolute text-secondary ps-1">
                        <small className="fas fa-fw fa-exclamation-circle"></small>
                    </a>
                </b>
            </div>
        )
    }

    const rebateBalanceCom = document.getElementById('rebateBalance');
    ReactDOM.render(<RebateBalance />, rebateBalanceCom)

</script>

</body>
</html>