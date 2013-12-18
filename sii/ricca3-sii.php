<?php
## Release build 2013.27.5
#############################################################################################
/**
 * Sistema d'Intercanvi d'Informació (SII)
 * shortcode: [ricca3-sii]
 *
 * @since ricca3.v.2013.51.1
 * @author Efraim Bayarri
 */
#############################################################################################
function ricca3_shortcode_sii($atts, $content = null) {
	global $ricca3_butons_sii;	
	
	ricca3_missatge(__('Sistema d\'Intercanvi d\'Informació (SII)','ricca3-sii'));	
	
	ricca3_butons( $ricca3_butons_sii, 6 );
	##	BEGIN debug
	//	print_r($_POST);
	//	dump($_POST);
	//	dump_r($_POST);
	##	END debug
	
}

#############################################################################################
/**
 * Sistema d'Intercanvi d'Informació (SII) - OPCIONS
 * shortcode: [ricca3-sii-options]
 *
 * @since ricca3.v.2013.51.1
 * @author Efraim Bayarri
 */
#############################################################################################
function ricca3_shortcode_sii_opcions($atts, $content = null) {
	global $ricca3_butons_sii;
	global $wpdb;
	
	ricca3_missatge(__('Sistema d\'Intercanvi d\'Informació (SII) - OPCIONS','ricca3-sii'));

	ricca3_butons( $ricca3_butons_sii, 6 );


	
}

#############################################################################################
/**
 * Sistema d'Intercanvi d'Informació (SII) - FITXERS
 * shortcode: [ricca3-sii-fitxers]
 *
 * @since ricca3.v.2013.51.1
 * @author Efraim Bayarri
 */
#############################################################################################
function ricca3_shortcode_sii_fitxers($atts, $content = null) {
	global $ricca3_butons_sii;
	global $wpdb;

	ricca3_missatge(__('Sistema d\'Intercanvi d\'Informació (SII) - FITXERS','ricca3-sii'));

	ricca3_butons( $ricca3_butons_sii, 6 );
	
	$query = $wpdb->prepare('SELECT * FROM ricca.ricca3_alumne '.
		'INNER JOIN ricca3_alumne_especialitat on ricca3_alumne_especialitat.idalumne=ricca3_alumne.idalumne '.
		'INNER JOIN ricca3_any ON ricca3_any.idany = ricca3_alumne_especialitat.idany '.
		'INNER JOIN ricca3_grups ON ricca3_grups.idgrup = ricca3_alumne_especialitat.idgrup '.
		'INNER JOIN ricca3_cursos ON ricca3_cursos.idcurs = ricca3_grups.idcurs '.
		'INNER JOIN ricca3_especialitats ON ricca3_especialitats.idespecialitat = ricca3_grups.idespecialitat '.
		'INNER JOIN ricca3_estat ON ricca3_estat.idestat = ricca3_alumne_especialitat.idestat_es '.
		'WHERE ricca3_alumne_especialitat.idany=13 '.
		'ORDER BY ricca3_especialitats.idespecialitat, cognomsinom ');
	$dades_sii = $wpdb->get_results( $query, ARRAY_A );
	

}


#############################################################################################
/**
 * Sistema d'Intercanvi d'Informació (SII) - Modificacions
 * shortcode: [ricca3-sii-fitxers]
 *
 * @since ricca3.v.2013.51.1
 * @author Efraim Bayarri
 */
#############################################################################################
function ricca3_shortcode_sii_modif($atts, $content = null) {
	global $ricca3_butons_sii;
	global $ricca3_sii_modif;
	global $wpdb;
	global $current_user;
//	dump_r($_POST);
	get_currentuserinfo();
//		comprovar si hem de guardar les dades de tots el crèdits
	$num_cols=count($ricca3_sii_modif,1)/count($ricca3_sii_modif,0)-1;
	if( isset( $_POST['accio'] ) && $_POST['accio'] == 'actualitzartot'){
		for( $i=0; $i < count($_POST['idalumne']); $i++){
			for( $j=0; $j < $num_cols; $j++){
				if(!$ricca3_sii_modif['nomeslect'][$j]){
					$result = $wpdb->update('ricca3_alumne',
						array( $ricca3_sii_modif['nomupdate'][$j] => stripslashes(strtoupper($_POST[$ricca3_sii_modif['nombd'][$j]][$i])), 'stampuser' => $current_user->user_login, 'stampplace' => 'ricca_shortcode_sii_modif' ),
						array('idalumne' => $_POST['idalumne'][$i]) );
				}
			}
		}
	}
//	
	ricca3_missatge(__('Sistema d\'Intercanvi d\'Informació (SII) - MODIFICACIONS','ricca3-sii'));
	ricca3_butons( $ricca3_butons_sii, 6 );
//
	printf('<form method="post" action="" name="cercar"><table dir="ltr" class="cercar"><tr>', NULL);
	printf('<td><button type="submit" name="cercar" value="actualitzar" title="%s"><img src=%s/ricca3/imatges/ricca3-llistar.png  border="0" /></button></td>', __('ajuda-llistar-alumnes', 'ricca3-sii'), WP_PLUGIN_URL);	
//		drop per el any
	$data_any = $wpdb->get_results('SELECT * FROM ricca3_any', ARRAY_A );
	ricca3_drop_any( __('Any:','ricca3-alum'), 'any', $data_any, 'idany', 'any', __('ajuda_drop_any', 'ricca3-alum'), 'actual' );
//		drop per el grup
	$data_grup = $wpdb->get_results('SELECT * FROM ricca3_grups WHERE actiu_gr = 1 ORDER BY grup ', ARRAY_A );
	ricca3_drop( __('Grup:','ricca3-alum'), 'grup',  $data_grup,  'idgrup', 'grup',  __('ajuda_drop_ grup', 'ricca3-alum'), FALSE );	
//		tanquem la barra de selecció
	printf('</tr></table></form>', NULL);	
//		Si ja hem fet la cerca, mostrar els resultats
	if( isset( $_POST['cercar'] ) && $_POST['cercar'] == "actualitzar" ){
		$query = $wpdb->prepare('SELECT * FROM ricca.ricca3_alumne '.
				'INNER JOIN ricca3_alumne_especialitat on ricca3_alumne_especialitat.idalumne=ricca3_alumne.idalumne '.
				'INNER JOIN ricca3_any ON ricca3_any.idany = ricca3_alumne_especialitat.idany '.
				'INNER JOIN ricca3_grups ON ricca3_grups.idgrup = ricca3_alumne_especialitat.idgrup '.
				'INNER JOIN ricca3_cursos ON ricca3_cursos.idcurs = ricca3_grups.idcurs '.
				'INNER JOIN ricca3_especialitats ON ricca3_especialitats.idespecialitat = ricca3_grups.idespecialitat '.
				'INNER JOIN ricca3_estat ON ricca3_estat.idestat = ricca3_alumne_especialitat.idestat_es '.
				'WHERE ricca3_alumne_especialitat.idany=%s AND idestat_es=1 ',$_POST['any']);
		if( $_POST['grup']  != "-1") $query = substr_replace( $query," AND ricca3_grups.idgrup='" .$_POST['grup']."' ", strlen( $query ) , 0 );
		$query=substr_replace( $query," ORDER BY ricca3_especialitats.idespecialitat, cognomsinom ",strlen( $query ), 0 );
//	fem el query i guardem tots els resultats a $data_view
		$data_view = $wpdb->get_results( $query, ARRAY_A);
//	llistat del alumnes del filtre
		printf('<form method="post" action="" target="_self" name="creadlu" id="especformtot">', NULL);
		ricca3_graella( $ricca3_sii_modif, $data_view );
		printf('</table>', NULL);
		ricca3_desar('accio', 'actualitzartot', __('ajuda-tab-credits-tots-desar', 'ricca3-sii'));
		printf('</td><td><INPUT type="hidden" name="any" value="%s" /></td><td><INPUT type="hidden" name="grup" value="%s" /></td><td><INPUT type="hidden" name="cercar" value="%s" /></td></tr></table></form>', $_POST['any'], $_POST['grup'], $_POST['cercar']);
	}
}