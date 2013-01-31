<?php
$baseurl = elgg_get_site_url().'mod/ssearch/';

header('content-type: text/html;charset=UTF-8');

include("functions.php");
connectiondb();
//recuperation du code de l 'objet
$code = $_GET["code"];

if(!isset($code) && empty($code))	
{	
?>
<h1 style="color:#046380;">Semantic Search</h1>	
<div id ="recherche" style="width:350px">
<form method="get" class="ajax">
  <label for="q">Rechercher</label>
  <input type="text"name="q" id="q" required/>  
</form>
</div>
<div id="results"></div>
<?php
}
else
{
	
echo '<h3><a href="./">Retour => Recherche</a></h3>';
mysql_query("SET NAMES 'utf8'");	
//2eme etape -- affiche les class
$sql_class = " select * from class where  objet_code='$code'";
//execution de la requete 
$res_class  = mysql_query($sql_class );
	while ($donnees_class= mysql_fetch_array($res_class))
	{
		extract($donnees_class);
		
		echo "<div class='objet'><a href='?code=$code&numero=$numero'><img src='".$baseurl."images/$images' border='0' title='$type_class' alt='$type_class'></a></div>";	
	}	
$num=$_GET['numero'];
$sql_interface = "select* from interface where class_numero=$num and Latitude !=0";
$res_interface = mysql_query($sql_interface);
?>	
<hr style="clear:both;">	
<!--3eme etape -- affiche google maps-->
<div id="carte" style="width:100%; height:100%;margin-left:25px auto;"></div>
	<script type="text/javascript">
		function initialiser() {
		
			var latlng = new google.maps.LatLng(48.794, 2.389);
			//objet contenant des propriétés avec des identificateurs prédéfinis dans Google Maps permettant
			//de définir des options d'affichage de notre carte
			var options = {
				center: latlng,
				zoom: 14,
				mapTypeId: google.maps.MapTypeId.ROADMAP
				};
				
				//constructeur de la carte qui prend en paramêtre le conteneur HTML
				//dans lequel la carte doit s'afficher et les options
				var carte = new google.maps.Map(document.getElementById("carte"), options);		
<?php
	while($donnees_interface= mysql_fetch_array($res_interface)){
		
		extract($donnees_interface);
		$x = $latitude;
		$y = $longitude;
		$z = $adresse;
		$i = $id;
		$s = $titre;
        $a = $telephone;	
        $url = $url;		
?>	
   
	 var marqueur<?php echo $i; ?> = new google.maps.Marker({
				position: new google.maps.LatLng(<?php echo $x;?>,<?php echo $y;?>),
				map: carte
	});
    
	 var contenuInfoBulle<?php echo $i; ?> = "<h5><?php echo $s ?></h5><p><?php echo $z ?></p><p><?php echo $a ?></p><p><a href='<?php echo $url ?>' target='_blank'><?php if(!empty($url)){ echo $url;} else{ echo "Voir le lien"; }  ?></a></p>";
	 var infoBulle<?php echo $i; ?>  = new google.maps.InfoWindow({
					content: contenuInfoBulle<?php echo $i; ?> 
				})
	google.maps.event.addListener(marqueur<?php echo $i; ?>, 'click', function() {
					infoBulle<?php echo $i; ?>.open(carte, marqueur<?php echo $i; ?>);
				});
			
				
<?php }//end while ?>
    }//end function initialiser

	</script>	

<?php
}//end else
?>

