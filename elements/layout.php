<?php
function navLink(string $href, string $name) {
    return <<<HTML
        <li class="nav-item" role="presentation"><a href=".$href" class="nav-link active rounded-5" id="home-tab2" data-bs-toggle="tab" type="button" role="tab" aria-selected="true">$name</a></li>
HTML;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="..\style.css"> -->
    <title><?= $title ?? "PV"?></title>
    <script type="module">
        const MONTHS = 1
        const YEARS = 0
        const DAYS = 2

        function addDays(date, days) {
            const ndt = new Date(date.getTime())
            ndt.setDate(date.getDate()+ days)
            return ndt
        }

        function addInterval(date, intervals) {
            const dp = [
                date.getFullYear(),
                date.getMonth(),
                date.getDate(),
                date.getHours(),
                date.getMinutes(),
                date.getSeconds(),
                date.getMilliseconds()
            ]
        
            for (const [unit, interval] of Object.entries(intervals)) {
                dp[unit] += interval
            }

            return new Date(...dp)

        }

        const today = new Date()
        const future = addInterval(today, {
            [MONTHS]: 3,
            [DAYS]: 12
        })
        console.log(today)
        console.log(future)
    </script>
</head>
<body>
    <header>
        <nav>
            <ul class="nav nav-pills nav-fill gap-2 p-1 small bg-primary rounded-5 shadow-sm" id="pillNav2" role="tablist" style="--bs-nav-link-color: var(--bs-white); --bs-nav-pills-link-active-color: var(--bs-primary); --bs-nav-pills-link-active-bg: var(--bs-white);">
                <?= navLink($router->generate("_home"), "home")?>
                <?= navLink($router->generate("_contact"), "contact")?>
                <?= navLink($router->generate("_catalogue"), "catalogue")?>
                <?= navLink($router->generate("_tableauDynamique"), "tableau Dynamique")?>
                <?= navLink($router->generate("_connexion"), "connexion")?>
            </ul>
        </nav>
    </header>
    <main>
        <div class="container">
            <?= $pageContent?>
        </div>
    </main>
    <footer>
        
    </footer>
</body>
</html>

