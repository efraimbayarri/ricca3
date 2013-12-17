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