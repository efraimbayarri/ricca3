<?php
## Release build 2013.27.5
#############################################################################################
/**
 * Professors
 * shortcode: [ricca3-professors]
 *
 * @since ricca3.v.2014.20.4
 * @author Efraim Bayarri
 */
#############################################################################################
function ricca3_shortcode_professors($atts, $content = null) {
	global $ricca3_butons_professors;

	ricca3_missatge(__('Eines dels professors','ricca3-prof'));
//	preparar ajudes als butons
	$ricca3_butons_professors['texte'][0] = __('ajuda-asistencia', 'ricca3-prof');
//		butons
	ricca3_butons( $ricca3_butons_professors, 6 );
}

#############################################################################################
/**
 * Assistencia
 * shortcode: [ricca3-assistencia]
 *
 * @since ricca3.v.2014.20.4
 * @author Efraim Bayarri
 */
#############################################################################################
function ricca3_shortcode_assistencia($atts, $content = null) {
	global $ricca3_butons_assistencia;
	
	ricca3_missatge(__('Assistencia','ricca3-prof'));
//	preparar ajudes als butons
	$ricca3_butons_assistencia['texte'][0] = __('ajuda-professors', 'ricca3-prof');
//		butons
	ricca3_butons( $ricca3_butons_assistencia, 6 );
}