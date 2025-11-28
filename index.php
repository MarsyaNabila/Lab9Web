<?php
include "header.php";

$page = isset($_GET['page']) ? $_GET['page'] : 'home';

// Routing Modular
$path = explode('/', $page);

if ($path[0] == "user") {
    include "user/" . $path[1] . ".php";
} else {
    include "pages/" . $path[0] . ".php";
}

include "footer.php";
?>