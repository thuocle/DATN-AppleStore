<?php
session_start();

if (isset($_GET['cong'])) {
    $opid = $_GET['cong'];
    $prod = array();
    
    foreach ($_SESSION['cart'] as $item) {
        if ($item['opid'] == $opid) {
            if ($item['sl'] < 10) {
                $tangsl = $item['sl'] + 1;
                $item['sl'] = $tangsl;
            }
        }
        
        $prod[] = $item;
    }
    
    $_SESSION['cart'] = $prod;
    header('Location:../apple-store/cart.php');
}

if (isset($_GET['tru'])) {
    $opid = $_GET['tru'];
    $prod = array();
    
    foreach ($_SESSION['cart'] as $item) {
        if ($item['opid'] == $opid) {
            if ($item['sl'] > 1) {
                $tangsl = $item['sl'] - 1;
                $item['sl'] = $tangsl;
            }
        }
        
        $prod[] = $item;
    }
    
    $_SESSION['cart'] = $prod;
    header('Location:../apple-store/cart.php');
}

if (isset($_GET['idxoa']) && isset($_SESSION['cart'])) {
    $opid = $_GET['idxoa'];
    $prod = array();
    
    foreach ($_SESSION['cart'] as $item) {
        if ($item['opid'] != $opid) {
            $prod[] = $item;
        }
    }
    
    $_SESSION['cart'] = $prod;
    header('Location:../apple-store/cart.php');
}

if (isset($_GET['xoatatca']) && $_GET['xoatatca'] == 1) {
    unset($_SESSION['cart']);
    header('Location:../apple-store/cart.php');
}
?>
