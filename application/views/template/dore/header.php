<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dore jQuery</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
        echo "<link rel='stylesheet' href=" . base_url('assets/font/iconsmind/style.css') . "></link>";
        echo "<link rel='stylesheet' href=" . base_url('assets/font/simple-line-icons/css/simple-line-icons.css') . "></link>";
        echo "<link rel='stylesheet' href=" . base_url('assets/css/vendor/bootstrap.min.css') . "></link>";
        echo "<link rel='stylesheet' href=" . base_url('assets/css/vendor/bootstrap-float-label.min.css') . "></link>";
        echo "<link rel='stylesheet' href=" . base_url('assets/css/dore.main.css') . "></link>";
        echo "<link rel='stylesheet' href=" . base_url('assets/css/toastr.css') . "></link>";
        if (isset($css) && sizeof($css)) {
            foreach ($css as $c) {
                echo "<link rel='stylesheet' href=" . base_url('assets/css/' . $c . '.css') . "></link>";
            }
        }
    ?>
</head>

