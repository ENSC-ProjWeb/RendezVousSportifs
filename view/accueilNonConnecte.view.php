<?php
    /**
     * Vue accueil non connecté
     * 
     * @author: Guillaume CARAYON
     * @version: 1.0.0
     * 
     */
?>
<table width="50%">
    <?php
        for ($i = 0; $i<4; $i++)
        {
            $nomImage = "./img/vignette.jpg";
            echo "<tr>
                    <td><a href='#'><img src='$nomImage' alt='vignSport' width='250px'/></a></td>
                    <td><a href='#'><img src='$nomImage' alt='vignSport' width='250px'/></a></td>
                    <td><a href='#'><img src='$nomImage' alt='vignSport' width='250px'/></a></td>
                </tr>
                <tr>
                    <td><a href='#'> Nom sport 1 </a></td>
                    <td><a href='#'>Nom sport 2</a></td>
                    <td><a href='#'>Nom sport 3</a></td>
            </tr>
            <tr>
            <td><a href='#'>Nom event 1</a></td>
            <td><a href='#'>Nom event 2</a></td>
            <td><a href='#'>Nom event 3</a></td>
            </tr>
            <tr>
            <td>Par : <a href='#'>organisateur 1</a></td>
            <td>Par : <a href='#'>organisateur 2</a></td>
            <td>Par : <a href='#'>organisateur 3</a></td>
            </tr>
            <tr>
            <td>Le 01/23/4567 à 89h01</td>
            <td>Le 01/23/4567 à 89h01</td>
            <td>Le 01/23/4567 à 89h01</td>
            </tr>
            <tr>
            <td> A Bordeaux </td>
            <td> A Bayonne </td>
            <td> A Gif-Sur-Yvette </td>
            </tr>";
        }
   ?> 
</table>


