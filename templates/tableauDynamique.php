<?Php

use App\NumberHelper;


$title = "PV-tableau-dynamique";
$pdo = new PDO("sqlite:C:\dev\PV\\test4\db\products.db", null, null, [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
]);

// organisation
$firstData = $pdo->query("SELECT * FROM products")->fetch();
foreach($firstData as $column => $value) {
    $columns[] = $column;
}
$sort = "id";
$dir = "asc";

if (isset($_GET["sort"]) && isset($_GET["dir"])) 
{
    if (in_array($_GET["sort"], $columns)) 
    {
        $sort = $_GET["sort"];
        
        switch ($_GET["dir"]) 
        {
            case "desc":
                $dir = "desc";
                break;
        }
    }
}

// pagination
define("LIMIT", 20);
$nbdata = (int)($pdo->query("SELECT COUNT(id) as count FROM products")->fetchAll()[0]["count"]);
$nbPages = ceil($nbdata/LIMIT);
$offset = 0;

if (isset($_GET["offset"])) {
    if ($_GET["offset"] < 0) {
        $_GET["offset"] = 0;
    } elseif ($_GET["offset"] > $nbdata - LIMIT) {
        $_GET["offset"] = $nbdata - LIMIT;
    }
    $offset = (int)$_GET["offset"]; 
}
// recherche
$sortQuery = "ORDER BY " . $sort . " " . $dir;
$query = "SELECT * FROM products " . $sortQuery . " LIMIT " . LIMIT . " OFFSET $offset";

if (isset($_GET["q"]) && !empty($_GET["q"])) {
    $query = "SELECT * FROM products WHERE city LIKE :city " . $sortQuery . " LIMIT " . LIMIT . " OFFSET :offset";
    $statement = $pdo->prepare($query);
    $statement->execute([
        "city" => "%" . $_GET["q"] . "%",
        "offset" => $offset,
    ]);
    $result = $statement->fetchAll();
    $nbdata = count($result);
    $nbPages = ceil($nbdata/LIMIT);
} else {
    $result = $pdo->query($query)->fetchAll();
}
?>
<h1 class="m-5">Les biens immobiliers</h1>
<br>
<form action="">
    <div class="form-group">
        <input type="text" class="form-control" name="q" placeholder="rechercher par ville" value = <?= isset($_GET["q"]) ? htmlentities($_GET["q"]) : ""?>>
    </div>
    <button class="btn btn-primary">rechercher</button>
</form>

<table class="table table-striped">
    <thead>
        <tr>
            <?php foreach($result[0] as $column => $value):?>
                <th><a href="<?= "?" . http_build_query($_GET). "&sort=$column&dir=" . (($sort === $column)?($dir === "asc" ? "desc" : "asc"):"asc")?>"><?=$column?>
                <?= $sort === $column ? ($dir === "asc" ? "^" : "v"): "" ?>
                </a></th>
            <?php endforeach?>
        </tr>
    </thead>
    <tbody>
        <?php foreach($result as $key => $row):?>
            <tr>
                <?php foreach($row as $name => $value):?>
                    <td><?= is_float($value) ? NumberHelper::price($value, "euros") : $value ?></td>
                <?Php endforeach?>
            </tr>
        <?php endforeach?>
    </tbody>
</table>

<?php if($nbPages > 1):?>
    <?php if ($offset > 0):?>
        <a class="btn btn-primary mb-5 text-white" href="?<?= http_build_query($_GET) . "&offset=" . ((int)$_GET["offset"]-LIMIT ?? 0 )?>">page precedente</a>
    <?php endif?>
    <?php if ($offset < $nbdata - LIMIT):?>
        <a class="btn btn-primary mb-5 text-white" href="?<?= http_build_query($_GET) . "&offset=" . ((int)$_GET["offset"]+LIMIT ?? LIMIT) ?>">page suivante</a>
    <?php endif?>
<?php endif?>