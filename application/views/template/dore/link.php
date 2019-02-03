<?php

echo "<script> var site_url = '" . site_url() . "'; var base_url = '" . base_url() . "'; </script>";
if (isset($mainMenu) && isset($subMenu)) {
    echo "<script> var mainMenu = '" . $mainMenu . "'; var subMenu = '" . $subMenu . "'; </script>";
}
echo "<script src=" . base_url('assets/js/vendor/jquery-3.3.1.min.js') . "></script>";
echo "<script src=" . base_url('assets/js/vendor/bootstrap.bundle.min.js') . "></script>";
?>
<script>
$(document).ready(function() {
    if (typeof mainMenu != "undefined" && mainMenu != "home") {
        $('#' + mainMenu).addClass("active");

        if (typeof subMenu != "undefined") {
            $('#' + subMenu).addClass("active");
        }
    } 
});
</script>
<?php

if (isset($vendorJS) && sizeof($vendorJS)) {
    foreach ($vendorJS as $j) {
        echo "<script src=" . base_url('assets/js/vendor/' . $j . '.js') . "></script>";
    }
}
echo "<script src=" . base_url('assets/js/dore/dore.script.js') . "></script>";
echo "<script src=" . base_url('assets/js/dore/scripts.js') . "></script>";
echo "<script src=" . base_url('assets/js/toastr.js') . "></script>";


if (isset($js) && sizeof($js)) {
    foreach ($js as $j) {
        echo "<script src=" . base_url('assets/js/dore/' . $j . '.js') . "></script>";
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
?>