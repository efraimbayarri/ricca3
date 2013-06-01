<?php
/**
 * Plugin Name: RICCA3
 * Plugin URI: http://replicantsfactory.com/
 * Author: Efraim Bayarri
 * Author URI: http://replicantsfactory.com/
 * Version: 201322061609
 * Description: Projecte RIC-CA (Escola Ramon i Cajal) Versió 3 (BETA)
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
add_shortcode( 'ricca3-pregrup',      'ricca3_shortcode_pregrup' );

add_shortcode( 'ricca3-avaluacions',  'ricca3_shortcode_avaluacions' );
add_shortcode( 'ricca3-actes',        'ricca3_shortcode_actes' );
add_shortcode( 'ricca3-impactes',     'ricca3_shortcode_impactes' );
add_shortcode( 'ricca3-impactesrepe', 'ricca3_shortcode_impactesrepe' );
add_shortcode( 'ricca3-notes',        'ricca3_shortcode_notes' );
add_shortcode( 'ricca3-obser',        'ricca3_shortcode_obser' );
add_shortcode( 'ricca3-certif',       'ricca3_shortcode_certif' );
add_shortcode( 'ricca3-impcertif',    'ricca3_shortcode_impcertif' );

add_shortcode( 'ricca3-dades',        'ricca3_shortcode_dades' );
add_shortcode( 'ricca3-espec',        'ricca3_shortcode_espec' );
add_shortcode( 'ricca3-cred',         'ricca3_shortcode_cred' );
add_shortcode( 'ricca3-grups',        'ricca3_shortcode_grups' );
add_shortcode( 'ricca3-prof',         'ricca3_shortcode_prof' );
add_shortcode( 'ricca3-ccomp',        'ricca3_shortcode_ccomp' );
add_shortcode( 'ricca3-pla',          'ricca3_shortcode_pla' );
add_shortcode( 'ricca3-guardarpla',   'ricca3_shortcode_guardarpla' );
add_shortcode( 'ricca3-llistarpla',   'ricca3_shortcode_llistarpla' );
add_shortcode( 'ricca3-sensepla',     'ricca3_shortcode_sensepla' );

function ricca3_init() {
	$ricca3_db_version     = "2013.17.1";
	$ricca3_plugin_version = "2013.17.1";
	$ricca3_db_prefix      = "ricca3_";
	$options = get_option('ricca3_options');

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

	if(isset($options['ricca3_alumespec']) && $options['ricca3_alumespec'] == 1){
		$options['ricca3_alumespec'] = 0;
		update_option('ricca3_options',$options);
		ricca3_ricca3_alumespec();
	}
	
	if(isset($options['ricca3_act_tot']) && $options['ricca3_act_tot'] == 1){
		$options['ricca3_act_tot'] = 0;
		update_option('ricca3_options',$options);
		ricca3_ricca3_act_tot();
	}
	
	if(isset($options['ricca3_professors']) && $options['ricca3_professors'] == 1){
		$options['ricca3_professors'] = 0;
		update_option('ricca3_options',$options);
		ricca3_ricca3_professors();
	}
	
	if(isset($options['ricca3_credits']) && $options['ricca3_credits'] == 1){
		$options['ricca3_credits'] = 0;
		update_option('ricca3_options',$options);
		ricca3_ricca3_credits();
	}

	if(isset($options['ricca3_ccomp']) && $options['ricca3_ccomp'] == 1){
		$options['ricca3_ccomp'] = 0;
		update_option('ricca3_options',$options);
		ricca3_ricca3_ccomp();
	}
	
	if(isset($options['ricca3_any']) && $options['ricca3_any'] == 1){
		$options['ricca3_any'] = 0;
		update_option('ricca3_options',$options);
		ricca3_ricca3_any();
	}
	
	if(isset($options['ricca3_alumne']) && $options['ricca3_alumne'] == 1){
		$options['ricca3_alumne'] = 0;
		update_option('ricca3_options',$options);
		ricca3_ricca3_alumne();
	}

	if(isset($options['ricca3_aval']) && $options['ricca3_aval'] == 1){
		$options['ricca3_aval'] = 0;
		update_option('ricca3_options',$options);
		ricca3_ricca3_aval();
	}
	
	if(isset($options['ricca3_credaval']) && $options['ricca3_credaval'] == 1){
		$options['ricca3_credaval'] = 0;
		update_option('ricca3_options',$options);
		ricca3_ricca3_credaval();
	}

	if(isset($options['ricca3_credespec']) && $options['ricca3_credespec'] == 1){
		$options['ricca3_credespec'] = 0;
		update_option('ricca3_options',$options);
		ricca3_ricca3_credespec();
	}

	if(isset($options['ricca3_historial']) && $options['ricca3_historial'] == 1){
		$options['ricca3_historial'] = 0;
		update_option('ricca3_options',$options);
		ricca3_ricca3_historial();
	}
	
	if(isset($options['ricca3_pla']) && $options['ricca3_pla'] == 1){
		$options['ricca3_pla'] = 0;
		update_option('ricca3_options',$options);
		ricca3_ricca3_pla();
	}

	if(isset($options['ricca3_grups']) && $options['ricca3_grups'] == 1){
		$options['ricca3_grups'] = 0;
		update_option('ricca3_options',$options);
		ricca3_ricca3_grups();
	}
		
	load_plugin_textdomain( 'ricca3-admin',  false, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );
	load_plugin_textdomain( 'ricca3-alum',   false, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );
	load_plugin_textdomain( 'ricca3-inc',    false, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );
	load_plugin_textdomain( 'ricca3-aval',   false, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );
	load_plugin_textdomain( 'ricca3-dades',  false, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );
	
}
