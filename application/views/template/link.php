<?php

echo "<link rel='stylesheet' href=" . base_url('assets/plugins/bootstrap/css/bootstrap.min.css') . "></link>";
echo "<link rel='stylesheet' href=" . base_url('assets/css/toastr.css') . "></link>";
if (isset($css) && sizeof($css)) {
    foreach ($css as $c) {
        echo "<link rel='stylesheet' href=" . base_url('assets/css/' . $c . '.css') . "></link>";
    }
}
// echo "<link rel='stylesheet' href=" . base_url('assets/css/main.css') . "></link>";

echo "<script src=" . base_url('assets/plugins/jQuery/jquery-2.1.1.min.js') . "></script>";
echo "<script src=" . base_url('assets/plugins/bootstrap/js/bootstrap.min.js') . "></script>";
echo "<script src=" . base_url('assets/js/toastr.js') . "></script>";
echo "<script> var site_url = '" . site_url() . "'; var base_url = '" . base_url() . "'; </script>";
if (isset($js) && sizeof($js)) {
    foreach ($js as $j) {
        echo "<script src=" . base_url('assets/js/' . $j . '.js') . "></script>";
    }
}
echo '<script>
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
    </script>';
echo '<script> var custom_flag="' . ($checkCustomizeQuestions ? 1 : 0) . '"; 
        if (custom_flag == "1") {
            $(".svd_toolbox_title").after(custom_toolbar);
        }
    </script>';
?>