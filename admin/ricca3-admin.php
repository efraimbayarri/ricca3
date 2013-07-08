<?php
## Release build 2013.27.5
#############################################################################################
/**
 * Funcions per a la pàgina d'administracio del connector
 *
 * @since ricca3.v.2013.13.6
 * @author Efraim Bayarri
 */
#############################################################################################
function ricca3_admin_page() {
	add_options_page( 'Opcions RICCA3', 'RICCA3', 'manage_options', 'RICCA3-admin-menu', 'ricca3_plugin_options' );
}

#############################################################################################
/**   */
#############################################################################################
function ricca3_plugin_options(){
	?>
	<div>
	<h2><?php _e('Opcions RICCA3','ricca3-admin');?></h2>
	<?php _e('Opcions de configuració i administracio de RICCA3','ricca3-admin'); ?>
	<form action="options.php" method="post">
	<input name="Submit" type="submit" value="<?php _e('Desar canvis','ricca3-admin'); ?>" />
	<?php settings_fields('ricca3_options')?>
	<?php do_settings_sections('RICCA3-admin-menu')?>
	<hr>
	<input name="Submit" type="submit" value="<?php _e('Desar canvis','ricca3-admin'); ?>" />
	</form>
	</div>
	<?php 	
}

#############################################################################################
/**   */
#############################################################################################
function ricca3_admin_init(){
	register_setting('ricca3_options', 'ricca3_options', 'ricca3_options_validate');
	add_settings_section('ricca3_main',         __('Opcions principals','ricca3-admin'),         'ricca3_section_text',           'RICCA3-admin-menu');
	add_settings_field('ricca3_db_version',     __('Versió de la base de dades','ricca3-admin'), 'ricca3_setting_db_version',     'RICCA3-admin-menu', 'ricca3_main');
	add_settings_field('ricca3_db_prefix',      __('Prefix de la base de dades','ricca3-admin'), 'ricca3_setting_db_prefix',      'RICCA3-admin-menu', 'ricca3_main');
	add_settings_field('ricca3_plugin_version', __('Versió del connector','ricca3-admin'),       'ricca3_setting_plugin_version', 'RICCA3-admin-menu', 'ricca3_main');
	add_settings_field('ricca3_any_actual',     __('Any escolar actiu', 'ricca3-admin'),         'ricca3_setting_any_actual',     'RICCA3-admin-menu', 'ricca3_main');
	add_settings_field('ricca3_any_inscrip',    __('Any inscripcions actives', 'ricca3-admin'),  'ricca3_setting_any_inscri',     'RICCA3-admin-menu', 'ricca3_main');
}

#############################################################################################
/**   */
#############################################################################################
function ricca3_section_text(){
	printf('<hr /><p>', NULL);
	_e('Versions actuals.','ricca3-admin');
	printf('</p><hr />', NULL);
}

#############################################################################################
/**   */
#############################################################################################
function ricca3_setting_db_version(){
	$options = get_option('ricca3_options');
	echo "<input id='ricca3_db_version' name='ricca3_options[db_version]' size='10' type='text' value='{$options['db_version']}' /> ";
}

#############################################################################################
/**   */
#############################################################################################
function ricca3_setting_db_prefix(){
	$options = get_option('ricca3_options');
	echo "<input id='ricca3_db_prefix' name='ricca3_options[db_prefix]' size='20' type='text' value='{$options['db_prefix']}' /> ";
}


#############################################################################################
/**   */
#############################################################################################
function ricca3_setting_plugin_version(){
	$options = get_option('ricca3_options');
	echo "<input id='ricca3_plugin_version' name='ricca3_options[plugin_version]' size='10' type='text' value='{$options['plugin_version']}' /> ";
}

#############################################################################################
/**   */
#############################################################################################
function ricca3_setting_any_actual(){
	$options = get_option('ricca3_options');
	echo "<input id='ricca3_any_actual' name='ricca3_options[any_actual]' size='10' type='text' value='{$options['any_actual']}' /> ";
}

#############################################################################################
/**   */
#############################################################################################
function ricca3_setting_any_inscri(){
	$options = get_option('ricca3_options');
	echo "<input id='ricca3_any_inscri' name='ricca3_options[any_inscri]' size='10' type='text' value='{$options['any_inscri']}' /> ";
}

#############################################################################################
/**   */
#############################################################################################
function ricca3_options_validate($input){
	if(isset($input['db_version']))     $newinput['db_version']     = trim($input['db_version']);
	if(isset($input['db_prefix']))      $newinput['db_prefix']      = trim($input['db_prefix']);
	if(isset($input['plugin_version'])) $newinput['plugin_version'] = trim($input['plugin_version']);
	if(isset($input['any_actual']))     $newinput['any_actual']     = trim($input['any_actual']);
	if(isset($input['any_inscri']))     $newinput['any_inscri']     = trim($input['any_inscri']);
	
	return $newinput;
}	

#############################################################################################
/**
 * Funcions per a la pàgina d'administracio del connector
 *
 * @since ricca3.v.2013.13.6
 * @author Efraim Bayarri
 */
#############################################################################################
function ricca3_update_plugin(){
	echo 'update plugin';
	//	$options = get_option('ricca3_options');
}

#############################################################################################
/**
 * Funcions per a la pàgina d'administracio del connector
 *
 * Nova versió de la base de dades: fer un dbDelta de totes les taules
 *
 * @since ricca3.v.2013.13.6
 * @author Efraim Bayarri
 */
#############################################################################################
function ricca3_update_db(){
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');	
}	

#############################################################################################
/**
 * Funcions per a la pàgina d'administracio del connector
 *
 * Nou any actual
 *
 * @since ricca3.v.2013.27.5
 * @author Efraim Bayarri
 */
#############################################################################################
function ricca3_update_any_actual(){
	global $wpdb;
	$options = get_option('ricca3_options');
	$any_act = $wpdb->get_row( 'SELECT * FROM ricca3_any WHERE actual = "1" ', ARRAY_A, 0 );
	echo 'update any actual';
	$any = $options['any_actual'];
	$options['any_actual'] = $any_act['any'];
	update_option('ricca3_options', $options);
	
	if($any_actual = $wpdb->get_row( $wpdb->prepare( 'SELECT * FROM ricca3_any WHERE any = %s ', $any ), ARRAY_A, 0 ) ){
		echo ' existeix[OK],';
		if($wpdb->update('ricca3_any', array('actual' => 0), array('actual' => 1)) ){
			echo ' esborrar antic[OK],';
			if ($wpdb->update('ricca3_any', array('actual' => 1), array('any' => $any) ) ){
				echo ' afegir nou[OK].';
				$options['any_actual'] = $any;
				update_option('ricca3_options', $options);
			}else{
				echo ' afegir nou[ERROR]';
			}
		}else{
			echo ' esborrar antic[ERROR]';
		}
	}else{
		echo ' no existeix[ERROR]';
	}
}

#############################################################################################
/**
 * Funcions per a la pàgina d'administracio del connector
 *
 * Nou any inscripcions
 *
 * @since ricca3.v.2013.27.5
 * @author Efraim Bayarri
 */
#############################################################################################
function ricca3_update_any_inscri(){
	global $wpdb;
	$options = get_option('ricca3_options');
	$any_ins = $wpdb->get_row( 'SELECT * FROM ricca3_any WHERE insc   = "1" ', ARRAY_A, 0 );
	echo 'update any inscripcions';
	$any = $options['any_inscri'];
	$options['any_inscri'] = $any_ins['any'];
	update_option('ricca3_options', $options);

	if($any_inscri = $wpdb->get_row( $wpdb->prepare( 'SELECT * FROM ricca3_any WHERE any = %s ', $any ), ARRAY_A, 0 ) ){
		echo ' existeix[OK],';
		if($wpdb->update('ricca3_any', array('insc' => 0), array('insc' => 1)) ){
			echo ' esborrar antic[OK],';
			if ($wpdb->update('ricca3_any', array('insc' => 1), array('any' => $any) ) ){
				echo ' afegir nou[OK].';
				$options['any_inscri'] = $any;
				update_option('ricca3_options', $options);
			}else{
				echo ' afegir nou[ERROR]';
			}
		}else{
			echo ' esborrar antic[ERROR]';
		}
	}else{
		echo ' no existeix[ERROR]';
	}
}
