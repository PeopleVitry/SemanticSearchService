<?php
$baseurl = elgg_get_site_url().'mod/ssearch/';
?>
<script type="text/javascript">
$(document).ready( function() {
  // d�tection de la saisie dans le champ de recherche
  $('#q').keyup( function(){
    $field = $(this);
    $('#results').html(''); // on vide les resultats
    $('#ajax-loader').remove(); // on retire le loader
 
    // on commence � traiter � partir du 2�me caract�re saisie
    if( $field.val().length >1 )
    {
      // on envoie la valeur recherch� en GET au fichier de traitement
      $.ajax({
  	type : 'GET', // envoi des donn�es en GET ou POST
	url : '<?Php echo $baseurl;?>actions/ajax-search.php' , // url du fichier de traitement
	data : 'q='+$(this).val() , // donn�es � envoyer en  GET ou POST
	beforeSend : function() { // traitements JS � faire AVANT l'envoi
		$field.after('<img src="<?Php echo $baseurl;?>images/ajax-loader.gif" alt="loader" id="ajax-loader" height="20" width="20"/>'); // ajout d'un loader pour signifier l'action
	},
	success : function(data){ // traitements JS � faire APRES le retour d'ajax-search.php
		$('#ajax-loader').remove(); // on enleve le loader
		$('#results').html(data); // affichage des r�sultats dans le bloc
	}
      });
    }		
  });
});	
</script>