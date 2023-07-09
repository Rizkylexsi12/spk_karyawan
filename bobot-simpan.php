<?php
    require "include/conn.php";
    $kriteria = $_POST['kriteria'];
    $bobot = $_POST['bobot'];
    $attribute = $_POST['attribute'];
    // $x = $db->query($sql);
    // var_dump($x);
    $sql = "INSERT INTO saw_criterias (criteria, weight, attribute) VALUES ('$kriteria', '$bobot', '$attribute')";
    
    if ($db->query($sql) === true) {
        header("location:./bobot.php");
    } else {
        echo "Error: " . $sql . "<br>" . $db->error;
    }
?>