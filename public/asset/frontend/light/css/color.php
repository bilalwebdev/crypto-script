<?php

header("Content-Type:text/css");

$primary_color = '#' .$_GET['primary_color'];

?>


:root {
    --clr-main: <?php echo $primary_color; ?>;
}