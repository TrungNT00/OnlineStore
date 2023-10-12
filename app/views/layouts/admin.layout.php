<?php $this->view('blocks/header_admin', $sub_data); ?>
<?php $this->view('blocks/sidebar_admin'); ?>

<?php
    $this->view($body, $sub_data);
?>

<?php $this->view('blocks/footer_admin'); ?>