<?php
require_once __DIR__ . "/lib/DataSource.php";
$database = new DataSource();
if (! empty($_POST["submit"])) {
    $sql = "UPDATE bauelemente SET typ=?, bezeichnung=?, artikelnr=?, zusatz=?, anlage=?, zeichnung=?, WHERE id=? ";
    $paramType = 'ssisss';
    $paramValue = array(
        $_POST["typ"],
        $_POST["bezeichnung"],
        $_POST["artikelnr"],
        $_POST["zusatz"],
        $_POST["anlage"],
        $_POST["zeichnung"],
        $_GET["id"]
    );
    $result = $database->execute($sql, $paramType, $paramValue);
    if (! $result) {
        $message = "Ändern fehlgeschlagen!";
    } else {
        header("Location:index.php");
    }
}
$sql = "SELECT * FROM bauelemente WHERE id=? ";
$paramType = 'i';
$paramValue = array(
    $_GET["id"]
);
$result = $database->select($sql, $paramType, $paramValue);
?>


<html>

<head>
<link rel="stylesheet" href="css/style.css" />
<link rel="stylesheet" href="css/form.css" />
<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="js/validation.js"></script>
</head>

<body>
    <div class="phppot-container tile-container text-center">
        <form name="frmToy" method="post" action="" id="frmToy" onClick="return validate();">
        <?php if(! empty($message)){?>
            <div class="error">
                <?php echo $message;?>
                </div><?php }?>
                <h1>ändere die Eingabe</h1>
            <div class="row">
                <label class="text-left">Typ: <span id="typ-info" class="validation-message"></span></label>
                <input type="text" name="typ" id="typ" class="full-width" value="<?php echo $result[0]["typ"]; ?>">
            </div>
            <div class="row">
                <label class="text-left">Bezeichnung: <span id="bezeichnung-info" class="validation-message"></span></label>
                <input type="text" name="bezeichnung" id="bezeichnung" class="full-width" value="<?php echo $result[0]["bezeichnung"]; ?>">
            </div>
            <div class="row">
                <label class="text-left">Artikelnummer: <span id="artikelnr-info" class="validation-message"></span></label>
                <input type="text" name="artikelnr" id="artikelnr" class="full-width" value="<?php echo $result[0]["artikelnr"]; ?>">
            </div>
            <div class="row">
                <label class="text-left">Zusatz: <span id="zusatz-info" class="validation-message"></span></label>
                <input type="text" name="zusatz" id="zusatz" class="full-width" value="<?php echo $result[0]["zusatz"]; ?>">
            </div>
            <div class="row">
                <label class="text-left">Anlage: <span id="anlage-info" class="validation-message"></span></label>
                <input type="text" name="anlage" id="anlage" class="full-width" value="<?php echo $result[0]["anlage"]; ?>">
            </div>
            <div class="row">
                <label class="text-left">Pfad zur Zeichnung: <span id="zeichnung-info" class="validation-message"></span></label>
                <input type="text" name="zeichnung" id="zeichnung" class="full-width" value="<?php echo $result[0]["zeichnung"]; ?>">
            <div class="row">
                <input type="submit" name="submit" id="btnAddAction" class="full-width " value="Save" />
            </div>
        </form>
    </div>
</body>
</html>