<form action="" method="post">
<select name="asso" id="">

<?php
require('bdd.php');
// récuperation des association
$reponse = $bdd->query('SELECT DISTINCT nom_association FROM animaux');

while($donnees = $reponse->fetch()){
   echo '<option value="'.$donnees['nom_association'].'">'.$donnees['nom_association'].'</option>';
}

?>
</select>
<input type="submit" value="trier les animaux par association">
</form>
<?php
// recuperation des animaux
if(isset($_POST['asso'])){
$asso = $_POST['asso'];
$liste_animaux_asso = array();
$rep = $bdd->query(" SELECT * FROM animaux WHERE nom_association ='$asso' ");
    while($info = $rep->fetch()){
        echo $info['nom_animaux'].'<br>' ;
        array_push($liste_animaux_asso, [$info['type_animaux'],$info['nom_animaux'],$info['surface_cage']]);
    } 


//creation des palettes
$aire_palette =9600;

$liste_palette = []; 
$palette=0;
//boucle sur les animaux d'une asso
for($i=0;$liste_animaux_asso[$i]>=count($liste_animaux_asso)-1;$i++){
    
    $animauxPalette= array();
    echo '/'.$i.'tour<br>';
    
    if($palette <= $aire_palette){//si il reste de la place on ajoute la cage sur la palette
        $palette += $liste_animaux_asso[$i][2];
        echo $palette;
        
        
        array_push($animauxPalette,[$liste_animaux_asso[$i][0],$liste_animaux_asso[$i][1]]);
        echo'<pre>';
        print_r($animauxPalette);
        echo '</pre>';
    }else{ //sinon on ajoute la palette à la liste des palette
        echo $palette;
       
        array_push($liste_palette, $animauxPalette);
      
        
    }
}
echo'<pre>';
print_r($liste_palette);
echo '</pre>';
}
?>