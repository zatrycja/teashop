<?php
// echo "<script>window.history.replaceState({}, teashop, '/user/')</script>";
// $url = "http://www.test.com/test.html?parameter=hey&parameter2=ho";
// $url = strtok($url, "?");
switch($_POST["id"]){
    case '2': {
        echo "
        <li class='nav-item'>
            <a class='nav-link' href='{$_POST["xyz"]}../user/workers/modify_products/product_manage.php'>Zarządzaj produktami</a>
        </li>
        <li class='nav-item'>
            <a class='nav-link' href='{$_POST["xyz"]}../user/workers/reports/reports.php'>Raporty</a>
        </li>
        <li class='nav-item'>
            <a class='nav-link' href='{$_POST["xyz"]}../user/workers/warehouse/warehouse.php'>Magazyn</a>
        </li>
        <li class='nav-item'>
            <a class='nav-link' href='{$_POST["xyz"]}../user/workers/admin_panel/admin_panel.php'>Panel administracyjny</a>
        </li>
        ";
    }break;

    case '3': {
        echo "
        <li class='nav-item'>
        <a class='nav-link' href='{$_POST["xyz"]}../user/workers/modify_products/product_manage.php'>Zarządzaj produktami</a>
        </li>
        <li class='nav-item'>
        <a class='nav-link' href='{$_POST["xyz"]}../user/workers/reports/reports.php'>Raporty</a>
        </li>
        ";
    }break;
    case '4': {
        echo "
        <li class='nav-item'>
        <a class='nav-link' href='../user/workers/warehouse/warehouse.php'>Magazyn</a>
        </li>
        ";
    }break;
}
?>