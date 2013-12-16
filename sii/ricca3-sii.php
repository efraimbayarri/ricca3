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
 * Sistema d'Intercanvi d'Informació (SII)
 * shortcode: [ricca3-sii]
 *
 * @since ricca3.v.2013.51.1
 * @author Efraim Bayarri
 */
#############################################################################################
function ricca3_shortcode_sii_opcions($atts, $content = null) {
	global $ricca3_butons_sii;

	ricca3_missatge(__('Sistema d\'Intercanvi d\'Informació (SII) - OPCIONS','ricca3-sii'));

	ricca3_butons( $ricca3_butons_sii, 6 );
	##	BEGIN debug
	//	print_r($_POST);
	//	dump($_POST);
	//	dump_r($_POST);
	##	END debug

}

#############################################################################################
/**
 * Sistema d'Intercanvi d'Informació (SII)
 * shortcode: [ricca3-sii]
 *
 * @since ricca3.v.2013.51.1
 * @author Efraim Bayarri
 */
#############################################################################################
function ricca3_shortcode_sii_fitxers($atts, $content = null) {
	global $ricca3_butons_sii;

	ricca3_missatge(__('Sistema d\'Intercanvi d\'Informació (SII) - FITXERS','ricca3-sii'));

	ricca3_butons( $ricca3_butons_sii, 6 );
	##	BEGIN debug
	//	print_r($_POST);
	//	dump($_POST);
	//	dump_r($_POST);
	##	END debug

}