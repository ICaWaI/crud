<?php
require_once __DIR__ . '/lib/perpage.php';
require_once __DIR__ . '/lib/DataSource.php';
$database = new DataSource();

$typ = "";
$artikelnr = "";

$queryCondition = "";
if (! empty($_POST["search"])) {
    foreach ($_POST["search"] as $k => $v) {
        if (! empty($v)) {

            $queryCases = array(
                "typ",
                "artikelnr"
            );
            if (in_array($k, $queryCases)) {
                if (! empty($queryCondition)) {
                    $queryCondition .= " AND ";
                } else {
                    $queryCondition .= " WHERE ";
                }
            }
            switch ($k) {
                case "typ":
                    $typ = $v;
                    $queryCondition .= "typ LIKE '" . $v . "%'";
                    break;
                case "artikelnr":
                    $artikelnr = $v;
                    $queryCondition .= "artikelnr LIKE '" . $v . "%'";
                    break;
            }
        }
    }
}
$orderby = " ORDER BY id desc";
$sql = "SELECT * FROM 'bauelemente' " . $queryCondition;
$href = 'index.php';

$perPage = 3;
$page = 1;
if (isset($_POST['page'])) {
    $page = $_POST['page'];
}
$start = ($page - 1) * $perPage;
if ($start < 0)
    $start = 0;

$query = $sql . $orderby . " limit " . $start . "," . $perPage;
$result = $database->select($query);

if (! empty($result)) {
    $result["perpage"] = showperpage($sql, $perPage, $href);
}
?>
<html>
<head>
<title>ISASEARCH Bauelement Suche</title>
<link rel="stylesheet" href="css/style.css" />
<link rel="stylesheet" href="css/table.css" />
<link rel="stylesheet" href="css/form.css" />
<style>
button, input[type=submit].btnSearch {
    width: 140px;
    font-size: 14px;
    margin: 10px 0px 0px 10px;
}

.btnReset {
    width: 140px;
    padding: 8px 0px;
    font-size: 14px;
    cursor: pointer;
    border-radius: 25px;
    color: #000000;
    border: 2px solid #d2d6dd;
    margin-top: 10px;
}

button, input[type=submit].perpage-link {
    width: auto;
    font-size: 14px;
    padding: 5px 10px;
    border: 2px solid #d2d6dd;
    border-radius: 4px;
    margin: 0px 5px;
    background-color: #fff;
    cursor: pointer;
}

.current-page {
    width: auto;
    font-size: 14px;
    padding: 5px 10px;
    border: 2px solid #d2d6dd;
    border-radius: 4px;
    margin: 0px 5px;
    background-color: #efefef;
    cursor: pointer;
}
</style>
</head>

<body>
    <div class="phppot-container">
        <h1>ISASEARCH Bauelement Suche</h1>

        <div>
            <form name="frmSearch" method="post" action="">
                <div>
                    <p>
                        <input type="text" placeholder="Bezeichnung"
                            name="search[typ]"
                            value="<?php echo $typ; ?>" /> <input
                            type="text" placeholder="Artikelnummer"
                            name="search[artikelnr]"
                            value="<?php echo $artikelnr; ?>" /> <input
                            type="submit" name="go" class="btnSearch"
                            value="Search"> <input type="reset"
                            class="btnReset" value="Reset"
                            onclick="window.location='index.php'">
                    </p>
                </div>
                <div>
                    <a class="font-bold float-right" href="add.php">Neu anlegen</a>
                </div>
                <table class="stripped">
                    <thead>
                        <tr>
                            <th>Typ</th>
                            <th>Bezeichnung</th>
                            <th>Artikelnummer</th>
                            <th>Zusatz</th>
                            <th>Anlage</th>
                            <th>Zeichnungspfad</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    if (! empty($result)) {
                        foreach ($result as $key => $value) {
                            if (is_numeric($key)) {
                                ?>
                     <tr>
                            <td><?php echo $result[$key]['typ']; ?></td>
                            <td><?php echo $result[$key]['bezeichnung']; ?></td>
                            <td><?php echo $result[$key]['artikelnr']; ?></td>
                            <td><?php echo $result[$key]['zusatz']; ?></td>
                            <td><?php echo $result[$key]['anlage']; ?></td>
                            <td><?php echo $result[$key]['zeichnung']; ?></td>
                            <td><a class="mr-20"
                                href="edit.php?id=<?php echo $result[$key]["id"]; ?>">Ändern</a>
                                <a
                                href="delete.php?action=delete&id=<?php echo $result[$key]["id"]; ?>">Löschen</a>
                            </td>
                        </tr>
                    <?php
                            }
                        }
                    }
                    if (isset($result["perpage"])) {
                        ?>
                        <tr>
                            <td colspan="6" align=right> <?php echo $result["perpage"]; ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</body>
</html>