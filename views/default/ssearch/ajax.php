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
	
<div  id ="recherche" style="width:250px; height:50px;">
<form method="get" class="ajax">
  <label for="q">Rechercher</label>
  <input type="text" name="q" id="q" required/>  
</form>
</div>

<div id="results"></div>
<?php
}
else
{
	
echo '<h3><a href="./">Retour => Recherche</a></h3>';	
//2eme etape -- affiche les class
$sql_class = " select * from class where  objet_code='$code'";
//execution de la requete 
$res_class  = mysql_query($sql_class );
	while ($donnees_class= mysql_fetch_array($res_class))
	{
		extract($donnees_class);
		
		echo "<div class='objet'><a href='?code=$code&numero=$numero'><img src="<?Php echo $baseurl;?>images/$images' border='0' title='$type_class' alt='$type_class'></a></div>";	
	}	
	
?>	
<hr style="clear:both;">	
<!--3eme etape -- affiche google maps-->

	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
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
$num=$_GET['numero'];
$sql_interface = "select* from interface where class_numero=$num and Latitude !=0";
$res_interface = mysql_query($sql_interface);
	while($donnees_interface= mysql_fetch_array($res_interface)){
		
		extract($donnees_interface);
		$x = $Latitude;
		$y = $longitude;
		$z = $adresse;
		$i = $id;
		$s = $Titre;
        $a = $telephone;		
?>	
	 var marqueur<?php echo $i; ?> = new google.maps.Marker({
				position: new google.maps.LatLng(<?php echo $x;?>,<?php echo $y;?>),
				map: carte,
				title:"<?php echo $s; 
		             echo ' ';
					 echo  $z;
					 echo ' ';
					 echo $a;
		         ?>"
	});
    
      
<?php }//end while ?>
		
    }//end function initialiser	
	</script>
<div id="carte" style="width:100%; height:100%"></div>
		
<?php
}//end else
?>

