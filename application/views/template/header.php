<!DOCTYPE html>
<html>

<head>
    <title><?php echo $title;?></title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
    if ($flag == "editor") {
    ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.2.0/ace.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.2.0/worker-json.js" type="text/javascript" charset="utf-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.2.0/mode-json.js" type="text/javascript" charset="utf-8"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/knockout/3.4.1/knockout-debug.js"></script>
    <script src="https://unpkg.com/survey-knockout"></script>
    <link rel="stylesheet" href="https://unpkg.com/survey-knockout/survey.css" />

    <script src="https://unpkg.com/surveyjs-editor"></script>
    <link rel="stylesheet" href="https://unpkg.com/surveyjs-editor/surveyeditor.css" />
    <link rel="stylesheet" href="<?php echo base_url("assets/css/download-file.css");?>" />

    <?php
    } else {
        echo "<script> var json = " . $json . "</script>";
    ?>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@3.3.7/dist/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
    <link rel="stylesheet" href="<?php echo base_url("assets/css/survey.css");?>">
    <script src="<?php echo base_url("assets/js/survey/survey.jquery.js"); ?>"></script>    
    <?php
    }
    ?>
</head>

<body>
