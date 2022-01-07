<?php require("config.php");?>
<?php include("header.php");?>
<?php     
?>
<?php if ( isset($_GET['view']) ):
    switch ($_GET['view']) :
        case "form" :
        default :
            include("home.php");
    endswitch;
else :
    include("home.php");
endif;?>

<?php include("footer.php");?>
<?php include "debug.php";?>
