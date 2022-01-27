<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"></script> -->
<script src="<?= base_url() ?>assets/vendor/jquery/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="<?= base_url() ?>assets/vendor/crypto-js/crypto-js.js"></script>
<script src="<?= base_url() ?>assets/vendor/owl.carousel/owl.carousel.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/datepicker/bootstrap-datepicker.js"></script>

<script src="<?= base_url() ?>assets/js/@babel/standalone/babel.min.js"></script>
<script src="<?= base_url() ?>assets/js/react/react.development.js"></script>
<script src="<?= base_url() ?>assets/js/react/react-dom.development.js"></script>

<script src="<?= base_url() ?>assets/vendor/sweetalert2/sweetalert2.min.js"></script>

<?php if ($this->uri->segment(1) == '' || $this->uri->segment(1) == null ) { ?>
    <script src="<?= base_url() ?>assets/js/main.js"></script>
<?php }else{ ?>
    <script src="<?= base_url() ?>assets/js/dashboard/main.js"></script>
<?php } ?>



