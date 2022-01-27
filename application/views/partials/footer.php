<?php 
    $getDeposit = $this->db->order_by('dt_depositDate', 'DESC')->limit(10)->get('deposit');
    $getWithdraw = $this->db->order_by('dt_withdrawDate', 'DESC')->limit(10)->get('withdrawal');


?>

<div class="rotator">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="rotator__slider owl-carousel">
                    <?php 
                    
                    if ($getDeposit->num_rows() > 0) {
                        foreach ($getDeposit->result_array() as $key => $value) {
                            $statusClass = $value["dt_status"] == "onProcess" ? "failed rounded-pill" : "success rounded-pill";
                            $status = $value["dt_status"] == "onProcess" ? "Proses" : "Sukses";
                            echo '<div class="item">
                            <div class="row">
                                <div class="col-md-4">
                                    <span>'.date('d-m-Y H:i:s', strtotime($value['dt_depositDate'])).'</span>
                                </div>
                                <div class="col-md-3">
                                    <span>'.$value['dt_noWallet'].'USD</span>
                                </div>
                                <div class="col-md-3">
                                    <span>IDR '.number_format($value['dt_depositIdr'],2,',','.').'</span>
                                </div>
                                <div class="col-md-2">
                                    <span class="'.$statusClass.'">'.$status.'</span>
                                </div>
                            </div>
                        </div>';
                        }
                    }
                    
                    if ($getWithdraw->num_rows() > 0) {
                        foreach ($getWithdraw->result_array() as $key => $value) {
                            $statusClass = $value["dt_status"] == "onProcess" ? "failed rounded-pill" : "success rounded-pill";
                            $status = $value["dt_status"] == "onProcess" ? "Proses" : "Sukses";
                            echo '<div class="item">
                            <div class="row">
                                <div class="col-md-4">
                                    <span>'.date('d-m-Y H:i:s', strtotime($value['dt_withdrawDate'])).'</span>
                                </div>
                                <div class="col-md-3">
                                    <span>'.$value['dt_noWallet'].'USD</span>
                                </div>
                                <div class="col-md-3">
                                    <span>USD '.number_format($value['dt_withdrawal'],2,'.',',').'</span>
                                </div>
                                <div class="col-md-2">
                                    <span class="'.$statusClass.'">'.$status.'</span>
                                </div>
                            </div>
                        </div>';
                        }
                    }
                    
                    ?>
                    
                    
                </div><!--end:rotator__slider-->
            </div>
        </div>
    </div>
</div><!--end:rotator-->


<div class="about">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="inner">
                    <?php $getTerm = $this->db->where('pages_id', 5)->get('pages') ?>
                    <?php if($getTerm->num_rows() > 0): ?>
                    <?php $row = $getTerm->row_array() ?>
                    <?= $row['description_en'] ?>
                    <?php endif ?>    
                </div><!--end:inner-->
            </div>
        </div>
    </div>
</div><!--end:about-->

<footer class="footer mt-4 mb-2 py-2">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="copyr text-center">
                    Copyright &copy; <?php echo date('Y'); ?> | <a href="#!">Syarat dan Ketentuan</a>
                </div><!--end:copyr-->
            </div>
        </div>
    </div>
</footer><!--end:footer-->

<div class="smodal">
    <div class="smodal-overlay modal-toggle"></div>
    <div class="smodal-wrapper modal-transition">
        <div class="smodal-header">
            <button class="smodal-close smodal-toggle">
                <i class="fas fa-fw fa-times"></i>
            </button>
            <h2 class="smodal-heading">Status: <span></span></h2>
        </div>
        <div class="smodal-body">
            <div class="smodal-content"></div>
        </div>
    </div>
</div>

<?php include 'footerScript.php' ?>