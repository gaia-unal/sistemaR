<?php
if ($sess == 1) {
    $logged = 1;
    ?>

    <link rel="stylesheet" href="<?php echo base_url() ?>asset/raty/lib/jquery.raty.css">

    <script src="<?php echo base_url() ?>asset/raty/lib/jquery.raty.js"></script>

<?php } else $logged = 0; ?>

<div id="row">
    <div class="col-lg-12">
        <a href="javascript:;" id="test">test</a>
        <?php if ($sess = 1) { ?>
            <div class="raty" username="<?php echo $user; ?>" rep_id="<?php echo $key['rep_id'] ?>" data-score="" id="<?php echo $key['lo_id'] ?>"></div>
        <?php } ?>
    </div>
</div>

