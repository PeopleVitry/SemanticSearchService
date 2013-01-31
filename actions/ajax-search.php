<?php
//connexion à la base de données 
define('DB_NAME', 'vitrydb');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_HOST', 'localhost');
 
$link   =   mysql_connect( DB_HOST , DB_USER , DB_PASSWORD );
mysql_select_db( DB_NAME , $link );

 
//recherche des résultats dans la base de données
$result =   mysql_query( 'SELECT *
                          FROM objet
                          WHERE code< 23 And libelle LIKE \'%' . safe( $_GET['q'] ) . '%\'
                          LIMIT 0,20' );

// affichage d'un message "pas de résultats"
if( mysql_num_rows( $result ) == 0 )
{
?>
    <h3 style="text-align:center; margin:10px 0;">Pas de r&eacute;sultats pour cette recherche</h3>
<?php
}
else
{
    // parcours et affichage des résultats
    while( $post = mysql_fetch_object( $result ))
    {
    ?>
        <div class="article-result">
		
		<div class='objet'><a href='?code=<?php echo $post->code; ?>'><img src='http://gtrvitry.net/elgg/mod/ssearch/images/<?php echo $post->images;?>' border='0' title='<?php echo $post->libelle; ?>' alt='<?php echo $post->libelle; ?>'></a></div>
        
        </div>
    <?php
    }
}
/*****
fonctions
*****/
function safe($var)
{
	$var = mysql_real_escape_string($var);
	$var = addcslashes($var, '%_');
	$var = trim($var);
	$var = htmlspecialchars($var);
	return $var;
}
?>