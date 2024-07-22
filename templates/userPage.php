<?Php
use App\authentication\DataSqliteAuthentication;
$title = "PV-user-page";

session_start();
if (isset($_POST["disconnect"])) {
    if (isset($_POST["disconnect"])) {
        unset($_SESSION["connected"]);
    }
}


if(isset($_POST["password"]) & isset($_POST["username"])) {
    $process = new DataSqliteAuthentication($_POST["password"], $_POST["username"], "user");
    if (!$process->getStatus()) {
        $errorMessage = $process->getErrorMeassage();
    } else {
        $_SESSION["connected"] = true;
        $_SESSION["role"] = $process->role;
    }
}
$action = "user-page";
?>

<?php if(!isset($_SESSION["connected"])):?>
    <?php require_once "..\\elements\loginForm.php"?>
    <?php if (isset($errorMessage)):?>
        <div class="alert alert-danger mt-2"><p><?=$errorMessage?></p></div>
    <?php endif?>
<?php else:?>
    <h1>user</h1>
    <br>
    <?php require_once "..\\elements\logoutForm.php"?> 
<?php endif?>