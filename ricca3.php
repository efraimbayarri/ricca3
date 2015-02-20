<?php
/**
 * Plugin Name: RICCA3
 * Plugin URI: http://efraim.cat/
 * Author: Efraim Bayarri
 * Author URI: http://efraim.cat/
 * Version: 2015.08.5
 * Description: Projecte RIC-CA Versió 3 (Escola Ramon i Cajal) 
 * Release Version:(build 2013.27.5)
 * Release Date: 5 juliol 2013
 */

##	BEGIN debug
require_once(WP_PLUGIN_DIR.'/ricca3/dumper.php');
require_once(WP_PLUGIN_DIR.'/ricca3/dump_r.php');
##	END debug
//require_once(WP_PLUGIN_DIR.'/ricca3/translate/class_translate.php');

require_once(WP_PLUGIN_DIR.'/ricca3/inc/ricca3-conf.php');
require_once(WP_PLUGIN_DIR.'/ricca3/inc/ricca3-inc.php');
require_once(WP_PLUGIN_DIR.'/ricca3/inc/ricca3-db-conf.php');

require_once(WP_PLUGIN_DIR.'/ricca3/admin/ricca3-admin.php');

require_once(WP_PLUGIN_DIR.'/ricca3/alumnes/ricca3-alumnes.php');
require_once(WP_PLUGIN_DIR.'/ricca3/avaluacions/ricca3-avaluacions.php');
require_once(WP_PLUGIN_DIR.'/ricca3/dades/ricca3-dades.php');
require_once(WP_PLUGIN_DIR.'/ricca3/sii/ricca3-sii.php');
require_once(WP_PLUGIN_DIR.'/ricca3/professors/ricca3-professors.php');

if (is_admin()){
	add_action('admin_menu', 'ricca3_admin_page');
	add_action('admin_init', 'ricca3_admin_init');
}
add_action( 'plugins_loaded', 'ricca3_init');

add_shortcode( 'ricca3-alumnes',      'ricca3_shortcode_alumnes' );
add_shortcode( 'ricca3-cercalumne',   'ricca3_shortcode_cercalumne' );
add_shortcode( 'ricca3-noualumne',    'ricca3_shortcode_noualumne' );
add_shortcode( 'ricca3-assist',       'ricca3_shortcode_assist' );
add_shortcode( 'ricca3-impassist',    'ricca3_shortcode_impassist' );
add_shortcode( 'ricca3-dadesalumne',  'ricca3_shortcode_dadesalumne' );
add_shortcode( 'ricca3-editardades',  'ricca3_shortcode_editardades' );
add_shortcode( 'ricca3-especalum',    'ricca3_shortcode_especalum' );
add_shortcode( 'ricca3-imphistorial', 'ricca3_shortcode_imphistorial' );
add_shortcode( 'ricca3-novaespec',    'ricca3_shortcode_novaespec' );
add_shortcode( 'ricca3-baixaespec',   'ricca3_shortcode_baixaespec' );
add_shortcode( 'ricca3-credalu',      'ricca3_shortcode_credalu' );
add_shortcode( 'ricca3-alumcreacred', 'ricca3_shortcode_alumcreacred' );
add_shortcode( 'ricca3-butlleti',     'ricca3_shortcode_butlleti' );
add_shortcode( 'ricca3-impbutlleti',  'ricca3_shortcode_impbutlleti' );
add_shortcode( 'ricca3-especrepe',    'ricca3_shortcode_especrepe' );
add_shortcode( 'ricca3-canviany',     'ricca3_shortcode_canviany' );
add_shortcode( 'ricca3-mailings',     'ricca3_shortcode_mailings' );
add_shortcode( 'ricca3-credpendents', 'ricca3_shortcode_credpendents' );
add_shortcode( 'ricca3-pendactual',   'ricca3_shortcode_pendactual' );
add_shortcode( 'ricca3-pregrup',      'ricca3_shortcode_pregrup' );
add_shortcode( 'ricca3-afegircredit', 'ricca3_shortcode_afegircredit' );
add_shortcode( 'ricca3-notafinal',    'ricca3_shortcode_notafinal' );
add_shortcode( 'ricca3-caratula',     'ricca3_shortcode_caratula' );
add_shortcode( 'ricca3-impcaratula',  'ricca3_shortcode_impcaratula' );
add_shortcode( 'ricca3-esborraalumne','ricca3_shortcode_esborraalumne' );
add_shortcode( 'ricca3-alumnes-sense-especialitat','ricca3_shortcode_alumnes_sense_especialitat' );
add_shortcode( 'ricca3-llistalu',     'ricca3_shortcode_llistalu' );
add_shortcode( 'ricca3-impalu',       'ricca3_shortcode_impalu' );



add_shortcode( 'ricca3-avaluacions',  'ricca3_shortcode_avaluacions' );
add_shortcode( 'ricca3-actes',        'ricca3_shortcode_actes' );
add_shortcode( 'ricca3-impactes',     'ricca3_shortcode_impactes' );
add_shortcode( 'ricca3-impactesrepe', 'ricca3_shortcode_impactesrepe' );
add_shortcode( 'ricca3-notes',        'ricca3_shortcode_notes' );
add_shortcode( 'ricca3-obser',        'ricca3_shortcode_obser' );
add_shortcode( 'ricca3-certif',       'ricca3_shortcode_certif' );
add_shortcode( 'ricca3-impcertif',    'ricca3_shortcode_impcertif' );
add_shortcode( 'ricca3-certifcurs1',  'ricca3_shortcode_certifcurs1' );
add_shortcode( 'ricca3-impcertifcurs1','ricca3_shortcode_impcertifcurs1' );
add_shortcode( 'ricca3-certiffinal',  'ricca3_shortcode_certiffinal' );
add_shortcode( 'ricca3-impcertiffinal','ricca3_shortcode_impcertiffinal' );
add_shortcode( 'ricca3-calcularnotaf' ,'ricca3_shortcode_calcularnotaf' );
add_shortcode( 'ricca3-notaalumne'    ,'ricca3_shortcode_notaalumne' );

add_shortcode( 'ricca3-dades',        'ricca3_shortcode_dades' );
add_shortcode( 'ricca3-espec',        'ricca3_shortcode_espec' );
add_shortcode( 'ricca3-cred',         'ricca3_shortcode_cred' );
add_shortcode( 'ricca3-grups',        'ricca3_shortcode_grups' );
add_shortcode( 'ricca3-prof',         'ricca3_shortcode_prof' );
add_shortcode( 'ricca3-ccomp',        'ricca3_shortcode_ccomp' );
add_shortcode( 'ricca3-credespec',    'ricca3_shortcode_credespec' );
add_shortcode( 'ricca3-pla',          'ricca3_shortcode_pla' );
add_shortcode( 'ricca3-guardarpla',   'ricca3_shortcode_guardarpla' );
add_shortcode( 'ricca3-llistarpla',   'ricca3_shortcode_llistarpla' );
add_shortcode( 'ricca3-sensepla',     'ricca3_shortcode_sensepla' );
add_shortcode( 'ricca3-ufloe',        'ricca3_shortcode_ufloe' );
add_shortcode( 'ricca3-notesufloe',   'ricca3_shortcode_notesufloe' );

add_shortcode( 'ricca3-sii',          'ricca3_shortcode_sii' );
add_shortcode( 'ricca3-sii-opcions',  'ricca3_shortcode_sii_opcions' );
add_shortcode( 'ricca3-sii-fitxers',  'ricca3_shortcode_sii_fitxers' );
add_shortcode( 'ricca3-sii-modif',    'ricca3_shortcode_sii_modif' );
add_shortcode( 'ricca3-sii-xml',      'ricca3_shortcode_sii_xml' );

add_shortcode( 'ricca3-professors',   'ricca3_shortcode_professors' );
add_shortcode( 'ricca3-assistencia',  'ricca3_shortcode_assistencia' );

function ricca3_init() {
	global $wpdb;
	
	$ricca3_db_version     = "2013.25.7";
	$ricca3_plugin_version = "2013.25.7";
	$ricca3_db_prefix      = "ricca3_";
	$options = get_option('ricca3_options');

	$any_act = $wpdb->get_row( 'SELECT * FROM ricca3_any WHERE actual = "1" ', ARRAY_A, 0 );
	$any_ins = $wpdb->get_row( 'SELECT * FROM ricca3_any WHERE insc   = "1" ', ARRAY_A, 0 );
	
	if(!$options)update_option( 'ricca3_options', NULL );
	
	if($options['plugin_version'] != $ricca3_plugin_version ){
		$options['plugin_version'] = $ricca3_plugin_version ;
		update_option('ricca3_options', $options);
		ricca3_update_plugin();
	}
	
	if($options['db_version'] != $ricca3_db_version ){
		$options['db_version'] = $ricca3_db_version ;
		update_option('ricca3_options', $options);
		ricca3_update_db();
	}
	
	if($options['db_prefix'] != $ricca3_db_prefix ){
		$options['db_prefix'] = $ricca3_db_prefix ;
		update_option('ricca3_options', $options);
	}

	if($options['any_actual'] != $any_act['any']){
		ricca3_update_any_actual();
	}

	if($options['any_inscri'] != $any_ins['any']){
		ricca3_update_any_inscri();
	}
	
	
	load_plugin_textdomain( 'ricca3-admin',  false, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );
	load_plugin_textdomain( 'ricca3-alum',   false, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );
	load_plugin_textdomain( 'ricca3-inc',    false, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );
	load_plugin_textdomain( 'ricca3-aval',   false, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );
	load_plugin_textdomain( 'ricca3-dades',  false, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );
	
}
