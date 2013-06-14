<?php
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
	add_settings_section('ricca3_main',             __('Opcions principals','ricca3-admin'),                       'ricca3_section_text',                'RICCA3-admin-menu');
	add_settings_field('ricca3_db_version',         __('Versió de la base de dades','ricca3-admin'),               'ricca3_setting_db_version',          'RICCA3-admin-menu','ricca3_main');
	add_settings_field('ricca3_db_prefix',          __('Prefix de la base de dades','ricca3-admin'),               'ricca3_setting_db_prefix',           'RICCA3-admin-menu','ricca3_main');
	add_settings_field('ricca3_plugin_version',     __('Versió del connector','ricca3-admin'),                     'ricca3_setting_plugin_version',      'RICCA3-admin-menu','ricca3_main');
	add_settings_section('ricca3_ricca3',           __('Traspassar dades a "ricca3"','ricca3-admin'),              'ricca3_ricca3_section_text',         'RICCA3-admin-menu');
	add_settings_field('ricca3_ricca3_act_tot',     __('(*)actualitza totes les taules','ricca3-admin'),           'ricca3_setting_ricca3_act_tot',      'RICCA3-admin-menu','ricca3_ricca3');
	add_settings_field('ricca3_ricca3_any',         __('(1)ricca3_any(dades_preparades)','ricca3-admin'),          'ricca3_setting_ricca3_any',          'RICCA3-admin-menu','ricca3_ricca3');
	add_settings_field('ricca3_ricca3_aval',        __('(2)ricca3_aval(dades_preparades)','ricca3-admin'),         'ricca3_setting_ricca3_aval',         'RICCA3-admin-menu','ricca3_ricca3');
	add_settings_field('ricca3_ricca3_alumne',      __('(3)ricca3_alumne','ricca3-admin'),                         'ricca3_setting_ricca3_alumne',       'RICCA3-admin-menu','ricca3_ricca3');
	add_settings_field('ricca3_ricca3_professors',  __('(4)ricca3_professors','ricca3-admin'),                     'ricca3_setting_ricca3_professors',   'RICCA3-admin-menu','ricca3_ricca3');
	add_settings_field('ricca3_ricca3_credits',     __('(5)ricca3_credits','ricca3-admin'),                        'ricca3_setting_ricca3_credits',      'RICCA3-admin-menu','ricca3_ricca3');
	add_settings_field('ricca3_ricca3_grups',       __('(6)ricca3_grups','ricca3-admin'),                          'ricca3_setting_ricca3_grups',        'RICCA3-admin-menu','ricca3_ricca3');
	add_settings_field('ricca3_ricca3_ccomp',       __('(7)ricca3_ccomp','ricca3-admin'),                          'ricca3_setting_ricca3_ccomp',        'RICCA3-admin-menu','ricca3_ricca3');
	add_settings_field('ricca3_ricca3_alumespec',   __('(8)ricca3_alumnes_especialitat','ricca3-admin'),           'ricca3_setting_ricca3_alumespec',    'RICCA3-admin-menu','ricca3_ricca3');
	add_settings_field('ricca3_ricca3_credespec',   __('(9)ricca3_credespec','ricca3-admin'),                      'ricca3_setting_ricca3_credespec',    'RICCA3-admin-menu','ricca3_ricca3');
	add_settings_field('ricca3_ricca3_historial',   __('(A)ricca3_historial','ricca3-admin'),                      'ricca3_setting_ricca3_historial',    'RICCA3-admin-menu','ricca3_ricca3');
	add_settings_field('ricca3_ricca3_pla',         __('(B)ricca3_pla','ricca3-admin'),                            'ricca3_setting_ricca3_pla',          'RICCA3-admin-menu','ricca3_ricca3');
	add_settings_field('ricca3_ricca3_credaval',    __('(C)ricca3_credaval','ricca3-admin'),                       'ricca3_setting_ricca3_credaval',     'RICCA3-admin-menu','ricca3_ricca3');
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
function ricca3_ricca3_section_text(){
	printf('<hr /><p>', NULL);
	_e('traspasar dades de les taules ricca(v.2) a ricca3(v.3)','ricca3-admin');
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
function ricca3_setting_tras_def(){
	$options = get_option('ricca3_options');
	echo "<input id='ricca3_tras_def' name='ricca3_options[tras_def]' size='10' type='checkbox' value='' /> ";
}

#############################################################################################
/**   */
#############################################################################################
function ricca3_setting_ricca3_act_tot(){
	$options = get_option('ricca3_options');
	echo "<input id='ricca_ricca3_act_tot' name='ricca3_options[ricca3_act_tot]'  size='10' type='checkbox' value='' /> ";
}

#############################################################################################
/**   */
#############################################################################################
function ricca3_setting_ricca3_alumespec(){
	$options = get_option('ricca3_options');
	echo "<input id='ricca_ricca3_alumespec' name='ricca3_options[ricca3_alumespec]'  size='10' type='checkbox' value='' /> ";
}

#############################################################################################
/**   */
#############################################################################################
function ricca3_setting_ricca3_professors(){
	$options = get_option('ricca3_options');
	echo "<input id='ricca3_ricca3_professors' name='ricca3_options[ricca3_professors]'  size='10' type='checkbox' value='' /> ";
}

#############################################################################################
/**   */
#############################################################################################
function ricca3_setting_ricca3_credits(){
	$options = get_option('ricca3_options');
	echo "<input id='ricca3_ricca3_credits' name='ricca3_options[ricca3_credits]'  size='10' type='checkbox' value='' /> ";
}

#############################################################################################
/**   */
#############################################################################################
function ricca3_setting_ricca3_ccomp(){
	$options = get_option('ricca3_options');
	echo "<input id='ricca3_ricca3_ccomp' name='ricca3_options[ricca3_ccomp]'  size='10' type='checkbox' value='' /> ";
}

#############################################################################################
/**   */
#############################################################################################
function ricca3_setting_ricca3_any(){
	$options = get_option('ricca3_options');
	echo "<input id='ricca3_ricca3_any' name='ricca3_options[ricca3_any]'  size='10' type='checkbox' value='' /> ";
}

#############################################################################################
/**   */
#############################################################################################
function ricca3_setting_ricca3_alumne(){
	$options = get_option('ricca3_options');
	echo "<input id='ricca3_ricca3_alumne' name='ricca3_options[ricca3_alumne]'  size='10' type='checkbox' value='' /> ";
}

#############################################################################################
/**   */
#############################################################################################
function ricca3_setting_ricca3_aval(){
	$options = get_option('ricca3_options');
	echo "<input id='ricca3_ricca3_aval' name='ricca3_options[ricca3_aval]'  size='10' type='checkbox' value='' /> ";
}

#############################################################################################
/**   */
#############################################################################################
function ricca3_setting_ricca3_credaval(){
	$options = get_option('ricca3_options');
	echo "<input id='ricca3_ricca3_credaval' name='ricca3_options[ricca3_credaval]'  size='10' type='checkbox' value='' /> ";
}

#############################################################################################
/**   */
#############################################################################################
function ricca3_setting_ricca3_credespec(){
	$options = get_option('ricca3_options');
	echo "<input id='ricca3_ricca3_credespec' name='ricca3_options[ricca3_credespec]'  size='10' type='checkbox' value='' /> ";
}

#############################################################################################
/**   */
#############################################################################################
function ricca3_setting_ricca3_historial(){
	$options = get_option('ricca3_options');
	echo "<input id='ricca3_ricca3_historial' name='ricca3_options[ricca3_historial]'  size='10' type='checkbox' value='' /> ";
}

#############################################################################################
/**   */
#############################################################################################
function ricca3_setting_ricca3_pla(){
	$options = get_option('ricca3_options');
	echo "<input id='ricca3_ricca3_pla' name='ricca3_options[ricca3_pla]'  size='10' type='checkbox' value='' /> ";
}

#############################################################################################
/**   */
#############################################################################################
function ricca3_setting_ricca3_grups(){
	$options = get_option('ricca3_options');
	echo "<input id='ricca3_ricca3_grups' name='ricca3_options[ricca3_grups]'  size='10' type='checkbox' value='' /> ";
}

#############################################################################################
/**   */
#############################################################################################
function ricca3_options_validate($input){
	if(isset($input['db_version']))          $newinput['db_version']          = trim($input['db_version']);
	if(isset($input['db_prefix']))           $newinput['db_prefix']           = trim($input['db_prefix']);
	if(isset($input['plugin_version']))      $newinput['plugin_version']      = trim($input['plugin_version']);
	if(isset($input['ricca3_act_tot']))      $newinput['ricca3_act_tot']      = 1;
	if(isset($input['ricca3_any']))          $newinput['ricca3_any']          = 1;
	if(isset($input['ricca3_aval']))         $newinput['ricca3_aval']         = 1;
	if(isset($input['ricca3_alumespec']))    $newinput['ricca3_alumespec']    = 1;
	if(isset($input['ricca3_professors']))   $newinput['ricca3_professors']   = 1;
	if(isset($input['ricca3_credits']))      $newinput['ricca3_credits']      = 1;
	if(isset($input['ricca3_ccomp']))        $newinput['ricca3_ccomp']        = 1;
	if(isset($input['ricca3_alumne']))       $newinput['ricca3_alumne']       = 1;
	if(isset($input['ricca3_credaval']))     $newinput['ricca3_credaval']     = 1;
	if(isset($input['ricca3_credespec']))    $newinput['ricca3_credespec']    = 1;
	if(isset($input['ricca3_historial']))    $newinput['ricca3_historial']    = 1;
	if(isset($input['ricca3_pla']))          $newinput['ricca3_pla']          = 1;
	if(isset($input['ricca3_grups']))        $newinput['ricca3_grups']        = 1;
	
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
	global $ricca3_sql_credits;
	global $ricca3_sql_professors;
	global $ricca3_sql_alumne_especialitat;
	global $ricca3_sql_grups;
	global $ricca3_sql_any;
	global $ricca3_sql_historial;
	global $ricca3_sql_avaluacions;
	global $ricca3_sql_ccomp;
	global $ricca3_sql_calcul_notaf;
	global $ricca3_sql_alumne;
	global $ricca3_sql_credits_especialitat;
	global $ricca3_sql_pla;
	global $ricca3_sql_cursos;
	global $ricca3_sql_estat;
	global $ricca3_sql_especialitats;
	global $ricca3_sql_credits_avaluacions;
	
	dbDelta($ricca3_sql_credits);
	dbDelta($ricca3_sql_professors);
	dbDelta($ricca3_sql_alumne_especialitat);
	dbDelta($ricca3_sql_grups);
	dbDelta($ricca3_sql_any);
	dbDelta($ricca3_sql_historial);
	dbDelta($ricca3_sql_avaluacions);
	dbDelta($ricca3_sql_ccomp);
	dbDelta($ricca3_sql_calcul_notaf);
	dbDelta($ricca3_sql_alumne);
	dbDelta($ricca3_sql_credits_especialitat);
	dbDelta($ricca3_sql_cursos);
	dbDelta($ricca3_sql_estat);
	dbDelta($ricca3_sql_especialitats);
	dbDelta($ricca3_sql_credits_avaluacions);
}	

#############################################################################################
/**   */
#############################################################################################
function ricca3_ricca3_act_tot(){
	$total_time_start = microtime(true);
	ricca3_ricca3_any();
	ricca3_ricca3_aval();
	ricca3_ricca3_alumne();
	ricca3_ricca3_professors();
	ricca3_ricca3_credits();
	ricca3_ricca3_grups();
	ricca3_ricca3_ccomp();
	ricca3_ricca3_alumespec();
	ricca3_ricca3_credespec();
	ricca3_ricca3_historial();
	ricca3_ricca3_pla();
	ricca3_ricca3_credaval();
	$total_time_end = microtime(true);
	$time = $total_time_end - $total_time_start;
	printf('<table><tr><td>ACTUALITZAR TOTES LES TAULES: Ha trigat %s segons</td></tr></table>', $time );
}

#############################################################################################
/**   */
#############################################################################################
function ricca3_ricca3_alumespec(){
	global $wpdb;
	$time_start = microtime(true);
	
	$dades = $wpdb->get_results( 'SELECT * FROM ricca_alumne_especialitat', ARRAY_A);
	for( $i = 0; $i < count($dades); $i++ ){
		$row_any   = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_any   WHERE any=%s',   $dades[$i]['idany']), ARRAY_A, 0);
		$row_estat = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_estat WHERE estat=%s', $dades[$i]['estat']), ARRAY_A, 0);
		$wpdb->query( $wpdb->prepare('INSERT INTO ricca3_alumne_especialitat (idalumespec, idalumne,    idgrup,    idany,    idestat_es,    motiubaixa,    databaixa,'.
			'    notaf_es,    repeteix,    observ1,    observ2,    observ3,    stampuser,          stampplace)'.
			'                                                         VALUES (%s,          %s,          %s,        %s,       %s,            %s,            %s,'.
			'           %f,          %s,          %s,         %s,         %s,         "upgrade",          "upgrade")'.
			' ON DUPLICATE KEY UPDATE                                                      idalumne=%s, idgrup=%s, idany=%s, idestat_es=%s, motiubaixa=%s, databaixa=%s,'.
			' notaf_es=%f, repeteix=%s, observ1=%s, observ2=%s, observ3=%s, stampuser="update", stampplace="update" ',
			$dades[$i]['idkey'],      $dades[$i]['idalumne'],   $dades[$i]['idgrup'],    $row_any['idany'],
			$row_estat['idestat'],    $dades[$i]['motiubaixa'], $dades[$i]['databaixa'], $dades[$i]['nota'], 
			$dades[$i]['repeteix'],   $dades[$i]['observ1'],    $dades[$i]['observ2'],   $dades[$i]['observ3'],
			                          $dades[$i]['idalumne'],   $dades[$i]['idgrup'],    $row_any['idany'],       
			$row_estat['idestat'],    $dades[$i]['motiubaixa'], $dades[$i]['databaixa'], $dades[$i]['nota'], 
			$dades[$i]['repeteix'],   $dades[$i]['observ1'],    $dades[$i]['observ2'],   $dades[$i]['observ3']));
	}
	$time_end = microtime(true);
	$time = $time_end - $time_start;
	
	printf('<table><tr><td>[ricca3_alumne_especialitat]: Ha trigat %s segons en fer %s transaccions</td></tr></table>', $time, count($dades));
}

#############################################################################################
/**   */
#############################################################################################
function ricca3_ricca3_professors(){
	global $wpdb;
	$time_start = microtime(true);
	
	$dades =$wpdb->get_results( 'SELECT * FROM ricca_professors', ARRAY_A);
	for( $i = 0; $i < count($dades); $i++ ){
		$wpdb->query( $wpdb->prepare('INSERT INTO ricca3_professors ( idprof, idtutor,    nomicognoms,    telcasa,    telcont1,    telcont2,    telcont3,    email,    stampuser,          stampplace) '.
			'                                                VALUES ( %d,     %d,         %s,             %s,         %s,          %s,          %s,          %s,       "upgrade",          "upgrade")'.
			' ON DUPLICATE KEY UPDATE                                         idtutor=%d, nomicognoms=%s, telcasa=%s, telcont1=%s, telcont2=%s, telcont3=%s, email=%s, stampuser="update", stampplace="update" ',
			$dades[$i]['idkey'], $dades[$i]['idkey'], $dades[$i]['nomicognoms'], $dades[$i]['telcasa'], $dades[$i]['telcont1'], $dades[$i]['telcont2'], $dades[$i]['telcont3'], $dades[$i]['email'],
			                     $dades[$i]['idkey'], $dades[$i]['nomicognoms'], $dades[$i]['telcasa'], $dades[$i]['telcont1'], $dades[$i]['telcont2'], $dades[$i]['telcont3'], $dades[$i]['email'] ));
	}
	$time_end = microtime(true);
	$time = $time_end - $time_start;
	
	printf('<table><tr><td>[ricca3_professors]: Ha trigat %s segons en fer %s transaccions</td></tr></table>', $time, count($dades));
}

#############################################################################################
/**   */
#############################################################################################
function ricca3_ricca3_credits(){
	global $wpdb;
	$time_start = microtime(true);
	
	$dades = $wpdb->get_results('SELECT * FROM ricca_credits', ARRAY_A);
	for( $i = 0; $i < count( $dades); $i++ ){
		$row_curs = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_cursos WHERE curs=%s', $dades[$i]['curs']), ARRAY_A, 0);
		$res_espec = $wpdb->query(  $wpdb->prepare('SELECT * FROM ricca3_especialitats WHERE idespecialitat=%s', $dades[$i]['idespecialitat']));
		if( $res_espec != 0){
			$wpdb->query($wpdb->prepare(' INSERT INTO ricca3_credits ( idcredit, idespecialitat,    idcurs,    hores_cr,    actiu_cr,    ordre_cr,    aval3nomes,    nomcredit,    credit,    stampuser,          stampplace) '.
				'                                             VALUES ( %d,       %d,                %d,        %d,          %d,          %d,          %d,            %s,           %s,        "upgrade",          "upgrade")'.
				' ON DUPLICATE KEY UPDATE                                        idespecialitat=%d, idcurs=%d, hores_cr=%d, actiu_cr=%d, ordre_cr=%d, aval3nomes=%d, nomcredit=%s, credit=%s, stampuser="update", stampplace="update" ',
				$dades[$i]['idcredit'], $dades[$i]['idespecialitat'], $row_curs['idcurs'], $dades[$i]['hores'], $dades[$i]['actiu'], $dades[$i]['ordre'], $dades[$i]['aval3nomes'], $dades[$i]['nomcredit'], $dades[$i]['credit'],
				                        $dades[$i]['idespecialitat'], $row_curs['idcurs'], $dades[$i]['hores'], $dades[$i]['actiu'], $dades[$i]['ordre'], $dades[$i]['aval3nomes'], $dades[$i]['nomcredit'], $dades[$i]['credit'] ));
		}
	}
	$time_end = microtime(true);
	$time = $time_end - $time_start;
	
	printf('<table><tr><td>[ricca3_credits]: Ha trigat %s segons en fer %s transaccions</td></tr></table>', $time, count($dades));
}

#############################################################################################
/**   */
#############################################################################################
function ricca3_ricca3_ccomp(){
	global $wpdb;
	$time_start = microtime(true);
	
	$dades = $wpdb->get_results( 'SELECT * FROM ricca.ricca_ccomp', ARRAY_A);
	for( $i = 0; $i < count($dades); $i++ ){
		$wpdb->query( $wpdb->prepare('INSERT INTO ricca3_ccomp (idccomp,    idcredit,    idgrup,    idprofessor,    idtutor,    hores_cc,    actiu_cc,    nomccomp,     stampuser,          stampplace )'.
			'                                           VALUES (%d,         %d,          %d,        %d,             %d,         %d,          %d,          %s,           "upgrade",          "upgrade")'.
			' ON DUPLICATE KEY UPDATE                                       idcredit=%d, idgrup=%d, idprofessor=%d, idtutor=%d, hores_cc=%d, actiu_cc=%d, nomccomp=%s , stampuser="update", stampplace="update" ',
			$dades[$i]['idkey'], $dades[$i]['idcredit'], $dades[$i]['idgrup'], $dades[$i]['idprofessor'], $dades[$i]['idtutor'], $dades[$i]['hores'], $dades[$i]['actiu'], $dades[$i]['nomccomp'],
			                     $dades[$i]['idcredit'], $dades[$i]['idgrup'], $dades[$i]['idprofessor'], $dades[$i]['idtutor'], $dades[$i]['hores'], $dades[$i]['actiu'], $dades[$i]['nomccomp']));

	}
	$time_end = microtime(true);
	$time = $time_end - $time_start;
	
	printf('<table><tr><td>[ricca3_cccomp]: Ha trigat %s segons en fer %s transaccions</td></tr></table>', $time, count($dades));
}

#############################################################################################
/**   */
#############################################################################################
function ricca3_ricca3_any(){
	global $wpdb;
	$time_start = microtime(true);
	
	$wpdb->query( $wpdb->prepare('INSERT INTO ricca3_any ( idany, any,             actual,   insc,   conv, stampuser, stampplace )'.
			'                                          VALUES( 1,     "2001-2002",     0,        0,      "", "upgrade", "upgrade" )'.
			' ON DUPLICATE KEY UPDATE                                 any="2001-2002", actual=0, insc=0, conv="", stampuser="update", stampplace="update" ', NULL));
	$wpdb->query( $wpdb->prepare('INSERT INTO ricca3_any ( idany, any,             actual,   insc,    conv, stampuser, stampplace )'.
			'                                          VALUES( 2,     "2002-2003",     0,        0,      "06/03", "upgrade", "upgrade" )'.
			' ON DUPLICATE KEY UPDATE                                 any="2002-2003", actual=0, insc=0, conv="06/03", stampuser="update", stampplace="update" ', NULL));
	$wpdb->query( $wpdb->prepare('INSERT INTO ricca3_any ( idany, any,             actual,   insc,    conv, stampuser, stampplace )'.
			'                                          VALUES( 3,     "2003-2004",     0,        0,      "06/04", "upgrade", "upgrade" )'.
			' ON DUPLICATE KEY UPDATE                                 any="2003-2004", actual=0, insc=0, conv="06/04", stampuser="update", stampplace="update" ', NULL));
	$wpdb->query( $wpdb->prepare('INSERT INTO ricca3_any ( idany, any,             actual,   insc,    conv, stampuser, stampplace )'.
			'                                          VALUES( 4,     "2004-2005",     0,        0,      "06/05", "upgrade", "upgrade" )'.
			' ON DUPLICATE KEY UPDATE                                 any="2004-2005", actual=0, insc=0, conv="06/05", stampuser="update", stampplace="update" ', NULL));
	$wpdb->query( $wpdb->prepare('INSERT INTO ricca3_any ( idany, any,             actual,   insc,    conv, stampuser, stampplace )'.
			'                                          VALUES( 5,     "2005-2006",     0,        0,      "06/06", "upgrade", "upgrade" )'.
			' ON DUPLICATE KEY UPDATE                                 any="2005-2006", actual=0, insc=0, conv="06/06", stampuser="update", stampplace="update" ', NULL));
	$wpdb->query( $wpdb->prepare('INSERT INTO ricca3_any ( idany, any,             actual,   insc,    conv, stampuser, stampplace )'.
			'                                          VALUES( 6,     "2006-2007",     0,        0,      "06/07", "upgrade", "upgrade" )'.
			' ON DUPLICATE KEY UPDATE                                 any="2006-2007", actual=0, insc=0, conv="06/07", stampuser="update", stampplace="update" ', NULL));
	$wpdb->query( $wpdb->prepare('INSERT INTO ricca3_any ( idany, any,             actual,   insc,    conv, stampuser, stampplace )'.
			'                                          VALUES( 7,     "2007-2008",     0,        0,      "06/08", "upgrade", "upgrade" )'.
			' ON DUPLICATE KEY UPDATE                                 any="2007-2008", actual=0, insc=0, conv="06/08", stampuser="update", stampplace="update" ', NULL));
	$wpdb->query( $wpdb->prepare('INSERT INTO ricca3_any ( idany, any,             actual,   insc,    conv, stampuser, stampplace )'.
			'                                          VALUES( 8,     "2008-2009",     0,        0,      "06/09", "upgrade", "upgrade" )'.
			' ON DUPLICATE KEY UPDATE                                 any="2008-2009", actual=0, insc=0, conv="06/09", stampuser="update", stampplace="update" ', NULL));
	$wpdb->query( $wpdb->prepare('INSERT INTO ricca3_any ( idany, any,             actual,   insc,    conv, stampuser, stampplace )'.
			'                                          VALUES( 9,     "2009-2010",     0,        0,      "06/10", "upgrade", "upgrade" )'.
			' ON DUPLICATE KEY UPDATE                                 any="2009-2010", actual=0, insc=0, conv="06/10", stampuser="update", stampplace="update" ', NULL));
	$wpdb->query( $wpdb->prepare('INSERT INTO ricca3_any ( idany, any,             actual,   insc,    conv, stampuser, stampplace )'.
			'                                          VALUES( 10,    "2010-2011",     0,        0,      "06/11", "upgrade", "upgrade" )'.
			' ON DUPLICATE KEY UPDATE                                 any="2010-2011", actual=0, insc=0, conv="06/11", stampuser="update", stampplace="update" ', NULL));
	$wpdb->query( $wpdb->prepare('INSERT INTO ricca3_any ( idany, any,             actual,   insc,    conv, stampuser, stampplace )'.
			'                                          VALUES( 11,    "2011-2012",     0,        0,      "06/12", "upgrade", "upgrade" )'.
			' ON DUPLICATE KEY UPDATE                                 any="2011-2012", actual=0, insc=0, conv="06/12", stampuser="update", stampplace="update" ', NULL));
	$wpdb->query( $wpdb->prepare('INSERT INTO ricca3_any ( idany, any,             actual,   insc,    conv, stampuser, stampplace )'.
			'                                          VALUES( 12,    "2012-2013",     1,        0,      "06/13", "upgrade", "upgrade" )'.
			' ON DUPLICATE KEY UPDATE                                 any="2012-2013", actual=1, insc=0, conv="06/13", stampuser="update", stampplace="update" ', NULL));
	$wpdb->query( $wpdb->prepare('INSERT INTO ricca3_any ( idany, any,             actual,   insc,    conv, stampuser, stampplace )'.
			'                                          VALUES( 13,    "2013-2014",     0,        1,      "06/14", "upgrade", "upgrade" )'.
			' ON DUPLICATE KEY UPDATE                                 any="2013-2014", actual=0, insc=1, conv="06/14", stampuser="update", stampplace="update" ', NULL));
	$wpdb->query( $wpdb->prepare('INSERT INTO ricca3_any ( idany, any,             actual,   insc,    conv, stampuser, stampplace )'.
			'                                          VALUES( 14,    "2014-2015",     0,        0,      "06/15", "upgrade", "upgrade" )'.
			' ON DUPLICATE KEY UPDATE                                 any="2014-2015", actual=0, insc=0, conv="06/15", stampuser="update", stampplace="update" ', NULL));
	$wpdb->query( $wpdb->prepare('INSERT INTO ricca3_any ( idany, any,             actual,   insc,    conv, stampuser, stampplace )'.
			'                                          VALUES( 15,    "2015-2016",     0,        0,      "06/16", "upgrade", "upgrade" )'.
			' ON DUPLICATE KEY UPDATE                                 any="2015-2016", actual=0, insc=0, conv="06/16", stampuser="update", stampplace="update" ', NULL));
	$wpdb->query( $wpdb->prepare('INSERT INTO ricca3_any ( idany, any,             actual,   insc,    conv, stampuser, stampplace )'.
			'                                          VALUES( 16,    "2016-2017",     0,        0,      "06/17", "upgrade", "upgrade" )'.
			' ON DUPLICATE KEY UPDATE                                 any="2016-2017", actual=0, insc=0, conv="06/17", stampuser="update", stampplace="update" ', NULL));
	$wpdb->query( $wpdb->prepare('INSERT INTO ricca3_any ( idany, any,             actual,   insc,    conv, stampuser, stampplace )'.
			'                                          VALUES( 17,    "2017-2018",     0,        0,      "06/18", "upgrade", "upgrade" )'.
			' ON DUPLICATE KEY UPDATE                                 any="2017-2018", actual=0, insc=0, conv="06/18", stampuser="update", stampplace="update" ', NULL));
	$wpdb->query( $wpdb->prepare('INSERT INTO ricca3_any ( idany, any,             actual,   insc,    conv, stampuser, stampplace )'.
			'                                          VALUES( 18,    "2018-2019",     0,        0,      "06/19", "upgrade", "upgrade" )'.
			' ON DUPLICATE KEY UPDATE                                 any="2018-2019", actual=0, insc=0, conv="06/19", stampuser="update", stampplace="update" ', NULL));
	$wpdb->query( $wpdb->prepare('INSERT INTO ricca3_any ( idany, any,             actual,   insc,    conv, stampuser, stampplace )'.
			'                                          VALUES( 19,    "2018-2019",     0,        0,      "06/19", "upgrade", "upgrade" )'.
			' ON DUPLICATE KEY UPDATE                                 any="2018-2019", actual=0, insc=0, conv="06/19", stampuser="update", stampplace="update" ', NULL));
	$wpdb->query( $wpdb->prepare('INSERT INTO ricca3_any ( idany, any,             actual,   insc,    conv, stampuser, stampplace )'.
			'                                          VALUES( 20,    "2019-2020",     0,        0,      "06/20", "upgrade", "upgrade" )'.
			' ON DUPLICATE KEY UPDATE                                 any="2019-2020", actual=0, insc=0, conv="06/20", stampuser="update", stampplace="update" ', NULL));
	$time_end = microtime(true);
	$time = $time_end - $time_start;
	
	printf('<table><tr><td>[ricca3_any]: Ha trigat %s segons</td></tr></table>', $time);
}

#############################################################################################
/**   */
#############################################################################################
function ricca3_ricca3_alumne(){
	global $wpdb;
	$time_start = microtime(true);
	
	$dades = $wpdb->get_results('SELECT * FROM ricca.ricca_alumne', ARRAY_A);
	for( $i = 0; $i < count($dades); $i++ ){
		$wpdb->query( $wpdb->prepare('INSERT INTO ricca3_alumne (idalumne, cognom1,   cognom2,     nom,   datanai,    llocnai,    provnai,    paisnai,    dni,    residenciacurs,    ciutatcurs,    codpostalcurs, '.
				'telefoncontactecurs1,    telefoncontactecurs2,    email,    residenciahabitual,    ciutathabitual,    provinciahabitual,    codipostal,    telefon,    estudisrealitzats, '.
				'datainscripcio,    telefonfixe,    estudisanteriors,    centreea,    poblacioea,    abonament,    tipusdni,    llenguafamiliar,    professio,    idhistorial,    nacionalitat,    attachment_id,    cognomsinom,    nomicognoms, stampuser, stampplace) '.
				' VALUES                                            (%d,       %s,        %s,          %s,    %s,         %s,         %s,         %s,         %s,     %s,                %s,            %s,'.
				'%s,                      %s,                      %s,       %s,                    %s,                %s,                   %s,            %s,         %s,'.
				'%s,                %s,             %s,                  %s,          %s,            %s,           %s,          %s,                 %s,           %s,             %s,              %s,               %s,             %s,          "upgrade", "upgrade" )'.
				' ON DUPLICATE KEY UPDATE                                             cognom1=%s,cognom2=%s, nom=%s, datanai=%s, llocnai=%s, provnai=%s, paisnai=%s, dni=%s, residenciacurs=%s, ciutatcurs=%s, codpostalcurs=%s, '.
				'telefoncontactecurs1=%s, telefoncontactecurs2=%s, email=%s, residenciahabitual=%s, ciutathabitual=%s, provinciahabitual=%s, codipostal=%s, telefon=%s, estudisrealitzats=%s, '.
				'datainscripcio=%s, telefonfixe=%s, estudisanteriors=%s, centreea=%s, poblacioea=%s, abonament=%s, tipusdni=%s, llenguafamiliar=%s, professio=%s, idhistorial=%s, nacionalitat=%s, attachment_id=%s, cognomsinom=%s, nomicognoms=%s, stampuser="update", stampplace="update" ',
				$dades[$i]['idalumne'], $dades[$i]['cognom1'], $dades[$i]['cognom2'], $dades[$i]['nom'], $dades[$i]['datanai'], $dades[$i]['llocnai'], $dades[$i]['provnai'], $dades[$i]['paisnai'], $dades[$i]['dni'], $dades[$i]['residenciacurs'], $dades[$i]['ciutatcurs'],
				$dades[$i]['codpostalcurs'], $dades[$i]['telefoncontactecurs1'], $dades[$i]['telefoncontactecurs2'], $dades[$i]['email'], $dades[$i]['residenciahabitual'], $dades[$i]['ciutathabitual'], $dades[$i]['provinciahabitual'], $dades[$i]['codipostal'],
				$dades[$i]['telefon'], $dades[$i]['estudisrealitzats'], $dades[$i]['datainscripcio'], $dades[$i]['telefonfixe'], $dades[$i]['estudisanteriors'], $dades[$i]['centreea'], $dades[$i]['poblacioea'], $dades[$i]['abonament'], $dades[$i]['tipusdni'],
				$dades[$i]['llenguafamiliar'], $dades[$i]['professio'], $dades[$i]['idhistorial'], $dades[$i]['nacionalitat'], $dades[$i]['attachment_id'], $dades[$i]['cognomsinom'], $dades[$i]['nomicognoms'],
				                        $dades[$i]['cognom1'], $dades[$i]['cognom2'], $dades[$i]['nom'], $dades[$i]['datanai'], $dades[$i]['llocnai'], $dades[$i]['provnai'], $dades[$i]['paisnai'], $dades[$i]['dni'], $dades[$i]['residenciacurs'], $dades[$i]['ciutatcurs'],
				$dades[$i]['codpostalcurs'], $dades[$i]['telefoncontactecurs1'], $dades[$i]['telefoncontactecurs2'], $dades[$i]['email'], $dades[$i]['residenciahabitual'], $dades[$i]['ciutathabitual'], $dades[$i]['provinciahabitual'], $dades[$i]['codipostal'],
				$dades[$i]['telefon'], $dades[$i]['estudisrealitzats'], $dades[$i]['datainscripcio'], $dades[$i]['telefonfixe'], $dades[$i]['estudisanteriors'], $dades[$i]['centreea'], $dades[$i]['poblacioea'], $dades[$i]['abonament'], $dades[$i]['tipusdni'],
				$dades[$i]['llenguafamiliar'], $dades[$i]['professio'], $dades[$i]['idhistorial'], $dades[$i]['nacionalitat'], $dades[$i]['attachment_id'], $dades[$i]['cognomsinom'], $dades[$i]['nomicognoms'] ));
	}
	$time_end = microtime(true);
	$time = $time_end - $time_start;
	
	printf('<table><tr><td>[ricca3_alumne]: Ha trigat %s segons en fer %s transaccions</td></tr></table>', $time, count($dades));
}

#############################################################################################
/**   */
#############################################################################################
function ricca3_ricca3_aval(){
	global $wpdb;
	$time_start = microtime(true);

	$wpdb->query( $wpdb->prepare('INSERT INTO ricca3_avaluacions   ( idavaluacio, nomaval, stampuser, stampplace ) VALUES ( 1, "1ª AVALUACIÓ", "upgrade", "upgrade" )    ON DUPLICATE KEY UPDATE nomaval = "1ª AVALUACIÓ", stampuser="update", stampplace="update" ',    NULL));
	$wpdb->query( $wpdb->prepare('INSERT INTO ricca3_avaluacions   ( idavaluacio, nomaval, stampuser, stampplace ) VALUES ( 2, "2ª AVALUACIÓ", "upgrade", "upgrade" )    ON DUPLICATE KEY UPDATE nomaval = "2ª AVALUACIÓ", stampuser="update", stampplace="update" ',    NULL));
	$wpdb->query( $wpdb->prepare('INSERT INTO ricca3_avaluacions   ( idavaluacio, nomaval, stampuser, stampplace ) VALUES ( 3, "3ª AVALUACIÓ", "upgrade", "upgrade" )    ON DUPLICATE KEY UPDATE nomaval = "3ª AVALUACIÓ", stampuser="update", stampplace="update" ',    NULL));
	$wpdb->query( $wpdb->prepare('INSERT INTO ricca3_avaluacions   ( idavaluacio, nomaval, stampuser, stampplace ) VALUES ( 4, "RECUPERACIÓ", "upgrade", "upgrade"  )    ON DUPLICATE KEY UPDATE nomaval = "RECUPERACIÓ", stampuser="update", stampplace="update" ',     NULL));
	$wpdb->query( $wpdb->prepare('INSERT INTO ricca3_avaluacions   ( idavaluacio, nomaval, stampuser, stampplace ) VALUES ( 5, "AVALUACIÓ FINAL", "upgrade", "upgrade" ) ON DUPLICATE KEY UPDATE nomaval = "AVALUACIÓ FINAL", stampuser="update", stampplace="update" ', NULL));
	$wpdb->query( $wpdb->prepare('INSERT INTO ricca3_cursos        ( idcurs, curs, stampuser, stampplace )         VALUES ( 1, "Curs I", "upgrade", "upgrade" )          ON DUPLICATE KEY UPDATE curs    = "Curs I", stampuser="update", stampplace="update" ',          NULL));
	$wpdb->query( $wpdb->prepare('INSERT INTO ricca3_cursos        ( idcurs, curs, stampuser, stampplace )         VALUES ( 2, "Curs II", "upgrade", "upgrade" )         ON DUPLICATE KEY UPDATE curs    = "Curs II", stampuser="update", stampplace="update" ',         NULL));
	$wpdb->query( $wpdb->prepare('INSERT INTO ricca3_estat         ( idestat, estat, stampuser, stampplace )       VALUES ( 1, "Alta", "upgrade", "upgrade" )            ON DUPLICATE KEY UPDATE estat   = "Alta", stampuser="update", stampplace="update" ',            NULL));
	$wpdb->query( $wpdb->prepare('INSERT INTO ricca3_estat         ( idestat, estat, stampuser, stampplace )       VALUES ( 2, "Baixa", "upgrade", "upgrade" )           ON DUPLICATE KEY UPDATE estat   = "Baixa", stampuser="update", stampplace="update" ',           NULL));
	$wpdb->query( $wpdb->prepare('INSERT INTO ricca3_especialitats (idespecialitat, nomespecialitat,                   codiespecialitat, pla,     actiu_es, cursos, ordre_es,   professio,                duracio, stampuser, stampplace )'.
			'                                                   VALUES (1,              "PRÒTESIS DENTAL",                 "1656",           "LOGSE", 1,        2,      5,          "PROTÈSIC DENTAL",        "2000",  "upgrade", "upgrade" ) '.
			'ON DUPLICATE KEY UPDATE   nomespecialitat="PRÒTESIS DENTAL",                 codiespecialitat="1656", pla="LOGSE", actiu_es=1, cursos=2, ordre_es=5,   professio="PROTÈSIC DENTAL",        duracio="2000", stampuser="update", stampplace="update" ', NULL));
	$wpdb->query( $wpdb->prepare('INSERT INTO ricca3_especialitats (idespecialitat, nomespecialitat,                   codiespecialitat, pla,     actiu_es, cursos, ordre_es,   professio,                duracio, stampuser, stampplace )'.
			'                                                   VALUES (2,              "IMATGE PER AL DIAGNÒSTIC",        "1660",           "LOGSE", 1,        2,      3,          "RADIÒLEG",               "2000",  "upgrade", "upgrade" ) '.
			'ON DUPLICATE KEY UPDATE   nomespecialitat="IMATGE PER AL DIAGNÒSTIC",        codiespecialitat="1660", pla="LOGSE", actiu_es=1, cursos=2,  ordre_es=3,  professio="RADIÒLEG",               duracio="2000", stampuser="update", stampplace="update" ', NULL));
	$wpdb->query( $wpdb->prepare('INSERT INTO ricca3_especialitats (idespecialitat, nomespecialitat,                   codiespecialitat, pla,     actiu_es, cursos, ordre_es,   professio,                duracio, stampuser, stampplace )'.
			'                                                   VALUES (3,              "LABORATORI DE DIAGNOSTIC CLINIC", "1654",           "LOGSE", 1,        2,      3,          "TÉCNIC LABORATORI",      "2000",  "upgrade", "upgrade" ) '.
			'ON DUPLICATE KEY UPDATE   nomespecialitat="LABORATORI DE DIAGNOSTIC CLINIC", codiespecialitat="1654", pla="LOGSE", actiu_es=1,  cursos=2, ordre_es=2,  professio="TÉCNIC LABORATORI",      duracio="2000", stampuser="update", stampplace="update" ', NULL));
	$wpdb->query( $wpdb->prepare('INSERT INTO ricca3_especialitats (idespecialitat, nomespecialitat,                   codiespecialitat, pla,     actiu_es, cursos, ordre_es,   professio,                duracio, stampuser, stampplace )'.
			'                                                   VALUES (4,              "ORTESIS I PRÓTESIS",              "1657",           "LOGSE", 1,        2,     6,           "ORTOPROTÈSIC",           "2000",  "upgrade", "upgrade" ) '.
			'ON DUPLICATE KEY UPDATE   nomespecialitat="ORTESIS I PRÓTESIS",              codiespecialitat="1657", pla="LOGSE", actiu_es=1,  cursos=2, ordre_es=6,  professio="ORTOPROTÈSIC",           duracio="2000", stampuser="update", stampplace="update" ', NULL));
	$wpdb->query( $wpdb->prepare('INSERT INTO ricca3_especialitats (idespecialitat, nomespecialitat,                   codiespecialitat, pla,     actiu_es, cursos, ordre_es,   professio,                duracio, stampuser, stampplace )'.
			'                                                   VALUES (5,              "DIETÈTICA",                       "1651",           "LOGSE", 1,        2,     1,           "DIETISTA",               "2000",  "upgrade", "upgrade" ) '.
			'ON DUPLICATE KEY UPDATE   nomespecialitat="DIETÈTICA",                       codiespecialitat="1651", pla="LOGSE", actiu_es=1,  cursos=2, ordre_es=1,  professio="DIETISTA",               duracio="2000", stampuser="update", stampplace="update" ', NULL));
	$wpdb->query( $wpdb->prepare('INSERT INTO ricca3_especialitats (idespecialitat, nomespecialitat,                   codiespecialitat, pla,     actiu_es, cursos, ordre_es,   professio,                duracio, stampuser, stampplace )'.
			'                                                   VALUES (6,              "HIGIENE BUCODENTAL",              "1652",           "LOGSE", 1,        1,     4,           "HIGIENISTA BUCODENTAL",  "1400",  "upgrade", "upgrade" ) '.
			'ON DUPLICATE KEY UPDATE   nomespecialitat="HIGIENE BUCODENTAL",              codiespecialitat="1652", pla="LOGSE", actiu_es=1,  cursos=1, ordre_es=4,  professio="HIGIENISTA BUCODENTAL",  duracio="1400", stampuser="update", stampplace="update" ', NULL));
	$wpdb->query( $wpdb->prepare('INSERT INTO ricca3_especialitats (idespecialitat, nomespecialitat,                   codiespecialitat, pla,     actiu_es, cursos, ordre_es,   professio,                duracio, stampuser, stampplace )'.
			'                                                   VALUES (7,              "DOCUMENTACIÓ SANITARIA",          "1658",           "LOGSE", 1,        1,     7,           "DOCUMENTACIÓ SANITARIA", "1400",  "upgrade", "upgrade" ) '.
			'ON DUPLICATE KEY UPDATE   nomespecialitat="DOCUMENTACIÓ SANITARIA",          codiespecialitat="1658", pla="LOGSE", actiu_es=1,  cursos=1, ordre_es=7,  professio="DOCUMENTACIÓ SANITARIA", duracio="1400", stampuser="update", stampplace="update" ', NULL));
	$wpdb->query( $wpdb->prepare('INSERT INTO ricca3_especialitats (idespecialitat, nomespecialitat,                   codiespecialitat, pla,     actiu_es, cursos, ordre_es,   professio,                duracio, stampuser, stampplace )'.
			'                                                   VALUES (8,              "FARMÀCIA",                        "1602",           "LOGSE", 0,        2,     8,           " ",                      "2000",  "upgrade", "upgrade" ) '.
			'ON DUPLICATE KEY UPDATE   nomespecialitat="FARMÀCIA",                        codiespecialitat="1602", pla="LOGSE", actiu_es=0,  cursos=2, ordre_es=8,  professio=" ",                      duracio="1400", stampuser="update", stampplace="update" ', NULL));
	$wpdb->query( $wpdb->prepare('INSERT INTO ricca3_especialitats (idespecialitat, nomespecialitat,                   codiespecialitat, pla,     actiu_es, cursos, ordre_es,   professio,                duracio, stampuser, stampplace )'.
			'                                                   VALUES (9,              "ACCES A C.F.S.",                  "",               "LOGSE", 0,        2,     9,           " ",                      "2000",  "upgrade", "upgrade" ) '.
			'ON DUPLICATE KEY UPDATE   nomespecialitat="ACCES A C.F.S.",                  codiespecialitat="",     pla="LOGSE", actiu_es=0,  cursos=2, ordre_es=9,  professio=" ",                      duracio="1400", stampuser="update", stampplace="update" ', NULL));
	$wpdb->query( $wpdb->prepare('INSERT INTO ricca3_especialitats (idespecialitat, nomespecialitat,                   codiespecialitat, pla,     actiu_es, cursos, ordre_es,   professio,                duracio, stampuser, stampplace )'.
			'                                                   VALUES (10,             "PRÒTESIS DENTAL (*)",             "",               "LOE",   1,        2,     10,          "PROTÈSIC DENTAL",        "2000",  "upgrade", "upgrade" ) '.
			'ON DUPLICATE KEY UPDATE   nomespecialitat="PRÒTESIS DENTAL (*)",             codiespecialitat="",     pla="LOE",   actiu_es=1,  cursos=2, ordre_es=10, professio="PROTÈSIC DENTAL",        duracio="2000", stampuser="update", stampplace="update" ', NULL));
	$time_end = microtime(true);
	$time = $time_end - $time_start;
	
	printf('<table><tr><td>avaluacions, cursos, estat especialitats: Ha trigat %s segons</td></tr></table>', $time);
}

#############################################################################################
/**   */
#############################################################################################
function ricca3_ricca3_credaval(){
	global $wpdb;
	$time_start = microtime(true);
	
	$dades = $wpdb->get_results( 'SELECT * FROM ricca.ricca_credits_avaluacions', ARRAY_A);
	
	for( $i = 0; $i < count($dades); $i++ ){
		$row_any   = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_any WHERE any=%s',   $dades[$i]['idany']), ARRAY_A, 0);
		$wpdb->query( $wpdb->prepare('INSERT INTO ricca3_credits_avaluacions ( idcredaval,    idany,    idccomp,    idalumne,    nota1,    nota2,    nota3,'.
			'recup,    notaf_cc,    notaf_cr,    act1,    act2,    actf,    pendi,    repe,    convord,    convext1,    convext2, stampuser, stampplace)'.
			'                                                         VALUES ( %d,            %d,       %d,         %d,          %s,       %s,       %s,'.
			'%s,       %s,          %s,          %s,      %s,      %s,      %s,       %s,      %d,         %d,          %d,       "upgrade", "upgrade" )'.
			' ON DUPLICATE KEY UPDATE                                                                idany=%d, idccomp=%d, idalumne=%d, nota1=%s, nota2=%s, nota3=%s,'.
			'recup=%s, notaf_cc=%s, notaf_cr=%s, act1=%s, act2=%s, actf=%s, pendi=%s, repe=%s, convord=%d, convext1=%d, convext2=%d, stampuser="update", stampplace="update" ',
			$dades[$i]['idkey'], $row_any['idany'], $dades[$i]['idccomp'], $dades[$i]['idalumne'], $dades[$i]['nota1'], $dades[$i]['nota2'], $dades[$i]['nota3'],
			$dades[$i]['recup'], $dades[$i]['notaf'], $dades[$i]['notaf'], $dades[$i]['act1'], $dades[$i]['act2'], $dades[$i]['actf'], $dades[$i]['pendi'], $dades[$i]['repe'], $dades[$i]['convord'], $dades[$i]['convext1'], $dades[$i]['convext2'],
			                     $row_any['idany'], $dades[$i]['idccomp'], $dades[$i]['idalumne'], $dades[$i]['nota1'], $dades[$i]['nota2'], $dades[$i]['nota3'],
			$dades[$i]['recup'], $dades[$i]['notaf'], $dades[$i]['notaf'], $dades[$i]['act1'], $dades[$i]['act2'], $dades[$i]['actf'], $dades[$i]['pendi'], $dades[$i]['repe'], $dades[$i]['convord'], $dades[$i]['convext1'], $dades[$i]['convext2'] ));
	}
	$time_end = microtime(true);
	$time = $time_end - $time_start;
	
	printf('<table><tr><td>[ricca3_credits_avaluacions]: Ha trigat %s segons en fer %s transaccions</td></tr></table>', $time, count($dades) );
}

#############################################################################################
/**   */
#############################################################################################
function ricca3_ricca3_credespec(){
	global $wpdb;
	$time_start = microtime(true);

	$dades = $wpdb->get_results('SELECT * FROM ricca.ricca_credits_especialitat', ARRAY_A);
	for( $i = 0; $i < count($dades); $i++ ){
		$wpdb->query( $wpdb->prepare('INSERT INTO ricca3_credits_especialitat ( idcredespec,    idespecialitat,    idcredit,    modul,    ordre_cr_es,    numero, stampuser, stampplace)'.
			'                                                          VALUES ( %d,             %d,                %d,          %d,       %d,             %s,     "upgrade", "upgrade")'.
			' ON DUPLICATE KEY UPDATE                                                                  idespecialitat=%d, idcredit=%d, modul=%d, ordre_cr_es=%d, numero=%s, stampuser="update", stampplace="update" ',
			$dades[$i]['idkey'], $dades[$i]['idespecialitat'], $dades[$i]['idcredit'], $dades[$i]['modul'], $dades[$i]['ordre'], $dades[$i]['numero'],
			                     $dades[$i]['idespecialitat'], $dades[$i]['idcredit'], $dades[$i]['modul'], $dades[$i]['ordre'], $dades[$i]['numero'] ));
	}
	$time_end = microtime(true);
	$time = $time_end - $time_start;
	
	printf('<table><tr><td>[ricca3_credits_credits_especialitat]: Ha trigat %s segons en fer %s transaccions</td></tr></table>', $time, count($dades) );	
}

#############################################################################################
/**   */
#############################################################################################
function ricca3_ricca3_historial(){
	global $wpdb;
	$time_start = microtime(true);
	
	$dades = $wpdb->get_results('SELECT * FROM ricca.ricca_historial', ARRAY_A);
	for( $i = 0; $i < count($dades); $i++ ){
		$wpdb->query( $wpdb->prepare('INSERT INTO ricca3_historial ( idhistorial, idalumne,    idespecialitat, codi_c,    nom_c,    grau_c,    titol,    prova,    condic,    cicle_codi,    cicle_nom,    cicle_any_de, '.
				'cicle_any_a,    cicle_curs,    modul,    m_hores,    m_qual,    m_conv,    uf,    uf_hores,    uf_qual,    uf_conv,    qual_final,    obs, stampuser, stampplace )'.
				'                                           VALUES ( %d,          %d,          %d,             %s,        %s,       %s,        %s,       %s,       %s,        %s,            %s,           %s, '.
				'%s,             %s,            %s,       %s,         %s,        %s,        %s,    %s,          %s,         %s,          %1.03f,       %s,  "upgrade", "upgrade" )'.
				' ON DUPLICATE KEY UPDATE                                                       idalumne=%d, idespecialitat=%d, codi_c=%s, nom_c=%s, grau_c=%s, titol=%s, prova=%s, condic=%s, cicle_codi=%s, cicle_nom=%s, cicle_any_de=%s, '.
				'cicle_any_a=%s, cicle_curs=%s, modul=%s, m_hores=%s, m_qual=%s, m_conv=%s, uf=%s, uf_hores=%s, uf_qual=%s, uf_conv=%s, qual_final=%1.03f, obs=%s, stampuser="update", stampplace="update" ',
				$dades[$i]['idkey'], $dades[$i]['idalumne'], $dades[$i]['idespecialitat'], $dades[$i]['codi_c'], $dades[$i]['nom_c'], $dades[$i]['grau_c'], $dades[$i]['titol'], $dades[$i]['prova'], $dades[$i]['condic'], $dades[$i]['cicle_codi'], $dades[$i]['cicle_nom'], $dades[$i]['cicle_any_de'],
				$dades[$i]['cicle_any_a'], $dades[$i]['cicle_curs'], $dades[$i]['modul'], $dades[$i]['m_hores'], $dades[$i]['m_qual'], $dades[$i]['m_conv'], $dades[$i]['uf'], $dades[$i]['uf_hores'], $dades[$i]['uf_qual'], $dades[$i]['uf_conv'], $dades[$i]['qual_final'], $dades[$i]['obs'],
									 $dades[$i]['idalumne'], $dades[$i]['idespecialitat'], $dades[$i]['codi_c'], $dades[$i]['nom_c'], $dades[$i]['grau_c'], $dades[$i]['titol'], $dades[$i]['prova'], $dades[$i]['condic'], $dades[$i]['cicle_codi'], $dades[$i]['cicle_nom'], $dades[$i]['cicle_any_de'],
				$dades[$i]['cicle_any_a'], $dades[$i]['cicle_curs'], $dades[$i]['modul'], $dades[$i]['m_hores'], $dades[$i]['m_qual'], $dades[$i]['m_conv'], $dades[$i]['uf'], $dades[$i]['uf_hores'], $dades[$i]['uf_qual'], $dades[$i]['uf_conv'], $dades[$i]['qual_final'], $dades[$i]['obs'] ));
	}
	$time_end = microtime(true);
	$time = $time_end - $time_start;
	
	printf('<table><tr><td>[ricca3_credits_credits_historial]: Ha trigat %s segons en fer %s transaccions</td></tr></table>', $time, count($dades) );
}

#############################################################################################
/**   */
#############################################################################################
function ricca3_ricca3_pla(){
	global $wpdb;
	$time_start = microtime(true);

	$dades = $wpdb->get_results('SELECT * FROM ricca.ricca_plan', ARRAY_A);
	for( $i = 0; $i < count($dades); $i++ ){
		$row_any   = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_any   WHERE any=%s',   $dades[$i]['any']), ARRAY_A, 0);
		$wpdb->query( $wpdb->prepare('INSERT INTO ricca3_pla ( idpla, idany, idccomp, stampuser, stampplace ) VALUES ( %d, %d, %d, "upgrade", "upgrade" ) ON DUPLICATE KEY UPDATE idany=%d, idccomp=%d, stampuser="update", stampplace="update" ',
				$dades[$i]['idkey'], $row_any['idany'], $dades[$i]['idccomp'], $row_any['idany'], $dades[$i]['idccomp'] ));
	}
	$time_end = microtime(true);
	$time = $time_end - $time_start;
	
	printf('<table><tr><td>[ricca3_pla]: Ha trigat %s segons en fer %s transaccions</td></tr></table>', $time, count($dades) );
}

#############################################################################################
/**   */
#############################################################################################
function ricca3_ricca3_grups(){
	global $wpdb;
	$time_start = microtime(true);
	
	$dades = $wpdb->get_results('SELECT * FROM ricca.ricca_grups', ARRAY_A);
	for( $i = 0; $i < count($dades); $i++ ){
		$row_curs = $wpdb->get_row( $wpdb->prepare( 'SELECT * FROM ricca3_cursos WHERE curs=%s', $dades[$i]['curs']), ARRAY_A, 0);
		$wpdb->query( $wpdb->prepare('INSERT INTO ricca3_grups ( idgrup,    grup,    idespecialitat,    idcurs,    actiu_gr,    ordre_gr,    sessio, stampuser, stampplace ) '.
			'                                           VALUES ( %d,        %s,      %d,                %d,        %d,          %d,          %s,     "upgrade", "upgrade" ) '.
			' ON DUPLICATE KEY UPDATE                                              grup=%s, idespecialitat=%d, idcurs=%d, actiu_gr=%d, ordre_gr=%d, sessio=%s, stampuser="update", stampplace="update" ',
			$dades[$i]['idgrup'], $dades[$i]['grup'], $dades[$i]['idespecialitat'], $row_curs['idcurs'], $dades[$i]['actiu'], $dades[$i]['ordre'], $dades[$i]['sessio'],
								  $dades[$i]['grup'], $dades[$i]['idespecialitat'], $row_curs['idcurs'], $dades[$i]['actiu'], $dades[$i]['ordre'], $dades[$i]['sessio'] ));
	}
	$time_end = microtime(true);
	$time = $time_end - $time_start;
	
	printf('<table><tr><td>[ricca3_grups]: Ha trigat %s segons en fer %s transaccions</td></tr></table>', $time, count($dades) );
}













