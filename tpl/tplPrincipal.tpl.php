<?php
    /**
     * Template principal
     * 
     * @author: Guillaume CARAYON
     * @version : 1.0.0
     * 
     */
    $dataView = $_SESSION['dataView'];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link type="text/css" rel="stylesheet" href="<?php echo $dataView['css']; ?>" />
        <title><?php echo $dataView['title']; ?></title>
    </head>
    <body>
        <div id="zoneHaute">
            <!-- Cette partie inclut la bannière du site  -->
            <?php include $dataView['zoneHaute']; ?>
        </div>
        
        <div id='zoneRecherche'>
            <!-- Cette partie inclut la zone de recherche -->
            <?php include $dataView['zoneRecherche']; ?>
        </div>
        
        <div id="zoneMenu">
            <!-- Cette partie inclut toute la partie relative au menu -->
            <?php include $dataView['zoneMenu']; ?>
        </div>
        <div id="zoneCentrale">
            <!-- Cette partie inclut tout le traitement concernant la partie centrale -->
            <?php include $dataView['zoneCentrale']; ?>
        </div>
    </body>
</html>
