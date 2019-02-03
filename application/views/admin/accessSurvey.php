<?php
$options = "";
foreach ($surveys as $survey) {
    $options .= "<option value='" . $survey . "'>" . $survey . "</option>";
}
?>
<body id="app-container" class="menu-default show-spinner">
    <main>
        <div class="container-fluid ">            
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Free</label>
                                    <select class="form-control select2-single" id="free">
                                        <option label="&nbsp;">&nbsp;</option>
                                        <?php echo $options; ?>
                                    </select>
                                </div>

                                <div class="col-sm-4">                                    
                                    <label>Freemium</label>
                                    <select class="form-control select2-multiple" id="freemium" multiple="multiple">
                                        <option label="&nbsp;">&nbsp;</option>

                                        <?php echo $options; ?>
                                    </select>
                                </div>

                                <div class="col-sm-4">                                    
                                    <label>Paid</label>
                                    <select class="form-control select2-multiple" id="paid" multiple="multiple">
                                        <option label="&nbsp;">&nbsp;</option>

                                        <?php echo $options; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-xs-12">
                                    <button class="btn btn-success default float-right simple-icon-check" id="save_access"> Save Settings</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>