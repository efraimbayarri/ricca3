<?php
## Release build 2013.27.5
#############################################################################################
/**
 * Dades primaries
 * shortcode: [ricca3-dades]
 *
 * @since ricca3.v.2013.20.7
 * @author Efraim Bayarri
 */
#############################################################################################
function ricca3_shortcode_dades($atts, $content = null) {
	global $ricca3_butons_dades;

	ricca3_missatge(__('Dades primeries','ricca3-dades'));
//		preparar ajudes als butons
	$ricca3_butons_dades['texte'][0] = __('ajuda-dades-espec', 'ricca3-dades');
	$ricca3_butons_dades['texte'][1] = __('ajuda-dades-cred', 'ricca3-dades');
	$ricca3_butons_dades['texte'][2] = __('ajuda-dades-grup', 'ricca3-dades');
	$ricca3_butons_dades['texte'][3] = __('ajuda-dades-prof', 'ricca3-dades');
	$ricca3_butons_dades['texte'][4] = __('ajuda-dades-ccomp', 'ricca3-dades');
	$ricca3_butons_dades['texte'][6] = __('ajuda-dades-pla', 'ricca3-dades');
	$ricca3_butons_dades['texte'][7] = __('ajuda-dades-guardarpla', 'ricca3-dades');
//		butons
	ricca3_butons( $ricca3_butons_dades, 12 );
}

#############################################################################################
/**
 * definició de les especialitats
 * shortcode: [ricca3-espec]
 *
 * @since ricca3.v.2013.20.7
 * @author Efraim Bayarri
 */
#############################################################################################
function ricca3_shortcode_espec($atts, $content = null) {
	global $wpdb;
	global $ricca3_butons_espec;
	global $ricca3_listespec;
	global $ricca3_editespec;
	global $current_user;
	
	get_currentuserinfo();
	ricca3_missatge(__('Definició Especialitats','ricca3-dades'));
	$ricca3_butons_espec['texte'][0] = __('ajuda-dades-dades', 'ricca3-dades');
//		butons
	ricca3_butons( $ricca3_butons_espec, 6 );
//	update
	if(isset($_POST['crear']) && $_POST['crear'] == 'guardar'){
		for( $i = 0; $i < count($_POST['idespecialitat']); $i++){
//			$wpdb->update('ricca3_especialitats',
			ricca3_dbupdate('ricca3_especialitats',
				array(	'nomespecialitat'  => $_POST['nomespecialitat'][$i],
						'codiespecialitat' => $_POST['codiespecialitat'][$i],
						'pla'              => $_POST['pla'][$i],
						'actiu_es'         => $_POST['actiu_es'][$i],
						'cursos'           => $_POST['cursos'][$i],
						'ordre_es'         => $_POST['ordre_es'][$i],
						'professio'        => $_POST['professio'][$i],
						'duracio'          => $_POST['duracio'][$i],
						'stampuser'        => $current_user->user_login,
						'stampplace'       => 'ricca_shortcode_especialitats'
				),
				array( 'idespecialitat' => $_POST['idespecialitat'][$i])
			);
		}
		unset($_POST['crear']);
	}
//	nova especialitat
	if(isset($_POST['crear']) && $_POST['crear'] == 'nou'){
		$wpdb->insert('ricca3_especialitats',
			array(	'nomespecialitat'  => $_POST['nom'],
					'codiespecialitat' => $_POST['codi'],
					'pla'              => $_POST['pla'],
					'actiu_es'         => $_POST['actiu_es'],
					'cursos'           => $_POST['cursos'],
					'ordre_es'         => $_POST['ordre_es'],
					'professio'        => $_POST['prof'],
					'duracio'          => $_POST['hores'],
					'stampuser'        => $current_user->user_login,
					'stampplace'       => 'ricca_shortcode_especialitats_insert'
				)
		);
		unset($_POST['crear']);
	}
//	eliminar especialitat
	if(isset($_POST['crear']) && $_POST['crear'] == 'delete'){
		if(!$wpdb->query($wpdb->prepare('DELETE FROM ricca3_especialitats WHERE idespecialitat=%s', $_POST['idespecialitat'])))
			ricca3_missatge(__('No es pot eliminar l\'especialitat','ricca3-dades'));
		unset($_POST['crear']);
	}
	if(!isset($_POST['crear']) || $_POST['crear'] != 'editar'){
//	capçalera de la taula
//	no estem editan
		printf('<table>', NULL);
		$data_view = $wpdb->get_results( 'SELECT * FROM ricca3_especialitats ORDER BY ordre_es ASC', ARRAY_A);
//		llistat de les especialitats del alumne
		ricca3_graella( $ricca3_listespec, $data_view );
		printf('</table>', NULL);
	}else{
//	capçalera de la taula
//	estem editan
		printf('<form method="post" action="" target="_self" name="especialitats"><table>', NULL);
		$data_view = $wpdb->get_results( 'SELECT * FROM ricca3_especialitats ORDER BY ordre_es ASC', ARRAY_A);
//	llistat de les especialitats del alumne
		ricca3_graella( $ricca3_editespec, $data_view );
		printf('<tr><td><button type="submit" name="crear" value="guardar"><font size ="1px" face="Arial, Helvetica, sans-serif">%s</button></td></tr></table></form>',	__('Guardar dades','ricca3-dades'));
	}
	printf('<form method="post" action="" target="_self" name="especialitats"><table>', NULL);
	printf('<tr><td><button type="submit" name="crear" value="editar"><font size ="1px" face="Arial, Helvetica, sans-serif">%s', __('Editar dades','ricca3-dades'));
	printf('</font></button></td><td><button type="submit" name="crear" value="afegir"><font size ="1px" face="Arial, Helvetica, sans-serif">%s', __('Afegir especialitat','ricca3-dades'));
	printf('</font></button></td><td><button type="submit" name="crear" value="eliminar"><font size ="1px" face="Arial, Helvetica, sans-serif">%s', __('Eliminar especialitat','ricca3-dades'));
	printf('</font></button></td></tr></table></form>', NULL);
//	prepara afegir
	if(isset($_POST['crear']) && $_POST['crear'] == 'afegir'){
		printf('<form method="post" action="" target="_self" name="especialitats"><table><tr><td>%s', __('Nom especialitat:', 'ricca3-dades'));
		printf('<INPUT type="text" name="nom"       size="20" /></td><td>%s', __('Pla:', 'ricca3-dades'));
		printf('<INPUT type="text" name="pla"       size="20" /></td><td>%s', __('Actiu:', 'ricca3-dades'));
		printf('<INPUT type="text" name="actiu_es"  size="5"  /></td><td>%s', __('Codi:', 'ricca3-dades'));
		printf('<INPUT type="text" name="codi"      size="5"  /></td><td>%s', __('Cursos:', 'ricca3-dades'));
		printf('<INPUT type="text" name="cursos"    size="5"  /></td><td>%s', __('Ordre:', 'ricca3-dades'));
		printf('<INPUT type="text" name="ordre_es"  size="5"  /></td><td>%s', __('Professió:', 'ricca3-dades'));
		printf('<INPUT type="text" name="prof"      size="20" /></td><td>%s', __('Hores:', 'ricca3-dades'));
		printf('<INPUT type="text" name="hores"     size="5"  /></td></tr><tr><td><button type="submit" name="crear" value="nou"><font size ="1px" face="Arial, Helvetica, sans-serif">%s', __('Guardar dades:','ricca3-dades'));
		printf('</font></button></td></tr></table></form>', NULL);
	}
//	prepara eliminar
	if(isset($_POST['crear']) && $_POST['crear'] == 'eliminar'){
		printf('<form method="post" action="" target="_self" name="especialitats"><table><tr><td>%s', __('id especialitat:', 'ricca3-dades'));
		printf('<INPUT type="text" name="idespecialitat" size="5" /></td></tr><tr><td><button type="submit" name="crear" value="delete"><font size ="1px" face="Arial, Helvetica, sans-serif">', NULL);
		printf('%s</font></button></td></tr></table></form>', __('Guardar dades:','ricca3-dades'));
	}
}

#############################################################################################
/**
 * definició dels crèdits
 * shortcode: [ricca3-cred]
 *
 * @since ricca3.v.2013.20.7
 * @author Efraim Bayarri
 */
#############################################################################################
function ricca3_shortcode_cred($atts, $content = null) {
	global $wpdb;
	global $ricca3_butons_espec;
	global $ricca3_listcredit;
	global $ricca3_editcredit;
	global $current_user;

	get_currentuserinfo();
	ricca3_missatge(__('Definició Crèdits','ricca3-dades'));
	$ricca3_butons_espec['texte'][0] = __('ajuda-dades-dades', 'ricca3-dades');
//		butons
	ricca3_butons( $ricca3_butons_espec, 6 );
//	drop	
	printf('<form method="post" action="" name="cercar"><table dir="ltr" class="menucurt600"><tr>', NULL);
	ricca3_drop_fixe( __('Estat:','ricca3-dades'), 'estat', array( "1" , "0"), array( "actiu", "inactiu"),  __('ajuda-credits-estat', 'ricca3-dades') );
	ricca3_drop_fixe( __('Curs:','ricca3-dades'),  'curs',  array( "1" , "2"), array( "Curs I", "Curs II"), __('ajuda-credits-curs', 'ricca3-dades')  );
//		drop per a especialitat
	$data_espec = $wpdb->get_results('SELECT * FROM ricca3_especialitats WHERE actiu_es = 1 ORDER BY ordre_es ', ARRAY_A);
	ricca3_drop( __('Especialitat:','ricca3-dades'), 'espec', $data_espec, 'idespecialitat', 'nomespecialitat', __('ajuda_drop_especialitat', 'ricca3-dades'), FALSE );
	printf('</tr></table>', NULL);
	ricca3_desar('cercar', 'actualitzar', __('ajuda-dades-cred-drop', 'ricca3-dades'));
	printf('</form>', NULL);
	if(isset($_POST['cercar'])){
		$query = "SELECT * FROM ricca3_credits WHERE 1 = 1";
		if( $_POST['espec'] != "-1") $query = substr_replace( $query," AND idespecialitat = '".$_POST['espec']."' ",strlen( $query ) , 0 );
		if( $_POST['estat'] != "-1") $query = substr_replace( $query," AND actiu_cr='"  .$_POST['estat']."' ",strlen( $query ) , 0 );
		if( $_POST['curs']  != "-1") $query = substr_replace( $query," AND idcurs='"   .$_POST['curs']."' ",strlen( $query ) , 0 );
		$query = substr_replace( $query," ORDER BY ordre_cr ASC ",strlen( $query ), 0 );
	}
//	Guardem les dades
	if(isset($_POST['cercar']) && $_POST['cercar'] == 'guardar'){
		for( $i = 0; $i < count($_POST['idcredit']); $i++){
//			$wpdb->update('ricca3_credits',
			ricca3_dbupdate('ricca3_credits',
				array(	'nomcredit'      => stripslashes($_POST['nomcredit'][$i]),
						'actiu_cr'       => $_POST['actiu_cr'][$i],
						'aval3nomes'     => $_POST['aval3nomes'][$i],
						'idespecialitat' => $_POST['idespecialitat'][$i],
						'idcurs'         => $_POST['idcurs'][$i],
						'hores_cr'       => $_POST['hores_cr'][$i],
						'ordre_cr'       => $_POST['ordre_cr'][$i],
						'credit'         => stripslashes($_POST['credit'][$i]),
						'stampuser'      => $current_user->user_login,
						'stampplace'     => 'ricca_shortcode_credits' ),
				array( 'idcredit' => $_POST['idcredit'][$i]) );
		}
		$_POST['cercar'] = 'actualitzar';
	}
// 	nou crèdit
	if(isset($_POST['cercar']) && $_POST['cercar'] == 'nou'){
		$wpdb->insert('ricca3_credits',
			array(	'nomcredit'      => $_POST['nomcredit'],
					'actiu_cr'       => $_POST['actiu_cr'],
					'aval3nomes'     => $_POST['aval3nomes'],
					'idespecialitat' => $_POST['idespecialitat'],
					'idcurs'         => $_POST['idcurs'],
					'hores_cr'       => $_POST['hores_cr'],
					'ordre_cr'       => $_POST['ordre_cr'],
					'credit'         => $_POST['credit'],
					'stampuser'      => $current_user->user_login,
					'stampplace'     => 'ricca_shortcode_credits_insert' ) );
		$_POST['cercar'] = 'actualitzar';
	}
//	esborrar crèdit
	if(isset($_POST['cercar']) && $_POST['cercar'] == 'delete'){
		if(!$wpdb->query($wpdb->prepare('DELETE FROM ricca3_credits WHERE idcredit=%s', $_POST['idcredit'])))
			ricca3_missatge(__('No es pot eliminar el crèdit!','ricca3-dades'));
		$_POST['cercar'] = 'actualitzar';
	}
//
	if(isset($_POST['cercar']) && $_POST['cercar'] != 'editar'){
		printf('<table>', NULL);
		$data_view = $wpdb->get_results( $query, ARRAY_A);
		ricca3_graella( $ricca3_listcredit, $data_view );
		printf('</table>', NULL);
	}
	if(isset($_POST['cercar']) && $_POST['cercar'] == 'editar'){
//	estem editan
		printf('<form method="post" action="" target="_self" name="especialitats"><table>', NULL);
		$data_view = $wpdb->get_results( $query, ARRAY_A);
		ricca3_graella( $ricca3_editcredit, $data_view );
		printf('<tr><td><button type="submit" name="cercar" value="guardar"><font size ="1px" face="Arial, Helvetica, sans-serif">%s</button>',	__('Guardar dades','ricca3-dades'));
		printf('<INPUT type="hidden" name="estat" value="%s" /><INPUT type="hidden" name="curs" value="%s" /><INPUT type="hidden" name="espec" value="%s" />', $_POST['estat'], $_POST['curs'], $_POST['espec']);
		printf('</td></tr></table></form>', NULL);
	}
	if(isset($_POST['cercar']) && $_POST['cercar'] == 'actualitzar'){
		printf('<form method="post" action="" target="_self" name="especialitats"><table>', NULL);
		printf('<tr><td><button type="submit" name="cercar" value="editar">  <font size ="1px" face="Arial, Helvetica, sans-serif">%s</font></button></td>', __('Editar dades','ricca3-dades'));
		printf('    <td><button type="submit" name="cercar" value="afegir">  <font size ="1px" face="Arial, Helvetica, sans-serif">%s</font></button></td>', __('Afegir crèdit','ricca3-dades'));
		printf('    <td><button type="submit" name="cercar" value="eliminar"><font size ="1px" face="Arial, Helvetica, sans-serif">%s</font></button>', __('Eliminar crèdit','ricca3-dades'));
		printf('<INPUT type="hidden" name="estat" value="%s" /><INPUT type="hidden" name="curs" value="%s" /><INPUT type="hidden" name="espec" value="%s" /></td></tr></table></form>', 
			$_POST['estat'], $_POST['curs'], $_POST['espec']);				
	}
//	prepara afegir
	if(isset($_POST['cercar']) && $_POST['cercar'] == 'afegir'){
		printf('<form method="post" action="" target="_self" name="credits"><table><tr>', NULL); 
		printf('<td>%s<INPUT type="text" name="nomcredit"      size="20" /></td>', __('Nom crèdit:', 'ricca3-dades'));
		printf('<td>%s<INPUT type="text" name="actiu_cr"       size="5"  /></td>', __('Actiu:', 'ricca3-dades'));
		printf('<td>%s<INPUT type="text" name="aval3nomes"     size="5"  /></td>', __('3 Aval:', 'ricca3-dades'));
		printf('<td>%s<INPUT type="text" name="idespecialitat" size="5"  /></td>', __('Espec:', 'ricca3-dades'));
		printf('<td>%s<INPUT type="text" name="idcurs"         size="5"  /></td>', __('Curs:', 'ricca3-dades'));
		printf('<td>%s<INPUT type="text" name="hores_cr"       size="5"  /></td>', __('Hores:', 'ricca3-dades'));
		printf('<td>%s<INPUT type="text" name="ordre_cr"       size="5"  /></td>', __('Ordre:', 'ricca3-dades'));
		printf('<td>%s<INPUT type="text" name="credit"         size="20" /></td></tr>',  __('Nom:', 'ricca3-dades'));
		printf('<tr><td><button type="submit" name="cercar" value="nou"><font size ="1px" face="Arial, Helvetica, sans-serif">%s</font></button></td>', __('Guardar dades:','ricca3-dades'));
		printf('<td><INPUT type="hidden" name="estat" value="%s" />', $_POST['estat']);
		printf('<INPUT type="hidden" name="curs" value="%s" /><INPUT type="hidden" name="espec" value="%s" /></td></tr></table></form>', $_POST['curs'], $_POST['espec']);
	}
//	prepara eliminar
	if(isset($_POST['cercar']) && $_POST['cercar'] == 'eliminar'){
		printf('<form method="post" action="" target="_self" name="credits"><table><tr><td>%s', __('id credit:', 'ricca3-dades'));
		printf('<INPUT type="text" name="idcredit" size="5" /></td></tr><tr><td><button type="submit" name="cercar" value="delete"><font size ="1px" face="Arial, Helvetica, sans-serif">', NULL);
		printf('%s</font></button></td><td><INPUT type="hidden" name="estat" value="%s" />', __('Guardar dades:','ricca3-dades'), $_POST['estat']);
		printf('<INPUT type="hidden" name="curs" value="%s" /><INPUT type="hidden" name="espec" value="%s" /></td></tr></table></form>', $_POST['curs'], $_POST['espec']);
	}
}

#############################################################################################
/**
 * definició dels grups
 * shortcode: [ricca3-grups]
 *
 * @since ricca3.v.2013.21.1
 * @author Efraim Bayarri
 */
#############################################################################################
function ricca3_shortcode_grups($atts, $content = null) {
	global $wpdb;
	global $ricca3_butons_espec;
	global $ricca3_listgrups;
	global $ricca3_editgrups;
	global $current_user;
	
	get_currentuserinfo();
	ricca3_missatge(__('Definició dels grups','ricca3-dades'));
	$ricca3_butons_espec['texte'][0] = __('ajuda-dades-dades', 'ricca3-dades');
//		butons
	ricca3_butons( $ricca3_butons_espec, 6 );
//	drop
	printf('<form method="post" action="" name="cercar"><table dir="ltr" class="menucurt600"><tr>', NULL);
	ricca3_drop_fixe( __('Estat:','ricca3-dades'), 'estat', array( "1" , "0"), array( "actiu", "inactiu"),  __('ajuda-credits-estat', 'ricca3-dades') );
	ricca3_drop_fixe( __('Curs:','ricca3-dades'),  'curs',  array( "1" , "2"), array( "Curs I", "Curs II"), __('ajuda-credits-curs', 'ricca3-dades')  );
//		drop per a especialitat
	$data_espec = $wpdb->get_results('SELECT * FROM ricca3_especialitats WHERE actiu_es = 1 ORDER BY ordre_es ', ARRAY_A);
	ricca3_drop( __('Especialitat:','ricca3-dades'), 'espec', $data_espec, 'idespecialitat', 'nomespecialitat', __('ajuda_drop_especialitat', 'ricca3-dades'), FALSE );
	printf('</tr></table>', NULL);
	ricca3_desar('cercar', 'actualitzar', __('ajuda-dades-cred-drop', 'ricca3-dades'));
	printf('</form>', NULL);
	if(isset($_POST['cercar'])){
		$query = "SELECT * FROM ricca3_grups WHERE 1 = 1";
		if( $_POST['espec'] != "-1") $query = substr_replace( $query," AND idespecialitat = '".$_POST['espec']."' ",strlen( $query ) , 0 );
		if( $_POST['estat'] != "-1") $query = substr_replace( $query," AND actiu_gr='"  .$_POST['estat']."' ",strlen( $query ) , 0 );
		if( $_POST['curs']  != "-1") $query = substr_replace( $query," AND idcurs='"   .$_POST['nomcurs']."' ",strlen( $query ) , 0 );
		$query = substr_replace( $query," ORDER BY ordre_gr ASC ",strlen( $query ), 0 );
	}
//	Guardem les dades
	if(isset($_POST['cercar']) && $_POST['cercar'] == 'guardar'){
		for( $i = 0; $i < count($_POST['idgrup']); $i++){
//			$wpdb->update('ricca3_grups',
			ricca3_dbupdate('ricca3_grups',
				array( 	'grup'           => $_POST['grup'][$i],
						'actiu_gr'       => $_POST['actiu_gr'][$i],
						'idespecialitat' => $_POST['idespecialitat'][$i],
						'ordre_gr'       => $_POST['ordre_gr'][$i],
						'idcurs'         => $_POST['idcurs'][$i],
						'sessio'         => $_POST['sessio'][$i],
						'stampuser'      => $current_user->user_login,
						'stampplace'     => 'ricca_shortcode_grups' ),
				array( 'idgrup' => $_POST['idgrup'][$i]) 	) ;
		}
		$_POST['cercar'] = 'actualitzar';
	}
// 	nou grup
	if(isset($_POST['cercar']) && $_POST['cercar'] == 'nou'){
		if(!$wpdb->insert('ricca3_grups',
			array(	'grup'           => $_POST['grup'],
					'actiu_gr'       => $_POST['actiu_gr'],
					'idespecialitat' => $_POST['idespecialitat'],
					'ordre_gr'       => $_POST['ordre_gr'],
					'idcurs'         => $_POST['idcurs'],
					'sessio'         => $_POST['sessio'],
					'stampuser'      => $current_user->user_login,
					'stampplace'     => 'ricca_shortcode_grups_insert' 	) ) )
			ricca3_missatge(__('No es pot crear el grup!','ricca3-dades'));
		$_POST['cercar'] = 'actualitzar';
	}
//	esborrar grup
	if(isset($_POST['cercar']) && $_POST['cercar'] == 'delete'){
		if(!$wpdb->query($wpdb->prepare('DELETE FROM ricca3_grups WHERE idgrup=%s', $_POST['idgrup'])))
			ricca3_missatge(__('No es pot eliminar el grup!','ricca3-dades'));
		$_POST['cercar'] = 'actualitzar';
	}
//
	if(isset($_POST['cercar']) && $_POST['cercar'] != 'editar'){
		printf('<table>', NULL);
		$data_view = $wpdb->get_results( $query, ARRAY_A);
		ricca3_graella( $ricca3_listgrups, $data_view );
		printf('</table>', NULL);
	}
	if(isset($_POST['cercar']) && $_POST['cercar'] == 'editar'){
//	estem editan
		printf('<form method="post" action="" target="_self" name="especialitats"><table>', NULL);
		$data_view = $wpdb->get_results( $query, ARRAY_A);
		ricca3_graella( $ricca3_editgrups, $data_view );
		printf('<tr><td><button type="submit" name="cercar" value="guardar"><font size ="1px" face="Arial, Helvetica, sans-serif">%s</button>',	__('Guardar dades','ricca3-dades'));
		printf('<INPUT type="hidden" name="estat" value="%s" /><INPUT type="hidden" name="curs" value="%s" /><INPUT type="hidden" name="espec" value="%s" />', $_POST['estat'], $_POST['curs'], $_POST['espec']);
		printf('</td></tr></table></form>', NULL);
	}
	if(isset($_POST['cercar']) && $_POST['cercar'] == 'actualitzar'){
		printf('<form method="post" action="" target="_self" name="especialitats"><table>', NULL);
		printf('<tr><td><button type="submit" name="cercar" value="editar">  <font size ="1px" face="Arial, Helvetica, sans-serif">%s</font></button></td>', __('Editar dades','ricca3-dades'));
		printf('    <td><button type="submit" name="cercar" value="afegir">  <font size ="1px" face="Arial, Helvetica, sans-serif">%s</font></button></td>', __('Afegir grup','ricca3-dades'));
		printf('    <td><button type="submit" name="cercar" value="eliminar"><font size ="1px" face="Arial, Helvetica, sans-serif">%s</font></button>', __('Eliminar grup','ricca3-dades'));
		printf('<INPUT type="hidden" name="estat" value="%s" /><INPUT type="hidden" name="curs" value="%s" /><INPUT type="hidden" name="espec" value="%s" /></td></tr></table></form>',
		$_POST['estat'], $_POST['curs'], $_POST['espec']);
	}
//	prepara afegir
	if(isset($_POST['cercar']) && $_POST['cercar'] == 'afegir'){
		printf('<form method="post" action="" target="_self" name="grups"><table><tr>', NULL);
		printf('<td>%s<INPUT type="text" name="grup"           size="20" /></td>', __('Grup:', 'ricca3-dades'));
		printf('<td>%s<INPUT type="text" name="actiu_gr"       size="5"  /></td>', __('Actiu:', 'ricca3-dades'));
		printf('<td>%s<INPUT type="text" name="idespecialitat" size="5"  /></td>', __('Espec:', 'ricca3-dades'));
		printf('<td>%s<INPUT type="text" name="ordre_gr"       size="5"  /></td>', __('Ordre:', 'ricca3-dades'));
		printf('<td>%s<INPUT type="text" name="idcurs"         size="5"  /></td>', __('Curs:', 'ricca3-dades'));
		printf('<td>%s<INPUT type="text" name="sessio"         size="5"  /></td></tr>', __('Sessió:', 'ricca3-dades'));
		printf('<tr><td><button type="submit" name="cercar" value="nou"><font size ="1px" face="Arial, Helvetica, sans-serif">%s</font></button></td>', __('Guardar dades:','ricca3-dades'));
		printf('<td><INPUT type="hidden" name="estat" value="%s" />', $_POST['estat']);
		printf('<INPUT type="hidden" name="curs" value="%s" /><INPUT type="hidden" name="espec" value="%s" /></td></tr></table></form>', $_POST['curs'], $_POST['espec']);
	}
//	prepara eliminar
	if(isset($_POST['cercar']) && $_POST['cercar'] == 'eliminar'){
		printf('<form method="post" action="" target="_self" name="grups"><table><tr><td>%s', __('id grup:', 'ricca3-dades'));
		printf('<INPUT type="text" name="idgrup" size="5" /></td></tr><tr><td><button type="submit" name="cercar" value="delete"><font size ="1px" face="Arial, Helvetica, sans-serif">', NULL);
		printf('%s</font></button></td><td><INPUT type="hidden" name="estat" value="%s" />', __('Guardar dades:','ricca3-dades'), $_POST['estat']);
		printf('<INPUT type="hidden" name="curs" value="%s" /><INPUT type="hidden" name="espec" value="%s" /></td></tr></table></form>', $_POST['curs'], $_POST['espec']);
	}
}

#############################################################################################
/**
 * definició dels professors
 * shortcode: [ricca3-prof]
 *
 * @since ricca3.v.2013.21.1
 * @author Efraim Bayarri
 */
#############################################################################################
function ricca3_shortcode_prof($atts, $content = null) {
	global $wpdb;
	global $ricca3_butons_espec;
	global $ricca3_listprof;
	global $ricca3_editprof;
	global $current_user;

	if(!isset($_POST['cercar']))$_POST['cercar'] = 'actualitzar';
	get_currentuserinfo();
	ricca3_missatge(__('Definició dels professors','ricca3-dades'));
	$ricca3_butons_espec['texte'][0] = __('ajuda-dades-dades', 'ricca3-dades');
//		butons
	ricca3_butons( $ricca3_butons_espec, 6 );
	$query = 'SELECT * FROM ricca3_professors ORDER BY idprof ASC';
//	Guardem les dades
	if(isset($_POST['cercar']) && $_POST['cercar'] == 'guardar'){
		for( $i = 0; $i < count($_POST['idprof']); $i++){
//			$wpdb->update('ricca3_professors',
			ricca3_dbupdate('ricca3_professors',
				array( 	'idprof'      => $_POST['idprof'][$i],
						'idtutor'     => $_POST['idprof'][$i],
						'nomicognoms' => $_POST['nomicognoms'][$i],
						'telcasa'     => $_POST['telcasa'][$i],
						'telcont1'    => $_POST['telcont1'][$i],
						'telcont2'    => $_POST['telcont2'][$i],
						'telcont3'    => $_POST['telcont3'][$i],
						'email'       => $_POST['email'][$i],
						'stampuser'   => $current_user->user_login,
						'stampplace'  => 'ricca_shortcode_grups' ),
				array( 'idprof' => $_POST['idprof'][$i]) 	) ;
		}
		$_POST['cercar'] = 'actualitzar';
	}
// 	nou professor
	if(isset($_POST['cercar']) && $_POST['cercar'] == 'nou'){
		if(!$wpdb->insert('ricca3_professors',
			array(	'nomicognoms' => $_POST['nomicognoms'],
					'telcasa'     => $_POST['telcasa'],
					'telcont1'    => $_POST['telcont1'],
					'telcont2'    => $_POST['telcont2'],
					'telcont3'    => $_POST['telcont3'],
					'email'       => $_POST['email'],
					'stampuser'   => $current_user->user_login,
					'stampplace'  => 'ricca_shortcode_grups_insert' 	) ) )
			ricca3_missatge(__('No es pot crear el professor!','ricca3-dades'));
		$_POST['cercar'] = 'actualitzar';
	}
//	esborrar professor
	if(isset($_POST['cercar']) && $_POST['cercar'] == 'delete'){
		if(!$wpdb->query($wpdb->prepare('DELETE FROM ricca3_professors WHERE idprof=%s', $_POST['idprof'])))
			ricca3_missatge(__('No es pot eliminar el professor!','ricca3-dades'));
		$_POST['cercar'] = 'actualitzar';
	}
//
	if(isset($_POST['cercar']) && $_POST['cercar'] != 'editar'){
		printf('<table>', NULL);
		$data_view = $wpdb->get_results( $query, ARRAY_A);
		ricca3_graella( $ricca3_listprof, $data_view );
		printf('</table>', NULL);
	}
	if(isset($_POST['cercar']) && $_POST['cercar'] == 'editar'){
//	estem editan
		printf('<form method="post" action="" target="_self" name="especialitats"><table>', NULL);
		$data_view = $wpdb->get_results( $query, ARRAY_A);
		ricca3_graella( $ricca3_editprof, $data_view );
		printf('<tr><td><button type="submit" name="cercar" value="guardar"><font size ="1px" face="Arial, Helvetica, sans-serif">%s</button>',	__('Guardar dades','ricca3-dades'));
		printf('</td></tr></table></form>', NULL);
	}
	if(isset($_POST['cercar']) && $_POST['cercar'] == 'actualitzar'){
		printf('<form method="post" action="" target="_self" name="especialitats"><table>', NULL);
		printf('<tr><td><button type="submit" name="cercar" value="editar">  <font size ="1px" face="Arial, Helvetica, sans-serif">%s</font></button></td>', __('Editar dades','ricca3-dades'));
		printf('    <td><button type="submit" name="cercar" value="afegir">  <font size ="1px" face="Arial, Helvetica, sans-serif">%s</font></button></td>', __('Afegir professor','ricca3-dades'));
		printf('    <td><button type="submit" name="cercar" value="eliminar"><font size ="1px" face="Arial, Helvetica, sans-serif">%s</font></button>', __('Eliminar professor','ricca3-dades'));
		printf('</td></tr></table></form>', NULL);
	}
//	prepara afegir
	if(isset($_POST['cercar']) && $_POST['cercar'] == 'afegir'){
		printf('<form method="post" action="" target="_self" name="grups"><table><tr>', NULL);
		printf('<td>%s<INPUT type="text" name="nomicognoms"    size="45" /></td>', __('Nom:', 'ricca3-dades'));
		printf('<td>%s<INPUT type="text" name="telcasa"        size="20" /></td>', __('Tel. casa:', 'ricca3-dades'));
		printf('<td>%s<INPUT type="text" name="telcont1"       size="20" /></td>', __('Tel. cont1:', 'ricca3-dades'));
		printf('<td>%s<INPUT type="text" name="telcont2"       size="20" /></td>', __('Tel. cont2:', 'ricca3-dades'));
		printf('<td>%s<INPUT type="text" name="telcont3"       size="20" /></td>', __('Tel. cont3:', 'ricca3-dades'));
		printf('<td>%s<INPUT type="text" name="email"          size="20" /></td></tr>', __('Email:', 'ricca3-dades'));
		printf('<tr><td><button type="submit" name="cercar" value="nou"><font size ="1px" face="Arial, Helvetica, sans-serif">%s</font></button></td></tr></table></form>', __('Guardar dades:','ricca3-dades'));
	}
//	prepara eliminar
	if(isset($_POST['cercar']) && $_POST['cercar'] == 'eliminar'){
		printf('<form method="post" action="" target="_self" name="prof"><table><tr><td>%s', __('id professor:', 'ricca3-dades'));
		printf('<INPUT type="text" name="idprof" size="5" /></td></tr><tr><td><button type="submit" name="cercar" value="delete"><font size ="1px" face="Arial, Helvetica, sans-serif">%s</font></button></td></tr></table></form>', __('Guardar dades:','ricca3-dades'));
	}
}	
	
#############################################################################################
/**
 * definició dels crèdits compartits
 * shortcode: [ricca3-ccomp]
 *
 * @since ricca3.v.2013.21.1
 * @author Efraim Bayarri
 */
#############################################################################################
function ricca3_shortcode_ccomp($atts, $content = null) {
	global $wpdb;
	global $ricca3_butons_espec;
	global $ricca3_listccomp;
	global $ricca3_editccomp;
	global $current_user;

	get_currentuserinfo();
	ricca3_missatge(__('Definició dels crèdits compartits','ricca3-dades'));
	$ricca3_butons_espec['texte'][0] = __('ajuda-dades-dades', 'ricca3-dades');
//		butons
	ricca3_butons( $ricca3_butons_espec, 6 );	
//	drop
	printf('<form method="post" action="" name="cercar"><table dir="ltr" class="menucurt600"><tr>', NULL);
	$data_espec = $wpdb->get_results('SELECT * FROM ricca3_especialitats WHERE actiu_es = 1 ORDER BY ordre_es ', ARRAY_A);
	ricca3_drop( __('Especialitat:','ricca3-dades'), 'espec', $data_espec, 'idespecialitat', 'nomespecialitat', __('ajuda_drop_especialitat', 'ricca3-dades'), FALSE );
	printf('</tr></table>', NULL);
	ricca3_desar('cercar', 'actualitzar', __('ajuda-dades-cred-drop', 'ricca3-dades'));
	printf('</form>', NULL);

	if(isset($_POST['cercar'])){
		$query = "SELECT * FROM ricca3_ccomp_view WHERE 1 = 1";
		if( $_POST['espec'] != "-1") $query = substr_replace( $query," AND idespecialitat = '".$_POST['espec']."' ",strlen( $query ) , 0 );
	}	
//	Guardem les dades
	if(isset($_POST['cercar']) && $_POST['cercar'] == 'guardar'){
		for( $i = 0; $i < count($_POST['idccomp']); $i++){
//			$wpdb->update('ricca3_ccomp',
			ricca3_dbupdate('ricca3_ccomp',
				array( 	'idcredit'    => $_POST['idcredit'][$i],
						'idgrup'      => $_POST['idgrup'][$i],
						'hores_cc'    => $_POST['hores_cc'][$i],
						'idprofessor' => $_POST['idprofessor'][$i],
						'idtutor'     => $_POST['idtutor'][$i],
						'actiu_cc'    => $_POST['actiu_cc'][$i],
						'nomccomp'    => stripslashes($_POST['nomccomp'][$i]),
						'stampuser'   => $current_user->user_login,
						'stampplace'  => 'ricca_shortcode_grups' ),
				array( 'idccomp' => $_POST['idccomp'][$i]) 	) ;
		}
		$_POST['cercar'] = 'actualitzar';
	}
// 	nou crèdit
	if(isset($_POST['cercar']) && $_POST['cercar'] == 'nou'){
		if(!$wpdb->insert('ricca3_ccomp',
			array(	'idcredit'    => $_POST['idcredit'],
					'idgrup'      => $_POST['idgrup'],
					'hores_cc'    => $_POST['hores_cc'],
					'idprofessor' => $_POST['idprofessor'],
					'idtutor'     => $_POST['idtutor'],
					'actiu_cc'    => $_POST['actiu_cc'],
					'nomccomp'    => $_POST['nomccomp'],
					'stampuser'   => $current_user->user_login,
					'stampplace'  => 'ricca_shortcode_grups_insert' 	) ) )
			ricca3_missatge(__('No es pot crear el crèdit compartit!','ricca3-dades'));
		$_POST['cercar'] = 'actualitzar';
	}
//	esborrar crèdit
	if(isset($_POST['cercar']) && $_POST['cercar'] == 'delete'){
		if(!$wpdb->query($wpdb->prepare('DELETE FROM ricca3_ccomp WHERE idccomp=%s', $_POST['idccomp'])))
			ricca3_missatge(__('No es pot eliminar el crèdit compartit!','ricca3-dades'));
		$_POST['cercar'] = 'actualitzar';
	}
//
	if(isset($_POST['cercar']) && $_POST['cercar'] != 'editar'){
		printf('<table>', NULL);
		$data_view = $wpdb->get_results( $query, ARRAY_A);
		ricca3_graella( $ricca3_listccomp, $data_view );
		printf('</table>', NULL);
	}
	if(isset($_POST['cercar']) && $_POST['cercar'] == 'editar'){
//	estem editan
		printf('<form method="post" action="" target="_self" name="especialitats"><table>', NULL);
		$data_view = $wpdb->get_results( $query, ARRAY_A);
		ricca3_graella( $ricca3_editccomp, $data_view );
		printf('<tr><td><button type="submit" name="cercar" value="guardar"><font size ="1px" face="Arial, Helvetica, sans-serif">%s</button>',	__('Guardar dades','ricca3-dades'));
		printf('<INPUT type="hidden" name="espec" value="%s" />', $_POST['espec']);
		printf('</td></tr></table></form>', NULL);
	}
	if(isset($_POST['cercar']) && $_POST['cercar'] == 'actualitzar'){
		printf('<form method="post" action="" target="_self" name="especialitats"><table>', NULL);
		printf('<tr><td><button type="submit" name="cercar" value="editar">  <font size ="1px" face="Arial, Helvetica, sans-serif">%s</font></button></td>', __('Editar dades','ricca3-dades'));
		printf('    <td><button type="submit" name="cercar" value="afegir">  <font size ="1px" face="Arial, Helvetica, sans-serif">%s</font></button></td>', __('Afegir ccomp','ricca3-dades'));
		printf('    <td><button type="submit" name="cercar" value="eliminar"><font size ="1px" face="Arial, Helvetica, sans-serif">%s</font></button>', __('Eliminar ccomp','ricca3-dades'));
		printf('<INPUT type="hidden" name="espec" value="%s" /></td></tr></table></form>', $_POST['espec']);
	}
//	prepara afegir
	if(isset($_POST['cercar']) && $_POST['cercar'] == 'afegir'){
		printf('<form method="post" action="" target="_self" name="ccomp"><table><tr>', NULL);
		printf('<td>%s<INPUT type="text" name="idcredit"    size="5"    /></td>', __('idcred:', 'ricca3-dades'));
		printf('<td>%s<INPUT type="text" name="idgrup"      size="5"    /></td>', __('idgrup:', 'ricca3-dades'));
		printf('<td>%s<INPUT type="text" name="hores_cc"    size="5"    /></td>', __('h:', 'ricca3-dades'));
		printf('<td>%s<INPUT type="text" name="idprofessor" size="5"    /></td>', __('idprof:', 'ricca3-dades'));
		printf('<td>%s<INPUT type="text" name="idtutor"     size="5"    /></td>', __('idtut:', 'ricca3-dades'));
		printf('<td>%s<INPUT type="text" name="actiu_cc"    size="5"    /></td>', __('actiu:', 'ricca3-dades'));
		printf('<td>%s<INPUT type="text" name="nomccomp"    size="100"  /></td></tr>', __('nom:', 'ricca3-dades'));
		printf('<tr><td><button type="submit" name="cercar" value="nou"><font size ="1px" face="Arial, Helvetica, sans-serif">%s</font></button></td>', __('Guardar dades:','ricca3-dades'));
		printf('<td><INPUT type="hidden" name="espec" value="%s" /></td></tr></table></form>', $_POST['espec']);
	}
//	prepara eliminar
	if(isset($_POST['cercar']) && $_POST['cercar'] == 'eliminar'){
		printf('<form method="post" action="" target="_self" name="grups"><table><tr><td>%s', __('id ccomp:', 'ricca3-dades'));
		printf('<INPUT type="text" name="idccomp" size="5" /></td></tr><tr><td><button type="submit" name="cercar" value="delete"><font size ="1px" face="Arial, Helvetica, sans-serif">', NULL);
		printf('%s</font></button></td><td><INPUT type="hidden" name="espec" value="%s" /></td></tr></table></form>', __('Guardar dades:','ricca3-dades'), $_POST['espec']);
	}	
}

#############################################################################################
/**
 * Mostrar el pla d'estudis
 * shortcode: [ricca3-pla]
 *
 * @since ricca3.v.2013.21.1
 * @author Efraim Bayarri
 */
#############################################################################################
function ricca3_shortcode_pla($atts, $content = null) {
	global $wpdb;
	global $ricca3_butons_espec;
	global $ricca3_listpla;

	ricca3_missatge(__('Pla d\'estudis','ricca3-dades'));
	$ricca3_butons_espec['texte'][0] = __('ajuda-dades-dades', 'ricca3-dades');
//		butons
	ricca3_butons( $ricca3_butons_espec, 6 );
//		drop
	printf('<form method="post" action="" name="cercar"><table dir="ltr" class="menucurt600"><tr>', NULL);
//		drop per a especialitat
	$data_espec = $wpdb->get_results('SELECT * FROM ricca3_especialitats WHERE actiu_es = 1 ORDER BY ordre_es ', ARRAY_A);
	ricca3_drop( __('Especialitat:','ricca3-dades'), 'espec', $data_espec, 'idespecialitat', 'nomespecialitat', __('ajuda_drop_especialitat', 'ricca3-dades'), FALSE );
//		drop per el grup	
	$data_grup = $wpdb->get_results('SELECT * FROM ricca3_grups WHERE actiu_gr = 1 ORDER BY grup ', ARRAY_A);
	ricca3_drop( __('Grup:','ricca3-dades'), 'grup', $data_grup, 'idgrup', 'grup', __('ajuda_drop_grup', 'ricca3-dades'), FALSE );
	printf('</tr></table>', NULL);
	ricca3_desar('cercar', 'actualitzar', __('ajuda-dades-cred-drop', 'ricca3-dades'));
	printf('</form>', NULL);
	if(isset($_POST['cercar']) && $_POST['cercar'] == 'actualitzar'){
		$query = "SELECT * FROM ricca3_ccomp_view WHERE actiu_cc = 1 AND actiu_cr = 1";
		if( $_POST['espec'] != "-1") $query = substr_replace( $query," AND idespecialitat = '".$_POST['espec']."' ",strlen( $query ) , 0 );
		if( $_POST['grup']  != "-1") $query = substr_replace( $query," AND idgrup='"   .$_POST['grup']."' ",strlen( $query ) , 0 );
		$query = substr_replace( $query," ORDER BY idespecialitat ASC, ordre_cr ASC ",strlen( $query ), 0 );
		printf('<table>', NULL);
		$data_view = $wpdb->get_results( $query, ARRAY_A);
		ricca3_graella( $ricca3_listpla, $data_view );
		printf('</table>', NULL);
	}
}

#############################################################################################
/**
 * Guardar el pla d'estudis
 * shortcode: [ricca3-guardarpla]
 *
 * @since ricca3.v.2013.21.2
 * @author Efraim Bayarri
 */
#############################################################################################
function ricca3_shortcode_guardarpla($atts, $content = null) {
	global $wpdb;
	global $ricca3_butons_espec;
	global $ricca3_listpla;
	global $current_user;
	
	get_currentuserinfo();
	ricca3_missatge(__('Guardar pla d\'estudis','ricca3-dades'));
	$ricca3_butons_espec['texte'][0] = __('ajuda-dades-dades', 'ricca3-dades');
//		butons
	ricca3_butons( $ricca3_butons_espec, 6 );

	printf('<form method="post" action="" name="cercar"><table dir="ltr" class="menucurt350"><tr>', NULL);
	printf('<td><button type="submit" name="cercar" value="actualitzar" title="%s">%s</td>',
		__('ajuda-gaurdarpla-escollir', 'ricca3-dades'), __('escollir', 'ricca3-dades'));
//		drop per el any
	$data_any = $wpdb->get_results('SELECT * FROM ricca3_any', ARRAY_A );
	ricca3_drop_any( __('Any:','ricca3-dades'), 'any', $data_any, 'idany', 'any', __('ajuda_aplicarpla_any', 'ricca3-dades'), 'actual' );
//		tanquem la barra de selecció
	printf('</tr></table></form>', NULL);
	if(isset($_POST['cercar']) && $_POST['cercar'] == 'actualitzar'){
//		esborrem les dades anteriors		
//		$wpdb->delete('ricca3_pla', array('idany' => $_POST['any']));
		ricca3_dbdelete('ricca3_pla', array('idany' => $_POST['any']));
//**
		$dades_pla = $wpdb->get_results( 'SELECT * FROM ricca3_ccomp_view WHERE actiu_cc = 1 AND actiu_cr = 1 ', ARRAY_A);
		for( $i=0; $i < count($dades_pla); $i++){
			if(!$wpdb->insert('ricca3_pla',
				array(	'idany'      => $_POST['any'],
						'idccomp'    => $dades_pla[$i]['idccomp'],
						'stampuser'  => $current_user->user_login,
						'stampplace' => 'ricca_shortcode_grups_insert' 	) ) ){
				ricca3_missatge(sprintf('%s %s', __('No es pot crear el crèdit!','ricca3-dades'), $dades_pla[$i]['idccomp']));
			}
		}
//**		
		unset($_POST['cercar']);
	}
}

#############################################################################################
/**
 * llistar pla d'estudis existents
 * shortcode: [ricca3-llistarpla]
 *
 * @since ricca3.v.2013.21.2
 * @author Efraim Bayarri
 */
#############################################################################################
function ricca3_shortcode_llistarpla($atts, $content = null) {
	global $wpdb;
	global $ricca3_butons_espec;
	global $ricca3_listpla;
	
	ricca3_missatge(__('Llistar plans d\'estudis','ricca3-dades'));
	$ricca3_butons_espec['texte'][0] = __('ajuda-dades-dades', 'ricca3-dades');
//		butons
	ricca3_butons( $ricca3_butons_espec, 6 );
	printf('<form method="post" action="" name="cercar"><table dir="ltr" class="menucurt800"><tr>', NULL);
	printf('<td><button type="submit" name="cercar" value="actualitzar" title="%s">%s</td>',
	__('ajuda-llistarpla-escollir', 'ricca3-dades'), __('escollir', 'ricca3-dades'));
//		drop per el any
	$data_any = $wpdb->get_results('SELECT DISTINCT ricca3_pla.idany, ricca3_any.any, ricca3_any.actual FROM ricca3_pla '.
		'INNER JOIN ricca3_any ON ricca3_any.idany = ricca3_pla.idany', ARRAY_A);
	ricca3_drop_any( __('Any:','ricca3-dades'), 'any', $data_any, 'idany', 'any', __('ajuda_llistarpla_any', 'ricca3-dades'), 'actual' );
//		drop per a especialitat
	$data_espec = $wpdb->get_results('SELECT * FROM ricca3_especialitats WHERE actiu_es = 1 ORDER BY ordre_es ', ARRAY_A);
	ricca3_drop( __('Especialitat:','ricca3-dades'), 'espec', $data_espec, 'idespecialitat', 'nomespecialitat', __('ajuda_drop_especialitat', 'ricca3-dades'), FALSE );
//		drop per el grup	
	$data_grup = $wpdb->get_results('SELECT * FROM ricca3_grups WHERE actiu_gr = 1 ORDER BY grup ', ARRAY_A);
	ricca3_drop( __('Grup:','ricca3-dades'), 'grup', $data_grup, 'idgrup', 'grup', __('ajuda_drop_grup', 'ricca3-dades'), FALSE );

	printf('</tr></table></form>', NULL);
	if(isset($_POST['cercar']) && $_POST['cercar'] == 'actualitzar'){
		$query = "SELECT * FROM ricca3_pla_view WHERE idany='".$_POST['any']."'      ";
		if( $_POST['espec'] != "-1") $query = substr_replace( $query," AND idespecialitat = '".$_POST['espec']."' ",strlen( $query ) , 0 );
		if( $_POST['grup']  != "-1") $query = substr_replace( $query," AND idgrup='"          .$_POST['grup']. "' ",strlen( $query ) , 0 );
		$query = substr_replace( $query," ORDER BY ordre_cr ASC ",strlen( $query ), 0 );
		printf('<table>', NULL);
		$data_view = $wpdb->get_results( $query, ARRAY_A);
		ricca3_graella( $ricca3_listpla, $data_view );
		printf('</table>', NULL);
	}	
}

#############################################################################################
/**
 * Alumnes sense pla d'estudis
 * shortcode: [ricca3-sensepla]
 *
 * @since ricca3.v.2013.21.2
 * @author Efraim Bayarri
 */
#############################################################################################
function ricca3_shortcode_sensepla($atts, $content = null) {
	global $wpdb;
	global $ricca3_butons_espec;
	global $current_user;
	
	get_currentuserinfo();
	$row_any  = $wpdb->get_row( 'SELECT * FROM ricca3_any WHERE actual = 1',  ARRAY_A, 0);
	ricca3_missatge(__('Alumnes sense pla d\'estudis','ricca3-dades'));
	$ricca3_butons_espec['texte'][0] = __('ajuda-dades-dades', 'ricca3-dades');
//		butons
	ricca3_butons( $ricca3_butons_espec, 6 );	
//		drop
	printf('<form method="post" action="" name="cercar"><table dir="ltr" class="menucurt600"><tr>', NULL);
//		drop per el grup
	$data_grup = $wpdb->get_results('SELECT * FROM ricca3_grups WHERE actiu_gr = 1 ORDER BY grup ', ARRAY_A);
	ricca3_drop( __('Grup:','ricca3-dades'), 'grup', $data_grup, 'idgrup', 'grup', __('ajuda_drop_grup', 'ricca3-dades'), TRUE );
	printf('</tr></table>', NULL);
	ricca3_desar('cercar', 'actualitzar', __('ajuda-dades-cred-drop', 'ricca3-dades'));
	printf('</form>', NULL);
//
	if(isset($_POST['cercar']) && $_POST['cercar'] == 'guardar'){
		for( $i=0; $i < count($_POST['cbox']); $i++){
			$query = $wpdb->prepare('SELECT * FROM ricca3_pla_view WHERE idany=%s AND idgrup=%s', 
				$row_any['idany'], $_POST['idgrup'][$i]);
			$dades_ccomp = $wpdb->get_results( $query , ARRAY_A);
			for( $j=0; $j < count( $dades_ccomp ); $j++ ){
				$wpdb->insert('ricca3_credits_avaluacions',
					array(
						'idany'    => $row_any['idany'],
						'idccomp'  => $dades_ccomp[$j]['idccomp'],
						'idalumne' => $_POST['cbox'][$i],
						'convord'  => $row_any['conv'],
						'convext1' => '1',
						'convext2' => '1',
						'stampuser'  => $current_user->user_login,
						'stampplace' => 'ricca_shortcode_grups_insert'
					));
			}
		}
		$_POST['cercar'] = 'actualitzar';
	}
//	
	if(isset($_POST['cercar']) && $_POST['cercar'] == 'actualitzar'){
		$query = "SELECT * FROM ricca3_alumne_especialitat ".
				"INNER JOIN ricca3_alumne ON ricca3_alumne.idalumne = ricca3_alumne_especialitat.idalumne ".
				"INNER JOIN ricca3_grups ON ricca3_grups.idgrup = ricca3_alumne_especialitat.idgrup ".
				"INNER JOIN ricca3_especialitats ON ricca3_especialitats.idespecialitat = ricca3_grups.idespecialitat ".
				"WHERE ricca3_alumne_especialitat.idany='".$row_any['idany']."' AND idestat_es = 1 AND repeteix != 'R' ";
		if( $_POST['grup']  != "-1") $query = substr_replace( $query," AND ricca3_alumne_especialitat.idgrup='".$_POST['grup']."' ",strlen( $query ) , 0 );
		$query = substr_replace( $query," ORDER BY cognomsinom ASC ",strlen( $query ), 0 );
		$data_view = $wpdb->get_results( $query, ARRAY_A);
//
		printf('<form method="post" action="" target="_self" name="sensepla"><table><tr><th><input type="checkbox" title="%s" value="on" name="allbox" onclick="checkAll2();"/></th><th title="%s">%s</th><th title="%s">%s</th><th title="%s">%s</th><th title="%s">%s</th></tr>',
			__('ajuda-sensepla-check',  'ricca3-dades'),
			__('ajuda-sensepla-id',     'ricca3-dades'),__('ID','ricca3-dades'),
			__('ajuda-sensepla-alumne', 'ricca3-dades'),__('Alumne','ricca3-dades'),
			__('ajuda-sensepla-espec',  'ricca3-dades'),__('Especialitat','ricca3-dades'),
			__('ajuda-sensepla-grup',   'ricca3-dades'),__('Grup','ricca3-dades')
		);
		for( $i=0; $i < count($data_view); $i++){
			$result = $wpdb->query( $wpdb->prepare( 'SELECT * FROM ricca3_alumcredit_view WHERE idalumne=%s AND idgrup=%s AND idany=%s',
					$data_view[$i]['idalumne'], $data_view[$i]['idgrup'], $data_view[$i]['idany']));
			if( $result == 0){
				printf('<tr><td><input type="checkbox" accesskey="" name="cbox[]" value="%s" title="" class="" ><INPUT type="hidden" name="idgrup[]" value="%s" /></td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>',
				$data_view[$i]['idalumne'], $data_view[$i]['idgrup'], $data_view[$i]['idalumne'], $data_view[$i]['cognomsinom'], $data_view[$i]['nomespecialitat'], $data_view[$i]['grup']);
			}
//
//	################## BUG convocatoria
//			$query_cred=($wpdb->prepare('SELECT convord,idcredaval FROM ricca3_credits_avaluacions WHERE idalumne=%s AND convord=%s', $data_view[$i]['idalumne'], "2014-2015"));
//			$data_cred=$wpdb->get_results($query_cred, ARRAY_A);
//			$result = $wpdb->query($query_cred);
//			dump_r($data_cred);
//			if( $result > 0){
//				for ($j=0; $j < $result; $j++){
//				ricca3_dbupdate('ricca3_credits_avaluacions',
//					array('convord' => "06/15" ),
//					array('idcredaval' => $data_cred[$j]['idcredaval']) );
//				}
//			}	
//  #############################			
		}
		printf('<tr><td><button type="submit" name="cercar" value="guardar"><font size ="1px" face="Arial, Helvetica, sans-serif">%s</button></td><td><INPUT type="hidden" name="grup" value="%s" /></td></tr></table></form>',	
			__('Guardar dades','ricca3-dades'), $_POST['grup'] );
	}
}

#############################################################################################
/**
 * definició dels crèdits per especialitat
 * shortcode: [ricca3-credespec]
 *
 * @since ricca3.v.20132206
 * @author Efraim Bayarri
 */
#############################################################################################
function ricca3_shortcode_credespec($atts, $content = null) {
	global $wpdb;
	global $ricca3_butons_espec;
	global $ricca3_listcredespec;
	global $ricca3_editcredespec;
	global $current_user;

	get_currentuserinfo();
	$row_any  = $wpdb->get_row( 'SELECT * FROM ricca3_any WHERE actual = 1',  ARRAY_A, 0);
	ricca3_missatge(__('Crèdits per especialitat','ricca3-dades'));
	$ricca3_butons_espec['texte'][0] = __('ajuda-dades-dades', 'ricca3-dades');
//		butons
	ricca3_butons( $ricca3_butons_espec, 6 );
	
	printf('<form method="post" action="" name="cercar"><table dir="ltr" class="menucurt800"><tr>', NULL);
	printf('<td><button type="submit" name="cercar" value="actualitzar" title="%s">%s</td>',
	__('ajuda-credespec-escollir', 'ricca3-dades'), __('escollir', 'ricca3-dades'));
//		drop per a especialitat
	$data_espec = $wpdb->get_results('SELECT * FROM ricca3_especialitats WHERE actiu_es = 1 ORDER BY ordre_es ', ARRAY_A);
	ricca3_drop( __('Especialitat:','ricca3-dades'), 'espec', $data_espec, 'idespecialitat', 'nomespecialitat', __('ajuda_drop_especialitat', 'ricca3-dades'), TRUE );
	
	printf('</tr></table></form>', NULL);
	
	if(isset($_POST['cercar'])){
		$query = 'SELECT * FROM ricca3_credits_especialitat '.
				'INNER JOIN ricca3_especialitats ON ricca3_especialitats.idespecialitat = ricca3_credits_especialitat.idespecialitat '.
				'INNER JOIN ricca3_credits ON ricca3_credits.idcredit = ricca3_credits_especialitat.idcredit '.
				'WHERE 1 = 1';
		if( $_POST['espec'] != "-1") $query = substr_replace( $query," AND ricca3_credits_especialitat.idespecialitat = '".$_POST['espec']."' ORDER BY ordre_cr_es ",strlen( $query ) , 0 );
	}
//	Guardem les dades
	if(isset($_POST['cercar']) && $_POST['cercar'] == 'guardar'){
		for( $i = 0; $i < count($_POST['idcredespec']); $i++){
//			$wpdb->update('ricca3_credits_especialitat',
			ricca3_dbupdate('ricca3_credits_especialitat',
					array( 	'idespecialitat' => $_POST['idespecialitat'][$i],
							'idcredit'       => $_POST['idcredit'][$i],
							'ordre_cr_es'    => $_POST['ordre_cr_es'][$i],
							'numero'         => $_POST['numero'][$i]),
					array(	'idcredespec' => $_POST['idcredespec'][$i]) 	) ;
		}
		$_POST['cercar'] = 'actualitzar';
	}
// 	nou crèdit
	if(isset($_POST['cercar']) && $_POST['cercar'] == 'nou'){
		if(!$wpdb->insert('ricca3_credits_especialitat',
				array(	'idespecialitat' => $_POST['idespecialitat'],
						'idcredit'       => $_POST['idcredit'],
						'ordre_cr_es'    => $_POST['ordre_cr_es'],
						'numero'         => $_POST['numero'],
						'stampuser'   => $current_user->user_login,
						'stampplace'  => 'ricca_shortcode_grups_insert' 	) ) )
			ricca3_missatge(__('No es pot crear la entrada!','ricca3-dades'));
		$_POST['cercar'] = 'actualitzar';
	}
//	esborrar crèdit
	if(isset($_POST['cercar']) && $_POST['cercar'] == 'delete'){
		if(!$wpdb->query($wpdb->prepare('DELETE FROM ricca3_credits_especialitat WHERE idcredespec=%s', $_POST['idcredespec'])))
			ricca3_missatge(__('No es pot eliminar l\'entrada!','ricca3-dades'));
		$_POST['cercar'] = 'actualitzar';
	}
//
	if(isset($_POST['cercar']) && $_POST['cercar'] != 'editar'){
		printf('<table>', NULL);
		$data_view = $wpdb->get_results( $query, ARRAY_A);
		ricca3_graella( $ricca3_listcredespec, $data_view );
		printf('</table>', NULL);
// 		suma les hores
		$suma=0;
		for( $t=0; $t<count($data_view);$t++){
			$suma=$suma+$data_view[$t]['hores_cr'];
		}
		printf('<table><tr><td>TOTAL HORES:</td><td><b>%s</b></td></tr></table>', $suma);
	}
	if(isset($_POST['cercar']) && $_POST['cercar'] == 'editar'){
//	estem editan
		printf('<form method="post" action="" target="_self" name="especialitats"><table>', NULL);
		$data_view = $wpdb->get_results( $query, ARRAY_A);
		ricca3_graella( $ricca3_editcredespec, $data_view );
		printf('<tr><td><button type="submit" name="cercar" value="guardar"><font size ="1px" face="Arial, Helvetica, sans-serif">%s</button>',	__('Guardar dades','ricca3-dades'));
		printf('<INPUT type="hidden" name="espec" value="%s" />', $_POST['espec']);
		printf('</td></tr></table></form>', NULL);
	}
	if(isset($_POST['cercar']) && $_POST['cercar'] == 'actualitzar'){
		printf('<form method="post" action="" target="_self" name="especialitats"><table>', NULL);
		printf('<tr><td><button type="submit" name="cercar" value="editar">  <font size ="1px" face="Arial, Helvetica, sans-serif">%s</font></button></td>', __('Editar dades','ricca3-dades'));
		printf('    <td><button type="submit" name="cercar" value="afegir">  <font size ="1px" face="Arial, Helvetica, sans-serif">%s</font></button></td>', __('Afegir crèdit','ricca3-dades'));
		printf('    <td><button type="submit" name="cercar" value="eliminar"><font size ="1px" face="Arial, Helvetica, sans-serif">%s</font></button>', __('Eliminar crèdit','ricca3-dades'));
		printf('<INPUT type="hidden" name="espec" value="%s" /></td></tr></table></form>', $_POST['espec']);
	}
//	prepara afegir
	if(isset($_POST['cercar']) && $_POST['cercar'] == 'afegir'){
		$data_cred = $wpdb->get_results( $wpdb->prepare('SELECT * FROM ricca3_credits WHERE idespecialitat = %s ORDER BY ordre_cr', $_POST['espec']), ARRAY_A);
		$data_espec = $wpdb->get_results('SELECT * FROM ricca3_especialitats WHERE actiu_es = 1 ORDER BY ordre_es ', ARRAY_A);
		printf('<form method="post" action="" target="_self" name="ccomp"><table><tr>', NULL);
		ricca3_drop( __('Especialitat:','ricca3-dades'), 'idespecialitat', $data_espec, 'idespecialitat', 'nomespecialitat', __('ajuda_drop_especialitat', 'ricca3-dades'), TRUE );
		ricca3_drop( __('idcredit:','ricca3-dades'), 'idcredit', $data_cred, 'idcredit', 'nomcredit', __('ajuda_drop_credit', 'ricca3-dades'), TRUE );
		printf('<td>%s<INPUT type="text" name="ordre_cr_es" value="0" pattern="[0-9]{1,2}" size="5"  /></td>', __('ordre:', 'ricca3-dades'));
		ricca3_drop_fixe( __('..:','ricca3-dades'), 'numero',  array( "0", "fct", "sintesi"), array( "0", "fct", "sintesi"), __('ajuda_drop_fct', 'ricca3-dades'), TRUE );
		printf('<tr><td><button type="submit" name="cercar" value="nou"><font size ="1px" face="Arial, Helvetica, sans-serif">%s</font></button></td>', __('Guardar dades:','ricca3-dades'));
		printf('<td><INPUT type="hidden" name="espec" value="%s" /></td></tr></table></form>', $_POST['espec']);
	}
//	prepara eliminar
	if(isset($_POST['cercar']) && $_POST['cercar'] == 'eliminar'){
		printf('<form method="post" action="" target="_self" name="grups"><table><tr><td>%s', __('idcredespec:', 'ricca3-dades'));
		printf('<INPUT type="text" name="idcredespec" size="5" /></td></tr><tr><td><button type="submit" name="cercar" value="delete"><font size ="1px" face="Arial, Helvetica, sans-serif">', NULL);
		printf('%s</font></button></td><td><INPUT type="hidden" name="espec" value="%s" /></td></tr></table></form>', __('Guardar dades:','ricca3-dades'), $_POST['espec']);
	}	
}

#############################################################################################
/**
 * notes UF loe
 * shortcode: [ricca3-ufloe]
 *
 * @since ricca3.v.20150804
 * @author Efraim Bayarri
 */
#############################################################################################
function ricca3_shortcode_ufloe($atts, $content = null) {
	global $wpdb;
	global $ricca3_butons_espec;
	global $ricca3_listpla;
	global $ricca3_ufloe;
	
//	dump_r($_POST);
	
	ricca3_missatge(__('Notes Unitats Formatives LOE','ricca3-dades'));
	$ricca3_butons_espec['texte'][0] = __('ajuda-dades-dades', 'ricca3-dades');
//		butons
	ricca3_butons( $ricca3_butons_espec, 6 );
	
	printf('<form method="post" action="" name="cercar"><table dir="ltr" class="menucurt800"><tr>', NULL);
	printf('<td><button type="submit" name="cercar" value="actualitzar" title="%s">%s</td>',
	__('ajuda-llistarpla-escollir', 'ricca3-dades'), __('escollir', 'ricca3-dades'));
//		drop per el any
	$data_any = $wpdb->get_results('SELECT DISTINCT ricca3_pla.idany, ricca3_any.any, ricca3_any.actual FROM ricca3_pla '.
			'INNER JOIN ricca3_any ON ricca3_any.idany = ricca3_pla.idany', ARRAY_A);
	ricca3_drop_any( __('Any:','ricca3-dades'), 'any', $data_any, 'idany', 'any', __('ajuda_llistarpla_any', 'ricca3-dades'), 'actual' );
//		drop per a especialitat
	$data_espec = $wpdb->get_results('SELECT * FROM ricca3_especialitats WHERE actiu_es = 1 AND pla = "loe" ORDER BY ordre_es ', ARRAY_A);
	ricca3_drop( __('Especialitat:','ricca3-dades'), 'espec', $data_espec, 'idespecialitat', 'nomespecialitat', __('ajuda_drop_especialitat', 'ricca3-dades'), TRUE );
	
	
	printf('</tr></table></form>', NULL);
	
	if(isset($_POST['cercar']) && $_POST['cercar'] == 'actualitzar'){

		$query = $wpdb->prepare('SELECT * FROM ricca3_alumespec_view WHERE idany= %s AND idespecialitat = %s AND idestat_es=1 ORDER BY cognomsinom ',$_POST['any'], $_POST['espec']);
		
//		dump_r($query);
		
		$data_view = $wpdb->get_results( $query , ARRAY_A);
		ricca3_graella( $ricca3_ufloe, $data_view, NULL );
		
	}
	
}

#############################################################################################
/**
 * notes UF loe
 * shortcode: [ricca3-notesufloe]
 *
 * @since ricca3.v.20150804
 * @author Efraim Bayarri
 */
#############################################################################################
function ricca3_shortcode_notesufloe($atts, $content = null) {
	global $wpdb;
	global $ricca3_butons_espec;
	global $ricca3_especalum;
	
//	dump_r($_POST);
	
	$dades_any=$wpdb->get_row('SELECT * FROM ricca3_any WHERE actual=1', ARRAY_A, 0);
	ricca3_missatge(__('Notes Unitats Formatives LOE','ricca3-dades'));
	$ricca3_butons_espec['texte'][0] = __('ajuda-dades-dades', 'ricca3-dades');
//		butons
	ricca3_butons( $ricca3_butons_espec, 6 );
	
	if( !isset( $_GET['ID'] ) ) return '';

#############################################
// 	navegació endevant i enrere
#############################################
	$query= $wpdb->prepare('SELECT * FROM ricca3_alumespec_view WHERE idalumne=%s AND idany=%s', $_GET['ID'], $dades_any['idany']);
	$data_alumne= $wpdb->get_row($query,ARRAY_A,0);
	$query= $wpdb->prepare('SELECT * FROM ricca3_alumespec_view WHERE idespecialitat=%s AND idany=%s AND idestat_es=1 ', $data_alumne['idespecialitat'], $data_alumne['idany']);
	$dades = $wpdb->get_results( $query, ARRAY_A );
	
//	dump_r($dades);
	
	for( $i=0; $i < count($dades); $i++){
		if( $dades[$i]['idalumne'] == $_GET['ID']){
			$ara = $i;
			$despr = $i + 1;
			$abans = $i - 1;
			if( $despr > count($dades) - 1) $despr = 0;
			if( $abans  == -1) $abans = count($dades) - 1 ;
			$row_abans = $wpdb->get_row( $query, ARRAY_A, $abans);
			$row_despr = $wpdb->get_row( $query, ARRAY_A, $despr);
			
//			dump_r($row_abans);
//			dump_r($row_despr);
			
			printf('<table width="100%%"><tr><td align="left"> <a href="%s/%s?ID=%s"><img src="%s/ricca3/imatges/ricca3-anterior.png" border=0 " /></a></td>',
			site_url(), 'ricca3-notesufloe', $row_abans['idalumne'], WP_PLUGIN_URL);
			printf('                         <td align="left"> <a href="%s/%s?ID=%s"><img src="%s/ricca3/imatges/ricca3-seguent.png" border=0 " /></a></td></tr></table>',
			site_url(), 'ricca3-notesufloe', $row_despr['idalumne'], WP_PLUGIN_URL);
		}
	}
#############################################	
	
//		buscar les dades del alumne
	$row_alu = $wpdb->get_row($wpdb->prepare('SELECT * FROM ricca3_alumne WHERE idalumne=%s', $_GET['ID']), ARRAY_A, 0);
	$image_attributes = ricca3_miniatura($_GET['ID']);
//		missatge de capçalera de la pàgina
	ricca3_missatge(sprintf('%s %s</td><td><img src="%s" width="%s" height="%s">',__('Especialitats de l\'alumne','ricca3-alum'), $row_alu['cognomsinom'], $image_attributes[0], $image_attributes[1], $image_attributes[2] ));
	$token = array( 'espec' => $_GET['espec'], 'grup' => $_GET['grup'], 'any' => $_GET['any'], 'estat' => $_GET['estat'], 'repe' => $_GET['repe']);
//		buscar especialitats
	$data_view = $wpdb->get_results( $wpdb->prepare('SELECT * FROM ricca3_alumespec_view WHERE idalumne = %s ORDER BY idany ',$_GET['ID']), ARRAY_A);
//		llistat de les especialitats del alumne
	ricca3_graella( $ricca3_especalum, $data_view, $token );
	printf('</table></form>', NULL);
	
	$idespec = $wpdb->get_row( $wpdb->prepare('SELECT DISTINCT idespecialitat FROM ricca3_alumespec_view WHERE idalumne=%s AND idestat_es=1 AND (idespecialitat = 10 or idespecialitat = 11) ', $_GET['ID']), ARRAY_A, 0);
	$row_espec = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_alumespec_view WHERE idalumne=%s AND idespecialitat=%s', $_GET['ID'], $idespec['idespecialitat']), ARRAY_A, 0);
	$nom = str_word_count($row_espec['nomespecialitat'], 1, 'ÀÈÒÓ');
	$query_cred = $wpdb->prepare('SELECT * FROM ricca3_credits_avaluacions '.
			'INNER JOIN ricca3_ccomp ON ricca3_ccomp.idccomp=ricca3_credits_avaluacions.idccomp '.
			'INNER JOIN ricca3_credits ON ricca3_credits.idcredit = ricca3_ccomp.idcredit '.
			'INNER JOIN ricca3_especialitats ON ricca3_especialitats.idespecialitat = ricca3_credits.idespecialitat '.
			'INNER JOIN ricca3_grups ON ricca3_grups.idgrup = ricca3_ccomp.idgrup '.
			'INNER JOIN ricca3_any ON ricca3_any.idany = ricca3_credits_avaluacions.idany '.
			'INNER JOIN ricca3_professors ON ricca3_professors.idprof = ricca3_ccomp.idprofessor '.
			'WHERE idalumne=%s AND ricca3_credits.idespecialitat=%s '.
			'ORDER BY ordre_cr, ricca3_credits_avaluacions.idccomp, ricca3_credits_avaluacions.idany ', $_GET['ID'], $idespec['idespecialitat']);
	$data_cred = $wpdb->get_results( $query_cred, ARRAY_A);
	
//	dump_r($data_cred);
	
//		Mirar si ja te UF creades
	$dades_uf= $wpdb->get_results($wpdb->prepare('SELECT * from ricca3_loe_alumnes WHERE idalumne=%s', $_GET['ID']), ARRAY_A);
	if(count($dades_uf)==0){
		$dades_loeuf=$wpdb->get_results($wpdb->prepare('SELECT * from ricca3_loe_uf WHERE idespecialitat=%s ORDER BY modul', $idespec['idespecialitat']), ARRAY_A);
		for($k=0; $k< count($dades_loeuf); $k++){
			$wpdb->insert('ricca3_loe_alumnes',
					array(	'idalumne'	=> $_GET['ID'],
							'iduf'		=> $dades_loeuf[$k]['iduf'],
							'nota'		=> '',
							'idany_uf'	=> $dades_any['idany']
					)
			);
		}
	}
//	
	if (isset($_POST['accio']) && $_POST['accio']=='actualitzarufloe'){
		for( $i=0; $i < count( $_POST['notauf']); $i++ ){
			
			$result = ricca3_dbupdate('ricca3_loe_alumnes',
					array( 'nota'  => $_POST['notauf'][$i]),
					array( 'idloe' => $_POST['idloe'][$i]) );
		}
	}
//	
	printf('<form method="post" action="" target="_self" name="notauf" id="notauf"><table>');
//	mostrem la capçalera de la graella amb les ajudes
	printf( '<tr><th>Grup</th><th></th><th>MODUL/UF</th><th></th><th>hores UF</th><th>Aval</th><th>Professor</th>'.
			'<th>Nota</th><th></th><th></th><th></th><th>NF</th><th></th><th></th><th></th><th>Hores</th></tr>', NULL);	
	$z=0;
	for( $j=0; $j < count($data_cred); $j++ ){
//	si el crèdit es actiu per aquest any mostrem la convocatoria en negretes
		$conv = $data_cred[$j]['convord'];
		if($data_cred[$j]['conv'] == $row_any['conv']) $conv = sprintf('<b>%s</b>', $data_cred[$j]['convord']);
//
		$repeteix = $data_cred[$j]['repe'];
		if($data_cred[$j]['repe'] =='R') $repeteix = '<b>*</b>';
//	mostrem els resultats a la linea de la graella
//	si es un credit nou a la graella, mostrem el grup, el nom del crèdit, la nota final de credit i les hores
		if( $j == 0 || $data_cred[$j]['idcredit'] != $data_cred[$j-1]['idcredit']){
//	busquem la ultima entrada del crèdit per esbrinar la nota final del credit
			$row_nota = $wpdb->get_row( $wpdb->prepare( 'SELECT * FROM ricca3_credits_avaluacions '.
				'INNER JOIN ricca3_ccomp ON ricca3_ccomp.idccomp=ricca3_credits_avaluacions.idccomp '.
						'WHERE idalumne=%s AND idcredit=%s ORDER by idany DESC ',
						$_GET['ID'], $data_cred[$j]['idcredit']), ARRAY_A, 0);
			$nota = $row_nota['notaf_cr'];
//	mostrem la linea inicial del crèdit
			$pendi='';
			if( $data_cred[$j]['pendi'] == 'P') $pendi='P';
			printf('<tr class="credit"><td>%s</td><td>%s</td><td colspan="2"><b>%s</b></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td><b>%s</b></td><td><b>%s</b></td><td></td><td></td><td>%s</td></tr>',
				$data_cred[$j]['grup'], '<b>===></b>', $data_cred[$j]['nomcredit'], $nota, $pendi, $data_cred[$j]['hores_cr']);
			$query=$wpdb->prepare('SELECT * from ricca3_loe_uf WHERE idcredit=%s ORDER BY uf, aval', $data_cred[$j]['idcredit']);
			$dades_loeuf=$wpdb->get_results($query, ARRAY_A);
			
//			echo(count($dades_loeuf));
//	mostrem les UF
			for($k=0;$k<count($dades_loeuf); $k++){
				$dades_prof=$wpdb->get_row( $wpdb->prepare('SELECT * from ricca3_professors WHERE idprof=%s', $dades_loeuf[$k]['prof']), ARRAY_A, 0);
				$dades_notauf=$wpdb->get_row( $wpdb->prepare('SELECT * from ricca3_loe_alumnes WHERE idalumne=%s AND iduf=%s', $_GET['ID'], $dades_loeuf[$k]['iduf']), ARRAY_A, 0);
				
				printf('<tr><td>%s</td><td>%s</td><td>%s</td><td></td><td>%s hores</td><td>%s aval</td><td>%s</td>',
					$dades_notauf['idloe'], $dades_loeuf[$k]['uf'], $dades_loeuf[$k]['ufnom'],$dades_loeuf[$k]['ufchores'], $dades_loeuf[$k]['aval'], $dades_prof['nomicognoms']);
				 
				printf('<td><INPUT type="text" size="5" name="notauf[%s]" value="%s"  /></td>',$z, $dades_notauf['nota']);
				printf('<td><input type="hidden" name="idloe[%s]" value="%s" /></td>', $z, $dades_notauf['idloe']);
				printf('<td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>', NULL);
				$z++;
			}			
		}
	}
	printf('</table>', NULL);
	ricca3_desar('accio', 'actualitzarufloe', __('ajuda-tab-credits-tots-desar', 'ricca3-alum'));
	printf('</td></tr></table></form>', NULL);
//	printf('</table></form>', NULL);
	
}