<?php
use App\database\Sqlite;
$title = "PV-connection";

$pdo = new Sqlite("..\db\data.sqlite");
$data = $pdo->queryResult("SELECT * FROM users");
?>
<div class="mt-3">
    <a href="admin-page">page reservée au admins</a>
    <br>
    <a href="user-page">page reservée au utilisateurs</a>
</div>

<table class="table mt-3">
    <thead>
        <th>id</th>
        <th>pseudo</th>
        <th>role</th>
    </thead>
    <tbody>
        <?Php foreach($data as $user):?>
        <tr>
            <?php foreach([$user["id"], $user["username"], $user["role"]] as $property):?>
            <td><?= $property?></td>
            <?php endforeach?>
        </tr>
        <?php endforeach?>
    </tbody>
</table>