<?php

require_once __DIR__ . '/lib/DataSource.php';

$database = new DataSource();

if (isset($_POST["submit"])) {
    $sql = "INSERT INTO 'bauelemente'('typ', 'bezeichnung', 'artikelnr', 'zusatz', 'anlage', 'zeichnung') VALUES(?, ?, ?, ?, ?, ?)";
    $paramType = 'ssisss';
    $paramValue = array(
        $_POST["typ"],
        $_POST["bezeichnung"],
        $_POST["artikelnr"],
        $_POST["zusatz"],
        $_POST["anlage"],
        $_POST["zeichnung"]
    );
    $result = $database->insert($sql, $paramType, $paramValue);
    if (! $result) {
        $message = "problem in Adding to database. Please Retry.";
    } else {
        header("Location:index.php");
    }
}
?>

<html>

<head>

<link href="css/style.css" type="text/css" rel="stylesheet" />
<link href="css/form.css" type="text/css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-2.1.1.min.js"
    type="text/javascript"></script>
<script src="./js/validation.js" type="text/javascript"></script>
</head>
<body>
    <div class="phppot-container tile-container text-center">
        <form name="frmToy" method="post" action="" id="frmToy"
            onClick="return validate();">
            <?php if(! empty($message)){?>
            <div class="error">
                <?php echo $message;?>
                </div><?php }?>
            <h1>Neuer Eintrag</h1>
            <div class="row">
                <label class="text-left">Typ: <span id="typ-info"
                    class="validation-message"></span></label><input
                    type="text" name="typ" id="typ"
                    class="full-width ">
            </div>
            <div class="row">
                <label class="text-left">Bezeichnung: <span id="bezeichnung-info"
                    class="validation-message"></span></label> <input
                    type="text" name="bezeichnung" id="bezeichnung"
                    class="full-width ">
            </div>
            <div class="row">
                <label class="text-left">Artikelnummer: <span
                    id="artikelnr-info" class="validation-message"></span></label><input
                    type="text" name="artikelnr" id="artikelnr"
                    class="full-width ">
            </div>
            <div class="row">
                <label class="text-left">Zusatz: <span id="zusatz-info"
                    class="validation-message"></span></label><input
                    type="text" name="zusatz" id="zusatz"
                    class="full-width">
            </div>
            <div class="row">
                <label class="text-left">Maschine: <span
                    id="anlage-info" class="validation-message"></span></label><input
                    type="text" name="anlage" id="anlage"
                    class="full-width ">
            </div>
            <div class="row">
                <label class="text-left">Pfad zur Zeichnung: <span
                    id="zeichnung-info" class="validation-message"></span></label><input
                    type="text" name="zeichnung" id="zeichnung"
                    class="full-width ">
            <div class="row">
                <input type="submit" name="submit" id="btnAddAction"
                    class="full-width " value="Add" />
            </div>
        </form>
    </div>
</body>
</html>