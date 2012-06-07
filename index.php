<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Recherche des objets</title>
<link rel="stylesheet" type="text/css" href="style.css" />


</head>
            
<body >
<div id="bloc_page">
            <header>
                
                
                <nav  style='text-align:center;' >
                    <ul style='list-style-type: none'>
                        <li style='display: inline-block;' 'margin-right: 15px;' ><a href="index.php">Activity</a></li>
                        <li style='display: inline-block;'  'margin-right: 15px;'><a href="index.php">Blogs</a></li>
						<li style='display: inline-block;' 'margin-right: 15px;' ><a href="index.php"><strong>Bookmarks</strong></a></li>
	
                        <li style='display: inline-block;'  'margin-right: 15px;' ><a href="index.php"> Files</a></li>
                        <li style='display: inline-block;'  'margin-right: 15px;'><a href="index.php">Groups</a></li>
						<li style='display: inline-block;' 'margin-right: 15px;' ><a href="index.php">More</a></li>
						<li style='display: inline-block;' 'margin-right: 15px;' ><a href="index.php"><strong>Recherche</strong></a></li>
                    </ul>
               </nav>
            </header>
			
<h1> Recherche sémantique</h1>
<form method="post" action="index.php">
<p>
<label for=" ">Selectionner un objet</label></br> 

<select id="code" name="objet" onchange="form.submit()"  >
<option value="" >  </option>

<?php
//Connexion à la base de données
//



//$code = $type = $libelle = "";
 $connection= mysql_connect("localhost", "root", "");
 if (!$connection){
  		die('Could not connect: ' . mysql_error());
  	}
mysql_select_db("peopledb", $connection);

$sql = 
    "
	    select 
            libelle ,code
		from 
		    objet 
		where 
		    type='service'
	";
	
	$res 	= mysql_query($sql);
		while ($donnees= mysql_fetch_array($res))
		{
	    ?>
	         <p>
	                 
	                 <option value='<?php echo $donnees['code'] ?> '> <?php echo  $donnees['libelle']; ?> </option>
					 
             <p>
			 <?php
         }
?>
</select>
 
 </form> 
 
 
<form method="post" action="index.php">
<p>
<label for=" ">Selectionner un nom</label></br> 
<select id="choix" name="service"   onchange="form.submit()"  >
<option value="" >   </option>

<?php
//Connexion à la base de données
//

//$code = $type = $libelle = "";
$cod=$_POST['objet'];
 $connection= mysql_connect("localhost", "root", "");
 if (!$connection){
  		die('Could not connect: ' . mysql_error());
  	}
mysql_select_db("peopledb", $connection);

$sql = 
    "
	    select 
            type_class ,numero 
		from 
		    class 
		inner join
		    objet
		on 
		     class.objet_code=objet.code
		where 
		   objet_code='$cod'
	";
	
	$res 	= mysql_query($sql);
		while ($donnees= mysql_fetch_array($res))
		{
	
	    ?>
	         
	                

	                <option value='<?php echo $donnees['numero'] ?>' > <?php echo  $donnees['type_class']; ?> </option>
             
			 <?php
         }
?>
</select>
<?php //<input type="submit" value="Rechercher"  id ="choix"  /> ?>

</p>
</form>

<form method="post" action="index.php">
<p>
<label for=" ">Selectionner votre Objet</label></br> 
<select id="choix" name="objet" >

<?php
//Connexion à la base de données
//

//$code = $type = $libelle = "";
$num=$_POST['service'];
 $connection= mysql_connect("localhost", "root", "");
 if (!$connection){
  		die('Could not connect: ' . mysql_error());
  	}
mysql_select_db("peopledb", $connection);

$sql = 
    "
	    select 
            i.nom
			,
			i.adresse
			, 
			i.telephone   
		from 
		    interface as i
		inner join
		    class as c
		on 
		    i.class_numero=c.numero
		where 
		    c.numero='$num'
	";
	
	$res 	= mysql_query($sql);
		while ($donnees= mysql_fetch_array($res))
		{
	    ?>
	         
			  <option  value='' > 
			   <?php
			       echo $donnees['nom'];
                   echo $donnees['adresse'];
                   echo $donnees['telephone'];				   
			   ?>
			   </option>
	                 
	                 
             
			 <?php
         }
		 
?>

 <input type="submit" value="Rechercher" id="choix"  >
 </form>
 
 
 <footer>
                <div id="tweet">
                    <h2> Welcome</h1>
                </div>
        
            </footer>
 
 

</body>
</html>