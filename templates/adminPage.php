<?Php
use App\authentication\DataSqliteAuthentication;
$title = "PV-admin-page";

session_start();
if (isset($_POST["disconnect"])) {
    if ($_POST["disconnect"] === "true") {
        unset($_SESSION["connected"]);
        unset($_SESSION["role"]);
    }
}

if(isset($_POST["password"]) & isset($_POST["username"])) {
    $process = new DataSqliteAuthentication($_POST["password"], $_POST["username"], "admin");
    if (!$process->getStatus()) {
        $errorMessage = $process->getErrorMeassage();
    } else {
        $_SESSION["connected"] = true;
        $_SESSION["role"] = $process->role;

    }
}
$action = "admin-page";
?>

<?php if(!isset($_SESSION["connected"]) || $_SESSION["role"] !== "admin"):?>
    <?php require_once "..\\elements\loginForm.php"?>
    <?php if (isset($errorMessage)):?>
        <div class="alert alert-danger mt-2"><p><?=$errorMessage?></p></div>
    <?php endif?>
<?php else:?>
    <h1>admin</h1>
    <br>
    <?php require_once "..\\elements\logoutForm.php"?> 
<?php endif?>