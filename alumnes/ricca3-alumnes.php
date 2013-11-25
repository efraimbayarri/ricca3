<?php
## Release build 2013.27.5
#############################################################################################
/**
 * Alumnes per especialitat. Mostra un filtre per escollir alumnes segons especialitat i any
 * shortcode: [ricca3-alumespec]
 *
 * @since ricca3.v.2013.13.6
 * @author Efraim Bayarri
 */
#############################################################################################
function ricca3_shortcode_alumnes($atts, $content = null) {
	global $wpdb;
	global $ricca3_butons_alumnes;
	global $ricca3_alumespec;
##	BEGIN debug
//	print_r($_POST);	
//	dump($_POST);
//	dump_r($_POST);
##	END debug	
//	missatge de capçalera de la pàgina
	ricca3_missatge(__('Alumnes','ricca3-alum'));
//	crear token
	if( !isset($_POST['espec']) ){
//	si entrem per primera vegada a alumnes i encara no tenim el token, en creem un de nou		
		if( !isset( $_GET['espec'])){
			$row_any = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_any WHERE actual = 1', NULL),ARRAY_A,0);
			$token = array( 'espec' => '-1', 'grup' => '-1', 'any' => $row_any['idany'], 'estat' => 'alta', 'repe' => 'no');
			$_POST['estat'] = '1';
			$_POST['repe']  = 'no';
//	si ja tenim token i venim d'un altre pàgina, passem els valors de $_GET a $_POST			
		}else{
			$_POST['espec'] = $_GET['espec'];
			$_POST['grup']  = $_GET['grup'];
			$_POST['any']   = $_GET['any'];
			$_POST['estat'] = $_GET['estat'];
			$_POST['repe']  = $_GET['repe'];
//	com que ja tenim valors de grup o especialitat, mostrar el resultats sense esperar a escollir de nou			
			if( $_POST['espec'] != '-1' || $_POST['grup'] != '-1' )	$_POST['cercar']= 'actualitzar';
			$token = array( 'espec' => $_POST['espec'], 'grup' => $_POST['grup'], 'any' => $_POST['any'], 'estat' => $_POST['estat'], 'repe' => $_POST['repe']);
		}
//	si recarreguem aquesta mateixa pàgina		
	}else{
		$token = array( 'espec' => $_POST['espec'], 'grup' => $_POST['grup'], 'any' => $_POST['any'], 'estat' => $_POST['estat'], 'repe' => $_POST['repe']);
	}
//	busquem la definicio de l'especialitat
	if((isset($_POST['grup']) && $_POST['grup'] != '-1') || (isset($_POST['espec']) && $_POST['espec'] != '-1') ){
		if($_POST['espec'] != '-1') {
			$row_espec = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_especialitats WHERE idespecialitat=%s', $_POST['espec']), ARRAY_A, 0);
		}else{
			$row_grup = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_grups WHERE idgrup=%s', $_POST['grup']), ARRAY_A, 0);
			$row_espec = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_especialitats WHERE idespecialitat=%s', $row_grup['idespecialitat']), ARRAY_A, 0);
		}
	}	
//		preparar ajudes als butons	
	$ricca3_butons_alumnes['texte'][0] = __('ajuda-cercar',        'ricca3-alum');
	$ricca3_butons_alumnes['texte'][1] = __('ajuda-nou-alumne',    'ricca3-alum');
	$ricca3_butons_alumnes['texte'][2] = __('ajuda-llistat-asist', 'ricca3-alum');
	$ricca3_butons_alumnes['texte'][3] = __('ajuda-mailings',      'ricca3-alum');
	$ricca3_butons_alumnes['texte'][4] = __('ajuda-cred-pendents', 'ricca3-alum');
	$ricca3_butons_alumnes['texte'][5] = __('ajuda-inscripcions',  'ricca3-alum');
//		mostrar la filera de butons	
	printf('<div id="alumnes">', NULL);
	ricca3_butons( $ricca3_butons_alumnes, 6, $token );
//		mostrem la barra de selecció d'especialitat
	ricca3_missatge(__('Alumnes per especialitat','ricca3-alum'));
	printf('<form method="post" action="" name="cercar"><table dir="ltr" class="cercar"><tr>', NULL);
	printf('<td><button type="submit" name="cercar" value="actualitzar" title="%s"><img src=%s/ricca3/imatges/ricca3-llistar.png  border="0" /></button></td>', __('ajuda-llistar-alumnes', 'ricca3-alum'), WP_PLUGIN_URL);
//		drop per a especialitat	
	$data_espec = $wpdb->get_results('SELECT * FROM ricca3_especialitats WHERE actiu_es = 1 ORDER BY ordre_es ', ARRAY_A);
	ricca3_drop( __('Especialitat:','ricca3-alum'), 'espec', $data_espec, 'idespecialitat', 'nomespecialitat', __('ajuda_drop_especialitat', 'ricca3-alum'), FALSE );
//		pla d'estudis si especifiquem l'especialitat	
	if(isset($_POST['espec']) && $_POST['espec'] != '-1')printf('<td>%s %s</td>', __('Pla:','ricca3-alum'), $row_espec['pla']);
//		drop per el grup
	$data_grup = $wpdb->get_results('SELECT * FROM ricca3_grups WHERE actiu_gr = 1 ORDER BY grup ', ARRAY_A );
	ricca3_drop( __('Grup:','ricca3-alum'), 'grup',  $data_grup,  'idgrup', 'grup',  __('ajuda_drop_ grup', 'ricca3-alum'), FALSE );
//		pla d'estudis si no especifiquem l'especialitat pero si el grup	
	if(isset($_POST['grup']) && $_POST['grup'] != '-1' && $_POST['espec'] == '-1')printf('<td>%s %s</td>', __('Pla:','ricca3-alum'), $row_espec['pla']);
//		drop per el any	
	$data_any = $wpdb->get_results('SELECT * FROM ricca3_any', ARRAY_A );
	ricca3_drop_any( __('Any:','ricca3-alum'), 'any', $data_any, 'idany', 'any', __('ajuda_drop_any', 'ricca3-alum'), 'actual' );
//		drop per el estat	
	ricca3_drop_fixe( __('Estat:','ricca3-alum'),      'estat', array( "1" , "2"),        array( "alta", "baixa"),             __('ajuda_drop_estat', 'ricca3-alum') );
//		drop per els alumnes repetidors	
	ricca3_drop_fixe( __('Repetidors:','ricca3-alum'), 'repe',  array( "si"   , "no"),    array( "si",    "no"),               __('ajuda_drop_repe', 'ricca3-alum') );
//		tanquem la barra de selecció	
	printf('</tr></table></form>', NULL);
//		Si ja hem fet la cerca, mostrar els resultats
	if( isset( $_POST['cercar'] ) && $_POST['cercar'] == "actualitzar" ){
		$query="SELECT * FROM ricca3_alumespec_view WHERE idany='".$_POST['any']."' ";
		if( $_POST['espec'] != "-1") $query = substr_replace( $query," AND idespecialitat = '".$_POST['espec']."' ",strlen( $query ) , 0 );
		if( $_POST['grup']  != "-1") $query = substr_replace( $query," AND idgrup='" .$_POST['grup']."' ", strlen( $query ) , 0 );
		if( $_POST['estat'] != "-1") $query = substr_replace( $query," AND idestat_es='"  .$_POST['estat']."' ",strlen( $query ) , 0 );
		if( $_POST['repe']  != "-1" && $_POST['repe'] == "si") { $query = substr_replace( $query," AND repeteix =  'R' ",strlen( $query ) , 0 );}
		if( $_POST['repe']  != "-1" && $_POST['repe'] == "no") { $query = substr_replace( $query," AND repeteix != 'R' ",strlen( $query ) , 0 );}
		$query=substr_replace( $query," ORDER BY cognomsinom ",strlen( $query ), 0 );

//	fem el query i guardem tots els resultats a $data_view 		
		$data_view = $wpdb->get_results( $query, ARRAY_A);
//	llistat del alumnes del filtre
		$ricca3_alumespec['ajuda'][1] = __('ajuda-alumespec-id', 'ricca3-alum');
		$ricca3_alumespec['ajuda'][2] = __('ajuda-alumespec-veure', 'ricca3-alum');
		$ricca3_alumespec['ajuda'][3] = __('ajuda-alumespec-nom', 'ricca3-alum');
		$ricca3_alumespec['ajuda'][4] = __('ajuda-alumespec-tel1', 'ricca3-alum');
		$ricca3_alumespec['ajuda'][5] = __('ajuda-alumespec-tel2', 'ricca3-alum');
		$ricca3_alumespec['ajuda'][6] = __('ajuda-alumespec-email', 'ricca3-alum');
		$ricca3_alumespec['ajuda'][7] = __('ajuda-alumespec-estat', 'ricca3-alum');
		$ricca3_alumespec['ajuda'][8] = __('ajuda-alumespec-repe', 'ricca3-alum');
		
		ricca3_graella( $ricca3_alumespec, $data_view, $token );
		printf('</div>', NULL);
	}
}

#############################################################################################
/**
 * Cerca alumnes segons criteris de Nom, Cognom, DNI i ID amb clausules %LIKE%
 * shortcode: [ricca3-cercalumne]
 *
 * @since ricca3.v.2013.13.6
 * @author Efraim Bayarri
 */
#############################################################################################
function ricca3_shortcode_cercalumne($atts, $content = null) {
	global $wpdb;
	global $ricca3_butons_cercalumne;
	global $ricca3_cercalumne;

	$ricca3_cercalumne['ajuda'][1] = __('ajuda-alumespec-id', 'ricca3-alum');
	$ricca3_cercalumne['ajuda'][2] = __('ajuda-alumespec-veure', 'ricca3-alum');
	$ricca3_cercalumne['ajuda'][3] = __('ajuda-alumespec-nom', 'ricca3-alum');
	$ricca3_cercalumne['ajuda'][4] = __('ajuda-alumespec-tel1', 'ricca3-alum');
	$ricca3_cercalumne['ajuda'][5] = __('ajuda-alumespec-tel2', 'ricca3-alum');
	$ricca3_cercalumne['ajuda'][6] = __('ajuda-alumespec-email', 'ricca3-alum');
//		missatge de capçalera de la pàgina	
	ricca3_missatge(__('Cerca d\'alumnes','ricca3-alum'));
//		crear token	
	$token = array( 'espec' => $_GET['espec'], 'grup' => $_GET['grup'], 'any' => $_GET['any'], 'estat' => $_GET['estat'], 'repe' => $_GET['repe']);
//		preparar ajudes als butons
	$ricca3_butons_cercalumne['texte'][0] = __('ajuda-alumnes', 'ricca3-alum');
//		mostrar la filera de butons	
	ricca3_butons( $ricca3_butons_cercalumne, 6, $token );
//		Mostrar barra de filtres
	printf('<div id="cerca"><form method="post" action="" name="cercar"><table dir="ltr" class="cercar">', NULL);
	if(isset($_POST['cognom1'])){ $value = $_POST['cognom1'];}else{ $value = "";}
	printf('<tr><td>%s <INPUT type="text" name="cognom1"    size=15 value="%s" title="%s"></td>', __('1er Cognom:', 'ricca3-alum'),       $value, __('ajuda-cercar-cognom1', 'ricca3-alum'));
	if(isset($_POST['cognom2'])){ $value = $_POST['cognom2'];}else{ $value = "";}
	printf('    <td>%s <INPUT type="text" name="cognom2"    size=15 value="%s" title="%s"></td>', __('2on Cognom:', 'ricca3-alum'),       $value, __('ajuda-cercar-cognom2', 'ricca3-alum'));
	if(isset($_POST['nom'])){     $value = $_POST['nom'];    }else{ $value = "";}
	printf('    <td>%s <INPUT type="text" name="nom"        size=15 value="%s" title="%s"></td>', __('Nom:', 'ricca3-alum'),              $value, __('ajuda-cercar-nom', 'ricca3-alum'));
	if(isset($_POST['DNI'])){     $value = $_POST['DNI'];    }else{ $value = "";}
	printf('    <td>%s <INPUT type="text" name="DNI"        size=15 value="%s" title="%s"></td>', __('DNI:', 'ricca3-alum'),              $value, __('ajuda-cercar-DNI', 'ricca3-alum'));
	if(isset($_POST['ID'])){      $value = $_POST['ID'];     }else{ $value = "";}
	printf('    <td>%s <INPUT type="text" name="ID"         size=15 value="%s" title="%s"></td><td></td></tr>', __('ID:', 'ricca3-alum'), $value, __('ajuda-cercar-ID', 'ricca3-alum'));
	printf('<tr><td><button type="submit" name="cercar" value="actualitzar" title="%s"><img src=%s/ricca3/imatges/ricca3-llistar.png border="0" /></button></td></tr>', __('ajuda-cercar-alumnes', 'ricca3-alum'), WP_PLUGIN_URL);
	printf('</table></form>', NULL);
//		Si ja hem fet la cerca, mostrar els resultats
	if(isset($_POST['cercar']) && $_POST['cercar'] == "actualitzar" ){
		if( strlen( $_POST['cognom1'] ) < 2 && strlen( $_POST['cognom2'] ) < 2 && strlen( $_POST['nom'] ) < 2 && strlen( $_POST['DNI'] ) < 2 && strlen( $_POST['ID'] ) < 2){
			ricca3_missatge(__('No hi han criteris de cerca. Si us plau afegiu-ne un.','ricca3-alum'));
		}else{
			$data_view = $wpdb->get_results( $wpdb->prepare('SELECT * FROM ricca3_alumne WHERE cognom1 LIKE %s AND cognom2 LIKE %s AND nom LIKE %s AND dni LIKE %s AND idalumne LIKE %s ORDER BY cognom1 ASC, cognom2 ASC, nom ASC' ,
					'%'.like_escape($_POST['cognom1']).'%' , '%'.like_escape($_POST['cognom2']).'%' , '%'.like_escape($_POST['nom']).'%',
					'%'.like_escape($_POST['DNI']).'%' , '%'.like_escape($_POST['ID']).'%' ), ARRAY_A) ;
//		llistat dels alumnes
			ricca3_graella( $ricca3_cercalumne, $data_view, $token );
		}
	}
	printf('</div>', NULL);
}

#############################################################################################
/**
 * Crea un nou registre d'alumne
 * shortcode: [ricca3-noualumne]
 *
 * @since ricca3.v.2013.13.6
 * @author Efraim Bayarri
 */
#############################################################################################
function ricca3_shortcode_noualumne($atts, $content = null) {
	global $wpdb;
	global $ricca3_butons_cercalumne;
	global $ricca3_butons_noualumne;
	global $ricca3_alumcol;
	global $current_user;

	get_currentuserinfo();
	$num_cols=count($ricca3_alumcol,1)/count($ricca3_alumcol,0)-1;
//		missatge de capçalera de la pàgina
	ricca3_missatge(__('Nou Alumne','ricca3-alum'));
//		crear token
	$token = array( 'espec' => $_GET['espec'], 'grup' => $_GET['grup'], 'any' => $_GET['any'], 'estat' => $_GET['estat'], 'repe' => $_GET['repe']);
//		preparar ajudes als butons
	$ricca3_butons_cercalumne['texte'][0] = __('ajuda-alumnes', 'ricca3-alum');
//		mostrar la filera de butons
	ricca3_butons( $ricca3_butons_cercalumne, 6, $token );
//		si entra per primera vegada, mostra el formulari i espera a rebre les dades
	if(!isset($_POST['crear'])){
		ricca3_missatge( __('Els camps amb asterisc(*) son obligatoris','ricca3-alum') );
//		preparar ajudes als camps
		$ajuda[0]  = __('ajuda-noualumne-nom',                'ricca3-alum');	
		$ajuda[1]  = __('ajuda-noualumne-cognom1',            'ricca3-alum');
		$ajuda[2]  = __('ajuda-noualumne-cognom2',            'ricca3-alum');
		$ajuda[3]  = __('ajuda-noualumne-dni',                'ricca3-alum');
		$ajuda[4]  = __('ajuda-noualumne-datanai',            'ricca3-alum');          
		$ajuda[5]  = __('ajuda-noualumne-llocnai',            'ricca3-alum');
		$ajuda[6]  = __('ajuda-noualumne-provnai',            'ricca3-alum');
		$ajuda[7]  = __('ajuda-noualumne-paisnai',            'ricca3-alum');
		$ajuda[8]  = __('ajuda-noualumne-email',              'ricca3-alum');
		$ajuda[9]  = __('ajuda-noualumne-residenciahabitual', 'ricca3-alum');
		$ajuda[10] = __('ajuda-noualumne-ciutathabitual',     'ricca3-alum');
		$ajuda[11] = __('ajuda-noualumne-provinciahabitual',  'ricca3-alum');
		$ajuda[12] = __('ajuda-noualumne-codipostal',         'ricca3-alum');
		$ajuda[13] = __('ajuda-noualumne-telefon',            'ricca3-alum');
		$ajuda[14] = __('ajuda-noualumne-telefonfixe',        'ricca3-alum');
		$ajuda[15] = __('ajuda-noualumne-datainscripcio',     'ricca3-alum');
		$ajuda[16] = __('ajuda-noualumne-estudisanteriors',   'ricca3-alum');
		$ajuda[17] = __('ajuda-noualumne-centreea',           'ricca3-alum');
		$ajuda[18] = __('ajuda-noualumne-poblacioea',         'ricca3-alum');
		$ajuda[19] = __('ajuda-noualumne-abonament',          'ricca3-alum');
//	Creem el formulari del nou alumne	
		printf('<div id="validate"><form method="post" action="" target="_self" name="NouAlumne" >',NULL );
//	Creem la taula amb l'entrada de dades		
		printf('<table>',NULL );
		for( $i = 0; $i < $num_cols; $i++ ){
		printf('<tr><th class="noualumne" title="%s">', $ajuda[$i]);
			if($ricca3_alumcol['obliga'][$i]) _e('*', 'ricca3-admin');
			printf('%s</th>', $ricca3_alumcol['visual'][ $i ] );
// 	especial per els camps de data
			if($ricca3_alumcol['data'][ $i ] ){
// 	si es la data d'inscripcio, formatala i  mostrala no mes.
				if($ricca3_alumcol['nomform'][ $i ] != 'FN'){
					printf('<td class="noualumne"></td></tr>', NULL );
				}else{
//	si es la data de naixament, formatala i editala
					printf('<td class="noualumne"><INPUT type="text" name="%s" size="50" value="" /></td></tr>', 
						$ricca3_alumcol['nombd'][$i] );
				}
			}elseif($ricca3_alumcol['nombd'][ $i ] == 'email'){
				printf('<td class="noualumne"><INPUT type="email" name="%s" size="50" value="" /></td></tr>',
				$ricca3_alumcol['nombd'][$i] );
			}else{	
//	si no son camps de datas, editales
				if(isset($ricca3_alumcol['nomeslect'][ $i ]) && $ricca3_alumcol['nomeslect'][ $i ]){
					printf('<td class="noualumne"></td></tr>', NULL );
				}else{
//	si es obligatori, ho validem
					if($ricca3_alumcol['obliga'][$i]){
//	si es nomes lletres
						if($ricca3_alumcol['nomes-az'][$i]){
							printf('<td class="noualumne"><INPUT type="text" name="%s" size="50" value="" required="required" pattern="[a-zA-ZàáÁÀèéÈÉíÍïÏòóÒÓúÚñÑçÇ·  ]{1,}" /></td></tr>',
								$ricca3_alumcol['nombd'][$i] );
						}else{						
							printf('<td class="noualumne"><INPUT type="text" name="%s" size="50" value="" required="required" /></td></tr>',
								$ricca3_alumcol['nombd'][$i] );
						}
					}else{
						//	si es nomes lletres
						if($ricca3_alumcol['nomes-az'][$i]){
							printf('<td class="noualumne"><INPUT type="text" name="%s" size="50" value="" pattern="[a-zA-ZàáÁÀèéÈÉíÍïÏòóÒÓúÚñÑçÇ· ]{1,}" /></td></tr>',
								$ricca3_alumcol['nombd'][$i] );
						}else{
							printf('<td class="noualumne"><INPUT type="text" name="%s" size="50" value="" /></td></tr>', 
								$ricca3_alumcol['nombd'][$i] );
						}
					}
				}
			}
		}
		printf('</table>', NULL);
//	Creem el buto de desar dades		
		ricca3_desar('crear', 'noualumne', __('ajuda-desar-noualumne', 'ricca3-alum'));
//	Tanquem el formulari		
		printf('</form></div>', NULL);
		return;
	}	
//		Ja tenim les dades del nou alumne
	if( isset( $_POST['crear'] ) && $_POST['crear'] == 'noualumne' ){
//		comprovem els camps obligatoris
		$validat = true;
		for( $i=0; $i < $num_cols; $i++){
			if( $ricca3_alumcol['obliga'][ $i ] && $_POST[$ricca3_alumcol['nombd'][ $i ]] == ''){
				ricca3_missatge(sprintf('%s <b>%s</b> %s', __('El camp','ricca3-alum'), $ricca3_alumcol['visual'][ $i ], __('es obligatori.','ricca3-alum')));
				$validat = false;
			}
		}
//	comprovem si ja existeix un usuari amb el DNI propossat
		if( $wpdb->query( $wpdb->prepare('SELECT * FROM ricca3_alumne WHERE dni = %s',$_POST['dni'])) > 0){
			ricca3_missatge( __('El DNI ja existeix per un altre alumne','ricca3-alum'));
			$validat = false;
		}
//	Si hi han errors de validació avisem i surtim
		if( !$validat ){
			ricca3_missatge( __('HI HAN ERRORS A LES DADES INTRODUIDES I NO S\'HAN ACTUALITZAT ELS REGISTRES DE DADES!!','ricca3-alum'));
			return ;
		}
//	tenim be les dades: treiem el ultim registre de $_POST ([crear] => noualumne) 
		$ultim = array_pop($_POST);
//	canviem el format de la data de neixement
		$_POST['datanai'] = strftime("%Y-%m-%d",strtotime(str_replace('/','-',$_POST['datanai'])));
//	marquem el registre amb la data actual com data d'inscripció		
		$_POST['datainscripcio'] = date('Y-m-d');
//	calculem els camps nomicognoms i cognomsinom
		$_POST['nomicognoms'] = sprintf('%s %s %s',  trim(mb_strtoupper($_POST['nom'], "utf-8")),     trim(mb_strtoupper($_POST['cognom1'], "utf-8")), trim(mb_strtoupper($_POST['cognom2'], "utf-8")) );
		$_POST['cognomsinom'] = sprintf('%s %s, %s', trim(mb_strtoupper($_POST['cognom1'], "utf-8")), trim(mb_strtoupper($_POST['cognom2'], "utf-8")), trim(mb_strtoupper($_POST['nom'], "utf-8")) );
		$_POST = stripslashes_deep($_POST);
//	afegim els stamp
		$_POST['stampuser'] = $current_user->user_login;
		$_POST['stampplace'] = 'ricca3_shortcode_noualumne_insert';
//	insertem el registre
		if( $wpdb->insert('ricca3_alumne',$_POST) ){
			ricca3_missatge( __('Entrada dades del nou alumne existosa!','ricca3-alum'));
//	busquem el id del nou registre i cridem als nous butons.			
			$_GET['ID']=$wpdb->insert_id;
			$ricca3_butons_noualumne['texte'][0] = __('ajuda-noualumne-especialitat', 'ricca3-alum');			
			ricca3_butons( $ricca3_butons_noualumne, 6, $token );
		}else{
			ricca3_missatge( __('S\'han produït errors mentre es desaven les dades del nou alumne! No s\'han desat les dades', 'ricca3-alum'));
		}
	}
}

#############################################################################################
/**
 * filtres per a l'impresio dels llistats d'assistencia
 * shortcode: [ricca3-assist]
 *
 * @since ricca3.v.2013.13.6
 * @author Efraim Bayarri
 */
#############################################################################################
function ricca3_shortcode_assist($atts, $content = null) {
	global $wpdb;
	global $ricca3_butons_cercalumne;
//		missatge de capçalera de la pàgina
	ricca3_missatge(__('Llistats d\'assistència','ricca3-alum'));
//		crear token
	$token = array( 'espec' => $_GET['espec'], 'grup' => $_GET['grup'], 'any' => $_GET['any'], 'estat' => $_GET['estat'], 'repe' => $_GET['repe']);
//		preparar ajudes als butons
	$ricca3_butons_cercalumne['texte'][0] = __('ajuda-alumnes', 'ricca3-alum');
//		mostrar la filera de butons
	ricca3_butons( $ricca3_butons_cercalumne, 6, $token );
//		formulari del filtre de grups	
	printf('<form method="post" action="" name="cercar"><table dir="ltr" class="menucurt350"><tr>', NULL);
	printf('<td><button type="submit" name="cercar" value="actualitzar"><img src=%s/ricca3/imatges/ricca3-escollirgrup.png " border="0" /></button></td>', WP_PLUGIN_URL);
//	si no hem escollit encara un grup i hi ha un definit al token, possar-ho com predeterminat
	if( !isset( $_POST['grupassist'] ) && $_GET['grup'] != '-1') $_POST['grupassist'] = $_GET['grup'];
//		drop per el grup
	$data_grup = $wpdb->get_results('SELECT * FROM ricca3_grups WHERE actiu_gr = 1 ORDER BY grup ', ARRAY_A );
	ricca3_drop( __('Grup:','ricca3-alum'), 'grupassist',  $data_grup,  'idgrup', 'grup',  __('ajuda_drop_ grup', 'ricca3-alum'), TRUE );
//		final del formulari	
	printf('</tr></table></form>', NULL);
//		si ja hem escollit el grup, 	
	if( isset( $_POST['grupassist'] ) ){
//	busquem el nom del grup i mostrem el missatge d'aceptació		
		$row_grup = $wpdb->get_row($wpdb->prepare('SELECT * FROM ricca3_grups WHERE idgrup = %s', $_POST['grupassist']), ARRAY_A, 0);
		ricca3_missatge(sprintf('%s %s', __('Llistat d\'assistencia del grup','ricca3-alum'), $row_grup['grup'] ) );
//	presentem la taula d'aceptació		
		printf('<table><tr>', NULL);
		printf('<td><a href="%s/%s/?ID=%s" target="POPUPW" onsubmit="POPUPW = window.open("about:blank","POPUPW","width=800,height=650" >',site_url(), 'ricca3-impassist', $_POST['grupassist']);
		printf('<button type="button"><img src="%s/ricca3/imatges/ricca3-impassist.png" border=0 /></button></a></td>',WP_PLUGIN_URL );
		printf('</tr></table>', NULL);
	}
}

#############################################################################################
/**
 * Impresio dels llistats d'assistencia
 * shortcode: [ricca3-impassist]
 *
 * @since ricca3.v.2013.13.6
 * @author Efraim Bayarri
 */
#############################################################################################
function ricca3_shortcode_impassist($atts, $content = null) {
	global $wpdb;
	$row_any = $wpdb->get_row( $wpdb->prepare( 'SELECT * FROM ricca3_any WHERE actual = 1', NULL ) , ARRAY_A , 0 );
	$dades = $wpdb->get_results( $wpdb->prepare( 'SELECT * FROM ricca3_alumespec_view WHERE idgrup = %s AND idany = %s AND idestat_es = 1 AND repeteix != "R" ORDER BY cognomsinom ASC' , $_GET['ID'] , $row_any['idany'] ), ARRAY_A );
	for( $i=0; $i < count( $dades ); $i++ ) {
		if ($i == 0 || $i == 16) {
			printf('<table class="cap"><tr><td><IMG SRC="%s/ricca3/imatges/ricca3-logo.jpg" ALIGN=left><IMG SRC="%s/ricca3/imatges/ricca3-adreca.png" ALIGN=left></td></tr></table>', WP_PLUGIN_URL, WP_PLUGIN_URL );
			printf('<table><tr><td width="200px"></td>', NULL);
			printf('<td>%s</td></tr>',                __('CONTROL D\'ASSISTENCIA','ricca3-alum'));
			printf('<tr><td>%s %s</td>',              __('Grup:','ricca3-alum'), $dades[$i]['grup']);
			printf('<td>%s %s</td></tr>',             __('Especialitat:','ricca3-alum'), $dades[$i]['nomespecialitat']);
			printf('<tr><td>%s %s</td></tr></table>', __('Curs:','ricca3-alum'), $dades[$i]['any']);
		}
		if ($i == 0 && count( $dades ) >= 16) {
			$table = " class=\"cosassist\" style=\"page-break-after: always;\" ";
		} else {
			$table = " class=\"cosassist\" ";
		}
		if ($i==0 || $i == 16) printf('<table %s>', $table );
		if ($i==0 || $i == 16) { 
			printf( '<tr><td width="380px" align="center">%s<br />&nbsp;</td><td width="40px"></td><td width="40px"></td><td width="40px"></td><td width="40px"></td><td width="40px"></td>', __('Alumnes','ricca3-alum'));
			printf( '<td width="40px"></td><td width="40px"></td><td width="40px"></td><td width="40px"></td><td width="40px"></td></tr>', NULL);
		}
		printf( '<tr><td>%s - %s</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>', $i+1 , $dades[$i]["cognomsinom"] );
	}
	printf('</table>', NULL);
}

#############################################################################################
/**
 * visualitza les dades del alumne
 * shortcode: [ricca3-dadesalumne]
 *
 * @since ricca3.v.2013.16.1
 * @author Efraim Bayarri
 */
#############################################################################################
function ricca3_shortcode_dadesalumne($atts, $content = null) {
	global $wpdb;
	global $ricca3_alumcol;
	global $ricca3_butons_dadesalumne;
	$num_cols=count($ricca3_alumcol,1)/count($ricca3_alumcol,0)-1;
//		buscar les dades del alumne	
	$row = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_alumne where idalumne = %s ',$_GET['ID']),ARRAY_A,0);
//		missatge de capçalera de la pàgina
	ricca3_missatge(sprintf('%s %s', __('Dades de l\'Alumne','ricca3-alum'), $row['cognomsinom']));
	
	$token = array( 'espec' => $_GET['espec'], 'grup' => $_GET['grup'], 'any' => $_GET['any'], 'estat' => $_GET['estat'], 'repe' => $_GET['repe']);
//		preparar ajudes als butons
	$ricca3_butons_dadesalumne['texte'][0] = __('ajuda-dadesalumne-especialitats', 'ricca3-alum');
	$ricca3_butons_dadesalumne['texte'][1] = __('ajuda-dadesalumne-editardades',   'ricca3-alum');
	$ricca3_butons_dadesalumne['texte'][2] = __('ajuda-dadesalumne-esborraalumne', 'ricca3-alum');
	$ricca3_butons_dadesalumne['texte'][3] = __('ajuda-dadesalumne-alumne',        'ricca3-alum');
//		mostrar la filera de butons
	ricca3_butons( $ricca3_butons_dadesalumne, 6, $token );
//		preparar ajudes als camps
	$ajuda[0]  = __('ajuda-noualumne-nom',                'ricca3-alum');
	$ajuda[1]  = __('ajuda-noualumne-cognom1',            'ricca3-alum');
	$ajuda[2]  = __('ajuda-noualumne-cognom2',            'ricca3-alum');
	$ajuda[3]  = __('ajuda-noualumne-dni',                'ricca3-alum');
	$ajuda[4]  = __('ajuda-noualumne-datanai',            'ricca3-alum');
	$ajuda[5]  = __('ajuda-noualumne-llocnai',            'ricca3-alum');
	$ajuda[6]  = __('ajuda-noualumne-provnai',            'ricca3-alum');
	$ajuda[7]  = __('ajuda-noualumne-paisnai',            'ricca3-alum');
	$ajuda[8]  = __('ajuda-noualumne-email',              'ricca3-alum');
	$ajuda[9]  = __('ajuda-noualumne-residenciahabitual', 'ricca3-alum');
	$ajuda[10] = __('ajuda-noualumne-ciutathabitual',     'ricca3-alum');
	$ajuda[11] = __('ajuda-noualumne-provinciahabitual',  'ricca3-alum');
	$ajuda[12] = __('ajuda-noualumne-codipostal',         'ricca3-alum');
	$ajuda[13] = __('ajuda-noualumne-telefon',            'ricca3-alum');
	$ajuda[14] = __('ajuda-noualumne-telefonfixe',        'ricca3-alum');
	$ajuda[15] = __('ajuda-noualumne-datainscripcio',     'ricca3-alum');
	$ajuda[16] = __('ajuda-noualumne-estudisanteriors',   'ricca3-alum');
	$ajuda[17] = __('ajuda-noualumne-centreea',           'ricca3-alum');
	$ajuda[18] = __('ajuda-noualumne-poblacioea',         'ricca3-alum');
	$ajuda[19] = __('ajuda-noualumne-abonament',          'ricca3-alum');
//		mostrar les dades del alumne	
	printf('<div id="dades"><form method="post" action="" target="_self" name="dades" id="dades">',NULL );
	printf('<table><tr><td><table>', NULL);
	for( $i=0; $i < $num_cols; $i++ ){
		printf('<tr><th class="noualumne" title="%s">%s</th>', $ajuda[$i], $ricca3_alumcol['visual'][$i]);
//			preparar la sortida de dates		
		if($ricca3_alumcol['data'][$i]){
			printf('<td class="noualumne">%s</td></tr>', date( 'd/m/Y' , strtotime( $row[$ricca3_alumcol['nombd'][$i]] ) ) );
		}else{
			printf('<td class="noualumne">%s</td></tr>', $row[$ricca3_alumcol['nombd'][$i]]);
		}
	}
//		mostra la foto del alumne	
	printf('</table></td><td><table><tr><td>', NULL);
	$attachment_id = $row['attachment_id'];
	if( strlen($attachment_id < 1 )) $attachment_id = 228;
	$image_attributes = wp_get_attachment_image_src( $attachment_id , 'full');
	printf('<img src="%s" width="141" height="177">', $image_attributes[0] );
	printf('</td></tr></table></td></tr></table>', NULL);
	printf('</form></div>', NULL);
}

#############################################################################################
/**
 * editar les dades personals del alumne
 * shortcode: [ricca3-editardades]
 *
 * @since ricca3.v.2013.16.1
 * @author Efraim Bayarri
 */
#############################################################################################
function ricca3_shortcode_editardades($atts, $content = null) {
	global $wpdb;
	global $current_user;
	global $ricca3_alumcol;
	global $ricca3_butons_editardades;
	$num_cols=count($ricca3_alumcol,1)/count($ricca3_alumcol,0)-1;
//		buscar les dades del alumne
	$row = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_alumne where idalumne = %s ',$_GET['ID']),ARRAY_A,0);
//		missatge de capçalera de la pàgina
	ricca3_missatge(sprintf('%s %s', __('Editar dades de l\'Alumne','ricca3-alum'), $row['cognomsinom']));
	
	$token = array( 'espec' => $_GET['espec'], 'grup' => $_GET['grup'], 'any' => $_GET['any'], 'estat' => $_GET['estat'], 'repe' => $_GET['repe']);
//		preparar ajudes als butons
	$ricca3_butons_editardades['texte'][0] = __('ajuda-editardades-especialitats', 'ricca3-alum');
	$ricca3_butons_editardades['texte'][1] = __('ajuda-editardades-dadesalumne',   'ricca3-alum');
	$ricca3_butons_editardades['texte'][2] = __('ajuda-editardades-alumnes', 'ricca3-alum');
//		mostrar la filera de butons
	ricca3_butons( $ricca3_butons_editardades, 6, $token );
//	imatge
	if( isset($_POST['desar']))	{
		if ( ! function_exists( 'wp_handle_upload' ) ) require_once( ABSPATH . 'wp-admin/includes/file.php' );
		$uploadedfile = $_FILES['imatge'];
		$upload_overrides = array( 'test_form' => false );
		$movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
	
		$wp_filetype = wp_check_filetype(basename($movefile['file']), null );
		$wp_upload_dir = wp_upload_dir();
		$attachment = array(
				'guid' => $wp_upload_dir['url'] . '/' . basename( $movefile['file'] ),
				'post_mime_type' => $wp_filetype['type'],
				'post_title' => preg_replace('/\.[^.]+$/', '', basename($movefile['file'])),
				'post_content' => '',
				'post_status' => 'inherit'
		);
	
		$attach_id = wp_insert_attachment( $attachment, $movefile['file'] );
// you must first include the image.php file
// for the function wp_generate_attachment_metadata() to work
		require_once(ABSPATH . 'wp-admin/includes/image.php');
		$attach_data = wp_generate_attachment_metadata( $attach_id, $movefile['file'] );
		wp_update_attachment_metadata( $attach_id, $attach_data );
		get_currentuserinfo();
		$wpdb->update('ricca3_alumne', array( 'attachment_id' => $attach_id, 'stampuser' => $current_user->user_login, 'stampplace' => 'ricca_shortcode_editardades_foto' ), array('idalumne' => $_GET['ID']));
		$row = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_alumne WHERE idalumne = %s',$_GET['ID']),ARRAY_A,0);
	}
//	visualitza les dades actuals
	if( !isset( $_POST['actualitzar'] ) ){
//		preparar ajudes als camps
		$ajuda[0]  = __('ajuda-noualumne-nom',                'ricca3-alum');
		$ajuda[1]  = __('ajuda-noualumne-cognom1',            'ricca3-alum');
		$ajuda[2]  = __('ajuda-noualumne-cognom2',            'ricca3-alum');
		$ajuda[3]  = __('ajuda-noualumne-dni',                'ricca3-alum');
		$ajuda[4]  = __('ajuda-noualumne-datanai',            'ricca3-alum');
		$ajuda[5]  = __('ajuda-noualumne-llocnai',            'ricca3-alum');
		$ajuda[6]  = __('ajuda-noualumne-provnai',            'ricca3-alum');
		$ajuda[7]  = __('ajuda-noualumne-paisnai',            'ricca3-alum');
		$ajuda[8]  = __('ajuda-noualumne-email',              'ricca3-alum');
		$ajuda[9]  = __('ajuda-noualumne-residenciahabitual', 'ricca3-alum');
		$ajuda[10] = __('ajuda-noualumne-ciutathabitual',     'ricca3-alum');
		$ajuda[11] = __('ajuda-noualumne-provinciahabitual',  'ricca3-alum');
		$ajuda[12] = __('ajuda-noualumne-codipostal',         'ricca3-alum');
		$ajuda[13] = __('ajuda-noualumne-telefon',            'ricca3-alum');
		$ajuda[14] = __('ajuda-noualumne-telefonfixe',        'ricca3-alum');
		$ajuda[15] = __('ajuda-noualumne-datainscripcio',     'ricca3-alum');
		$ajuda[16] = __('ajuda-noualumne-estudisanteriors',   'ricca3-alum');
		$ajuda[17] = __('ajuda-noualumne-centreea',           'ricca3-alum');
		$ajuda[18] = __('ajuda-noualumne-poblacioea',         'ricca3-alum');
		$ajuda[19] = __('ajuda-noualumne-abonament',          'ricca3-alum');
		
		ricca3_missatge(__('Els camps amb asterisc(*) son obligatoris','ricca3-alum'));
		printf('<table><tr><td><form method="post" action="" target="_self" name="editardades" id="myform"><table> ', NULL);
		for( $i = 0; $i < $num_cols; $i++){
			printf('<tr><th class="noualumne" title="%s">', $ajuda[$i]);
			if($ricca3_alumcol['obliga'][$i]) _e('*', 'ricca3-admin');
			printf('%s</th>', $ricca3_alumcol['visual'][ $i ] );
// 	especial per els camps de data
			if($ricca3_alumcol['data'][ $i ] ){
// 	si es la data d'inscripcio, formatala i  mostrala no mes.
				if($ricca3_alumcol['nomform'][ $i ] != 'FN'){
					printf('<td class="noualumne">%s</td></tr>', date('d/m/Y',strtotime($row[$ricca3_alumcol['nombd'][$i]]) ));
				}else{
//	si es la data de naixament, formatala i editala
					printf('<td class="noualumne"><INPUT type="text" name="%s" size="50" value="%s" /></td></tr>', 
						$ricca3_alumcol['nombd'][$i],date('d/m/Y',strtotime($row[$ricca3_alumcol['nombd'][$i]])) );
				}
			}elseif($ricca3_alumcol['nombd'][ $i ] == 'email'){
				printf('<td class="noualumne"><INPUT type="email" name="%s" size="50" value="%s" /></td></tr>',
				$ricca3_alumcol['nombd'][$i],$row[$ricca3_alumcol['nombd'][$i]] );
			}else{	
//	si no son camps de datas, editales
				if(isset($ricca3_alumcol['nomeslect'][ $i ]) && $ricca3_alumcol['nomeslect'][ $i ]){
					printf('<td class="noualumne">%s</td></tr>', $row[$ricca3_alumcol['nombd'][ $i ]]);
				}else{
//	si es obligatori, ho validem
					if($ricca3_alumcol['obliga'][$i]){
//	si es nomes lletres
						if($ricca3_alumcol['nomes-az'][$i]){
							printf('<td class="noualumne"><INPUT type="text" name="%s" size="50" value="%s" required="required" pattern="[a-zA-ZàáÁÀèéÈÉíÍïÏòóÒÓúÚñÑçÇ·\'-,  ]{1,}" /></td></tr>',
								$ricca3_alumcol['nombd'][$i],$row[$ricca3_alumcol['nombd'][$i]] );
						}else{						
							printf('<td class="noualumne"><INPUT type="text" name="%s" size="50" value="%s" required="required" /></td></tr>',
								$ricca3_alumcol['nombd'][$i],$row[$ricca3_alumcol['nombd'][$i]] );
						}
					}else{
						//	si es nomes lletres
						if($ricca3_alumcol['nomes-az'][$i]){
							printf('<td class="noualumne"><INPUT type="text" name="%s" size="50" value="%s" pattern="[a-zA-ZàáÁÀèéÈÉíÍïÏòóÒÓúÚñÑçÇ·\'-, ]{1,}" /></td></tr>',
								$ricca3_alumcol['nombd'][$i],$row[$ricca3_alumcol['nombd'][$i]] );
						}else{
							printf('<td class="noualumne"><INPUT type="text" name="%s" size="50" value="%s" /></td></tr>', 
								$ricca3_alumcol['nombd'][$i],$row[$ricca3_alumcol['nombd'][$i]] );
						}
					}
				}
			}
		}
//	mostra el buton de guardar dades
		printf('<tr class="credit"><td><button type="submit" name="actualitzar" value="editardades" title="%s"><font size ="1px" face="Arial, Helvetica, sans-serif">%s</font></button></td></tr>',  
			__('ajuda-noualumne-desar', 'ricca3-alum') , __('Desar dades','ricca3-alum'));
		printf('</table></form>', NULL);
		printf('</td><td><table><tr><td>', NULL);
		$attachment_id = $row['attachment_id'];
		if( strlen($attachment_id < 1 )) $attachment_id = 228;
		$image_attributes = wp_get_attachment_image_src( $attachment_id, 'full' ); // returns an array
		printf('<img src="%s" width="141" height="177">', $image_attributes[0] );
		printf('<form action="" method="POST" enctype="multipart/form-data"><label for="imagen">Fotografia:</label>', NULL);
		printf('<input type="file" name="imatge" id="imatge" /><input type="submit" name="desar" value="desar" /></form>', NULL);
			
		printf('</td></tr></table></td></tr></table>', NULL);
		return;
		}
// actualitzem les dades	
		get_currentuserinfo();
		$ultim = array_pop($_POST);
//	calculem els camps nomicognoms i cognomsinom
		$_POST['nomicognoms'] = sprintf('%s %s %s',  trim(mb_strtoupper($_POST['nom'], "utf-8")),     trim(mb_strtoupper($_POST['cognom1'], "utf-8")), trim(mb_strtoupper($_POST['cognom2'], "utf-8")) );
		$_POST['cognomsinom'] = sprintf('%s %s, %s', trim(mb_strtoupper($_POST['cognom1'], "utf-8")), trim(mb_strtoupper($_POST['cognom2'], "utf-8")), trim(mb_strtoupper($_POST['nom'], "utf-8")) );
		$_POST = stripslashes_deep($_POST);
//	canviem el format de la data de neixement
		$_POST['datanai']    = strftime("%Y-%m-%d",strtotime(str_replace('/','-',$_POST['datanai'])));
//	afegim els stamp
		$_POST['stampuser']  = $current_user->user_login;
		$_POST['stampplace'] = 'ricca_shortcode_editardades';
		if( $result = $wpdb->update('ricca3_alumne' , $_POST , array('idalumne' => $_GET['ID']) ) ) 
			ricca3_missatge(sprintf('%s', __('S\'HAN ACTUALITZAT ELS REGISTRES DE DADES SATISFACTORIAMENT', 'ricca3_alum')));
}

#############################################################################################
/**
 * especialitats de l'alumne
 * shortcode: [ricca3-especalum]
 *
 * @since ricca3.v.2013.16.7
 * @author Efraim Bayarri
 */
#############################################################################################
function ricca3_shortcode_especalum($atts, $content = null) {
	global $wpdb;
	global $ricca3_especalum;
	global $ricca3_butons_especalum;
	global $current_user;

	get_currentuserinfo();
	$num_cols=count($ricca3_especalum,1)/count($ricca3_especalum,0)-1;
	
	if( !isset( $_GET['ID'] ) ) return '';
//		buscar les dades del alumne
	$row_alu = $wpdb->get_row($wpdb->prepare('SELECT * FROM ricca3_alumne WHERE idalumne=%s', $_GET['ID']), ARRAY_A, 0);
	$image_attributes = ricca3_miniatura($_GET['ID']);
//		missatge de capçalera de la pàgina	
	ricca3_missatge(sprintf('%s %s</td><td><img src="%s" width="%s" height="%s">',__('Especialitats de l\'alumne','ricca3-alum'), $row_alu['cognomsinom'], $image_attributes[0], $image_attributes[1], $image_attributes[2] ));
	$token = array( 'espec' => $_GET['espec'], 'grup' => $_GET['grup'], 'any' => $_GET['any'], 'estat' => $_GET['estat'], 'repe' => $_GET['repe']);
//	ajuda al butons	
	$ricca3_butons_especalum['texte'][0] =  __('ajuda-especalum-afegirespecialitat', 'ricca3-alum');
	$ricca3_butons_especalum['texte'][1] =  __('ajuda-especalum-baixaespecialitat',  'ricca3-alum');
	$ricca3_butons_especalum['texte'][2] =  __('ajuda-especalum-creditsalumne',      'ricca3-alum');
	$ricca3_butons_especalum['texte'][3] =  __('ajuda-especalum-aplicarpla',         'ricca3-alum');
	$ricca3_butons_especalum['texte'][4] =  __('ajuda-especalum-dadesalumne',        'ricca3-alum');
	$ricca3_butons_especalum['texte'][5] =  __('ajuda-especalum-alumne',             'ricca3-alum');
	$ricca3_butons_especalum['texte'][6] =  __('ajuda-especalum-butlleti',           'ricca3-alum');
	$ricca3_butons_especalum['texte'][7] =  __('ajuda-especalum-caratula',           'ricca3-alum');
	$ricca3_butons_especalum['texte'][8] =  __('ajuda-especalum-marcarrepetidor',    'ricca3-alum');
	$ricca3_butons_especalum['texte'][9] =  __('ajuda-especalum-canviarany',         'ricca3-alum');
	$ricca3_butons_especalum['texte'][10] = __('ajuda-especalum-afegircredit',       'ricca3-alum');
	$ricca3_butons_especalum['texte'][11] = __('ajuda-especalum-notafinal',          'ricca3-alum');
//		mostrar la filera de butons
	ricca3_butons( $ricca3_butons_especalum, 12, $token );	
//		ajuda a la graella
	$ricca3_especalum['ajuda'][0] = __('ajuda-graella-especalum-any',          'ricca3-alum');
	$ricca3_especalum['ajuda'][1] = __('ajuda-graella-especalum-especialitat', 'ricca3-alum');
	$ricca3_especalum['ajuda'][2] = __('ajuda-graella-especalum-grup',         'ricca3-alum');
	$ricca3_especalum['ajuda'][3] = __('ajuda-graella-especalum-estat',        'ricca3-alum');
	$ricca3_especalum['ajuda'][4] = __('ajuda-graella-especalum-nota',         'ricca3-alum');
	$ricca3_especalum['ajuda'][5] = __('ajuda-graella-especalum-repeteix',     'ricca3-alum');
//		buscar especialitats
	$data_view = $wpdb->get_results( $wpdb->prepare('SELECT * FROM ricca3_alumespec_view WHERE idalumne = %s ORDER BY idany ',$_GET['ID']), ARRAY_A);
//		llistat de les especialitats del alumne
	ricca3_graella( $ricca3_especalum, $data_view, $token );
	printf('</table></form>', NULL);
//		quantes especialitats te l'alumne?
	$espec = $wpdb->query( $wpdb->prepare('SELECT DISTINCT idespecialitat FROM ricca3_alumespec_view WHERE idalumne=%s and idestat_es = 1', $_GET['ID']));	
//	<!-- the tabs -->
	printf('<div id="tabs">', NULL);
//		tab principal
	printf('<ul class="tabs"><li><a href="#estat" title="%s">%s</a></li>', __('ajuda-tab-estatcredits', 'ricca3-alum'), __('Estat dels crèdits', 'ricca3-alum'));
//		tabs especialitats	
	for( $i = 0; $i < $espec; $i++){
		$idespec = $wpdb->get_row( $wpdb->prepare('SELECT DISTINCT idespecialitat FROM ricca3_alumespec_view WHERE idalumne=%s and idestat_es = 1', $_GET['ID']), ARRAY_A, $i);
		$row_espec = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_alumespec_view WHERE idalumne=%s AND idespecialitat=%s', $_GET['ID'], $idespec['idespecialitat']), ARRAY_A, 0);
		$nom = str_word_count($row_espec['nomespecialitat'], 1, 'ÀÈÒÓ');
		printf('<li><a href="#espec%s" title="%s">%s</a></li>', $i, __('ajuda-tab-especialitats','ricca3-alum'), $nom[0]); 
	}
//		tabs historial	
	for( $i = 0; $i < $espec; $i++){
		$idespec = $wpdb->get_row( $wpdb->prepare('SELECT DISTINCT idespecialitat FROM ricca3_alumespec_view WHERE idalumne=%s and idestat_es = 1', $_GET['ID']), ARRAY_A, $i);
		$row_espec = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_alumespec_view WHERE idalumne=%s AND idespecialitat=%s', $_GET['ID'], $idespec['idespecialitat']), ARRAY_A, 0);
		$nom = str_word_count($row_espec['nomespecialitat'], 1, 'ÀÈÒÓ');
		printf('<li><a href="#hist%s" title="%s">HISTORIAL %s</a></li>', $i, __('ajuda-tab-historial','ricca3-alum') ,$nom[0]);
	}
  	printf('</ul>', NULL);
//		<!-- tab "panes" -->
#################################
##//		primer tab
#################################
  	printf('<div id="estat">', NULL);
  	for( $i = 0; $i < $espec; $i++){
//	busquem quines son les especialitats
		$idespec = $wpdb->get_row( $wpdb->prepare('SELECT DISTINCT idespecialitat FROM ricca3_alumespec_view WHERE idalumne=%s AND idestat_es=1 ', $_GET['ID']), ARRAY_A, $i);
 		$row_espec = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_alumespec_view WHERE idalumne=%s AND idespecialitat=%s', $_GET['ID'], $idespec['idespecialitat']), ARRAY_A, 0);
 		printf('<form method="post" action="" target="_self" name="espec" id="primertab">', NULL);
 		printf('<table><tr><td>%s</td></tr></table>', $row_espec['nomespecialitat']);
//	busquem quin credits te asignats 		
 		$query = $wpdb->prepare('SELECT DISTINCT ricca3_credits_avaluacions.idccomp, ricca3_credits.ordre_cr FROM ricca.ricca3_credits_avaluacions '. 
								'INNER JOIN ricca3_ccomp ON ricca3_ccomp.idccomp = ricca3_credits_avaluacions.idccomp '.
								'INNER JOIN ricca3_credits ON ricca3_credits.idcredit = ricca3_ccomp.idcredit '.
								'WHERE idalumne=%s AND ricca3_credits.idespecialitat=%s ORDER BY ricca3_credits.ordre_cr ', $_GET['ID'], $idespec['idespecialitat']);
 		$array_cred_espec = $wpdb->get_results( $query, ARRAY_A );
 		printf('<table>', NULL);
//	mostrem la capçalera de la graella amb les ajudes
 		printf( '<tr><th title="%s">Grup</th><th title="%s">Conv</th><th title="%s">R</th><th title="%s">Crèdit</th><th title="%s">N1</th><th title="%s">A1</th><th title="%s">N2</th>'.
 				'<th title="%s">A2</th><th title="%s">N3</th><th title="%s">A3</th><th title="%s">NFCC</th><th title="%s">NF</th><th title="%s">P</th><th title="%s">Professor</th><th title="%s">HoresCC</th><th title="%s">Hores</th></tr>',
 				__('ajuda-graella-credalu-grup',    'ricca3-alum'),
 				__('ajuda-graella-credalu-conv',    'ricca3-alum'),
 				__('ajuda-graella-credalu-R',       'ricca3-alum'),
 				__('ajuda-graella-credalu-credit',  'ricca3-alum'),
 				__('ajuda-graella-credalu-N1',      'ricca3-alum'),
 				__('ajuda-graella-credalu-A1',      'ricca3-alum'),
 				__('ajuda-graella-credalu-N2',      'ricca3-alum'),
 				__('ajuda-graella-credalu-A2',      'ricca3-alum'),
 				__('ajuda-graella-credalu-N3',      'ricca3-alum'),
 				__('ajuda-graella-credalu-A3',      'ricca3-alum'),
 				__('ajuda-graella-credalu-NFCC',    'ricca3-alum'),
 				__('ajuda-graella-credalu-NF',      'ricca3-alum'),
 				__('ajuda-graella-credalu-P',       'ricca3-alum'),
 				__('ajuda-graella-credalu-prof',    'ricca3-alum'),
 				__('ajuda-graella-credalu-horesCC', 'ricca3-alum'),
 				__('ajuda-graella-credalu-hores',   'ricca3-alum')
 				);
//	busquem quin es el any actual per les negretes de la graella 		
 		$row_any = $wpdb->get_row( $wpdb->prepare( 'SELECT * FROM ricca3_any WHERE actual = 1', NULL ) , ARRAY_A , 0 );
//	busquem l'infomació dels crèdits 		
 		for( $j=0; $j < count($array_cred_espec); $j++){
 			$query_cred = $wpdb->prepare('SELECT * FROM ricca3_credits_avaluacions '. 
										'INNER JOIN ricca3_ccomp ON ricca3_ccomp.idccomp=ricca3_credits_avaluacions.idccomp '.
										'INNER JOIN ricca3_credits ON ricca3_credits.idcredit = ricca3_ccomp.idcredit '.
										'INNER JOIN ricca3_especialitats ON ricca3_especialitats.idespecialitat = ricca3_credits.idespecialitat '.
 										'INNER JOIN ricca3_grups ON ricca3_grups.idgrup = ricca3_ccomp.idgrup '.
 										'INNER JOIN ricca3_any ON ricca3_any.idany = ricca3_credits_avaluacions.idany '.
 										'INNER JOIN ricca3_professors ON ricca3_professors.idprof = ricca3_ccomp.idprofessor '.
										'WHERE idalumne=%s AND ricca3_credits_avaluacions.idccomp=%s '.
 										'ORDER BY ricca3_credits_avaluacions.idany DESC', $_GET['ID'], $array_cred_espec[$j]['idccomp']);
 			$row_cred = $wpdb->get_row( $query_cred, ARRAY_A, 0);
//	si el crèdit es actiu per aquest any mostrem la convocatoria en negretes
 			$conv = $row_cred['convord'];
 			if($row_cred['conv'] == $row_any['conv']) $conv = sprintf('<b>%s</b>', $row_cred['convord']);
// 	preparem les dades
 			$repeteix = $row_cred['repe'];
 			if($row_cred['repe'] =='R') $repeteix = '<b>*</b>';
 			$title = '';
//	info del crèdit a title=""
			$query_dades = $wpdb->prepare('SELECT * FROM ricca3_credits_avaluacions '.
					'INNER JOIN ricca3_ccomp ON ricca3_ccomp.idccomp=ricca3_credits_avaluacions.idccomp '.
					'INNER JOIN ricca3_credits ON ricca3_credits.idcredit = ricca3_ccomp.idcredit '.
					'INNER JOIN ricca3_especialitats ON ricca3_especialitats.idespecialitat = ricca3_credits.idespecialitat '.
					'INNER JOIN ricca3_grups ON ricca3_grups.idgrup = ricca3_ccomp.idgrup '.
					'INNER JOIN ricca3_any ON ricca3_any.idany = ricca3_credits_avaluacions.idany '.
					'INNER JOIN ricca3_professors ON ricca3_professors.idprof = ricca3_ccomp.idprofessor '.
					'WHERE idalumne=%s AND ricca3_credits.idcredit = %s '.
					'ORDER BY ricca3_credits_avaluacions.idany ASC', $_GET['ID'], $row_cred['idcredit']);
//			echo "<br />", $query_dades;						
 			$dades_cred = $wpdb->get_results( $query_dades, ARRAY_A);
 			$title = sprintf('%s', $dades_cred[0]['nomcredit']);
 			for( $k = 0; $k < count( $dades_cred ); $k++){

 			}
//	mostrem els resultats a la linea de la graella 			
			printf('<tr><td>%s</td><td>%s</td><td>%s</td><td title="%s">%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td><b>%s</b></td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>', 
 				$row_cred['grup'], $conv, $repeteix, $title, $row_cred['nomccomp'], $row_cred['nota1'], $row_cred['act1'], $row_cred['nota2'], $row_cred['act2'], 
 				$row_cred['nota3'], $row_cred['actf'], $row_cred['notaf_cc'], $row_cred['notaf_cr'], $row_cred['pendi'],  $row_cred['nomicognoms'], $row_cred['hores_cc'], $row_cred['hores_cr']);
 		}
 		printf('</table></form>', NULL);
  	}
  	printf('</div>', NULL);
#################################
//		tabs detallats especialitat
#################################
  	for( $i = 0; $i < $espec; $i++){
  		$idespec = $wpdb->get_row( $wpdb->prepare('SELECT DISTINCT idespecialitat FROM ricca3_alumespec_view WHERE idalumne=%s AND idestat_es=1 ', $_GET['ID']), ARRAY_A, $i);
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
		printf('<div id="espec%s"><table>', $i);
//	mostrem la capçalera de la graella amb les ajudes
 		printf( '<tr><th title="%s">Grup</th><th title="%s">Conv</th><th title="%s">R</th><th title="%s">Crèdit</th><th title="%s">N1</th><th title="%s">A1</th><th title="%s">N2</th>'.
 				'<th title="%s">A2</th><th title="%s">N3</th><th title="%s">A3</th><th title="%s">NFCC</th><th title="%s">NF</th><th title="%s">P</th><th title="%s">Professor</th><th title="%s">HoresCC</th><th title="%s">Hores</th></tr>',
 				__('ajuda-graella-credalu-grup',    'ricca3-alum'),
 				__('ajuda-graella-credalu-conv',    'ricca3-alum'),
 				__('ajuda-graella-credalu-R',       'ricca3-alum'),
 				__('ajuda-graella-credalu-credit',  'ricca3-alum'),
 				__('ajuda-graella-credalu-N1',      'ricca3-alum'),
 				__('ajuda-graella-credalu-A1',      'ricca3-alum'),
 				__('ajuda-graella-credalu-N2',      'ricca3-alum'),
 				__('ajuda-graella-credalu-A2',      'ricca3-alum'),
 				__('ajuda-graella-credalu-N3',      'ricca3-alum'),
 				__('ajuda-graella-credalu-A3',      'ricca3-alum'),
 				__('ajuda-graella-credalu-NFCC',    'ricca3-alum'),
 				__('ajuda-graella-credalu-NF',      'ricca3-alum'),
 				__('ajuda-graella-credalu-P',       'ricca3-alum'),
 				__('ajuda-graella-credalu-prof',    'ricca3-alum'),
 				__('ajuda-graella-credalu-horesCC', 'ricca3-alum'),
 				__('ajuda-graella-credalu-hores',   'ricca3-alum')
 				);			
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
//				printf('<tr class="credit"><td>%s</td><td>%s</td><td></td><td><b>%s</b></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td><b>%s</b></td><td><b>%s</b></td><td></td><td></td><td>%s</td></tr>',
				printf('<tr class="credit"><td>%s</td><td>%s</td><td colspan="2"><b>%s</b></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td><b>%s</b></td><td><b>%s</b></td><td></td><td></td><td>%s</td></tr>',
				$data_cred[$j]['grup'], '<b>===></b>', $data_cred[$j]['nomcredit'], $nota, $pendi, $data_cred[$j]['hores_cr']);
			}
//	si ja hem mostrat el ccomp a la linea anterior, no posem el nomccomp
			if( $j != 0 && $data_cred[$j]['idccomp'] == $data_cred[$j-1]['idccomp'] ){
				printf('<tr><td>%s</td><td>%s</td><td>%s</td><td></td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td></td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>',
				$data_cred[$j]['grup'], $conv, $repeteix, $data_cred[$j]['nota1'], $data_cred[$j]['act1'], $data_cred[$j]['nota2'], $data_cred[$j]['act2'],
				$data_cred[$j]['nota3'], $data_cred[$j]['actf'], $data_cred[$j]['notaf_cc'], $data_cred[$j]['pendi'], $data_cred[$j]['nomicognoms'], $data_cred[$j]['hores_cc'], $data_cred[$j]['hores_cr']);
			}else{			
				printf('<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td></td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>',
				$data_cred[$j]['grup'], $conv, $repeteix, $data_cred[$j]['nomccomp'], $data_cred[$j]['nota1'], $data_cred[$j]['act1'], $data_cred[$j]['nota2'], $data_cred[$j]['act2'],
				$data_cred[$j]['nota3'], $data_cred[$j]['actf'], $data_cred[$j]['notaf_cc'], $data_cred[$j]['pendi'], $data_cred[$j]['nomicognoms'], $data_cred[$j]['hores_cc'], $data_cred[$j]['hores_cr']);
			}
		}
		printf('</table></div>', NULL);
  	}
#################################  	
//		TABS HISTORIAL
#################################
  	for( $z = 0; $z < $espec; $z++){
  		$idespec = $wpdb->get_row( $wpdb->prepare('SELECT DISTINCT idespecialitat FROM ricca3_alumespec_view WHERE idalumne=%s AND idestat_es=1 ', $_GET['ID']), ARRAY_A, $z);
  		$row_espec = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_alumespec_view WHERE idalumne=%s AND idespecialitat=%s', $_GET['ID'], $idespec['idespecialitat']), ARRAY_A, 0);
  		$nom = str_word_count($row_espec['nomespecialitat'], 1, 'ÀÈÒÓ');
  		printf('<div id="hist%s">', $z);
//
//	buto imprimir historial
  		printf('<form method="post" action="" target="_self" name="espec" id="imphist"><table><tr>', NULL);
  		printf('<td><a href="%s/ricca3-imphistorial/?ID=%s&espec=%s" target="POPUPW" onsubmit="POPUPW = window.open("about:blank","POPUPW","width=800,height=650" ><button type="button" title="%s">%s</button></a></td>',
  			site_url(), $_GET['ID'], $idespec['idespecialitat'], __('ajuda-historial-imprimir', 'ricca3-alum'), __('Imprimir Historial', 'ricca3-alum') );
  		printf('</tr></table></form>', NULL);
//	initzialitzem els arrays  		
  		$cursespec   = array();
  		$ciclecodi   = array();
  		$ciclecentre = array();
  		$nom_modul   = array();
  		$hores_modul = array();
  		$qual_modul  = array();
		$conv_modul  = array();
//  		
  		if(isset($_POST['accio']) && $_POST['accio'] == "actualitzar"){
  			$encoded_codi     = json_encode($_POST['cicle_codi'][$z],  JSON_FORCE_OBJECT);
  			$encoded_nom      = json_encode($_POST['cicle_nom'][$z],   JSON_FORCE_OBJECT);
  			$encoded_anyd     = json_encode($_POST['cicle_any_de'][$z],JSON_FORCE_OBJECT);
  			$encoded_anya     = json_encode($_POST['cicle_any_a'][$z], JSON_FORCE_OBJECT);
  			$encoded_curs     = json_encode($_POST['cicle_curs'][$z],  JSON_FORCE_OBJECT | JSON_UNESCAPED_UNICODE);
//		radio buttons
  			$titol="";
  			$prova="";
  			if(!isset($_POST['hist']['condic'][$z])) $_POST['hist']['condic'][$z] = "sense";
  			if(!isset($_POST['hist']['prova'][$z]))  $_POST['hist']['prova'][$z]  = "";
  			if(!isset($_POST['hist']['titol'][$z]))  $_POST['hist']['titol'][$z]  = "";
  			if($_POST['hist']['condic'][$z] == 'prova') $prova = $_POST['hist']['prova'][$z];
  			if($_POST['hist']['condic'][$z] == 'titol') $titol = $_POST['hist']['titol'][$z];
//
  			$wpdb->update('ricca3_historial' ,
  					array(  'codi_c' => $_POST['hist']['codi_c'][$z],
  							'grau_c' => $_POST['hist']['grau_c'][$z],
  							'nom_c'  => $_POST['hist']['nom_c'][$z],
  							'titol'  => $titol,
  							'prova'  => $prova,
  							'condic' => $_POST['hist']['condic'][$z],
  							'cicle_codi'   => $encoded_codi,
  							'cicle_nom'    => $encoded_nom,
  							'cicle_any_de' => $encoded_anyd,
  							'cicle_any_a'  => $encoded_anya,
  							'cicle_curs'   => $encoded_curs,
  							'obs'         => stripslashes($_POST['obs'][$z]),
  							'stampuser'   => $current_user->user_login,
  							'stampplace'  => 'ricca_shortcode_historial'
  					) ,
  					array( 'idalumne' => $_GET['ID'], 'idespecialitat' => $idespec['idespecialitat'] )
  			);
//	alumnes 
  			$data_naix=strftime("%Y-%m-%d",strtotime(str_replace('/',"-",$_POST['alumne']['FechaNac'][$z])));
  			$wpdb->update('ricca3_alumne',
  					array(	'tipusdni'      => $_POST['alumne']['tipoDNI'][$z],
  							'datanai'       => $data_naix,
  							'llocnai'       => stripslashes($_POST['alumne']['LocalidadNac'][$z]),
  							'paisnai'       => stripslashes($_POST['alumne']['PaisNac'][$z]),
  							'nacionalitat'  => stripslashes($_POST['alumne']['nacionalitat'][$z]),
  							'stampuser'     => $current_user->user_login,
  							'stampplace'    => 'ricca_shortcode_historial'
  					),
  					array(  'idalumne' => $_GET['ID'])
  			);
  		}
//
// FI ACTUALITZAR
//
  		$query_hist = $wpdb->prepare( 'SELECT * FROM ricca3_historial WHERE idalumne=%s AND idespecialitat=%s' , $_GET['ID'], $idespec['idespecialitat'] );
  		$res_hist   = $wpdb->query( $query_hist );
  		$row_h = $wpdb->get_row( $query_hist, ARRAY_A, 0);
//
//	SI NO TE HISTORIAL
//
  		if( $res_hist == 0){
  			$row = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_alumne WHERE idalumne = %s', $_GET['ID']),ARRAY_A,0);
//	comprovar el DNI i mirar si es espanyol o no
// 	comprova que el camp 'tipusdni' estigui vuid,
//		Si el primer caracter del DNI es un numero i el ultim una lletra, el marca com DNI,
//		Si el primer caracter del DNI es una lletra i el ultim una lletra, el marca com a NIE,
//		sino com a pasaport
  			if( strlen(trim($row['dni'])) == 9
  					&& (ord(trim($row['dni'])) > 47 && ord(trim($row['dni'])) < 58 )
  					&& (ord(strrev(trim($row['dni']))) > 64 )){
  				$tipodni="DNI";
  			}elseif( strlen(trim($row['dni'])) == 9
  					&& (ord(trim($row['dni'])) > 64)
  					&& (ord(strrev(trim($row['dni']))) > 64 )){
  				$tipodni="NIE";
  			}else{
  				$tipodni="Passaport";
  			}
//	si el tipus de DNI es DNI assigna 'nacionalitat' a espanyola i si ho deixa en blanc
  			$nacio = $row['nacionalitat'];
  			if($tipodni == "DNI" ) $nacio = "Espanyola";
//	canviem el lloc de naixemant de 'España' a 'Espanya'
  			$pais = $row['paisnai'];
  			if( strtolower( $pais ) == "españa") $pais = "Espanya";
// 	busquem el nom del cicle formatiu
  			$row_espec = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_especialitats WHERE idespecialitat = %s', $idespec['idespecialitat'] ),ARRAY_A,0);
//	Condicions d'acces
  			$titol = ""; $prova = "";
  			if( strtolower( $row['estudisrealitzats']) == 'batxillerat'){
  				$titol = "Batxillerat"; $condic = 'titol';
  			}else{
  				$prova = $row['estudisrealitzats']; $condic = 'prova';
  			}
//	matriculacions
  			$query = $wpdb->prepare('SELECT * FROM ricca3_alumespec_view WHERE idalumne = %s AND idespecialitat = %s ORDER BY idany ASC', $_GET['ID'], $idespec['idespecialitat'] );
  			$result = $wpdb->query( $query );
  			for( $i = 0; $i < $result; $i++){
  				$row_grup  = $wpdb->get_row( $query, ARRAY_A, $i);
  				$row_desde = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_any WHERE idany=%s', $row_grup['idany']), ARRAY_A, 0);
  				$row_cur =   $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_grups WHERE idgrup=%s', $row_grup['idgrup']), ARRAY_A, 0);
  				$row_curs  = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_cursos WHERE idcurs=%s', $row_cur['idcurs']), ARRAY_A, 0); 
  				list($anydesde[],$anyfins[]) = explode('-',$row_desde['any']);
  				$cursespec[$i] = sprintf('%s %s', mb_strtoupper($row_grup['nomespecialitat'], "utf-8"), $row_curs['curs']);
  				$ciclecodi[$i] ='08035672';
  				$ciclecentre[$i] = 'Escola Ramon i Cajal';
  			}
  			$encoded_anyd     = json_encode($anydesde,        JSON_FORCE_OBJECT);
  			$encoded_anya     = json_encode($anyfins,         JSON_FORCE_OBJECT);
  			$encoded_cursespec= json_encode($cursespec,       JSON_FORCE_OBJECT | JSON_UNESCAPED_UNICODE );
  			$encoded_ciclecodi= json_encode($ciclecodi,       JSON_FORCE_OBJECT);
  			$encoded_ciclecentre= json_encode($ciclecentre,   JSON_FORCE_OBJECT);

  			$modul='{"0":""}';
  			$wpdb->insert('ricca3_historial',
 					array(  'idalumne'         => $_GET['ID'],
  							'idespecialitat'   => $idespec['idespecialitat'],
  							'nom_c'            => $row_espec['nomespecialitat'],
  							'codi_c'           => $row_espec['codiespecialitat'],
  							'cicle_codi'       => $encoded_ciclecodi,
  							'cicle_nom'        => $encoded_ciclecentre,
  							'cicle_any_de'     => $encoded_anyd,
  							'cicle_any_a'      => $encoded_anya,
  							'cicle_curs'       => $encoded_cursespec,
  							'condic'           => $condic,
  							'titol'            => $titol,
  							'prova'            => $prova,
 							'obs'              => '',
  							'stampuser'        => $current_user->user_login,
  							'stampplace'       => 'ricca_shortcode_historial_insert'
  		
  					)
 			);
  			$wpdb->update( 'ricca3_alumne',
  					array(  'idhistorial'  => 'si',
  							'tipusdni'     => $tipodni,
  							'paisnai'      => $pais,
  							'nacionalitat' => $nacio,
  							'stampuser'    => $current_user->user_login,
  							'stampplace' => 'ricca_shortcode_historial'
  					),
  					array( 'idalumne' => $_GET['ID'] )
  			);
//
// 	FI DE 'SI NO TE HISTORIAL'
//
  		}
  		$row_h = $wpdb->get_row( $query_hist, ARRAY_A, 0);
//
//	RECALCULEM LES DADES
//
//	cerquem tots el crèdits de l'alumne

  		$dades_cred = $wpdb->get_results( $wpdb->prepare('SELECT DISTINCT  ricca3_credits.idcredit ,ricca3_credits.ordre_cr '.
				'FROM ricca.ricca3_credits_avaluacions '.
				'INNER JOIN ricca3_ccomp ON ricca3_ccomp.idccomp = ricca3_credits_avaluacions.idccomp '.
				'INNER JOIN ricca3_credits ON ricca3_credits.idcredit = ricca3_ccomp.idcredit '.
				'WHERE idalumne=%s AND ricca3_credits.idespecialitat=%s '.
				'ORDER BY ricca3_credits.ordre_cr', $_GET['ID'], $idespec['idespecialitat'] ), ARRAY_A);
//	mirem si l'alumne te resultats del crèdit
		for( $j = 0; $j < count($dades_cred); $j++ ){
			$dades_ccomp = $wpdb->get_results( $wpdb->prepare('SELECT * FROM ricca3_credits_avaluacions '.
  				'INNER JOIN ricca3_ccomp ON ricca3_ccomp.idccomp=ricca3_credits_avaluacions.idccomp '.
  				'INNER JOIN ricca3_credits ON ricca3_credits.idcredit = ricca3_ccomp.idcredit '.
  				'INNER JOIN ricca3_especialitats ON ricca3_especialitats.idespecialitat = ricca3_credits.idespecialitat '.
  				'INNER JOIN ricca3_grups ON ricca3_grups.idgrup = ricca3_ccomp.idgrup '.
  				'INNER JOIN ricca3_any ON ricca3_any.idany = ricca3_credits_avaluacions.idany '.
  				'INNER JOIN ricca3_professors ON ricca3_professors.idprof = ricca3_ccomp.idprofessor '.
  				'WHERE idalumne=%s AND ricca3_credits.idespecialitat=%s AND ricca3_credits.idcredit=%s '.
  				'ORDER BY ordre_cr, ricca3_credits_avaluacions.idccomp, ricca3_credits_avaluacions.idany DESC', 
					$_GET['ID'], $idespec['idespecialitat'], $dades_cred[$j]['idcredit']), ARRAY_A);
			$nom_modul[$j]   = $dades_ccomp[0]['nomcredit'];
			$hores_modul[$j] = $dades_ccomp[0]['hores_cr'];
			$qual_modul[$j]  = $dades_ccomp[0]['notaf_cr'];
			$conv_modul[$j]  = $dades_ccomp[0]['convord'];		
		}
// nota final
	  	$notafinal = "";
		$query = $wpdb->prepare('SELECT * FROM ricca3_alumespec_view WHERE idalumne = %s AND idespecialitat = %s ORDER BY idany DESC',
				$_GET['ID'],$idespec['idespecialitat']);
		$result = $wpdb->query( $query );
		if($result > 0){
			$row = $wpdb->get_row( $query, ARRAY_A, 0);
			if($row['notaf_es'] != 0){
				$notafinal = $row['notaf_es'];
			}else{
				$notafinal='';
			}
// si hem introduit la nota final a mà, fer-la servir.			
			if($row['notaf_es_manual'] != 0) $notafinal = $row['notaf_es_manual'];
		}
//
//	FI RECALCULEM LES DADES
//  		
  		$row   = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_alumne WHERE idalumne=%s', $_GET['ID']), ARRAY_A, 0);
  		printf('<form method="post" action="" target="_self" name="hist" id="hist"><table><tr><td><b>%s</b></td></tr></table>',
  			__('DADES DEL ALUMNE','ricca3-alum'));
  		printf('<table><tr><td><b>%s</b></td><td>%s</td>', 
  			__('Cognoms i nom','ricca3-alum'), $row['cognomsinom']);
  		printf('<td><b>%s</b></td><td>%s</td></tr></table>', 
  			__('Núm. d\'identificació','ricca3-alum'), $_GET['ID']);
  		printf('<table><tr><td title="%s"><b>%s</b></td><td><INPUT type="text" name="alumne[tipoDNI][%s]" size="10" maxlength="15" value="%s" ></td>',
  			 __('ajuda-historial-tipusdni','ricca3-alum'), __('Document d\'indentificació','ricca3-alum'), $z, $row['tipusdni'] );
  		printf('<td><b>%s</b></td><td>%s</td></tr></table>',
  			__('Número','ricca3-alum'), $row['dni']);
  		printf('<table><tr><td  title="%s"><b>%s</b></td><td><INPUT type="text" name="alumne[FechaNac][%s]" size="15" maxlength="15" value="%s"></td>',
  			__('ajuda-historial-datanai','ricca3-alum'), __('Data de neixament','ricca3-alum'), $z, date('d/m/Y',strtotime($row['datanai'])) );
  		printf('<td title="%s"><b>%s</b></td><td><INPUT type="text" name="alumne[LocalidadNac][%s]" size="25" maxlength="35" value="%s" \></td></tr></table>',
  			__('ajuda-historial-llocnai','ricca3-alum'), __('Lloc de neixament','ricca3-alum'), $z, $row['llocnai'] );
  		printf('<table><tr><td title="%s"><b>%s</b></td><td><INPUT type="text" name="alumne[PaisNac][%s]" size="15" maxlength="25" value="%s" \></td>',
  			__('ajuda-historial-paisnai','ricca3-alum'), __('País','ricca3-alum'), $z, $row['paisnai'] );
  		printf('<td title="%s"><b>%s</b></td><td><INPUT type="text" name="alumne[nacionalitat][%s]" size="15" maxlength="25" value="%s" ></td></tr></table>',
  			__('ajuda-historial-nacionalitat','ricca3-alum'), __('Nacionalitat','ricca3-alum'), $z, $row['nacionalitat'] );
  		printf('<hr /><table><tr><td><b>%s</b></td></tr></table>',
  			__('DADES ACADÈMIQUES','ricca3-alum'));
  		printf('<table><tr><td title="%s"><b>%s</b></td><td><INPUT type="text" name="hist[codi_c][%s]" size="6" maxlength="15" value="%s" /></td>',
  			__('ajuda-historial-codidades','ricca3-alum'), __('Codi','ricca3-alum'), $z, $row_h['codi_c'] );
  		printf('<td title="%s"><b>%s</b></td><td><INPUT type="text" name="hist[nom_c][%s]" size="35" maxlength="65" value="%s" /></td>',
  			__('ajuda-historial-nomcicle','ricca3-alum'), __('Nom del cicle formatiu','ricca3-alum'), $z, $row_h['nom_c'] );
  		printf('<td title="%s"><b>%s</b></td><td><INPUT type="text" name="hist[grau_c][%s]" size="10" maxlength="15" value="%s" /></td></tr></table>',
  			__('ajuda-historial-graucicle','ricca3-alum'), __('Grau','ricca3-alum'), $z, $row_h['grau_c'] );
  		printf('<hr />', NULL);
  		ricca3_desar_color('accio', 'actualitzar', __('ajuda-historial-desar', 'ricca3-alum'));
  		printf('<hr /><table><tr><td><b>%s</b></td></tr></table>',
  			__('CONDICIONS D\'ACCÉS','ricca3-alum'));
  		printf('<table><tr><td title="%s"> <INPUT type="radio" name="hist[condic][%s]" value="titol" ', 
  			__('ajuda-historial-radiotitol', 'ricca3-alum'), $z);
  		if($row_h['condic'] == 'titol')printf('checked', NULL);
  		printf(' /><b>%s</b></td>',__('Títol de:','ricca3-alum'));
  		printf('<td title="%s"><INPUT type="text" name="hist[titol][%s]" size="20" maxlength="35" value="%s" \></td>', 
  			__('ajuda-historial-titolde', 'ricca3-alum'), $z, $row_h['titol'] );
		printf('<td title="%s"><INPUT type="radio" name="hist[condic][%s]" value="prova" ', 
			__('ajuda-historial-radioprova', 'ricca3-alum'), $z);
  		if($row_h['condic'] == 'prova')printf('checked', NULL);
  		printf(' /><b>%s</b></td>',__('Prova d\'accés a:','ricca3-alum'));
		printf('<td  title="%s"><INPUT type="text" name="hist[prova][%s]" size="20" maxlength="35" value="%s" \></td>',
  			__('ajuda-historial-provaa', 'ricca3-alum'), $z, $row_h['prova'] );
  		printf('<td title="%s"><INPUT type="radio" name="hist[condic][%s]" value="sense" ', 
  			__('ajuda-historial-radiosense', 'ricca3-alum'), $z );
  		if($row_h['condic'] == 'sense') printf('checked', NULL);
  		printf(' /><b>%s</b></td></tr></table>',
  			__('Sense requisits, amb autorització:','ricca3-alum'));
  		printf('<hr /><table><tr><td><b>%s</b></td></tr></table>',
  			__('MATRICULACIONS EN EL CICLE FORMATIU','ricca3-alum'));
  		printf('<table><tr><td title="%s"><b>%s</b></td>',
  			__('ajuda-hist-codidelcentre','ricca3-alum'), __('Codi de centre','ricca3-alum'));
  		printf('<td title="%s"><b>%s</b></td>',
  			__('ajuda-hist-cnomdelcentre','ricca3-alum'), __('Nom del centre','ricca3-alum'));
  		printf('<td title="%s"><b>%s</b></td></tr>',
  			__('ajuda-hist-anycicle','ricca3-alum'), __('Anys acadèmics','ricca3-alum'));
  		$decoded_codi = json_decode($row_h['cicle_codi'], true);
  		$decoded_nom  = json_decode($row_h['cicle_nom'], true);
  		$decoded_anyd = json_decode($row_h['cicle_any_de'], true);
  		$decoded_anya = json_decode($row_h['cicle_any_a'], true);
  		$decoded_curs = json_decode($row_h['cicle_curs'], true);
  		for( $i = 0; $i < 5; $i++){
  			if(count($decoded_codi) > $i){
				printf('<tr>                      <td><INPUT type="text" name="cicle_codi[%s][]"   size="8"  maxlength="15" value="%s" title="%s" ></td>',
					$z, $decoded_codi[$i], __('ajuda-historial-codicentre', 'ricca3-alum'));
				printf('                          <td><INPUT type="text" name="cicle_nom[%s][]"    size="20" maxlength="45" value="%s" title="%s" ></td>',
					$z, $decoded_nom[$i], __('ajuda-historial-nomcentre', 'ricca3-alum'));
				printf('<td><table><tr><td>de</td><td><INPUT type="text" name="cicle_any_de[%s][]" size="8"  maxlength="15" value="%s" title="%s" ></td>',
					$z, $decoded_anyd[$i], __('ajuda-historial-anydesde', 'ricca3-alum'));
				printf('                <td>a</td><td><INPUT type="text" name="cicle_any_a[%s][]"  size="8"  maxlength="15" value="%s" title="%s" ></td>',
					$z, $decoded_anya[$i], __('ajuda-historial-anyfins', 'ricca3-alum'));
				printf('                          <td><INPUT type="text" name="cicle_curs[%s][]"   size="45" maxlength="75" value="%s" title="%s" ></td></tr></table>',
					$z, $decoded_curs[$i], __('ajuda-historial-nomcurs', 'ricca3-alum'));
			}else{
				printf('<tr>                      <td><INPUT type="text" name="cicle_codi[%s][]" size="8" maxlength="15" value="" title="%s" ></td>',
					$z, __('ajuda-historial-codicentre', 'ricca3-alum'));
				printf('                          <td><INPUT type="text" name="cicle_nom[%s][]" size="20" maxlength="45" value="" title="%s" ></td>',
					$z, __('ajuda-historial-nomcentre', 'ricca3-alum'));
				printf('<td><table><tr><td>de</td><td><INPUT type="text" name="cicle_any_de[%s][]" size="8" maxlength="15" value="" title="%s" ></td>',
					$z, __('ajuda-historial-anydesde', 'ricca3-alum'));
				printf('                <td>a</td><td><INPUT type="text" name="cicle_any_a[%s][]" size="8" maxlength="15" value="" title="%s" ></td>',
					$z, __('ajuda-historial-anyfins', 'ricca3-alum'));
				printf('                          <td><INPUT type="text" name="cicle_curs[%s][]" size="45" maxlength="75" value="" title="%s" ></td></tr></table>',
					$z, __('ajuda-historial-nomcurs', 'ricca3-alum'));
			}
  		}
  		printf('</table>', NULL);
  		printf('<hr />', NULL);
  		ricca3_desar_color('accio', 'actualitzar', __('ajuda-historial-desar', 'ricca3-alum'));
  		printf('<hr /><table><tr><td><b>%s</b></td></tr></table>', __('QUALIFICACIONS','ricca3-alum'));
  		printf('<table><tr><th title="%s">%s</th><th title="%s">%s</th><th title="%s">%s</th><th title="%s">%s</th></tr>',
  			__('ajuda-hist-nomcredit','ricca3-alum'),   __('Crèdit','ricca3-alum'), 
  			__('ajuda-hist-horescredit','ricca3-alum'), __('Hores','ricca3-alum'), 
  			__('ajuda-hist-qualcredit','ricca3-alum'),  __('Qualif.','ricca3-alum'),
  			__('ajuda-hist-convcredit','ricca3-alum'),  __('Conv.','ricca3-alum'));
    		for( $y = 0; $y < 20; $y++){
			if(isset($nom_modul[$y]) && strlen( $nom_modul[$y]) > 5){
				printf('<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>',
				$nom_modul[$y], $hores_modul[$y], $qual_modul[$y], $conv_modul[$y]);  					
			}
  		}
  		printf('</table><hr /><table><tr><td><b>%s</b></td><td>%s</td></tr></table>', 
  			__('Qualificació final del cicle formatiu','ricca3-alum'), $notafinal);
  		printf('');
  		printf('<hr /><table><tr><td><b>%s</b></td></tr></table>', __('OBSERVACIONS','ricca3-alum')); 
  		printf('<table><tr><td title="%s"><INPUT type="text" name="obs[%s]" size="180" maxlength="225" value="%s" ></td></tr></table>', 
  			__('ajuda-historial-observacions', 'ricca3-alum'), $z, $row_h['obs'] );
  		printf('<table class="opcions"><tr><td class="opcions"><input type="hidden" name="ID" value="%s"><input type="hidden" name="espec[%s]" value="%s"></tr></td></table>', 
  			$_GET['ID'], $z, $idespec['idespecialitat'] );
  		ricca3_desar_color('accio', 'actualitzar', __('ajuda-historial-desar', 'ricca3-alum'));
//
		printf('</form>', NULL);
  		printf('</div>', NULL);
  	}
	printf('</div>', NULL);
#############################################
// 	navegació endevant i enrere
#############################################
	if(isset($_GET['grup']) && $_GET['grup'] != '-1'){
		$query= $wpdb->prepare('SELECT * FROM ricca3_alumespec_view WHERE idgrup=%s AND idany=%s AND idestat_es=1 ', 
				$_GET['grup'], $_GET['any']);
		$dades = $wpdb->get_results( $query, ARRAY_A );
		for( $i=0; $i < count($dades); $i++){
			if( $dades[$i]['idalumne'] == $_GET['ID']){
				$ara = $i;
				$despr = $i + 1;
				$abans = $i - 1;
				if( $despr > count($dades) - 1) $despr = 0;
				if( $abans  == -1) $abans = count($dades) - 1 ;
				$row_abans = $wpdb->get_row( $query, ARRAY_A, $abans);
				$row_despr = $wpdb->get_row( $query, ARRAY_A, $despr);
				printf('<table width="100%%"><tr><td align="left"> <a href="%s/%s?ID=%s&espec=%s&grup=%s&any=%s&estat=%s&repe=%s"><img src="%s/ricca3/imatges/ricca3-anterior.png" border=0 title="%s" /></a></td>',
					site_url(), 'ricca3-especalum', $row_abans['idalumne'],$_GET['espec'], $_GET['grup'], $_GET['any'], $_GET['estat'], $_GET['repe'], WP_PLUGIN_URL, __('ajuda-especalum-anterior', 'ricca3-alum'));
				printf('                         <td align="right"><a href="%s/%s?ID=%s&espec=%s&grup=%s&any=%s&estat=%s&repe=%s"><img src="%s/ricca3/imatges/ricca3-seguent.png"  border=0 title="%s" /></a></td></tr></table>',
					site_url(), 'ricca3-especalum', $row_despr['idalumne'],$_GET['espec'], $_GET['grup'], $_GET['any'], $_GET['estat'], $_GET['repe'], WP_PLUGIN_URL, __('ajuda-especalum-seguent', 'ricca3-alum'));
				
			}
		}
	}
}

#############################################################################################
/**
 * Impressió Historial
 * shortcode: [ricca3-imphistorial]
 *
 * @since ricca3.v.2013.17.1
 * @author Efraim Bayarri
 */
#############################################################################################
function ricca3_shortcode_imphistorial($atts, $content = null) {
	global $wpdb;
	$row_alum = $wpdb->get_row( $wpdb->prepare( 'SELECT * FROM ricca3_alumne WHERE idalumne=%s',    $_GET['ID']), ARRAY_A, 0);
	$row      = $wpdb->get_row( $wpdb->prepare( 'SELECT * FROM ricca3_historial WHERE idalumne=%s AND idespecialitat=%s', $_GET['ID'], $_GET['espec']), ARRAY_A, 0);
//		logo
	printf('<table class="cap"><tr><td><IMG SRC="%s/ricca3/imatges/ricca3-logo.jpg" ALIGN=left><IMG SRC="%s/ricca3/imatges/ricca3-adreca.png" ALIGN=left></td></tr></table><br />', WP_PLUGIN_URL, WP_PLUGIN_URL );
//		historial acadèmic
	printf('<table class="cap"><tr><td width="340px" class="gran"> <b>%s</b></td><td width="340px" class="dereta"><b>%s</b></td></tr>',
	__('Historial acadèmic de l\'alumne/a','ricca3-alum'), __('Formació professional inicial','ricca3-alum'));
	printf('                   <tr class="linea"><td colspan="2" width="680px" class="petit"><IMG SRC="%s/ricca3/imatges/ricca3-linea-ampla.png"></td></tr>', WP_PLUGIN_URL);
	printf('                   <tr>              <td colspan="2">&nbsp;</td></tr></table>', NULL);
//		dades del centre
	printf('<table class="cap"><tr><td width="680px" colspan="3"><b>%s</b></td></tr>',
	__('Dades del centre','ricca3-alum') );
	printf('                   <tr class="linea"><td colspan="3" width="680px"  class="petit"><IMG SRC="%s/ricca3/imatges/ricca3-linea-mitja.png"></td></tr>', WP_PLUGIN_URL);
	printf('                   <tr>              <td width="230px">%s</td><td width="230px">%s</td><td width="230px">%s</td></tr>',
	__('Nom','ricca3-alum'), __('Codi','ricca3-alum'), __('Municipi','ricca3-alum') );
	printf('<tr><td class="gran">%s</td><td class="gran">%s</td><td class="gran">%s</td></tr>',
	__('Escola Ramon i Cajal','ricca3-alum'), __('08035672','ricca3-alum'), __('Barcelona','ricca3-alum'));
	printf('                   <tr class="linea"><td width="680px" colspan="3" class="petit"><IMG SRC="%s/ricca3/imatges/ricca3-linea-mitja.png"></td></tr>', WP_PLUGIN_URL);
	printf('<tr><td>&nbsp;</td></tr></table>', NULL);
//		dades del alumne
	printf('<table class="cap"><tr><td width="680px" colspan="4"><b>%s</b></td></tr>',
	__('Dades de l\'alumne','ricca3-alum') );
	printf('                   <tr class="linea"><td colspan="4" width="680px" class="petit"><IMG SRC="%s/ricca3/imatges/ricca3-linea-mitja.png"></td></tr>', WP_PLUGIN_URL);
	printf('                   <tr><td width="520px" colspan="3">%s</td><td width="160px">%s</td></tr>',
	__('Cognoms i nom','ricca3-alum'), __('Núm. d\'identificació','ricca3-alum') );
	printf('<tr><td colspan="3" class="gran">%s</td><td class="gran">%s</td></tr>',
	$row_alum['cognomsinom'], $row_alum['idalumne'] );
	printf('                   <tr class="linea"><td colspan="4" width="680px" class="petit"><IMG SRC="%s/ricca3/imatges/ricca3-linea-estreta.png"></td></tr>', WP_PLUGIN_URL);
	printf('                   <tr><td width="200px">%s</td><td width="480px" colspan="3">%s</td></tr>',
	__('Document d\'identificació','ricca3-alum'), __('Número','ricca3-alum') );
	printf('<tr><td class="gran">%s</td><td colspan="3" class="gran">%s</td></tr>',
	$row_alum['tipusdni'], $row_alum['dni']);
	printf('                   <tr class="linea"><td colspan="4" width="680px" class="petit"><IMG SRC="%s/ricca3/imatges/ricca3-linea-estreta.png"></td></tr>', WP_PLUGIN_URL);
	printf('                   <tr><td width="200px">%s</td><td width="160px">%s</td><td width="160px">%s</td><td width="170px">%s</td></tr>',
	__('Data de naixement','ricca3-alum'), __('Lloc de naixement','ricca3-alum'), __('País','ricca3-alum'), __('Nacionalitat','ricca3-alum') );
	printf('<tr><td class="gran">%s</td><td class="gran">%s</td><td class="gran">%s</td><td class="gran">%s</td></tr>',
	date( 'd/m/Y' , strtotime( $row_alum['datanai'] ) ), $row_alum['llocnai'], $row_alum['paisnai'], $row_alum['nacionalitat'] );
	printf('                   <tr class="linea"><td colspan="4" width="680px" class="petit"><IMG SRC="%s/ricca3/imatges/ricca3-linea-mitja.png"></td></tr>', WP_PLUGIN_URL);
	printf('<tr><td width="680px" colspan="4">&nbsp;</td></tr></table>', NULL);
//		dades acadèmiques
	printf('<table class="cap"><tr><td width="680px" colspan="4"><b>%s</b></td></tr>',
	__('Dades acadèmiques','ricca3-alum') );
	printf('                   <tr class="linea"><td colspan="4" width="680px" class="petit"><IMG SRC="%s/ricca3/imatges/ricca3-linea-mitja.png"></td></tr>', WP_PLUGIN_URL);
	printf('                   <tr><td width="100px">%s</td><td width="480px" colspan="2">%s</td><td width="100px">%s</td></tr>',
	__('Codi','ricca3-alum'), __('Nom del cicle formatiu','ricca3-alum'), __('Grau','ricca3-alum') );
	printf('<tr><td class="gran">%s</td><td class="gran" colspan="2">%s</td><td class="gran">%s</td></tr>',
	$row['codi_c'], $row['nom_c'], __('SUPERIOR','ricca3-alum') );
	printf('                   <tr class="linea"><td colspan="4" width="680px" class="petit"><IMG SRC="%s/ricca3/imatges/ricca3-linea-estreta.png"></td></tr>', WP_PLUGIN_URL);
	printf('<tr><td width="680px" colspan="4">&nbsp;</td></tr></table>', NULL);	// dades
//		condicions d'accès
	printf('<table class="cap"><tr><td width="680px" colspan="3"><b>%s</b></td></tr>',
	__('Condicions d\'accés','ricca3-alum') );
	printf('                   <tr class="linea"><td colspan="3" width="680px" class="petit"><IMG SRC="%s/ricca3/imatges/ricca3-linea-estreta.png"></td></tr>', WP_PLUGIN_URL);
	if( $row['condic'] == 'titol' ){
		printf('<tr><td width="230px">%s</td><td width="230px">%s</td><td width="230px">%s</td></tr>',
		__('[x] Títol de:','ricca3-alum'), __('Prova d\'accés a:','ricca3-alum'), __('Sense requisits amb autorització','ricca3-alum') );
		printf('<tr><td class="gran">%s</td><td class="gran">%s</td><td class="gran">%s</td></tr>',
		$row['titol'], __(' ', 'ricca3-alum'), __(' ', 'ricca3-alum'));
	}elseif( $row['condic'] == 'prova' ){
		printf('<tr><td width="230px">%s</td><td width="230px">%s</td><td width="230px">%s</td></tr>',
		__('Títol de:','ricca3-alum'), __('[x] Prova d\'accés a:','ricca3-alum'), __('Sense requisits amb autorització','ricca3-alum') );
		printf('<tr><td class="gran">%s</td><td class="gran">%s</td><td class="gran">%s</td></tr>',
		__(' ', 'ricca3-alum'), $row['prova'],  __(' ', 'ricca3-alum'));
	}else{
		printf('<tr><td width="230px">%s</td><td width="230px">%s</td><td width="230px">%s</td></tr>',
		__('Títol de:','ricca3-alum'), __('Prova d\'accés a:','ricca3-alum'), __('[x] Sense requisits amb autorització','ricca3-alum') );
		printf('<tr><td class="gran">%s</td><td class="gran">%s</td><td class="gran">%s</td></tr>',
		__(' ', 'ricca3-alum'), __(' ', 'ricca3-alum'),  __(' ', 'ricca3-alum'));
	}
	printf('                   <tr class="linea"><td colspan="3" width="680px" class="petit"><IMG SRC="%s/ricca3/imatges/ricca3-linea-mitja.png"></td></tr>', WP_PLUGIN_URL);
	printf('<tr><td width="680px" colspan="3">&nbsp;</td></tr></table>', NULL);
//		Matriculacions
	$decoded_codi = json_decode($row['cicle_codi'], true);
	$decoded_nom  = json_decode($row['cicle_nom'], true);
	$decoded_anyd = json_decode($row['cicle_any_de'], true);
	$decoded_anya = json_decode($row['cicle_any_a'], true);
	$decoded_curs = json_decode($row['cicle_curs'], true);

	printf('<table class="cap"><tr><td width="320px" colspan="7"><b>%s</b></td></tr>',
	__('Matriculacions en el cicle formatiu','ricca3-alum') );
	printf('                   <tr class="linea"><td colspan="7" width="680px" class="petit"><IMG SRC="%s/ricca3/imatges/ricca3-linea-mitja.png"></td></tr>', WP_PLUGIN_URL);
	printf('                   <tr><td width="100px">%s</td><td width="180px">%s</td><td width="250px">&nbsp;</td><td width="20px" colspan="4">%s</td></tr>',
	__('Codi del centre','ricca3-alum'), __('Nom del centre','ricca3-alum'), __('Anys acadèmics','ricca3-alum'));
	printf('                   <tr><td colspan="7" width="680px" class="petit"><IMG SRC="%s/ricca3/imatges/ricca3-linea-estreta.png"></td></tr>', WP_PLUGIN_URL);
	if( isset( $decoded_curs[0])){
		printf('<tr><td class="gran">%s</td><td class="gran">%s</td><td class="gran">%s</td><td>%s</td>             <td class="gran">%s</td><td>%s</td>          <td class="gran">%s</td></tr> ',
		$decoded_codi[0],        $decoded_nom[0],       $decoded_curs[0],     __('de','ricca3-alum'), $decoded_anyd[0],       __('a','ricca3-alum'), $decoded_anya[0] );
	}else{
		printf('<tr><td></td><td></td><td></td><td>%s</td><td></td><td>%s</td><td></td>', __('de','ricca3-alum'), __('a','ricca3-alum') );
	}
	if( isset( $decoded_curs[1])){
		printf('<tr><td class="gran">%s</td><td class="gran">%s</td><td class="gran">%s</td><td>%s</td>             <td class="gran">%s</td><td>%s</td>          <td class="gran">%s</td></tr> ',
		$decoded_codi[1],        $decoded_nom[1],       $decoded_curs[1],     __('de','ricca3-alum'), $decoded_anyd[1],       __('a','ricca3-alum'), $decoded_anya[1] );
	}else{
		printf('<tr><td></td><td></td><td></td><td>%s</td><td></td><td>%s</td><td></td>', __('de','ricca3-alum'), __('a','ricca3-alum') );
	}
	if( isset( $decoded_curs[2])){
		printf('<tr><td class="gran">%s</td><td class="gran">%s</td><td class="gran">%s</td><td>%s</td>             <td class="gran">%s</td><td>%s</td>          <td class="gran">%s</td></tr> ',
		$decoded_codi[2],        $decoded_nom[2],       $decoded_curs[2],     __('de','ricca3-alum'), $decoded_anyd[2],       __('a','ricca3-alum'), $decoded_anya[2] );
	}else{
		printf('<tr><td></td><td></td><td></td><td>%s</td><td></td><td>%s</td><td></td>', __('de','ricca3-alum'), __('a','ricca3-alum') );
	}
	if( isset( $decoded_curs[3])){
		printf('<tr><td class="gran">%s</td><td class="gran">%s</td><td class="gran">%s</td><td>%s</td>             <td class="gran">%s</td><td>%s</td>          <td class="gran">%s</td></tr> ',
		$decoded_codi[3],        $decoded_nom[3],       $decoded_curs[3],     __('de','ricca3-alum'), $decoded_anyd[3],       __('a','ricca3-alum'), $decoded_anya[3] );
	}else{
		printf('<tr><td></td><td></td><td></td><td>%s</td><td></td><td>%s</td><td></td>', __('de','ricca3-alum'), __('a','ricca3-alum') );
	}
	if( isset( $decoded_curs[4])){
		printf('<tr><td class="gran">%s</td><td class="gran">%s</td><td class="gran">%s</td><td>%s</td>             <td class="gran">%s</td><td>%s</td>          <td class="gran">%s</td></tr> ',
		$decoded_codi[4],        $decoded_nom[4],       $decoded_curs[3],     __('de','ricca3-alum'), $decoded_anyd[4],       __('a','ricca3-alum'), $decoded_anya[4] );
	}else{
		printf('<tr><td></td><td></td><td></td><td>%s</td><td></td><td>%s</td><td></td></table>', __('de','ricca3-alum'), __('a','ricca3-alum') );
	}
//		espai en blanc
	printf('<br /><br /><br /><br /><br />', NULL);
//		peu de pàgina
	printf('<table class="cap"><tr class="linea"><td colspan="3" width="680px" class="petit"><IMG SRC="%s/ricca3/imatges/ricca3-linea-mitja.png"></td></tr>', WP_PLUGIN_URL);
	printf('                   <tr><td width="230px">%s</td><td width="230px">%s</td><td width="230px">%s</td></tr>',
	__('Signatura del secretari','ricca3-alum'), __('Segell del centre','ricca3-alum'), __('Vist i plau de la directora','ricca3-alum') );
	printf('                   <tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr>', NULL);
	printf('                   <tr><td width="230px">%s</td><td width="230px"></td><td width="230px">%s</td></tr>',
	__('Nom i cognoms','ricca3-alum'), __('Nom i cognoms','ricca3-alum') );
	printf('                   <tr><td width="230px">%s</td><td width="230px"></td><td width="230px">%s</td></tr>',
	__('Carlos Aylagas Molero','ricca3-alum'), __('Teresa Llirinós Sopena','ricca3-alum') );
	printf('                   <tr class="linea"><td colspan="3" width="680px" class="petit"><IMG SRC="%s/ricca3/imatges/ricca3-linea-mitja.png"></td></tr></table>', WP_PLUGIN_URL);
	printf('<table style="page-break-after: always;"><tr><td class="dereta" width="680px">%s</td></tr></table>', __('___/___', 'ricca3-alum'));
//
//		SEGONA PÀGINA
//
	printf('<table class="cap"> <tr><td><IMG SRC="%s/ricca3/imatges/ricca3-logo.jpg" ALIGN=left><IMG SRC="%s/ricca3/imatges/ricca3-adreca.png" ALIGN=left></td></tr></table><br />', WP_PLUGIN_URL, WP_PLUGIN_URL );
	printf('<table class="cap"><tr><td width="680px" colspan="3" class="gran"><b>%s</b></td></tr>',
	__('Historial acadèmic','ricca3-alum') );
	printf('                   <tr><td width="460px" colspan="2"><b>%s</b></td><td width="230px" class="dereta"><b>%s</b></td>',
	__('Resultats de l\'avaluació dels crèdits','ricca3-alum'), __('Formació professional inicial','ricca3-alum') );
	printf('                   <tr class="linea"><td colspan="3" width="680px" class="petit"><IMG SRC="%s/ricca3/imatges/ricca3-linea-mitja.png"></td></tr></table>', WP_PLUGIN_URL);
//		dades del alumne
	printf('<table class="cap"><tr><td width="230px" colspan="3"><b>%s</b></td></tr>',
	__('Dades de l\'alumne/a','ricca3-alum') );
	printf('                   <tr class="linea"><td colspan="3" width="680px" class="petit"><IMG SRC="%s/ricca3/imatges/ricca3-linea-mitja.png"></td></tr>', WP_PLUGIN_URL);
	printf('                   <tr><td width="340px">%s</td><td width="170px">%s</td><td width="170px">%s</td></tr>',
	__('Cognoms i nom','ricca3-alum'),__('DNI/NIE/passaport','ricca3-alum'), __('Núm. d\'identificació','ricca3-alum') );
	printf('<tr><td class="gran">%s</td><td class="gran">%s</td><td class="gran">%s</td></tr>',
	$row_alum['cognomsinom'], $row_alum['dni'], $row_alum['idalumne'] );
	printf('                   <tr class="linea"><td colspan="3" width="680px" class="petit"><IMG SRC="%s/ricca3/imatges/ricca3-linea-mitja.png"></td></tr></table>', WP_PLUGIN_URL);
//		dades acadèmiques
	printf('<table class="cap"><tr><td width="680px" colspan="4"><b>%s</b></td></tr>',
	__('Dades acadèmiques','ricca3-alum') );
	printf('                   <tr class="linea"><td colspan="4" width="680px" class="petit"><IMG SRC="%s/ricca3/imatges/ricca3-linea-mitja.png"></td></tr>', WP_PLUGIN_URL);
	printf('                   <tr><td width="100px">%s</td><td width="480px" colspan="2">%s</td><td width="100px">%s</td></tr>',
	__('Codi','ricca3-alum'), __('Nom del cicle formatiu','ricca3-alum'), __('Grau','ricca3-alum') );
	printf('<tr><td class="gran">%s</td><td class="gran" colspan="2">%s</td><td class="gran">%s</td></tr>',
	$row['codi_c'], $row['nom_c'], __('SUPERIOR','ricca3-alum') );
	printf('                   <tr class="linea"><td colspan="4" width="680px" class="petit"><IMG SRC="%s/ricca3/imatges/ricca3-linea-mitja.png"></td></tr></table>', WP_PLUGIN_URL);
//		qualificacions
	printf('<table class="cap"><tr><td width="680px" colspan="4"><b>%s</b></td></tr>', __('Qualificacions','ricca3-alum'));
	printf('                   <tr class="linea"><td colspan="4" width="680px" class="petit"><IMG SRC="%s/ricca3/imatges/ricca3-linea-mitja.png"></td></tr>', WP_PLUGIN_URL);
	printf('                   <tr><td width="380px">%s</td><td width="100px">%s</td><td width="100px">%s</td><td width="100px">%s</td></tr>',
	__('Crèdit','ricca3-alum'), __('Hores','ricca3-alum'), __('Convocatoria','ricca3-alum'), __('Qualificació','ricca3-alum') );
	printf('                   <tr class="linea"><td colspan="4" width="680px" class="petit"><IMG SRC="%s/ricca3/imatges/ricca3-linea-estreta.png"></td></tr>', WP_PLUGIN_URL);
//		entrada qualificacions
	$dades_cred = $wpdb->get_results( $wpdb->prepare('SELECT DISTINCT  ricca3_credits.idcredit ,ricca3_credits.ordre_cr '.
			'FROM ricca.ricca3_credits_avaluacions '.
			'INNER JOIN ricca3_ccomp ON ricca3_ccomp.idccomp = ricca3_credits_avaluacions.idccomp '.
			'INNER JOIN ricca3_credits ON ricca3_credits.idcredit = ricca3_ccomp.idcredit '.
			'WHERE idalumne=%s AND ricca3_credits.idespecialitat=%s '.
			'ORDER BY ricca3_credits.ordre_cr', $_GET['ID'], $_GET['espec'] ), ARRAY_A);
	for( $i = 0; $i < count($dades_cred); $i++ ){
		$dades_ccomp = $wpdb->get_results( $wpdb->prepare('SELECT * FROM ricca3_credits_avaluacions '.
				'INNER JOIN ricca3_ccomp ON ricca3_ccomp.idccomp=ricca3_credits_avaluacions.idccomp '.
				'INNER JOIN ricca3_credits ON ricca3_credits.idcredit = ricca3_ccomp.idcredit '.
				'INNER JOIN ricca3_especialitats ON ricca3_especialitats.idespecialitat = ricca3_credits.idespecialitat '.
				'INNER JOIN ricca3_grups ON ricca3_grups.idgrup = ricca3_ccomp.idgrup '.
				'INNER JOIN ricca3_any ON ricca3_any.idany = ricca3_credits_avaluacions.idany '.
				'INNER JOIN ricca3_professors ON ricca3_professors.idprof = ricca3_ccomp.idprofessor '.
				'WHERE idalumne=%s AND ricca3_credits.idespecialitat=%s AND ricca3_credits.idcredit=%s '.
				'ORDER BY ordre_cr, ricca3_credits_avaluacions.idccomp, ricca3_credits_avaluacions.idany DESC',
				$_GET['ID'], $_GET['espec'], $dades_cred[$i]['idcredit']), ARRAY_A);
		printf('<tr><td width="380px">%s</td><td width="100px">%s</td><td width="100px">%s</td><td width="100px">%s</td></tr>',
					$dades_ccomp[0]['nomcredit'], $dades_ccomp[0]['hores_cr'], $dades_ccomp[0]['convord'], $dades_ccomp[0]['notaf_cr'] );
	}	
	for( $j = $i; $j < 25; $j++ ){
		printf('<tr><td width="680px" colspan="4">&nbsp;</td></tr>', NULL );
	}
	printf('</table>', NULL);
//		peu de pàgina
	printf('<table class="cap"><tr class="linea"><td colspan="3" width="680px" class="petit"><IMG SRC="%s/ricca3/imatges/ricca3-linea-mitja.png"></td></tr>', WP_PLUGIN_URL);
	printf('                   <tr><td width="230px">%s</td><td width="230px">%s</td><td width="230px">%s</td></tr>',
	__('Signatura del secretari','ricca3-alum'), __('Segell del centre','ricca3-alum'), __('Vist i plau de la directora','ricca3-alum') );
	printf('                   <tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr>', NULL);
	printf('                   <tr><td width="230px">%s</td><td width="230px"></td><td width="230px">%s</td></tr>',
	__('Nom i cognoms','ricca3-alum'), __('Nom i cognoms','ricca3-alum') );
	printf('                   <tr><td width="230px">%s</td><td width="230px"></td><td width="230px">%s</td></tr>',
	__('Carlos Aylagas Molero','ricca3-alum'), __('Teresa Llirinós Sopena','ricca3-alum') );
	printf('                   <tr class="linea"><td colspan="3" width="680px" class="petit"><IMG SRC="%s/ricca3/imatges/ricca3-linea-mitja.png"></td></tr></table>', WP_PLUGIN_URL);
	printf('<table style="page-break-after: always;"><tr><td class="dereta" width="680px">%s</td></tr></table>', __('___/___', 'ricca3-alum'));
//
//		TERCERA PÀGINA
//
	printf('<table class="cap"> <tr><td><IMG SRC="%s/ricca3/imatges/ricca3-logo.jpg" ALIGN=left><IMG SRC="%s/ricca3/imatges/ricca3-adreca.png" ALIGN=left></td></tr></table><br />', WP_PLUGIN_URL, WP_PLUGIN_URL );
	printf('<table class="cap"><tr><td width="680px" colspan="3" class="gran"><b>%s</b></td></tr>',
		__('Historial acadèmic','ricca3-alum') );
	printf('                   <tr><td width="460px" colspan="2"><b>%s</b></td><td width="230px" class="dereta"><b>%s</b></td>',
		__('Resultats de l\'avaluació dels crèdits','ricca3-alum'), __('Formació professional inicial','ricca3-alum') );
	printf('                   <tr class="linea"><td colspan="3" width="680px" class="petit"><IMG SRC="%s/ricca3/imatges/ricca3-linea-mitja.png"></td></tr></table>', WP_PLUGIN_URL);
//		dades del alumne
	printf('<table class="cap"><tr><td width="230px" colspan="3"><b>%s</b></td></tr>',
		__('Dades de l\'alumne/a','ricca3-alum') );
	printf('                   <tr class="linea"><td colspan="3" width="680px" class="petit"><IMG SRC="%s/ricca3/imatges/ricca3-linea-mitja.png"></td></tr>', WP_PLUGIN_URL);
	printf('                   <tr><td width="340px">%s</td><td width="170px">%s</td><td width="170px">%s</td></tr>',
		__('Cognoms i nom','ricca3-alum'),__('DNI/NIE/passaport','ricca3-alum'), __('Núm. d\'identificació','ricca3-alum') );
	printf('<tr><td class="gran">%s</td><td class="gran">%s</td><td class="gran">%s</td></tr>',
		$row_alum['cognomsinom'], $row_alum['dni'], $row_alum['idalumne'] );
	printf('                   <tr class="linea"><td colspan="3" width="680px" class="petit"><IMG SRC="%s/ricca3/imatges/ricca3-linea-mitja.png"></td></tr></table>', WP_PLUGIN_URL);
//		dades acadèmiques
	printf('<table class="cap"><tr><td width="680px" colspan="4"><b>%s</b></td></tr>',
		__('Dades acadèmiques','ricca3-alum') );
	printf('                   <tr class="linea"><td colspan="4" width="680px" class="petit"><IMG SRC="%s/ricca3/imatges/ricca3-linea-mitja.png"></td></tr>', WP_PLUGIN_URL);
	printf('                   <tr><td width="100px">%s</td><td width="480px" colspan="2">%s</td><td width="100px">%s</td></tr>',
		__('Codi','ricca3-alum'), __('Nom del cicle formatiu','ricca3-alum'), __('Grau','ricca3-alum') );
	printf('<tr><td class="gran">%s</td><td class="gran" colspan="2">%s</td><td class="gran">%s</td></tr>',
		$row['codi_c'], $row['nom_c'], __('SUPERIOR','ricca3-alum') );
	printf('                   <tr class="linea"><td colspan="4" width="680px" class="petit"><IMG SRC="%s/ricca3/imatges/ricca3-linea-mitja.png"></td></tr></table>', WP_PLUGIN_URL);
//		qualificacions
	printf('<table class="cap"><tr><td width="680px" colspan="4"><b>%s</b></td></tr>', __('Qualificacions','ricca3-alum'));
	printf('                   <tr class="linea"><td colspan="4" width="680px" class="petit"><IMG SRC="%s/ricca3/imatges/ricca3-linea-mitja.png"></td></tr>', WP_PLUGIN_URL);
	printf('                   <tr><td width="380px">%s</td><td width="100px">%s</td><td width="100px">%s</td><td width="100px">%s</td></tr>',
		__('Crèdit','ricca3-alum'), __('Hores','ricca3-alum'), __('Convocatoria','ricca3-alum'), __('Qualificació','ricca3-alum') );
	printf('                   <tr class="linea"><td colspan="4" width="680px" class="petit"><IMG SRC="%s/ricca3/imatges/ricca3-linea-estreta.png"></td></tr>', WP_PLUGIN_URL);
//		entrada qualificacions
	$dades_cred = $wpdb->get_results( $wpdb->prepare('SELECT DISTINCT  ricca3_credits.idcredit ,ricca3_credits.ordre_cr '.
			'FROM ricca.ricca3_credits_avaluacions '.
			'INNER JOIN ricca3_ccomp ON ricca3_ccomp.idccomp = ricca3_credits_avaluacions.idccomp '.
			'INNER JOIN ricca3_credits ON ricca3_credits.idcredit = ricca3_ccomp.idcredit '.
			'WHERE idalumne=%s AND ricca3_credits.idespecialitat=%s '.
			'ORDER BY ricca3_credits.ordre_cr', $_GET['ID'], $_GET['espec'] ), ARRAY_A);
	for( $i = 0; $i < count($dades_cred); $i++ ){
		$dades_ccomp = $wpdb->get_results( $wpdb->prepare('SELECT * FROM ricca3_credits_avaluacions '.
				'INNER JOIN ricca3_ccomp ON ricca3_ccomp.idccomp=ricca3_credits_avaluacions.idccomp '.
				'INNER JOIN ricca3_credits ON ricca3_credits.idcredit = ricca3_ccomp.idcredit '.
				'INNER JOIN ricca3_especialitats ON ricca3_especialitats.idespecialitat = ricca3_credits.idespecialitat '.
				'INNER JOIN ricca3_grups ON ricca3_grups.idgrup = ricca3_ccomp.idgrup '.
				'INNER JOIN ricca3_any ON ricca3_any.idany = ricca3_credits_avaluacions.idany '.
				'INNER JOIN ricca3_professors ON ricca3_professors.idprof = ricca3_ccomp.idprofessor '.
				'WHERE idalumne=%s AND ricca3_credits.idespecialitat=%s AND ricca3_credits.idcredit=%s '.
				'ORDER BY ordre_cr, ricca3_credits_avaluacions.idccomp, ricca3_credits_avaluacions.idany DESC',
				$_GET['ID'], $_GET['espec'], $dades_cred[$i]['idcredit']), ARRAY_A);
		printf('<tr><td width="380px">%s</td><td width="100px">%s</td><td width="100px">%s</td><td width="100px">%s</td></tr>',
		$dades_ccomp[0]['nomcredit'], $dades_ccomp[0]['hores_cr'], $dades_ccomp[0]['convord'], $dades_ccomp[0]['notaf_cr'] );
	}
	for( $j = $i; $j < 16; $j++ ){
		printf('<tr><td width="680px" colspan="4">&nbsp;</td></tr>', NULL );
	}
	printf('</table>', NULL);
//		qualificació final
	printf('<table class="cap"><tr class="linea"><td colspan="3" width="680px" class="petit"><IMG SRC="%s/ricca3/imatges/ricca3-linea-mitja.png"></td></tr>', WP_PLUGIN_URL);
	printf('<tr><td width="680px" colspan="3">&nbsp;</td></tr>', NULL);
	$nota = $row['qual_final'];
	if( $row['qual_final'] < 5) $nota='';
	printf('                   <tr><td width="400px"></td><td width="200px"><b>%s</b></td><td width="80px" rowspan="2" class="notaf">%s</td></tr>',
		__('Qualificació final del cicle formatíu','ricca3-alum'), $nota );
	printf('                   <tr><td width="400px"><b>%s</b></td><td width="200px"></td></tr></table>', __('Observacions','ricca3-alum') );
	printf('                   <tr class="linea"><td colspan="3" width="680px" class="petit"><IMG SRC="%s/ricca3/imatges/ricca3-linea-mitja.png"></td></tr></table>', WP_PLUGIN_URL);
	printf('<table><tr><td>%s</tr></td></table>', $row['obs']);
	printf('<br /><br /><br />', NULL);
//		diligencia
	printf('<table class="cap"><tr class="linea"><td colspan="3" width="680px" class="petit"><IMG SRC="%s/ricca3/imatges/ricca3-linea-mitja.png"></td></tr></table>', WP_PLUGIN_URL);
	printf('<table class="cap"><tr><td width="680px"><b>%s</b></td></tr>', __('Diligència de la validesa de l\'historial acadèmic','ricca3-alum') );
	printf('<table class="cap"><tr class="linea"><td width="680px" class="petit"><IMG SRC="%s/ricca3/imatges/ricca3-linea-mitja.png"></td></tr></table>', WP_PLUGIN_URL);
	printf('<table class="cap"><tr><td>%s</td></tr></table>', __('CARLOS AYLAGAS MOLERO Secretari del centre ESCOLA RAMON I CAJAL amb codi 08035672 certifica que les dades que figuren en aquest historial reflecteixen les que consten en la documentació dipositada a la secretaria d\'aquest centre.', 'ricca3-alum'));
//		peu de pàgina
	printf('<table class="cap"><tr class="linea"><td colspan="3" width="680px" class="petit"><IMG SRC="%s/ricca3/imatges/ricca3-linea-mitja.png"></td></tr>', WP_PLUGIN_URL);
	printf('                   <tr><td width="230px">%s</td><td width="230px">%s</td><td width="230px">%s</td></tr>',
		__('Signatura del secretari','ricca3-alum'), __('Segell del centre','ricca3-alum'), __('Vist i plau de la directora','ricca3-alum') );
	printf('                   <tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr>', NULL);
	printf('                   <tr><td width="230px">%s</td><td width="230px"></td><td width="230px">%s</td></tr>',
		__('Nom i cognoms','ricca3-alum'), __('Nom i cognoms','ricca3-alum') );
	printf('                   <tr><td width="230px">%s</td><td width="230px"></td><td width="230px">%s</td></tr>',
		__('Carlos Aylagas Molero','ricca3-alum'), __('Teresa Llirinós Sopena','ricca3-alum') );
	printf('                   <tr class="linea"><td colspan="3" width="680px" class="petit"><IMG SRC="%s/ricca3/imatges/ricca3-linea-estreta.png"></td></tr>', WP_PLUGIN_URL);
	printf('                   <tr><td width="680px" colspan="3">%s</td></tr>',
		__('Lloc i data','ricca3-alum'));
	printf('                   <tr class="linea"><td colspan="3" width="680px" class="petit"><IMG SRC="%s/ricca3/imatges/ricca3-linea-ampla.png"></td></tr></table>', WP_PLUGIN_URL);
	printf('<table style="page-break-after: always;"><tr><td class="dereta" width="680px">%s</td></tr></table>', __('___/___', 'ricca3-alum'));
}

#############################################################################################
/**
 * Afegir nova especialitat
 * shortcode: [ricca3-novaespec]
 *
 * @since ricca3.v.2013.17.2
 * @author Efraim Bayarri
 */
#############################################################################################
function ricca3_shortcode_novaespec($atts, $content = null) {
	global $wpdb;
	global $ricca3_butons_editardades;
	global $ricca3_especalum;
	global $current_user;
	
	get_currentuserinfo();
//		Ja hem escollit l'especialitat
	if( isset( $_POST['cercar'] ) && $_POST['cercar'] == 'afegir'){
//	veure quina especialitat ha escollit
		$row = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_grups WHERE idgrup= %s',$_POST['grup']),ARRAY_A,0);
//	busca la configuracio de la especialitat
		$row_espec = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_especialitats WHERE idespecialitat = %s ', $row['idespecialitat'] ),ARRAY_A,0);
//	busca definició d'estat
		$row_estat = $wpdb->get_row( 'SELECT * FROM ricca3_estat WHERE estat="Alta"', ARRAY_A, 0);
//	busca la data actual
		$datainscripcio = date('Y-m-d');	
//
		if( $row_espec['cursos'] == 1){
// 	Si la especialitat no mes te un curs
			$row = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_grups WHERE idgrup= %s' , $_POST['grup'] ),ARRAY_A,0);

			$result = $wpdb->insert('ricca3_alumne_especialitat',array( 'idany' => $_POST['any'],
					'idgrup' => $row['idgrup'] , 'idalumne' => $_GET['ID'] , 'idestat_es' => $row_estat['idestat'],
					'datainscripcio' => $datainscripcio, 'abonament' => $_POST['abonament'],
					'stampuser' => $current_user->user_login, 'stampplace' => 'ricca_shortcode_novaespec_insert'));
// 	Si la especialita te 2 cursos
		}else{
			$rowa = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_grups WHERE idgrup= %s', $_POST['grup'] ),ARRAY_A,0);
			$rowb = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_any   WHERE idany= %s ', $_POST['any']  ),ARRAY_A,0);
			$rowc = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_grups WHERE idgrup= %s', $_POST['grup'] ),ARRAY_A,0);
			$rowd = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_grups WHERE actiu_gr=1 AND sessio =%s AND idespecialitat = %s AND idcurs=2 ' , $rowc['sessio'], $rowc['idespecialitat'] ), ARRAY_A, 0);
			$rowe = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_grups WHERE actiu_gr=1 AND sessio =%s AND idespecialitat = %s AND idcurs=1 ' , $rowc['sessio'], $rowc['idespecialitat'] ), ARRAY_A, 0);
//		si es matricula de primer curs, afegeix el segon curs al any que ve
			if( $row['idcurs'] == 1){
				$result = $wpdb->insert('ricca3_alumne_especialitat',array( 'idany' => $_POST['any'], 
						'idgrup' => $rowa['idgrup'] , 'idalumne' => $_GET['ID'] , 'idestat_es' => $row_estat['idestat'],
						'datainscripcio' => $datainscripcio, 'abonament' => $_POST['abonament'],
						'stampuser' => $current_user->user_login, 'stampplace' => 'ricca_shortcode_novaespec_insert'));
				$result = $wpdb->insert('ricca3_alumne_especialitat',array( 'idany' => $rowb['idany']+1, 
						'idgrup' => $rowd['idgrup'] , 'idalumne' => $_GET['ID'] , 'idestat_es' => $row_estat['idestat'],
						'datainscripcio' => $datainscripcio, 'abonament' => $_POST['abonament'],
						'stampuser' => $current_user->user_login, 'stampplace' => 'ricca_shortcode_novaespec_insert'));
//		si es matricula de segon, afegeix el primer curs al any passat
			}else{
				$result = $wpdb->insert('ricca3_alumne_especialitat',array( 'idany' => $rowb['idany']-1, 
						'idgrup' => $rowe['idgrup'] , 'idalumne' => $_GET['ID'] , 'idestat_es' => $row_estat['idestat'],
						'datainscripcio' => $datainscripcio, 'abonament' => $_POST['abonament'],
						'stampuser' => $current_user->user_login, 'stampplace' => 'ricca_shortcode_novaespec_insert'));
				$result = $wpdb->insert('ricca3_alumne_especialitat',array( 'idany' => $_POST['any'],
						'idgrup' => $rowd['idgrup'] , 'idalumne' => $_GET['ID'] , 'idestat_es' => $row_estat['idestat'],
						'datainscripcio' => $datainscripcio, 'abonament' => $_POST['abonament'],
						'stampuser' => $current_user->user_login, 'stampplace' => 'ricca_shortcode_novaespec_insert'));
			}
		}
	}
//		pantalla inicial	
	$row_alu = $wpdb->get_row($wpdb->prepare('SELECT * FROM ricca3_alumne WHERE idalumne=%s', $_GET['ID']), ARRAY_A, 0);
	$image_attributes = ricca3_miniatura($_GET['ID']);
//		missatge de capçalera de la pàgina
	ricca3_missatge(sprintf('%s %s</td><td><img src="%s" width="%s" height="%s">', __('Afegir especialitat a l\'alumne','ricca3-alum'), $row_alu['cognomsinom'], $image_attributes[0], $image_attributes[1], $image_attributes[2] ));
	$token = array( 'espec' => $_GET['espec'], 'grup' => $_GET['grup'], 'any' => $_GET['any'], 'estat' => $_GET['estat'], 'repe' => $_GET['repe']);
//	ajuda al butons
	$ricca3_butons_editardades['texte'][0] = __('ajuda-editardades-especialitats', 'ricca3-alum');
	$ricca3_butons_editardades['texte'][1] = __('ajuda-editardades-dadesalumne',   'ricca3-alum');
	$ricca3_butons_editardades['texte'][2] = __('ajuda-editardades-alumnes', 'ricca3-alum');
//		mostrar la filera de butons
	ricca3_butons( $ricca3_butons_editardades, 6, $token );	
//		ajuda a la graella
	$ricca3_especalum['ajuda'][0] = __('ajuda-graella-especalum-any',          'ricca3-alum');
	$ricca3_especalum['ajuda'][1] = __('ajuda-graella-especalum-especialitat', 'ricca3-alum');
	$ricca3_especalum['ajuda'][2] = __('ajuda-graella-especalum-grup',         'ricca3-alum');
	$ricca3_especalum['ajuda'][3] = __('ajuda-graella-especalum-estat',        'ricca3-alum');
	$ricca3_especalum['ajuda'][4] = __('ajuda-graella-especalum-nota',         'ricca3-alum');
	$ricca3_especalum['ajuda'][5] = __('ajuda-graella-especalum-repeteix',     'ricca3-alum');
//		buscar especialitats
	$data_view = $wpdb->get_results( $wpdb->prepare('SELECT * FROM ricca3_alumespec_view WHERE idalumne = %s ORDER BY idany ',$_GET['ID']), ARRAY_A);
//		llistat de les especialitats del alumne
	ricca3_graella( $ricca3_especalum, $data_view, $token );
	printf('</table>', NULL);	
//		No hem escollit la nova especialitat
	if( !isset( $_POST['cercar'] ) ){
//	mostra el filtre de selleccio
		printf('<form method="post" action="" name="cercar" id="drop"><table dir="ltr" class="menucurt400"><tr>', NULL);
//	drop per el grup
		$data_grup = $wpdb->get_results('SELECT * FROM ricca3_grups WHERE actiu_gr = 1 ORDER BY grup ', ARRAY_A );
		ricca3_drop( __('Grup:','ricca3-alum'), 'grup',  $data_grup,  'idgrup', 'grup',  __('ajuda_novaespec_grup', 'ricca3-alum'), TRUE );
//	drop per el any
		$data_any = $wpdb->get_results('SELECT * FROM ricca3_any', ARRAY_A );
		ricca3_drop_any( __('Any:','ricca3-alum'), 'any', $data_any, 'idany', 'any', __('ajuda_novaespec_any', 'ricca3-alum'), 'insc' );
//	afegir abonament
  		printf('<td title="%s">%s<INPUT type="text" name="abonament" size="15" maxlength="25" value="" ></td></tr></table>',
  			__('ajuda_novaespec_abonament', 'ricca3-alum'), __('Abonament', 'ricca3-alum') );
//	buto afegir especialitat		
		printf('</tr><tr><td><button type="submit" name="cercar" value="afegir" title="%s"><img src="%s/ricca3/imatges/ricca3-afegirespecialitat.png " border="0" /></button></td></tr></table></form>' , 
			__('ajuda_novaespec_afegir', 'rica3-alum'), WP_PLUGIN_URL );
	}
}

#############################################################################################
/**
 * Donar de baixa d'una especialitat
 * shortcode: [ricca3-baixaespec]
 *
 * @since ricca3.v.2013.17.3
 * @author Efraim Bayarri
 */
#############################################################################################
function ricca3_shortcode_baixaespec($atts, $content = null) {
	global $wpdb;
	global $ricca3_butons_editardades;
	global $ricca3_baixaespec;
	global $current_user;

	get_currentuserinfo();	
//		pantalla inicial
	$row_alu = $wpdb->get_row($wpdb->prepare('SELECT * FROM ricca3_alumne WHERE idalumne=%s', $_GET['ID']), ARRAY_A, 0);
	$image_attributes = ricca3_miniatura($_GET['ID']);
//		missatge de capçalera de la pàgina
	ricca3_missatge(sprintf('%s %s</td><td><img src="%s" width="%s" height="%s">', __('Donar de baixa d\'una especialitat a l\'alumne','ricca3-alum'), $row_alu['cognomsinom'], $image_attributes[0], $image_attributes[1], $image_attributes[2] ));
	$token = array( 'espec' => $_GET['espec'], 'grup' => $_GET['grup'], 'any' => $_GET['any'], 'estat' => $_GET['estat'], 'repe' => $_GET['repe']);
//	ajuda al butons
	$ricca3_butons_editardades['texte'][0] = __('ajuda-editardades-especialitats', 'ricca3-alum');
	$ricca3_butons_editardades['texte'][1] = __('ajuda-editardades-dadesalumne',   'ricca3-alum');
	$ricca3_butons_editardades['texte'][2] = __('ajuda-editardades-alumnes', 'ricca3-alum');
//		mostrar la filera de butons
	ricca3_butons( $ricca3_butons_editardades, 6, $token );
//	si ha premut el buto de guardar dades, actualitzem
	if( isset( $_POST['accio'] ) && $_POST['accio'] == 'baixaespec' && isset($_POST['cbox'])){
		for( $i = 0; $i <count($_POST['cbox']); $i++){
			$row = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_alumne_especialitat where idalumespec = %s', 
				$_POST['cbox'][$i] ),ARRAY_A,0);
//	si ja està de baixa, la donem d'alta
			if($row['idestat_es'] == 2 ){
				$result = $wpdb->update('ricca3_alumne_especialitat' , array('idestat_es' =>  1, 'motiubaixa' => '', 'stampuser' => $current_user->user_login, 'stampplace' => 'ricca_shortcode_baixaespec' ) , array( 'idalumespec' => $_POST['cbox'][$i] ));
// si està d'alta, la donem de baixa
			}else{
				$result = $wpdb->update('ricca3_alumne_especialitat' , array('idestat_es' =>  2, 'motiubaixa' => $_POST['motiu'], 'stampuser' => $current_user->user_login, 'stampplace' => 'ricca_shortcode_baixaespec' ) , array( 'idalumespec' => $_POST['cbox'][$i] ));
			}
		}
	}
//	ESBORRA especialitat
	if( isset( $_POST['accio'] ) && $_POST['accio'] == 'borraespec' && isset($_POST['cbox'])){
		for( $i = 0; $i <count($_POST['cbox']); $i++){
			if( $wpdb->delete('ricca3_alumne_especialitat', array('idalumespec' => $_POST['cbox'][$i]) ) ){
				ricca3_missatge( __('Especialitat esborrada amb exit!', 'ricca3-alum'));
			}else{
				ricca3_missatge( __('No s\'ha pogut esborrar l\'especialitat!', 'ricca3-alum'));
			}
		}
	}	
//		ajuda a la graella
	$ricca3_baixaespec['ajuda'][1] = __('ajuda-graella-baixaespec-motiu', 'ricca3-alum');
	$ricca3_baixaespec['ajuda'][2] = __('ajuda-graella-baixaespec-nom',   'ricca3-alum');
	$ricca3_baixaespec['ajuda'][3] = __('ajuda-graella-baixaespec-any',   'ricca3-alum');
	$ricca3_baixaespec['ajuda'][4] = __('ajuda-graella-baixaespec-espec', 'ricca3-alum');
	$ricca3_baixaespec['ajuda'][5] = __('ajuda-graella-baixaespec-grup',  'ricca3-alum');
	$ricca3_baixaespec['ajuda'][6] = __('ajuda-graella-baixaespec-estat', 'ricca3-alum');
//		buscar especialitats
	$data_view = $wpdb->get_results( $wpdb->prepare('SELECT * FROM ricca3_alumespec_view WHERE idalumne = %s ORDER BY idespecialitat, idany ',$_GET['ID']), ARRAY_A);
//		llistat de les especialitats del alumne
	printf('<form method="post" action="" target="_self" name="Baixes" id="baixes">', NULL);
	ricca3_graella( $ricca3_baixaespec, $data_view, $token );
	printf('</table>', NULL);
	printf('<table><tr><td title="%s">%s<INPUT type="text" name="motiu" size="30" value="" /> </td></tr></table>',
		__('ajuda-baixaespec-motiubaixa', 'ricca3_alum'), __('Motiu Baixa', 'ricca3-alum') );
	ricca3_desar('accio', 'baixaespec', __('ajuda-desar-baixaespec', 'ricca3-alum'));
	ricca3_missatge(sprintf('%s %s', __('Esborrar una especialitat a l\'alumne','ricca3-alum'), $row_alu['cognomsinom']));
	ricca3_desar('accio', 'borraespec', __('ajuda-desar-borraespec', 'ricca3-alum'));
	printf('</td></tr></table></form>', NULL);
}

#############################################################################################
/**
 * Editar els crèdits de l'alumne
 * shortcode: [ricca3-credalu]
 *
 * @since ricca3.v.2013.17.4
 * @author Efraim Bayarri
 */
#############################################################################################
function ricca3_shortcode_credalu($atts, $content = null) {
	global $wpdb;
	global $ricca3_butons_editardades;
	global $ricca3_credalu;
	global $current_user;
//	dump_r($_POST);
	get_currentuserinfo();
//		comprovar si hem de guardar les dades de tots el crèdits
	$num_cols=count($ricca3_credalu,1)/count($ricca3_credalu,0)-1;
	if( isset( $_POST['accio'] ) && $_POST['accio'] == 'actualitzartot'){
		for( $i=0; $i < count($_POST['idcredaval']); $i++){
			for( $j=0; $j < $num_cols; $j++){
				if(!$ricca3_credalu['nomeslect'][$j]){
					$result = $wpdb->update('ricca3_credits_avaluacions',
						array( $ricca3_credalu['nomupdate'][$j] => strtoupper($_POST[$ricca3_credalu['nombd'][$j]][$i]), 'stampuser' => $current_user->user_login, 'stampplace' => 'ricca_shortcode_credalu' ), 
						array('idcredaval' => $_POST['idcredaval'][$i]) );
				}
			}
		}
	}
//		comprovar si he de guardar les dades d'una especialitat
	if( isset( $_POST['accio'] ) && $_POST['accio'] == 'actualitzarespec'){
		for( $i=0; $i < count( $_POST['pendi']); $i++ ){
			$result = $wpdb->update('ricca3_credits_avaluacions',
				array(  'pendi' => strtoupper($_POST['pendi'][$i]), 'repe'     => strtoupper($_POST['repe'][$i]),   'nota1' => strtoupper($_POST['nota1'][$i]), 
						'act1'  => strtoupper($_POST['act1'][$i]),  'nota2'    => strtoupper($_POST['nota2'][$i]),  'act2'  => strtoupper($_POST['act2'][$i]), 
						'nota3' => strtoupper($_POST['nota3'][$i]), 'actf'     => strtoupper($_POST['actf'][$i]),   'notaf_cc' => strtoupper($_POST['notaf_cc'][$i]), 
						'convord' => $_POST['convord'][$i], 
						'stampuser' => $current_user->user_login, 'stampplace' => 'ricca_shortcode_credalu'),
				array('idcredaval' => $_POST['idcredaval'][$i]) );
		}
	}
//		pantalla inicial
	$row_alu = $wpdb->get_row($wpdb->prepare('SELECT * FROM ricca3_alumne WHERE idalumne=%s', $_GET['ID']), ARRAY_A, 0);
	$image_attributes = ricca3_miniatura($_GET['ID']);
//		missatge de capçalera de la pàgina
	ricca3_missatge(sprintf('%s %s</td><td><img src="%s" width="%s" height="%s">', __('Dades dels crèdits de l\'alumne','ricca3-alum'), $row_alu['cognomsinom'], $image_attributes[0], $image_attributes[1], $image_attributes[2] ));
	$token = array( 'espec' => $_GET['espec'], 'grup' => $_GET['grup'], 'any' => $_GET['any'], 'estat' => $_GET['estat'], 'repe' => $_GET['repe']);
//		ajuda al butons
	$ricca3_butons_editardades['texte'][0] = __('ajuda-editardades-especialitats', 'ricca3-alum');
	$ricca3_butons_editardades['texte'][1] = __('ajuda-editardades-dadesalumne',   'ricca3-alum');
	$ricca3_butons_editardades['texte'][2] = __('ajuda-editardades-alumnes', 'ricca3-alum');
//		mostrar la filera de butons
	ricca3_butons( $ricca3_butons_editardades, 6, $token );
//		quantes especialitats te l'alumne?
	$espec = $wpdb->query( $wpdb->prepare('SELECT DISTINCT idespecialitat FROM ricca3_alumespec_view WHERE idalumne=%s', $_GET['ID']));
//	<!-- the tabs -->
	printf('<div id="tabs">', NULL);
	printf('<ul class="tabs">', NULL);
//		tabs especialitats
	for( $i = 0; $i < $espec; $i++){
		$idespec = $wpdb->get_row( $wpdb->prepare('SELECT DISTINCT idespecialitat FROM ricca3_alumespec_view WHERE idalumne=%s', $_GET['ID']), ARRAY_A, $i);
		$row_espec = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_alumespec_view WHERE idalumne=%s AND idespecialitat=%s', $_GET['ID'], $idespec['idespecialitat']), ARRAY_A, 0);
		$nom = str_word_count($row_espec['nomespecialitat'], 1, 'ÀÈÒÓ');
		printf('<li><a href="#espec%s" title="%s">%s</a></li>',$i , __('ajuda-tab-credits-especialitat','ricca3-alum'), $nom[0]);
	}
//		tab tots els crèdits	
	printf('<li><a href="#estat" title="%s">%s</a></li>', __('ajuda-tab-credits-tots', 'ricca3-alum'), __('Tots els crèdits', 'ricca3-alum'));
  	printf('</ul>', NULL);
//		<!-- tab "panes" -->
#################################
//		tabs detallats especialitat
#################################
	for( $i = 0; $i < $espec; $i++){
		$idespec = $wpdb->get_row( $wpdb->prepare('SELECT DISTINCT idespecialitat FROM ricca3_alumespec_view WHERE idalumne=%s', $_GET['ID']), ARRAY_A, $i);
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
		printf('<div id="espec%s"><table>', $i);
//	mostrem la capçalera de la graella amb les ajudes
		printf( '<tr><th title="%s">Grup</th><th></th><th title="%s">Conv</th><th title="%s">P</th><th title="%s">R</th><th title="%s">Crèdit</th><th title="%s">N1</th><th title="%s">A1</th><th title="%s">N2</th>'.
				'<th title="%s">A2</th><th title="%s">N3</th><th title="%s">A3</th><th title="%s">NFCC</th><th title="%s">NFCR</th><th title="%s">Professor</th><th title="%s">HoresCC</th><th title="%s">Hores</th></tr>',
				__('ajuda-graella-credalu-grup',     'ricca3-alum'),
				__('ajuda-graella-credalu-conv',     'ricca3-alum'),
				__('ajuda-graella-credalu-P',        'ricca3-alum'),
				__('ajuda-graella-credalu-R',        'ricca3-alum'),
				__('ajuda-graella-credalu-credit',   'ricca3-alum'),
				__('ajuda-graella-credalu-N1',       'ricca3-alum'),
				__('ajuda-graella-credalu-A1',       'ricca3-alum'),
				__('ajuda-graella-credalu-N2',       'ricca3-alum'),
				__('ajuda-graella-credalu-A2',       'ricca3-alum'),
				__('ajuda-graella-credalu-N3',       'ricca3-alum'),
				__('ajuda-graella-credalu-A3',       'ricca3-alum'),
				__('ajuda-graella-credalu-NFCC',     'ricca3-alum'),
				__('ajuda-graella-credalu-NFCR',     'ricca3-alum'),
				__('ajuda-graella-credalu-prof',     'ricca3-alum'),
				__('ajuda-graella-credalu-horesCC',  'ricca3-alum'),
				__('ajuda-graella-credalu-hores CR', 'ricca3-alum')
		);

		if( $i == 0){
			printf('<form method="post" action="" target="_self" name="credespec" id="form1">', NULL);
		}else{
			printf('<form method="post" action="" target="_self" name="credespec" id="especform2">', NULL);
		}
		for( $j=0; $j < count($data_cred); $j++ ){
//
			$row_any = $wpdb->get_row( $wpdb->prepare( 'SELECT * FROM ricca3_any WHERE idany = %s', $data_cred[$j]['idany'] ) , ARRAY_A , 0 );
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
				printf('<tr class="credit"><td><b>%s</b></td><td></td><td><b>%s</b></td><td></td><td colspan="2"><b>%s</b></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td><b>%s</b></td><td></td><td></td><td>%s</td></tr>',
				$data_cred[$j]['grup'], '<b>===></b>', $data_cred[$j]['nomcredit'], $nota, $data_cred[$j]['hores_cr']);
			}
//	si ja hem mostrat el ccomp a la linea anterior, no posem el nomccomp
			printf('<tr><td>%s</td>', $data_cred[$j]['grup'] );
			printf('<td>%s</td>',$row_any['any']);
			printf('<td width="15px"><INPUT type="text" size="5" name="convord[%s]" value="%s" title="%s"  required="required" pattern="[0-9]{2,2}/[0-9]{2,2}" /></td>',
				$j, $data_cred[$j]['convord'], __('ajuda-graella-credalu-conv'));
			printf('<td width="10px"><INPUT type="text" size="1" name="pendi[%s]"  value="%s" title="%s" pattern="[PRpr ]{1,1}" /></td>',
				$j, $data_cred[$j]['pendi'], __('ajuda-graella-credalu-P', 'ricca3-alum'));
			printf('<td width="10px"><INPUT type="text" size="1" name="repe[%s]"  value="%s" title="%s" pattern="[Rrj ]{1,1}" /></td>',
				$j, $data_cred[$j]['repe'],  __('ajuda-graella-credalu-R', 'ricca3-alum'));
//	si ja hem mostrat el ccomp a la linea anterior, no posem el nomccomp			
			if( $j != 0 && $data_cred[$j]['idccomp'] == $data_cred[$j-1]['idccomp'] ){
				printf('<td></td>', NULL);
			}else{
				printf('<td>%s</td>', $data_cred[$j]['nomccomp']);
			}
			printf('<td width="10px"><INPUT type="text" size="1" name="nota1[%s]"  value="%s" title="%s" pattern="[0-9NPCOEXnpcoex ]{1,2}" /></td>',
				$j, $data_cred[$j]['nota1'],  __('ajuda-graella-credalu-N1', 'ricca3-alum'));
			printf('<td width="10px"><INPUT type="text" size="1" name="act1[%s]"  value="%s" title="%s" pattern="[ABCDEabcde ]{1,1}" /></td>',
				$j, $data_cred[$j]['act1'],  __('ajuda-graella-credalu-A1', 'ricca3-alum'));
			printf('<td width="10px"><INPUT type="text" size="1" name="nota2[%s]"  value="%s" title="%s" pattern="[0-9NPCOEXnpcoex ]{1,2}" /></td>',
				$j, $data_cred[$j]['nota2'],  __('ajuda-graella-credalu-N2', 'ricca3-alum'));
			printf('<td width="10px"><INPUT type="text" size="1" name="act2[%s]"  value="%s" title="%s" pattern="[ABCDEabcde ]{1,1}" /></td>',
				$j, $data_cred[$j]['act2'],  __('ajuda-graella-credalu-A2', 'ricca3-alum'));
			printf('<td width="10px"><INPUT type="text" size="1" name="nota3[%s]"  value="%s" title="%s" pattern="[0-9NPCOEXnpcoex ]{1,2}" /></td>',
				$j, $data_cred[$j]['nota3'],  __('ajuda-graella-credalu-N3', 'ricca3-alum'));
			printf('<td width="10px"><INPUT type="text" size="1" name="actf[%s]"   value="%s" title="%s" pattern="[ABCDEabcde ]{1,1}" /></td>',
				$j, $data_cred[$j]['actf'],   __('ajuda-graella-credalu-A3', 'ricca3-alum'));
			printf('<td width="10px"><INPUT type="text" size="10" name="notaf_cc[%s]"  value="%s" title="%s" pattern="[0-9A-Za-zèéÈÉ: ]{1,15}" /></td>',
				$j, $data_cred[$j]['notaf_cc'],  __('ajuda-graella-credalu-NFCC', 'ricca3-alum'));
			printf('<td width="10px"><INPUT type="text" size="10" name="notaf_cr[%s]"  value="%s" title="%s" pattern="[0-9A-Za-zèéÈÉ: ]{1,15}" /></td>',
				$j, $data_cred[$j]['notaf_cr'],  __('ajuda-graella-credalu-NFCR', 'ricca3-alum'));
			printf('<td>%s</td><td>%s</td><td>%s<input type="hidden" name="idcredaval[%s]" value="%s"></td></tr>', $data_cred[$j]['nomicognoms'], $data_cred[$j]['hores_cc'], $data_cred[$j]['hores_cr'], $j, $data_cred[$j]['idcredaval']);
		}
		printf('</table>', NULL);
		ricca3_desar('accio', 'actualitzarespec', __('ajuda-tab-credits-tots-desar', 'ricca3-alum'));
		printf('</td></tr></table></form>', NULL);
		printf('</div>', NULL);
	}
#################################
##//		Tab tots el crèdits
#################################
  	printf('<div id="estat">', NULL);
//	$query = $wpdb->prepare('SELECT * FROM ricca3_alumcredit_view WHERE idalumne = %s ORDER BY idany, idcurs, ordre_cr',$_GET['ID']);
//	$data_view = $wpdb->get_results( $query, ARRAY_A);
  	$idespec = $wpdb->get_row( $wpdb->prepare('SELECT DISTINCT idespecialitat FROM ricca3_alumespec_view WHERE idalumne=%s', $_GET['ID']), ARRAY_A, 0);
  	$row_espec = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_alumespec_view WHERE idalumne=%s AND idespecialitat=%s', $_GET['ID'], $idespec['idespecialitat']), ARRAY_A, 0);
  	$query_cred = $wpdb->prepare('SELECT * FROM ricca3_credits_avaluacions '.
  			'INNER JOIN ricca3_ccomp ON ricca3_ccomp.idccomp=ricca3_credits_avaluacions.idccomp '.
  			'INNER JOIN ricca3_credits ON ricca3_credits.idcredit = ricca3_ccomp.idcredit '.
  			'INNER JOIN ricca3_especialitats ON ricca3_especialitats.idespecialitat = ricca3_credits.idespecialitat '.
  			'INNER JOIN ricca3_grups ON ricca3_grups.idgrup = ricca3_ccomp.idgrup '.
  			'INNER JOIN ricca3_any ON ricca3_any.idany = ricca3_credits_avaluacions.idany '.
  			'INNER JOIN ricca3_professors ON ricca3_professors.idprof = ricca3_ccomp.idprofessor '.
  			'WHERE idalumne=%s AND ricca3_credits.idespecialitat=%s '.
  			'ORDER BY ricca3_credits_avaluacions.idany, ordre_cr ', $_GET['ID'], $idespec['idespecialitat']);
  	$data_view = $wpdb->get_results( $query_cred, ARRAY_A);
//		ajuda a la graella
	$ricca3_credalu['ajuda'][4] = __('ajuda-graella-credalu-N1', 'ricca3-alum');
	$ricca3_credalu['ajuda'][5] = __('ajuda-graella-credalu-A1', 'ricca3-alum');
	$ricca3_credalu['ajuda'][6] = __('ajuda-graella-credalu-N2', 'ricca3-alum');
	$ricca3_credalu['ajuda'][7] = __('ajuda-graella-credalu-A2', 'ricca3-alum');
	$ricca3_credalu['ajuda'][8] = __('ajuda-graella-credalu-N3', 'ricca3-alum');
	$ricca3_credalu['ajuda'][9] = __('ajuda-graella-credalu-A3', 'ricca3-alum');
	$ricca3_credalu['ajuda'][10] = __('ajuda-graella-credalu-RE', 'ricca3-alum');
	$ricca3_credalu['ajuda'][11] = __('ajuda-graella-credalu-NFCC', 'ricca3-alum');
	$ricca3_credalu['ajuda'][12] = __('ajuda-graella-credalu-NFCR', 'ricca3-alum');
	$ricca3_credalu['ajuda'][13] = __('ajuda-graella-credalu-P', 'ricca3-alum');
	$ricca3_credalu['ajuda'][14] = __('ajuda-graella-credalu-R', 'ricca3-alum');
//		Patrons validació
	$ricca3_credalu['pattern'][4] = '[0-9NPCOEXnpcoex ]{1,2}';
	$ricca3_credalu['pattern'][5] = '[ABCDEabcde ]{1,1}';
	$ricca3_credalu['pattern'][6] = '[0-9NPCOEXnpcoex ]{1,2}';
	$ricca3_credalu['pattern'][7] = '[ABCDEabcde ]{1,1}';
	$ricca3_credalu['pattern'][8] = '[0-9NPCOEXnpcoex ]{1,2}';
	$ricca3_credalu['pattern'][9] = '[ABCDEabcde ]{1,1}';
	$ricca3_credalu['pattern'][10] = '[0-9NPCOEXnpcoex ]{1,2}';
	$ricca3_credalu['pattern'][11] = '[0-9NPCOEXnpcoexat ]{1,4}';
	$ricca3_credalu['pattern'][12] = '[0-9NPCOEXATnpcoexat ]{1,4}';
	$ricca3_credalu['pattern'][13] = '[PRpr ]{1,1}';
	$ricca3_credalu['pattern'][14] = '[Rr ]{1,1}';
//	
	printf('<form method="post" action="" target="_self" name="creadlu" id="especformtot">', NULL);
	ricca3_graella( $ricca3_credalu, $data_view, $token );
	printf('</table>', NULL);
	ricca3_desar('accio', 'actualitzartot', __('ajuda-tab-credits-tots-desar', 'ricca3-alum'));
	printf('</td></tr></table></form>', NULL);

	
	printf('</div>', NULL);
//	<!-- Final de tab "panes" -->
	printf('</div>', NULL);
}

#############################################################################################
/**
 * Aplicar pla d'estudis a un alumne
 * shortcode: [ricca3-alumcreacred]
 *
 * @since ricca3.v.2013.17.4
 * @author Efraim Bayarri
 */
#############################################################################################
function ricca3_shortcode_alumcreacred($atts, $content = null) {
	global $wpdb;
	global $ricca3_butons_editardades;
	global $ricca3_alumcreacred;
	global $current_user;

	get_currentuserinfo();
//		pantalla inicial
	$row_alu = $wpdb->get_row($wpdb->prepare('SELECT * FROM ricca3_alumne WHERE idalumne=%s', $_GET['ID']), ARRAY_A, 0);
	$image_attributes = ricca3_miniatura($_GET['ID']);
//		missatge de capçalera de la pàgina
	ricca3_missatge(sprintf('%s %s</td><td><img src="%s" width="%s" height="%s">', __('Aplicar plà d\'estudis a l\'alumne','ricca3-alum'), $row_alu['cognomsinom'], $image_attributes[0], $image_attributes[1], $image_attributes[2] ));
	$token = array( 'espec' => $_GET['espec'], 'grup' => $_GET['grup'], 'any' => $_GET['any'], 'estat' => $_GET['estat'], 'repe' => $_GET['repe']);
//	ajuda al butons
	$ricca3_butons_editardades['texte'][0] = __('ajuda-editardades-especialitats', 'ricca3-alum');
	$ricca3_butons_editardades['texte'][1] = __('ajuda-editardades-dadesalumne',   'ricca3-alum');
	$ricca3_butons_editardades['texte'][2] = __('ajuda-editardades-alumnes', 'ricca3-alum');
//		mostrar la filera de butons
	ricca3_butons( $ricca3_butons_editardades, 6, $token );
//		desar dades
	if( isset( $_POST['accio'] ) && $_POST['accio'] == 'desarpla' && isset($_POST['cbox'])){
		for( $i=0; $i < count($_POST['cbox']); $i++ ){
			$row_alumespec = $wpdb->get_row($wpdb->prepare('SELECT * FROM ricca3_alumespec_view WHERE idalumespec = %s', $_POST['cbox'][$i]), ARRAY_A, 0);
			$row_any   = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_any WHERE idany = %s', $row_alumespec['idany']), ARRAY_A, 0);
			$row_grup  = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_grups WHERE idgrup = %s', $row_alumespec['idgrup']), ARRAY_A, 0);
			for( $j = 0; $j < count($_POST['idccomp'][$i]); $j++ ){
				$row_ccomp = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_ccomp WHERE idccomp = %s', $_POST['idccomp'][$i][$j]), ARRAY_A, 0); 				
				$query = $wpdb->prepare('SELECT * FROM ricca3_credits_avaluacions WHERE idany = %s AND idccomp = %s AND idalumne = %s',
					$row_alumespec['idany'], $_POST['idccomp'][$i][$j], $_GET['ID']);
				$result = $wpdb->query( $query );
				if( $result == 0){
					$result_insert = $wpdb->insert('ricca3_credits_avaluacions', array( 
							'idany' => $row_alumespec['idany'], 
							'idccomp' => $_POST['idccomp'][$i][$j], 
							'idalumne' => $_GET['ID'], 
							'convord' => $row_any['conv'],
							'stampuser' => $current_user->user_login, 'stampplace' => 'ricca_shortcode_creacred_insert'));
					if( $result_insert ){
						ricca3_missatge(sprintf('%s %s %s', __('El crèdit','ricca3-alum'), $row_ccomp['nomccomp'], __('afegit correctament', 'ricca3-alum')));
					}else{										
						ricca3_missatge(sprintf('%s %s %s', __('El crèdit','ricca3-alum'), $row_ccomp['nomccomp'], __('no s\'ha pogut afegir, ERROR!!', 'ricca3-alum')));
					}
				}else{
					ricca3_missatge(sprintf('%s %s %s', __('El crèdit','ricca3-alum'), $row_ccomp['nomccomp'], __('ja existeix per el alumne i any especificats', 'ricca3-alum')));
				}
			}
		}
		return;
	}	
//		ajuda a la graella
	$ricca3_baixaespec['ajuda'][1] = __('ajuda-graella-creacred-nom',   'ricca3-alum');
	$ricca3_baixaespec['ajuda'][2] = __('ajuda-graella-creacred-any',   'ricca3-alum');
	$ricca3_baixaespec['ajuda'][3] = __('ajuda-graella-creacred-espec', 'ricca3-alum');
	$ricca3_baixaespec['ajuda'][4] = __('ajuda-graella-creacred-grup',  'ricca3-alum');
	$ricca3_baixaespec['ajuda'][5] = __('ajuda-graella-creacred-estat', 'ricca3-alum');
//		buscar especialitats
	$data_view = $wpdb->get_results( $wpdb->prepare('SELECT * FROM ricca3_alumespec_view WHERE idalumne = %s ORDER BY idespecialitat, idany ',$_GET['ID']), ARRAY_A);
//		llistat de les especialitats del alumne
	printf('<form method="post" action="" target="_self" name="Baixes">', NULL);
	ricca3_graella( $ricca3_alumcreacred, $data_view, $token );
	printf('</table>', NULL);
//	si ha premut el buto de guardar dades, actualitzem
	$ind = 0;
	if( isset( $_POST['accio'] ) && $_POST['accio'] == 'aplicapla' && isset($_POST['cbox'])){
		for( $i=0; $i < count($_POST['cbox']); $i++ ){
			$row_espec = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_alumespec_view WHERE idalumespec = %s ',$_POST['cbox'][ $i ] ), ARRAY_A,0);
			$row_any   = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_any WHERE idany = %s', $row_espec['idany']), ARRAY_A, 0);
			$row_grup  = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_grups WHERE idgrup = %s', $row_espec['idgrup']), ARRAY_A, 0);
			$query_pla = $wpdb->prepare('SELECT * FROM ricca3_pla '.
					'INNER JOIN ricca3_ccomp ON ricca3_ccomp.idccomp = ricca3_pla.idccomp '.
					'INNER JOIN ricca3_grups ON ricca3_grups.idgrup = ricca3_ccomp.idgrup '.
					'INNER JOIN ricca3_any ON ricca3_any.idany = ricca3_pla.idany '.
					'WHERE ricca3_pla.idany =%s AND ricca3_ccomp.idgrup = %s',$row_espec['idany'],$row_espec['idgrup'] );
			$data_view2 = $wpdb->get_results( $query_pla, ARRAY_A);
//	comprovar que existeis el plà solicitat
			if( count($data_view2) > 0){
				ricca3_missatge(sprintf('%s %s %s %s', __('Crèdits del grup','ricca3-alum'), $data_view2[0]['grup'], __('per el any','ricca3-alum'), $data_view2[0]['any']));
				printf('<table>', NULL);
				for( $j = 0; $j < count($data_view2); $j++ ){
					printf('<tr><td>%s<INPUT type="hidden" name="idccomp[%s][]" value="%s" /></td></tr>', 
					$data_view2[$j]['nomccomp'], $ind, $data_view2[$j]['idccomp']);
				}
				printf('<tr><td><INPUT type="hidden" name="cbox[]" value="%s" /></td></tr>', $_POST['cbox'][$i]);				
				printf('</table>', NULL);
				$ind++;
			}else{
//	no hi ha pla per el any
				ricca3_missatge(sprintf('%s %s %s %s', __('No existeis plà per el any ','ricca3-alum'), $row_any['any'], __('per el grup','ricca3_alum'), $row_grup['grup']));
			}	
		}
		ricca3_desar('accio', 'desarpla', __('ajuda-desar-aplicapla', 'ricca3-alum'));
		printf('</td></tr></table>', NULL);
	}else{
		ricca3_desar('accio', 'aplicapla', __('ajuda-aplica-aplicapla', 'ricca3-alum'));
		printf('</td></tr></table>', NULL);
	}	
	printf('</form>', NULL);
}

#############################################################################################
/**
 * primera pàgina per l'impresió del butlletí d'inscripció
 * shortcode: [ricca3-butlleti]
 *
 * @since ricca3.v.2013.17.7
 * @author Efraim Bayarri
 */
#############################################################################################
function ricca3_shortcode_butlleti($atts, $content = null) {
	global $wpdb;
	global $ricca3_butons_editardades;
	
//		pantalla inicial
	$row_alu = $wpdb->get_row($wpdb->prepare('SELECT * FROM ricca3_alumne WHERE idalumne=%s', $_GET['ID']), ARRAY_A, 0);
	$image_attributes = ricca3_miniatura($_GET['ID']);
//		missatge de capçalera de la pàgina
	ricca3_missatge(sprintf('%s %s</td><td><img src="%s" width="%s" height="%s">', __('Butlletí de Preinscripció de l\'alumne','ricca3-alum'), $row_alu['cognomsinom'], $image_attributes[0], $image_attributes[1], $image_attributes[2] ));
	$token = array( 'espec' => $_GET['espec'], 'grup' => $_GET['grup'], 'any' => $_GET['any'], 'estat' => $_GET['estat'], 'repe' => $_GET['repe']);
//	ajuda al butons
	$ricca3_butons_editardades['texte'][0] = __('ajuda-editardades-especialitats', 'ricca3-alum');
	$ricca3_butons_editardades['texte'][1] = __('ajuda-editardades-dadesalumne',   'ricca3-alum');
	$ricca3_butons_editardades['texte'][2] = __('ajuda-editardades-alumnes', 'ricca3-alum');
//		mostrar la filera de butons
	ricca3_butons( $ricca3_butons_editardades, 6, $token );
//		si ja hem escollit l'especialitat
	if( isset( $_POST['accio'] ) && $_POST['accio'] == 'desar' ){
		$row_espec = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_alumespec_view WHERE idalumne = %s AND idespecialitat = %s', 
			$_GET['ID'], $_POST['cbox']), ARRAY_A, 0);
		printf('<form method="post" action="" name="cercar"><table dir="ltr" class="menucurt400">', NULL);
//	data i abonament
		$today = getdate();
		$avui = sprintf('%s/%s/%s', $today['mday'], $today['mon'], $today['year']);
		printf(' <tr><td>%s<INPUT type="text" name="abona" value="%s" title="%s" />€</td>'.
					'<td>%s<INPUT type="text" name="data" value="%s" title="%s" /><INPUT type="hidden" name="cbox" value="%s" /></td></tr>',
			 __('Abonament:','ricca3-alum'), $row_espec['abonament'], __('ajuda-butlleti-abonament','ricca3-alum'), 
//			 __('data d\'inscripció','ricca3-alum'), date('d/m/Y', strtotime($row_espec['datainscripcio']) ), 
			 __('data d\'inscripció','ricca3-alum'), $avui,
			 __('ajuda-butlleti-data','ricca3-alum'), $_POST['cbox']  );
//		
		printf('</table><table><tr><td>', NULL);
		ricca3_desar('accio', 'imprimir', __('ajuda-imprimir-butlleti', 'ricca3-alum'));
		printf('</td></tr></table></form>', NULL);
	}elseif( isset( $_POST['accio'] ) && $_POST['accio'] == 'imprimir' ){
		$row_espec = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_alumespec_view WHERE idalumne = %s AND idespecialitat = %s',
			$_GET['ID'], $_POST['cbox']), ARRAY_A, 0);
		ricca3_missatge(sprintf('%s %s', __('Butlletí d\'inscripció per l\'especialitat:','ricca3-alum'), $row_espec['nomespecialitat'] ));		
		printf('<table><tr>', NULL);
		printf('<td><a href="%s/%s/?ID=%s&esp=%s&abona=%s&data=%s" target="POPUPW" onsubmit="POPUPW = window.open("about:blank","POPUPW","width=800,height=650" >',site_url(), 'ricca3-impbutlleti', $_GET['ID'], $_POST['cbox'], $_POST['abona'], $_POST['data']);
		printf('<button type="button"><img src="%s/ricca3/imatges/ricca3-imprimir.png" border=0 /></button></a></td>',WP_PLUGIN_URL);
		printf('</tr></table>', NULL);
	}else{
		$data_view = $wpdb->get_results( $wpdb->prepare('SELECT DISTINCT idespecialitat, nomespecialitat, sessio FROM ricca3_alumespec_view WHERE idalumne = %s ORDER BY idany ',$_GET['ID']), ARRAY_A);
		printf('<form method="post" action="" name="cercar"><table dir="ltr" class="menucurt400">', NULL);
		for( $i = 0; $i < count( $data_view ); $i++ ){
			printf('<tr><td><INPUT type="radio" name="cbox" value="%s" title="%s" /></td><td title="%s" >%s %s</td></tr>', 
				$data_view[$i]['idespecialitat'], __('ajuda-radio-butlleti','ricca3-alum'), __('ajuda-curs-butlleti','ricca3-alum'), $data_view[$i]['nomespecialitat'], $data_view[$i]['sessio'] );
		}
		printf('</table><table><tr><td>', NULL);
		ricca3_desar('accio', 'desar', __('ajuda-desar-especbutlleti', 'ricca3-alum'));
		printf('</td></tr></table></form>', NULL);
	}
}

#############################################################################################
/**
 * impresió del butlleti de preinscripció
 * shortcode: [ricca3-impbutlleti]
 *
 * @since ricca3.v.2013.17.7
 * @author Efraim Bayarri
 */
#############################################################################################
function ricca3_shortcode_impbutlleti($atts, $content = null) {
	global $wpdb;
	$row_any = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_any WHERE insc = 1', NULL),ARRAY_A,0);
	$row_alu = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_alumne WHERE idalumne = %s',$_GET['ID']),ARRAY_A,0);
	$row     = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_alumespec_view WHERE idalumne = %s AND idespecialitat = %s',
			$_GET['ID'], $_GET['esp']), ARRAY_A, 0);
##
##	CAPÇALERA
##
	printf('<table class="cap"><tr><td><IMG SRC="%s/ricca3/imatges/ricca3-logo.jpg" ALIGN=left><IMG SRC="%s/ricca3/imatges/ricca3-adreca.png" ALIGN=left></td></tr></table>', WP_PLUGIN_URL, WP_PLUGIN_URL );
	printf('<br><br><table class="cap"><tr><td align="center" width="900">', NULL);
	printf('%s <b>%s</b></td></tr></table><br><br><table class="cap"><tr><td>', __('<b>PREINSCRIPCIÓ</b> CURS','ricca3-alum'), $row_any["any"] );
	printf('%s<b> %s %s %s</b></td></tr></table><table><tr><td>', __('Nom i cognoms','ricca3-alum'),$row_alu["nom"],$row_alu["cognom1"],$row_alu["cognom2"]);
	printf('%s<b> %s</b></td><td width="350">',                   __('Data de naixement','ricca3-alum'), date("d-m-Y",strtotime($row_alu["datanai"])));
	printf('%s<b> %s</b>', __('Lloc de naixement','ricca3-alum'), $row_alu["llocnai"]);
	if(trim(strtolower($row_alu['paisnai'])) != 'españa' && trim(strtolower($row_alu['paisnai'])) != 'espanya') printf(', <b>%s</b>', $row_alu['paisnai']);
	printf('</td></tr><tr><td>', NULL);
	printf('%s<b> %s</b></td><td width="350">',             __('DNI/Passaport','ricca3-alum'), $row_alu["dni"] );
	printf('%s<b> %s</b></td></tr><tr><td>',                __('Professió','ricca3-alum'), $row_alu["professio"] );
	printf('%s<b> %s</b></td><td width="350">',             __('Telèfon fixe','ricca3-alum'), $row_alu["telefonfixe"] );
	printf('%s<b> %s</b></td></tr></table><table><tr><td>', __('Telèfon mòbil','ricca3-alum'), $row_alu["telefon"]);
	printf('%s<b> %s</b></td><td width="350"></td></tr></table><table><tr><td>', __('Domicili','ricca3-alum'), $row_alu["residenciahabitual"] );
	printf('%s<b> %s</b></td><td width="350">',             __('Població','ricca3-alum'), $row_alu["ciutathabitual"] );
	printf('%s<b> %s</b></td></tr><tr><td>',                __('Codi postal','ricca3-alum'), $row_alu["codipostal"] );
	printf('%s<b> %s</b></td><td></td></tr></table><table class="cap"><tr><td>', __('Email','ricca3-alum'), $row_alu["email"] );
	printf('%s</td></tr></table><table class="cap"><tr><td><b> %s %s</b></td></tr></table>', __('EL ALUMNE S\'HA MATRICULAT A L\'ESPECIALITAT','ricca3-alum'), $row["nomespecialitat"],strtoupper($row["sessio"]));
	printf('<br><table class="cap"><tr><td width="650">', NULL);
	printf('%s<b> %s</b></td><td width="250"></td></tr><tr><td>', __('Domicili durant el curs','ricca3-alum'), $row_alu["residenciacurs"] );
	printf('%s<b> %s</b></td><td>',                               __('Població','ricca3-alum'), $row_alu['ciutatcurs'] );
	printf('%s<b> %s</b></td></tr><tr><td>',                      __('Codi Postal','ricca3-alum'), $row_alu['codpostalcurs'] );
	printf('%s<b> %s</b></td><td></td></tr><tr><td>',             __('Estudis anteriors','ricca3-alum'), $row_alu['estudisrealitzats'] );
	printf('%s<b> %s</b></td><td></td></tr><tr><td>',             __('Centre estudis anteriors','ricca3-alum'), $row_alu['centreea'] );
	printf('%s<b> %s</b></td><td></td></tr></table><table class="cap"><tr><td width="100"></td><td width="400"><table class="cap"><tr><td>', __('Població estudis anteriors','ricca3-alum'), $row_alu['poblacioea'] );
	printf('%s</td></tr></table></td><td width="300"><table class="cos"><tr><td width="300" align="right">%s € </td></tr></table></td></tr></table><table class="cap"><tr><td>', 
		__('Abonament en concepte<br>d\'inscripció (*):','ricca3-alum'), $_GET['abona'] );
	printf('%s</td></tr></table><br><table class="cap"><tr><td width="500">', __('* L\'inscripció no es retornarà en cas de baixa.','ricca3-alum'));
	printf('%s %s</td><td>', __('Data d\'inscripció','ricca3-alum'), $_GET['data']);
	printf('%s</td></tr></table><br><br><br><br><br><p style="text-align: justify;">', __('Signatura','ricca3-alum'));
	_e('<b>Clàusula de Protecció de Dades Personals:</b> D\'acord amb els principis disposats en la Llei Orgànica 15/1999, de 13 de desembre,
		de Protecció de Dades Personals, l\'informem que les seves dades personals s\'incorporaran a un fitxer de dades personals, titularitat de
		ESCOLA DE FORMACIÓ PROFESSIONAL RAMON I CAJAL, SCCL, amb domicili a C/Roselló 303 Baixos, Barcelona (08037), degudament inscrit al
		registre de Fitxers de l\'Agència Espanyola de Protecció de Dades. L\'informem que les seves dades són tractats confidencialment i són
		utilitzats exclusivament de manera interna i per a les finalitats indicades. Per tant, no cedim ni comuniquem a cap tercer les seves
		dades, llevat que siguin necessaris per a la prestació del servei contractat, o en els casos legalment previstos.','ricca3-alum');
}

#############################################################################################
/**
 * primera pàgina per a la caratula
 * shortcode: [ricca3-caratula]
 *
 * @since ricca3.v.2013.19.1
 * @author Efraim Bayarri
 */
#############################################################################################
function ricca3_shortcode_caratula($atts, $content = null) {
	global $wpdb;
	global $ricca3_butons_editardades;
//		pantalla inicial
	$row_alu = $wpdb->get_row($wpdb->prepare('SELECT * FROM ricca3_alumne WHERE idalumne=%s', $_GET['ID']), ARRAY_A, 0);
	$image_attributes = ricca3_miniatura($_GET['ID']);
//		missatge de capçalera de la pàgina
	ricca3_missatge(sprintf('%s %s</td><td><img src="%s" width="%s" height="%s">', __('Caràtula de l\'alumne','ricca3-alum'), $row_alu['cognomsinom'], $image_attributes[0], $image_attributes[1], $image_attributes[2] ));
	$token = array( 'espec' => $_GET['espec'], 'grup' => $_GET['grup'], 'any' => $_GET['any'], 'estat' => $_GET['estat'], 'repe' => $_GET['repe']);
//	ajuda al butons
	$ricca3_butons_editardades['texte'][0] = __('ajuda-editardades-especialitats', 'ricca3-alum');
	$ricca3_butons_editardades['texte'][1] = __('ajuda-editardades-dadesalumne',   'ricca3-alum');
	$ricca3_butons_editardades['texte'][2] = __('ajuda-editardades-alumnes', 'ricca3-alum');
//		mostrar la filera de butons
	ricca3_butons( $ricca3_butons_editardades, 6, $token );
//
	if(isset($_POST['accio']) && $_POST['accio'] == 'desar' && count($_POST['cbox']) == 1){
		$row_espec = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_alumespec_view WHERE idalumne = %s AND idespecialitat = %s',
				$_GET['ID'], $_POST['cbox']), ARRAY_A, 0);
		ricca3_missatge(sprintf('%s %s', __('Caràtula per l\'especialitat:','ricca3-alum'), $row_espec['nomespecialitat'] ));
		printf('<table><tr>', NULL);
		printf('<td><a href="%s/%s/?ID=%s&esp=%s" target="POPUPW" onsubmit="POPUPW = window.open("about:blank","POPUPW","width=800,height=650" >',site_url(), 'ricca3-impcaratula', $_GET['ID'], $_POST['cbox']);
		printf('<button type="button"><img src="%s/ricca3/imatges/ricca3-imprimir.png" border=0 /></button></a></td>',WP_PLUGIN_URL);
		printf('</tr></table>', NULL);
	}
	$data_view = $wpdb->get_results( $wpdb->prepare('SELECT DISTINCT idespecialitat, nomespecialitat, sessio FROM ricca3_alumespec_view WHERE idalumne = %s ORDER BY idany ',$_GET['ID']), ARRAY_A);
	printf('<form method="post" action="" name="cercar"><table dir="ltr" class="menucurt400">', NULL);
	for( $i = 0; $i < count( $data_view ); $i++ ){
		printf('<tr><td><INPUT type="radio" name="cbox" value="%s" title="%s" /></td><td title="%s" >%s %s</td></tr>',
		$data_view[$i]['idespecialitat'], __('ajuda-radio-butlleti','ricca3-alum'), __('ajuda-curs-butlleti','ricca3-alum'), $data_view[$i]['nomespecialitat'], $data_view[$i]['sessio'] );
	}
	printf('</table><table><tr><td>', NULL);
	ricca3_desar('accio', 'desar', __('ajuda-desar-especbutlleti', 'ricca3-alum'));
	printf('</td></tr></table></form>', NULL);	
}	

#############################################################################################
/**
 * imprimir caratula
 * shortcode: [ricca3-caratula]
 *
 * @since ricca3.v.2013.19.1
 * @author Efraim Bayarri
 */
#############################################################################################
function ricca3_shortcode_impcaratula($atts, $content = null) {
	global $wpdb;
	$row_any = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_any WHERE insc = 1', NULL),ARRAY_A,0);
	$row_alu = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_alumne WHERE idalumne = %s',$_GET['ID']),ARRAY_A,0);
	$row     = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_alumespec_view WHERE idalumne = %s AND idespecialitat = %s',
			$_GET['ID'], $_GET['esp']), ARRAY_A, 0);
	printf('<table class="cap"> 
				<tr>
					<td width="350px">
						<table class="cos2">
							<tr>
								<td class="cos" align="center" height="30px" width="350px">ESCOLA DE FP RAMON I CAJAL</td>
							</tr>
			                <tr>
								<td class="cos" align="center" heigth="90px" width="350px"><br />CICLES FORMATIUS DE GRAU SUPERIOR<br /> <br />CURS ACADÈMIC:  %s<br /><br /></td>
							</tr>
						</table>
					</td>
					<td width="50px"></td>
					<td width="350px">
						<table class="cos2">
							<tr>
								<td class="cos" height="20px" width="350px" align="center" colspan="2">%s %s</td>
							</tr>
			                <tr>
								<td class="cos" height="20px" width="60px">1er Cognom:</td><td class="cos" width="290px"><b>%s</b></td>
							</tr>
			                <tr>
								<td class="cos" height="20px" >2on Cognom:</td><td class="cos"><b>%s</b></td>
							</tr>
			                <tr>
								<td class="cos" height="20px" >Nom:       </td><td class="cos"><b>%s</b></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<br />
			<table class="cap">
				<tr>
					<td width="600px">
						<table class="cos2">
							<tr>
								<td class="cos" height="20px" width="150px" colspan="2" rowspan="2" >Dades Personals</td>
								<td class="cos" height="20px" width="100px">Telèfon</td>
								<td class="cos" height="20px" width="350px">%s</td>
							</tr>
							<tr>
								<td class="cos" height="20px" width="100px">Mobil</td>
								<td class="cos" height="20px" width="350px">%s</td>
							</tr>
							<tr>
								<td class="cos" height="20px" width="150px" >Adreça</td>
								<td class="cos" height="20px" colspan="3"   >%s</td>
							</tr>
							<tr>
								<td class="cos" height="20px" width="150px" >Població</td>
								<td class="cos" height="20px" colspan="3"   >%s</td>
							</tr>
							<tr>
								<td class="cos" height="20px" width="150px" >Codi Postal</td>
								<td class="cos" height="20px" colspan="3"   >%s</td>
							</tr>
						</table>
					</td>
					<td width="50px"></td>
					<td width="300px">
						<table class="cos2">
							<tr>
								<td class="cos" height="20px" width="300px">%s</td>
							</tr>
							<tr>
								<td class="cos" height="20px" ><b></b></td>
							</tr>
							<tr>
								<td class="cos" height="20px" ><b></b></td>
							</tr>
							<tr>
								<td class="cos" height="20px" ><b></b></td>
							</tr>
							<tr>
								<td class="cos" height="20px" ><b></b></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<br />
			<table class="cap">
				<tr>	
					<td width="100px">
					</td>
					<td width="750px">
						<table class="cos2" >
							<tr>
								<td class="cos" height="20px" width="250px" align="center">Estudis</td>
								<td class="cos" height="20px" width="250px" align="center">Nom del Centre</td>
								<td class="cos" height="20px" width="250px" align="center">Localitat</td>
							</tr>
							<tr>
								<td class="cos" height="20px" >%s</td>
								<td class="cos" height="20px" >%s</td>
								<td class="cos" height="20px" >%s</td>
							</tr>
							<tr>
								<td class="cos" height="20px" ></td>
								<td class="cos" height="20px" ></td>
								<td class="cos" height="20px" ></td>
							<tr>
							<tr>
								<td class="cos" height="20px" ></td>
								<td class="cos" height="20px" ></td>
								<td class="cos" height="20px" ></td>
							<tr>
							<tr>
								<td class="cos" height="20px" ></td>
								<td class="cos" height="20px" ></td>
								<td class="cos" height="20px" ></td>
							<tr>
						</table>
					</td>
				</tr>
			</table>',
			$row_any['any'], $row['nomespecialitat'], $row['sessio'], $row_alu['cognom1'], $row_alu['cognom2'], $row_alu['nom'],
			$row_alu['telefonfixe'], $row_alu['telefon'], $row_alu['residenciahabitual'], $row_alu['ciutathabitual'], $row_alu['codipostal'],
			$row_alu['email'], $row_alu['estudisrealitzats'], $row_alu['centreea'], $row_alu['poblacioea']
	);
}

	
#############################################################################################
/**
 * Marcar com a repetidor d'una especialitat
 * shortcode: [ricca3-especrepe]
 *
 * @since ricca3.v.2013.19.1
 * @author Efraim Bayarri
 */
#############################################################################################
function ricca3_shortcode_especrepe($atts, $content = null) {
	global $wpdb;
	global $ricca3_butons_editardades;
	global $ricca3_especrepe;
	global $current_user;
	
	get_currentuserinfo();
	if( isset($_POST['cbox']) && $_POST['accio'] == 'actualitzar'){
		for( $i=0; $i < count($_POST['cbox']); $i++){
			$row = $wpdb->get_row( $wpdb->prepare('SELECT repeteix from ricca3_alumne_especialitat WHERE idalumespec = %s' , $_POST['cbox'][$i] ),ARRAY_A,0);
			if($row['repeteix'] == "R"){
				$wpdb->update('ricca3_alumne_especialitat', array ( 'repeteix' => NULL , 'stampuser' => $current_user->user_login, 'stampplace' => 'ricca_shortcode_especrepe' ) , array( 'idalumespec' => $_POST['cbox'][ $i ] ) );
			}else{
				$wpdb->update('ricca3_alumne_especialitat', array ( 'repeteix' => 'R',   'stampuser' => $current_user->user_login, 'stampplace' => 'ricca_shortcode_especrepe' ) , array( 'idalumespec' => $_POST['cbox'][ $i ] ) );
			}
		}
	}	
	$row_alu = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_alumne where idalumne = %s',$_GET['ID']),ARRAY_A,0);
	$image_attributes = ricca3_miniatura($_GET['ID']);
//		missatge de capçalera de la pàgina
	ricca3_missatge(sprintf('%s %s</td><td><img src="%s" width="%s" height="%s">', __('Marcar com a repetidor d\'una especialitat o curs de l\'alumne','ricca3-alum'), $row_alu['cognomsinom'], $image_attributes[0], $image_attributes[1], $image_attributes[2] ));
	$token = array( 'espec' => $_GET['espec'], 'grup' => $_GET['grup'], 'any' => $_GET['any'], 'estat' => $_GET['estat'], 'repe' => $_GET['repe']);
//	ajuda al butons
	$ricca3_butons_editardades['texte'][0] = __('ajuda-editardades-especialitats', 'ricca3-alum');
	$ricca3_butons_editardades['texte'][1] = __('ajuda-editardades-dadesalumne',   'ricca3-alum');
	$ricca3_butons_editardades['texte'][2] = __('ajuda-editardades-alumnes', 'ricca3-alum');
//		mostrar la filera de butons
	ricca3_butons( $ricca3_butons_editardades, 6, $token );
//		ajuda a la graella
	$ricca3_baixaespec['ajuda'][1] = __('ajuda-graella-baixaespec-motiu', 'ricca3-alum');
	$ricca3_baixaespec['ajuda'][2] = __('ajuda-graella-baixaespec-nom',   'ricca3-alum');
	$ricca3_baixaespec['ajuda'][3] = __('ajuda-graella-baixaespec-any',   'ricca3-alum');
	$ricca3_baixaespec['ajuda'][4] = __('ajuda-graella-baixaespec-espec', 'ricca3-alum');
	$ricca3_baixaespec['ajuda'][5] = __('ajuda-graella-baixaespec-grup',  'ricca3-alum');
	$ricca3_baixaespec['ajuda'][6] = __('ajuda-graella-baixaespec-estat', 'ricca3-alum');
//		buscar especialitats
	$data_view = $wpdb->get_results( $wpdb->prepare('SELECT * FROM ricca3_alumespec_view WHERE idalumne = %s ORDER BY idespecialitat, idany ',$_GET['ID']), ARRAY_A);
	//		llistat de les especialitats del alumne
	printf('<form method="post" action="" target="_self" name="Baixes" id="especrepe">', NULL);
	ricca3_graella( $ricca3_especrepe, $data_view, $token );
	printf('</table>', NULL);
	ricca3_desar('accio', 'actualitzar', __('ajuda-desar-especrepe', 'ricca3-alum'));
	printf('</td></tr></table></form>', NULL);	
}

#############################################################################################
/**
 * Canviar any especialitat
 * shortcode: [ricca3-canviany]
 *
 * @since ricca3.v.2013.19.2
 * @author Efraim Bayarri
 */
#############################################################################################
function ricca3_shortcode_canviany($atts, $content = null) {
	global $wpdb;
	global $ricca3_butons_editardades;
	global $ricca3_canviany;
	global $current_user;
	
	get_currentuserinfo();
	if( isset( $_POST['cbox']) && $_POST['crear'] == 'escollir'){
		$ricca3_canviany['radio'][0] = $_POST['cbox'];
	}
	if( isset( $_POST['cbox'] ) && $_POST['crear'] == 'data'){
		$row      = $wpdb->get_row($wpdb->prepare('SELECT * FROM ricca3_alumne_especialitat WHERE idalumespec=%s', $_POST['cbox']), ARRAY_A, 0);
		$row_grup = $wpdb->get_row($wpdb->prepare('SELECT * FROM ricca3_grups WHERE idgrup="%s"', $row['idgrup']), ARRAY_A, 0);
		$wpdb->update('ricca3_alumne_especialitat' , array( 'idany' => $_POST['any'], 'stampuser' => $current_user->user_login, 'stampplace' => 'ricca_shortcode_canviany' ) , array( 'idalumespec' => $_POST['cbox'] ) );
		$dades = $wpdb->get_results($wpdb->prepare('SELECT * FROM ricca.ricca3_credits_avaluacions '.
			'INNER JOIN ricca3_ccomp ON ricca3_ccomp.idccomp = ricca3_credits_avaluacions.idccomp '.
			'INNER JOIN ricca3_credits ON ricca3_credits.idcredit = ricca3_ccomp.idcredit '.
			'WHERE idalumne=%s AND idany="%s" AND idespecialitat="%s"',
			$_GET['ID'], $row['idany'], $row_grup['idespecialitat']), 
			ARRAY_A);
		for( $i=0; $i < count($dades); $i++){
			$wpdb->update('ricca3_credits_avaluacions' , array( 'idany' => $_POST['any'], 'stampuser' => $current_user->user_login, 'stampplace' => 'ricca_shortcode_canviany' ) , array( 'idcredaval' => $dades[$i]['idcredaval']) );
		}
	}
	$row_alu = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_alumne where idalumne = %s',$_GET['ID']),ARRAY_A,0);
	$image_attributes = ricca3_miniatura($_GET['ID']);
//		missatge de capçalera de la pàgina
	ricca3_missatge(sprintf('%s %s</td><td><img src="%s" width="%s" height="%s">', __('Canviar any d\'especialitat de l\'alumne','ricca3-alum'), $row_alu['cognomsinom'], $image_attributes[0], $image_attributes[1], $image_attributes[2] ));
	$token = array( 'espec' => $_GET['espec'], 'grup' => $_GET['grup'], 'any' => $_GET['any'], 'estat' => $_GET['estat'], 'repe' => $_GET['repe']);
//	ajuda al butons
	$ricca3_butons_editardades['texte'][0] = __('ajuda-editardades-especialitats', 'ricca3-alum');
	$ricca3_butons_editardades['texte'][1] = __('ajuda-editardades-dadesalumne',   'ricca3-alum');
	$ricca3_butons_editardades['texte'][2] = __('ajuda-editardades-alumnes', 'ricca3-alum');
//		mostrar la filera de butons
	ricca3_butons( $ricca3_butons_editardades, 6, $token );
//		ajuda a la graella
	$ricca3_baixaespec['ajuda'][1] = __('ajuda-graella-baixaespec-motiu', 'ricca3-alum');
	$ricca3_baixaespec['ajuda'][2] = __('ajuda-graella-baixaespec-nom',   'ricca3-alum');
	$ricca3_baixaespec['ajuda'][3] = __('ajuda-graella-baixaespec-any',   'ricca3-alum');
	$ricca3_baixaespec['ajuda'][4] = __('ajuda-graella-baixaespec-espec', 'ricca3-alum');
	$ricca3_baixaespec['ajuda'][5] = __('ajuda-graella-baixaespec-grup',  'ricca3-alum');
	$ricca3_baixaespec['ajuda'][6] = __('ajuda-graella-baixaespec-estat', 'ricca3-alum');
//		buscar especialitats
	$data_view = $wpdb->get_results( $wpdb->prepare('SELECT * FROM ricca3_alumespec_view WHERE idalumne = %s ORDER BY idespecialitat, idany ',$_GET['ID']), ARRAY_A);
//		llistat de les especialitats del alumne
	printf('<form method="post" action="" target="_self" name="Baixes" id="especrepe">', NULL);
	ricca3_graella( $ricca3_canviany, $data_view, $token );
	printf('</table>', NULL);
	if( !isset( $_POST['cbox']) || $_POST['crear'] == 'data'){
		printf('<tr><td><button type="submit" name="crear" value="escollir"><font size ="1px" face="Arial, Helvetica, sans-serif">', NULL);
		printf('%s</font></button></td></tr></table></form>', __('Guardar dades','ricca3-alum'));
	}
	if(isset($_POST['cbox']) && $_POST['crear'] == 'escollir'){
		printf('<form method="post" action="" name="cercar"><table dir="ltr" class="cercar"><tr>', NULL);
		
		//		drop per el any
		$data_any = $wpdb->get_results('SELECT * FROM ricca3_any', ARRAY_A );
		ricca3_drop_any( __('Any:','ricca3-alum'), 'any', $data_any, 'idany', 'any', __('ajuda_drop_any', 'ricca3-alum'), 'actual' );
		
		printf('<input type="hidden" name="cbox" value="%s" />', $_POST['cbox']);
		printf('</tr><tr><td><button type="submit" name="crear" value="data"><font size ="1px" face="Arial, Helvetica, sans-serif">', NULL);
		printf('%s</font></button></td></tr></table></form>', __('Guardar dades','ricca3-alum'));
	}
}

#############################################################################################
/**
 * Mailings
 * shortcode: [ricca3-mailings]
 *
 * @since ricca3.v.2013.19.2
 * @author Efraim Bayarri
 */
#############################################################################################
function ricca3_shortcode_mailings($atts, $content = null) {
	global $wpdb;
	global $ricca3_butons_cercalumne;
	global $ricca3_mailings;
//		missatge de capçalera de la pàgina
	ricca3_missatge(__('Mailings','ricca3-alum'));
//		crear token
	$token = array( 'espec' => $_GET['espec'], 'grup' => $_GET['grup'], 'any' => $_GET['any'], 'estat' => $_GET['estat'], 'repe' => $_GET['repe']);
//		preparar ajudes als butons
	$ricca3_butons_cercalumne['texte'][0] = __('ajuda-alumnes', 'ricca3-alum');
//		mostrar la filera de butons
	ricca3_butons( $ricca3_butons_cercalumne, 6, $token );	
//	
	if( !isset( $_POST['cercar'] ) ){
		if( !isset( $_POST['grup']) )  $_POST['grup']  = $_GET['grup'];
		if( !isset( $_POST['espec']) ) $_POST['espec'] = $_GET['espec'];
		if( !isset( $_POST['any']) )   $_POST['any']   = $_GET['any'];
		if( !isset( $_POST['estat']) ) $_POST['estat'] = $_GET['estat'];
		if( !isset( $_POST['repe']) )  $_POST['repe']  = $_GET['repe'];
		printf('<form method="post" action="" name="cercar"><table dir="ltr" class="cercar"><tr>', NULL);
		printf('<td><button type="submit" name="cercar" value="actualitzar" title="%s"><img src=%s/ricca3/imatges/ricca3-llistar.png  border="0" /></button></td>', __('ajuda-llistar-alumnes', 'ricca3-alum'), WP_PLUGIN_URL);
//		drop per a especialitat	
		$data_espec = $wpdb->get_results('SELECT * FROM ricca3_especialitats WHERE actiu_es = 1 ORDER BY ordre_es ', ARRAY_A);
		ricca3_drop( __('Especialitat:','ricca3-alum'), 'espec', $data_espec, 'idespecialitat', 'nomespecialitat', __('ajuda_drop_especialitat', 'ricca3-alum'), FALSE );
//		pla d'estudis si especifiquem l'especialitat
		if(isset($_POST['espec']) && $_POST['espec'] != '-1')printf('<td>%s %s</td>', __('Pla:','ricca3-alum'), $row_espec['pla']);
//		drop per el grup
		$data_grup = $wpdb->get_results('SELECT * FROM ricca3_grups WHERE actiu_gr = 1 ORDER BY grup ', ARRAY_A );
		ricca3_drop( __('Grup:','ricca3-alum'), 'grup',  $data_grup,  'idgrup', 'grup',  __('ajuda_drop_ grup', 'ricca3-alum'), FALSE );
//		drop per el any
		$data_any = $wpdb->get_results('SELECT * FROM ricca3_any', ARRAY_A );
		ricca3_drop_any( __('Any:','ricca3-alum'), 'any', $data_any, 'idany', 'any', __('ajuda_drop_any', 'ricca3-alum'), 'actual' );
//		drop per el estat
		ricca3_drop_fixe( __('Estat:','ricca3-alum'),      'estat', array( "1" , "2"),        array( "alta", "baixa"),             __('ajuda_drop_estat', 'ricca3-alum') );
//		drop per els alumnes repetidors
		ricca3_drop_fixe( __('Repetidors:','ricca3-alum'), 'repe',  array( "si"   , "no"),    array( "si",    "no"),               __('ajuda_drop_repe', 'ricca3-alum') );
//		tanquem la barra de selecció
		printf('</tr></table></form>', NULL);
	}
//	Si ja hem fet la cerca, mostrar els resultats
	if( isset( $_POST['cercar'] ) && $_POST['cercar'] == "actualitzar" ){
		$query="SELECT * FROM ricca3_alumespec_view WHERE idany='".$_POST['any']."' ";
		if( $_POST['espec'] != "-1") $query = substr_replace( $query," AND idespecialitat = '".$_POST['espec']."' ",strlen( $query ) , 0 );
		if( $_POST['grup']  != "-1") $query = substr_replace( $query," AND idgrup='" .$_POST['grup']."' ", strlen( $query ) , 0 );
		if( $_POST['estat'] != "-1") $query = substr_replace( $query," AND idestat_es='"  .$_POST['estat']."' ",strlen( $query ) , 0 );
		if( $_POST['repe']  != "-1" && $_POST['repe'] == "si") { $query = substr_replace( $query," AND repeteix =  'R' ",strlen( $query ) , 0 );}
		if( $_POST['repe']  != "-1" && $_POST['repe'] == "no") { $query = substr_replace( $query," AND repeteix != 'R' ",strlen( $query ) , 0 );}
		$query=substr_replace( $query," ORDER BY cognomsinom ",strlen( $query ), 0 );
//	fem el query i guardem tots els resultats a $data_view
		$data_view = $wpdb->get_results( $query, ARRAY_A);
//	llistat del alumnes del filtre
		$ricca3_mailings['ajuda'][2] = __('ajuda-mailings-nom', 'ricca3-alum');
		$ricca3_mailings['ajuda'][3] = __('ajuda-mailings-email', 'ricca3-alum');
		$ricca3_mailings['ajuda'][4] = __('ajuda-mailings-grup', 'ricca3-alum');
		printf('<form method="post" action="" name="cercar">', NULL);
		ricca3_graella( $ricca3_mailings, $data_view, $token );
		printf('</table><table>', NULL);
		printf('<tr><td><button type="submit" name="cercar" value="escriure"><img src=%s/ricca3/imatges/ricca3-escriure.png " border="0" /></button></td></tr>',WP_PLUGIN_URL);
		printf('</table></form>', NULL);
	}
	if( isset($_POST['cercar'] ) && $_POST['cercar'] == "escriure" ){
		printf('<form method="post" action="" target="_self" name="mail"><table class="menucurt400"><tr><td>', NULL);
		printf('%s</td><td><textarea accesskey="" cols="20" rows="1" name="assumpte" title="assumpte">', __('<b>Assumpte:</b>', 'ricca3-alum'));
		printf('</textarea></td></tr></table>', NULL);
		
		wp_editor( __('Hola!','ricca3-alum'), 'ricca3mailings', array( 'textarea_name' => 'cos', 'media_buttons' => false) );
		printf('<table><tr><td>', NULL);
		for( $i = 0; $i < count($_POST['cbox']); $i++ ){
			printf('<input type="hidden" name="cbox[]" value=%s title="" class="" >', $_POST['cbox'][ $i ]);
		}
		printf('<button type="submit" name="cercar" value="fitxer"><img src=%s/ricca3/imatges/ricca3-enviar.png " border="0" /></button></td></tr></table></form>',WP_PLUGIN_URL);
	}
	if(isset($_POST['cercar']) && $_POST['cercar'] == "fitxer" ){
		ricca3_missatge(__('Desitja afegir un fitxer al correu electrónic?','ricca3-alum'));
		printf('<form action="" method="POST" enctype="multipart/form-data"><label for="file">Fitxer:</label>', NULL);
		printf('<input type="file" name="file" id="file" /><input type="submit" name="cercar" value="enviar" />
				<input type="hidden" name="cos" value="%s" />
				<input type="hidden" name="assumpte" value="%s" />',
				$_POST['cos'], $_POST['assumpte'] );
		for ($i=0; $i < count($_POST['cbox']); $i++){
				printf('<input type="hidden" name="cbox[%s]" value="%s" />', $i, $_POST['cbox'][$i]);
		}
		printf('</form>', NULL);
	}
	if(isset($_POST['cercar']) && $_POST['cercar'] == "enviar" ){
		if(strlen($_POST['assumpte'])< 1) $_POST['assumpte'] = '(Sense Asumpte)';
		$peu="<hr />
			<p style=\"margin-bottom:0cm;margin-bottom:.0001pt;background:white\"><strong><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;;mso-bidi-font-family:Arial;color:#222222\">ESCOLA DE FORMACI&Oacute; PROFESSIONAL RAMON I CAJAL</span></strong></p>
			<p style=\"margin:0cm;margin-bottom:.0001pt;background:white;orphans: 2; text-align:start;widows: 2;-webkit-text-size-adjust: auto;-webkit-text-stroke-width: 0px;word-spacing:0px\">
			<span style=\"font-size:9.0pt;font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;;mso-bidi-font-family:Arial;color:#222222\">
			SOCIETAT COOP. CATALANA LTDA. CENTRE HOMOLOGAT<br />
			Rosell&oacute; 303 Baixos - 08037 BARCELONA<br />
			93 207 06 80 - <a href=\"mailto:info@ramonycajal.com\" style=\"line-height: 1.6em;\" target=\"_blank\"><span style=\"color:#1155CC\">info@ramonycajal.com</span></a>
			</span></p><hr /><p align=\"JUSTIFY\" class=\"western\" lang=\"ca-ES\" style=\"margin-bottom: 0.35cm\"><font color=\"#4d4d4d\"><font face=\"Arial, sans-serif\"><font size=\"1\" style=\"font-size: 8pt\">Aquest correu electr&ograve;nic i els annexos poden contenir informaci&oacute; confidencial o protegida legalment i est&agrave; adre&ccedil;at exclusivament a la persona o entitat destinat&agrave;ria. Si no sou el destinatari final o la persona encarregada de rebre&rsquo;l, no esteu autoritzat a llegir-lo, retenir-lo, modificar-lo, distribuir-lo, copiar-lo ni a revelar-ne el contingut. Si heu rebut aquest correu electr&ograve;nic per error, us preguem que n&rsquo;informeu al remitent i que elimineu del sistema el missatge i el material annex que pugui contenir. Gr&agrave;cies per la vostra col&middot;laboraci&oacute;.&nbsp;</font></font></font></p>
		";
		$html_text=substr_replace($_POST['cos'], $peu, strlen($_POST['cos']),0);
//		$headers[] = 'From: escolaramonicajal@gmail.com';
		$headers[] = 'Reply-To: info@ramonycajal.com';
//		$headers[] = 'Return-Path: escolaramonicajal@gmail.com';
//		$headers[] = 'Errors-To: escolaramonicajal@gmail.com';
		add_filter('wp_mail_content_type',create_function('', 'return "text/html";'));
//
		move_uploaded_file($_FILES["file"]["tmp_name"], WP_CONTENT_DIR .'/uploads/'.basename($_FILES["file"]["name"]));
		$attachments = array(WP_CONTENT_DIR ."/uploads/".$_FILES["file"]["name"]);
		
// ONLY FOR DEBUG
//		if ( wp_mail( 'efraim.bayarri@gmail.com' , $_POST['assumpte'], $html_text, $headers, $attachments ) ){
//			printf('[OK] enviant correu a: efraim bayarri <br>');
//		}else{
//			printf('[Error] enviant correu a: efraim bayarri <br>');
//		}
// NO DEBUG
		for( $i = 0; $i < count($_POST['cbox']) ; $i++){
			$row = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_alumne WHERE idalumne=%s',$_POST['cbox'][$i]),ARRAY_A,0);
			if( strlen( $row['email'] ) > 0){
				if ( wp_mail( $row['email'] , $_POST['assumpte'], $html_text, $headers, $attachments ) ){
					printf('[OK] enviant correu a: %s %s, %s <br>', $row['cognom1'] , $row['cognom2'] , $row['nom']);
				}else{
					printf('[Error] enviant correu a: %s %s, %s <br>', $row['cognom1'] , $row['cognom2'] , $row['nom']);
				}
			}
		}
//	END
		unset($_POST['cercar']);
	}
}

#############################################################################################
/**
 * Alumnes amb crèdits pendents
 * shortcode: [ricca3-credpendents]
 *
 * @since ricca3.v.2013.19.2
 * @author Efraim Bayarri
 */
#############################################################################################
function ricca3_shortcode_credpendents($atts, $content = null) {
	global $wpdb;
	global $current_user;
	global $ricca3_alumpendi;
	global $ricca3_butons_credpendents;
	get_currentuserinfo();
	
	if(isset($_POST['crear']) && $_POST['crear'] == 'guardar'){
		for( $i = 0; $i < count($_POST['cbox']); $i++){
			$row_cre = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_credits_avaluacions '.
					'INNER JOIN ricca3_ccomp ON ricca3_ccomp.idccomp = ricca3_credits_avaluacions.idccomp '.
					'INNER JOIN ricca3_credits ON ricca3_credits.idcredit = ricca3_ccomp.idcredit '.
					'WHERE idcredaval = %s', $_POST['cbox'][$i] ), ARRAY_A, 0);
			$row_any = $wpdb->get_row( 'SELECT * FROM ricca3_any WHERE actual = 1', ARRAY_A, 0);
			$wpdb->update('ricca3_credits_avaluacions', array( 'pendi' => 'R' ), array( 'idcredaval' => $_POST['cbox'][$i] )	);
			$wpdb->insert('ricca3_credits_avaluacions',
					array(
							'idany'          => $row_any['idany'],
							'idccomp'        => $row_cre['idccomp'],
							'idalumne'       => $row_cre['idalumne'],
							'repe'           => 'R',
							'convord'        => $row_any['conv'],
							'stampuser'      => $current_user->user_login,
							'stampplace'     => 'ricca_shortcode_credpendents_insert'
					)
			);
			$result = $wpdb->query( $wpdb->prepare('SELECT * FROM ricca3_alumne_especialitat WHERE idalumne=%s AND idgrup=%s', $row_cre['idalumne'], $row_cre['idgrup'] ));
			if($result)	$wpdb->update('ricca3_alumne_especialitat', array( 'repeteix' => 'R', 'stampuser' => $current_user->user_login, 'stampplace' => 'ricca_shortcode_credpendents' ), 
										array('idalumne' => $row_cre['idalumne'], 'idgrup' => $row_cre['idgrup'] ) );
//	afegir especialitat als alumnes repetidors (no als que estan fent segon i tenen perndents de primer)
			if(!$wpdb->query($wpdb->prepare('SELECT * FROM ricca3_alumespec_view WHERE idalumne=%s AND idespecialitat=%s AND idany=%s ',
					$row_cre['idalumne'], $row_cre['idespecialitat'], $row_any['idany']))){
				$wpdb->insert('ricca3_alumne_especialitat', array('idalumne' => $row_cre['idalumne'], 'idgrup' => $row_cre['idgrup'], 'idany' => $row_any['idany'], 'idestat_es' => 1, 'repeteix' => 'R'));	
			}
			ricca3_missatge( __('Crèdit afegit correctament','ricca3-alum') );
		}
	}
//		missatge de capçalera de la pàgina
	ricca3_missatge(__('Alumnes amb crèdits pendents','ricca3-alum'));
//		crear token
	$token = array( 'espec' => $_GET['espec'], 'grup' => $_GET['grup'], 'any' => $_GET['any'], 'estat' => $_GET['estat'], 'repe' => $_GET['repe']);
//		preparar ajudes als butons
	$ricca3_butons_credpendents['texte'][0] = __('ajuda-alumnes', 'ricca3-alum');
//		mostrar la filera de butons
	ricca3_butons( $ricca3_butons_credpendents, 6, $token );
//		ajuda a la graella
	$ricca3_alumpendi['ajuda'][2] = __('ajuda-alumpendi-nom', 'ricca3-alum');
	$ricca3_alumpendi['ajuda'][3] = __('ajuda-alumpendi-any', 'ricca3-alum');
	$ricca3_alumpendi['ajuda'][4] = __('ajuda-alumpendi-cred', 'ricca3-alum');
//		buscar especialitats
	$data_view = $wpdb->get_results('SELECT ricca3_credits_avaluacions.idcredaval, '.
									'ricca3_alumne.idalumne, '.
									'ricca3_alumne.cognomsinom, '.
									'ricca3_credits_avaluacions.idany, '.
									'ricca3_any.any, '.
									'ricca3_ccomp.nomccomp, '.
									'ricca3_grups.grup '.
									'FROM ricca3_credits_avaluacions '. 
									'INNER JOIN ricca3_alumne ON ricca3_alumne.idalumne = ricca3_credits_avaluacions.idalumne '. 
									'INNER JOIN ricca3_any ON ricca3_any.idany = ricca3_credits_avaluacions.idany '.
									'INNER JOIN ricca3_ccomp ON ricca3_ccomp.idccomp = ricca3_credits_avaluacions.idccomp '.
									'INNER JOIN ricca3_grups ON ricca3_grups.idgrup = ricca3_ccomp.idgrup '.
									'WHERE pendi="P" ORDER BY cognomsinom ASC', ARRAY_A); 
//		llistat de les especialitats del alumne
	printf('<form method="post" action="" target="_self" name="Baixes" id="especrepe">', NULL);
	ricca3_graella( $ricca3_alumpendi, $data_view, $token );
	printf('</table><table><tr><td><button type="submit" name="crear" value="guardar"><font size ="1px" face="Arial, Helvetica, sans-serif">', NULL);
	printf('%s</td></tr></table></form>', __('Assignar crèdits als alumnes seleccionats','ricca3-alum'));
}

#############################################################################################
/**
 * Alumnes amb crèdits pendents per el curs actual
 * shortcode: [ricca3-credpendentsactual]
 *
 * @since ricca3.v.2013.40.5
 * @author Efraim Bayarri
 */
#############################################################################################
function ricca3_shortcode_pendactual($atts, $content = null) {
	global $wpdb;
	global $current_user;
	global $ricca3_alumpendi;
	global $ricca3_butons_cercalumne;
	get_currentuserinfo();

	if(isset($_POST['crear']) && $_POST['crear'] == 'guardar'){
		for( $i = 0; $i < count($_POST['cbox']); $i++){
			$row_cre = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_credits_avaluacions '.
					'INNER JOIN ricca3_ccomp ON ricca3_ccomp.idccomp = ricca3_credits_avaluacions.idccomp '.
					'INNER JOIN ricca3_credits ON ricca3_credits.idcredit = ricca3_ccomp.idcredit '.
					'WHERE idcredaval = %s', $_POST['cbox'][$i] ), ARRAY_A, 0);
			$row_any = $wpdb->get_row( 'SELECT * FROM ricca3_any WHERE actual = 1', ARRAY_A, 0);
			$wpdb->update('ricca3_credits_avaluacions', array( 'pendi' => 'R' ), array( 'idcredaval' => $_POST['cbox'][$i] )	);
			$wpdb->insert('ricca3_credits_avaluacions',
					array(
							'idany'          => $row_any['idany'],
							'idccomp'        => $row_cre['idccomp'],
							'idalumne'       => $row_cre['idalumne'],
							'repe'           => 'R',
							'convord'        => $row_any['conv'],
							'stampuser'      => $current_user->user_login,
							'stampplace'     => 'ricca_shortcode_credpendents_insert'
					)
			);
			$result = $wpdb->query( $wpdb->prepare('SELECT * FROM ricca3_alumne_especialitat WHERE idalumne=%s AND idgrup=%s', $row_cre['idalumne'], $row_cre['idgrup'] ));
			if($result)	$wpdb->update('ricca3_alumne_especialitat', array( 'repeteix' => 'R', 'stampuser' => $current_user->user_login, 'stampplace' => 'ricca_shortcode_credpendents' ),
					array('idalumne' => $row_cre['idalumne'], 'idgrup' => $row_cre['idgrup'] ) );
			//	afegir especialitat als alumnes repetidors (no als que estan fent segon i tenen perndents de primer)
			if(!$wpdb->query($wpdb->prepare('SELECT * FROM ricca3_alumespec_view WHERE idalumne=%s AND idespecialitat=%s AND idany=%s ',
					$row_cre['idalumne'], $row_cre['idespecialitat'], $row_any['idany']))){
				$wpdb->insert('ricca3_alumne_especialitat', array('idalumne' => $row_cre['idalumne'], 'idgrup' => $row_cre['idgrup'], 'idany' => $row_any['idany'], 'idestat_es' => 1, 'repeteix' => 'R'));
			}
			ricca3_missatge( __('Crèdit afegit correctament','ricca3-alum') );
		}
	}
	//		missatge de capçalera de la pàgina
	ricca3_missatge(__('Alumnes amb crèdits pendents en el curs actual','ricca3-alum'));
	//		crear token
	$token = array( 'espec' => $_GET['espec'], 'grup' => $_GET['grup'], 'any' => $_GET['any'], 'estat' => $_GET['estat'], 'repe' => $_GET['repe']);
	//		preparar ajudes als butons
	$ricca3_butons_cercalumne['texte'][0] = __('ajuda-alumnes', 'ricca3-alum');
	//		mostrar la filera de butons
	ricca3_butons( $ricca3_butons_cercalumne, 6, $token );
	//		ajuda a la graella
	$ricca3_alumpendi['ajuda'][2] = __('ajuda-alumpendi-nom', 'ricca3-alum');
	$ricca3_alumpendi['ajuda'][3] = __('ajuda-alumpendi-any', 'ricca3-alum');
	$ricca3_alumpendi['ajuda'][4] = __('ajuda-alumpendi-cred', 'ricca3-alum');
	//		buscar especialitats
	$data_view = $wpdb->get_results('SELECT ricca3_credits_avaluacions.idcredaval, '.
			'ricca3_alumne.idalumne, '.
			'ricca3_alumne.cognomsinom, '.
			'ricca3_credits_avaluacions.idany, '.
			'ricca3_any.any, '.
			'ricca3_ccomp.nomccomp, '.
			'ricca3_grups.grup, '.
			'ricca3_alumne_especialitat.idestat_es '.
			'FROM ricca3_credits_avaluacions '.
			'INNER JOIN ricca3_alumne ON ricca3_alumne.idalumne = ricca3_credits_avaluacions.idalumne '.
			'INNER JOIN ricca3_any ON ricca3_any.idany = ricca3_credits_avaluacions.idany '.
			'INNER JOIN ricca3_ccomp ON ricca3_ccomp.idccomp = ricca3_credits_avaluacions.idccomp '.
			'INNER JOIN ricca3_grups ON ricca3_grups.idgrup = ricca3_ccomp.idgrup '.
			'INNER JOIN ricca3_alumne_especialitat ON ricca3_alumne_especialitat.idalumne = ricca3_alumne.idalumne '.
			'AND ricca3_alumne_especialitat.idgrup = ricca3_grups.idgrup '.
			'WHERE pendi="P" AND idestat_es = 1 ORDER BY cognomsinom ASC', ARRAY_A);
	//		llistat de les especialitats del alumne
	printf('<form method="post" action="" target="_self" name="Baixes" id="especrepe">', NULL);
	ricca3_graella( $ricca3_alumpendi, $data_view, $token );
	printf('</table><table><tr><td><button type="submit" name="crear" value="guardar"><font size ="1px" face="Arial, Helvetica, sans-serif">', NULL);
	printf('%s</td></tr></table></form>', __('Assignar crèdits als alumnes seleccionats','ricca3-alum'));
}

#############################################################################################
/**
 * Preinscripcions per grup
 * shortcode: [ricca3-pregrup]
 *
 * @since ricca3.v.2013.19.2
 * @author Efraim Bayarri
 */
#############################################################################################
function ricca3_shortcode_pregrup($atts, $content = null) {
	global $wpdb;
	global $ricca3_butons_cercalumne;

	$query_grup = 'SELECT * FROM ricca3_grups WHERE actiu_gr = 1 ORDER by idcurs, grup';
	$res_grup = $wpdb->query($query_grup);
	$row_any = $wpdb->get_row( 'SELECT * FROM ricca3_any WHERE insc = 1', ARRAY_A, 0);
//		missatge de capçalera de la pàgina
	ricca3_missatge(sprintf('%s %s', __('Preinscripcions per grup per el curs ','ricca3-alum'), $row_any['any']));
//		crear token
	$token = array( 'espec' => $_GET['espec'], 'grup' => $_GET['grup'], 'any' => $_GET['any'], 'estat' => $_GET['estat'], 'repe' => $_GET['repe']);
//		preparar ajudes als butons
	$ricca3_butons_cercalumne['texte'][0] = __('ajuda-alumnes', 'ricca3-alum');
//		mostrar la filera de butons
	ricca3_butons( $ricca3_butons_cercalumne, 6, $token );

	

	printf('<table>', NULL);
	$tot = 0; $tot1 = 0; $tot1mati = 0; $tot1tarda= 0 ; $tot2 = 0; $tot2mati = 0; $tot2tarda = 0;
	for( $i = 0; $i < $res_grup; $i++){
		$row_grup = $wpdb->get_row( $query_grup, ARRAY_A, $i);
// Fem un INNER JOIN per tal de no incloure els alumnes esborrats
		$result = $wpdb->query( $wpdb->prepare('SELECT * FROM ricca3_alumne_especialitat '.
			'INNER JOIN ricca3_alumne ON ricca3_alumne.idalumne = ricca3_alumne_especialitat.idalumne '.
			'WHERE idany= %s AND idgrup = %s AND idestat_es = 1 ', 
			$row_any['idany'], $row_grup['idgrup']));
		$tot = $tot + $result;
		if( $row_grup['idcurs'] == 1){
			$tot1 = $tot1 + $result;
			if( $row_grup['sessio'] == 'Matí')  $tot1mati  = $tot1mati  + $result;
			if( $row_grup['sessio'] == 'Tarda') $tot1tarda = $tot1tarda + $result;
		}
		if( $row_grup['idcurs'] == 2){
			$tot2 = $tot2 + $result;
			if( $row_grup['sessio'] == 'Matí')  $tot2mati  = $tot2mati  + $result;
			if( $row_grup['sessio'] == 'Tarda') $tot2tarda = $tot2tarda + $result;
		}
		printf('<tr><td width="100px">%s</td><td><b>%s</b></td></tr>', $row_grup['grup'], $result);
	}
	printf('</table><table><tr><td>%s <b>%s</b> %s %s (%s %s, %s %s)  %s %s (%s %s, %s %s)</td></tr></table> ',
	__('TOTAL:','ricca3-alum'), $tot, __('Curs I:','ricca3-alum'), $tot1, __('Matí:','ricca3'), $tot1mati, __('Tarda:','ricca3-alum'),$tot1tarda,
	__('Curs II:','ricca3-alum'), $tot2, __('Matí:','ricca3-alum'), $tot2mati, __('Tarda:','ricca3-alum'), $tot2tarda);
}

#############################################################################################
/**
 * Afegir o esborrar un crèdit a un alumne
 * shortcode: [ricca3-afegircredit]
 *
 * @since ricca3.v.2013.24.7
 * @author Efraim Bayarri
 */
#############################################################################################
function ricca3_shortcode_afegircredit($atts, $content = null) {
	global $wpdb;
	global $ricca3_butons_editardades;
	global $ricca3_afegircredit;
	global $ricca3_afegircredit_sinradio;
	global $ricca3_afegircredit_ccomp;
	global $current_user;

	get_currentuserinfo();

	$row_alu = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_alumne where idalumne = %s',$_GET['ID']),ARRAY_A,0);
	$image_attributes = ricca3_miniatura($_GET['ID']);
//		missatge de capçalera de la pàgina
	ricca3_missatge(sprintf('%s %s</td><td><img src="%s" width="%s" height="%s">', __('Afegir o esborrar crèdits a l\'alumne','ricca3-alum'), $row_alu['cognomsinom'], $image_attributes[0], $image_attributes[1], $image_attributes[2] ));
	$token = array( 'espec' => $_GET['espec'], 'grup' => $_GET['grup'], 'any' => $_GET['any'], 'estat' => $_GET['estat'], 'repe' => $_GET['repe']);
//	ajuda al butons
	$ricca3_butons_editardades['texte'][0] = __('ajuda-editardades-especialitats', 'ricca3-alum');
	$ricca3_butons_editardades['texte'][1] = __('ajuda-editardades-dadesalumne',   'ricca3-alum');
	$ricca3_butons_editardades['texte'][2] = __('ajuda-editardades-alumnes', 'ricca3-alum');
//		mostrar la filera de butons
	ricca3_butons( $ricca3_butons_editardades, 6, $token );
//		Afegir crèdit
	if(isset( $_POST['accio']) && $_POST['accio'] == 'afegircredit_ccomp'){
		$row_ccomp = $wpdb->get_row( $wpdb->prepare( 'SELECT * FROM ricca3_ccomp_view WHERE idccomp=%s', $_POST['cbox']), ARRAY_A, 0);
		$row_any = $wpdb->get_row('SELECT * FROM ricca3_any WHERE actual=1', ARRAY_A,0);
		ricca3_missatge(sprintf('%s %s', __('Afegint el crèdit','ricca3-alum'),$row_ccomp['nomccomp']));
		$wpdb->insert('ricca3_credits_avaluacions',
				array(	'idany'      => $row_any['idany'],
						'idccomp'    => $_POST['cbox'],
						'idalumne'   => $_GET['ID'],
						'convord'    => $row_any['conv'],
						'stampuser'  => $current_user->user_login,
						'stampplace' => 'ricca_shortcode_credits_insert'
				));
		
		unset($_POST['accio']);
	}
//		Esborrar crèdit
	if( isset( $_POST['accio']) && $_POST['accio'] == 'esborrarcredit' && isset($_POST['cbox']) ){
		if( $wpdb->delete('ricca3_credits_avaluacions', array( 'idcredaval' => $_POST['cbox'] ) ) ){
			ricca3_missatge(__('Crèdit esborrat amb exit!!!','ricca3-alum'));
		}else{
			ricca3_missatge(__('ERROR!! esborrant crèdit','ricca3-alum'));
		}
		unset($_POST['accio']);
	}
//		Buscar credits de l'alumne
	$dades_cred = $wpdb->get_results( $wpdb->prepare('SELECT * FROM ricca3_credits_avaluacions '. 
				'INNER JOIN ricca3_ccomp ON ricca3_ccomp.idccomp=ricca3_credits_avaluacions.idccomp '. 
				'INNER JOIN ricca3_credits ON ricca3_credits.idcredit = ricca3_ccomp.idcredit  '.
				'INNER JOIN ricca3_especialitats ON ricca3_especialitats.idespecialitat = ricca3_credits.idespecialitat '. 
				'INNER JOIN ricca3_grups ON ricca3_grups.idgrup = ricca3_ccomp.idgrup  '.
				'INNER JOIN ricca3_any ON ricca3_any.idany = ricca3_credits_avaluacions.idany '. 
				'INNER JOIN ricca3_professors ON ricca3_professors.idprof = ricca3_ccomp.idprofessor '. 
				'WHERE idalumne=%s ORDER BY ricca3_credits_avaluacions.idany, ricca3_especialitats.idespecialitat, ordre_cr ', 
				$_GET['ID']), ARRAY_A);
//
	printf('<form method="post" action="" target="_self" name="credit" id="credit">', NULL);
//	si no està afegint, mostrem els radio buttons	
	if(!isset($_POST['accio'])){
		ricca3_graella( $ricca3_afegircredit, $dades_cred, $token );
		printf('</table>', NULL);
		ricca3_missatge(__('Esborrar crèdit','ricca3-alum'));
		ricca3_desar('accio', 'esborrarcredit', __('ajuda-desar-esborrarcredit', 'ricca3-alum'));
		printf('</td></tr></table>', NULL);
//	Si estem afegint, no mostrem els radio buttons		
	}else{
		ricca3_graella( $ricca3_afegircredit_sinradio, $dades_cred, $token );
		printf('</table>', NULL);
	}
//	Si estem afegint, mostrar els ccomps del grup
	if( isset( $_POST['accio'] ) && $_POST['accio'] == 'afegircredit_grup'){
		$row_grup = $wpdb->get_row($wpdb->prepare('SELECT grup FROM ricca3_grups WHERE idgrup=%s', $_POST['grup']), ARRAY_A,0);
		ricca3_missatge(sprintf('%s %s %s',__('Afegir crèdit per el grup:','ricca3-alum'),$row_grup['grup'], __('al any actual.','ricca3-alum')));
		$dades_ccomp = $wpdb->get_results( $wpdb->prepare( 'SELECT * FROM ricca.ricca3_ccomp_view WHERE idgrup=%s', $_POST['grup']), ARRAY_A);
		ricca3_graella( $ricca3_afegircredit_ccomp, $dades_ccomp, $token );
		printf('</table>', NULL);
		ricca3_desar('accio', 'afegircredit_ccomp', __('ajuda-afegirccomp-drop', 'ricca3-alum'));
//	Escollir el grup del qual volem afegir el ccomp		
	}else{
		ricca3_missatge(__('Afegir crèdit','ricca3-alum'));
		$dades_grup = $wpdb->get_results( $wpdb->prepare( 'SELECT DISTINCT ricca3_ccomp.idgrup, grup FROM ricca3_credits_avaluacions '.
				'INNER JOIN ricca3_ccomp ON ricca3_ccomp.idccomp=ricca3_credits_avaluacions.idccomp '.
				'INNER JOIN ricca3_grups ON ricca3_grups.idgrup = ricca3_ccomp.idgrup '.
				'WHERE idalumne=%s', $_GET['ID']), ARRAY_A);
		printf('<table dir="ltr" class="menucurt600"><tr>', NULL);
		ricca3_drop( __('Grup:','ricca3-alum'), 'grup', $dades_grup, 'idgrup', 'grup', __('ajuda_drop_afegircredit_grup', 'ricca3-alum'), TRUE );
		printf('</tr></table>', NULL);
		ricca3_desar('accio', 'afegircredit_grup', __('ajuda-afegircredit-drop', 'ricca3-alum'));
	}
	printf('</form>', NULL);
}

#############################################################################################
/**
 * Entrada manual de la nota final
 * shortcode: [ricca3-notafinal]
 *
 * @since ricca3.v.2013.24.7
 * @author Efraim Bayarri
 */
#############################################################################################
function ricca3_shortcode_notafinal($atts, $content = null) {
	global $wpdb;
	global $ricca3_butons_editardades;
	global $current_user;
	global $ricca3_notafmanual;

	get_currentuserinfo();

	$row_alu = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_alumne where idalumne = %s',$_GET['ID']),ARRAY_A,0);
	$image_attributes = ricca3_miniatura($_GET['ID']);
//		missatge de capçalera de la pàgina
	ricca3_missatge(sprintf('%s %s</td><td><img src="%s" width="%s" height="%s">', __('Entrada manual de la nota final de l\'alumne','ricca3-alum'), $row_alu['cognomsinom'], $image_attributes[0], $image_attributes[1], $image_attributes[2] ));
	$token = array( 'espec' => $_GET['espec'], 'grup' => $_GET['grup'], 'any' => $_GET['any'], 'estat' => $_GET['estat'], 'repe' => $_GET['repe']);
//	ajuda al butons
	$ricca3_butons_editardades['texte'][0] = __('ajuda-editardades-especialitats', 'ricca3-alum');
	$ricca3_butons_editardades['texte'][1] = __('ajuda-editardades-dadesalumne',   'ricca3-alum');
	$ricca3_butons_editardades['texte'][2] = __('ajuda-editardades-alumnes', 'ricca3-alum');
//		mostrar la filera de butons
	ricca3_butons( $ricca3_butons_editardades, 6, $token );
//
	if(isset($_POST['accio']) && $_POST['accio'] == "entranota"){
		if( $wpdb->update('ricca3_alumne_especialitat', array( 'notaf_es_manual' => $_POST['notafmanual']), array( 'idalumespec' => $_POST['cbox']) ) ){
			ricca3_missatge( __('Nota Final Manual afegida amb exit!', 'ricca3-alum'));
		}else{
			ricca3_missatge( __('ERROR al afegir Nota Final Manual!!', 'ricca3-alum'));
		}
		unset($_POST['accio']);
	}	
//		ajuda a la graella
	$ricca3_notafmanual['ajuda'][1] = __('ajuda-graella-notafmanual-nom', 'ricca3-alum');
	$ricca3_notafmanual['ajuda'][2] = __('ajuda-graella-notafmanual-any', 'ricca3-alum');
	$ricca3_notafmanual['ajuda'][3] = __('ajuda-graella-notafmanual-espec', 'ricca3-alum');
	$ricca3_notafmanual['ajuda'][4] = __('ajuda-graella-notafmanual-grup', 'ricca3-alum');
	$ricca3_notafmanual['ajuda'][5] = __('ajuda-graella-notafmanual-notaf', 'ricca3-alum');
	$ricca3_notafmanual['ajuda'][6] = __('ajuda-graella-notafmanual-notaf-manual', 'ricca3-alum');
	
//		buscar especialitats del alumne
	$dades_espec = $wpdb->get_results( $wpdb->prepare('SELECT * FROM ricca3_alumespec_view WHERE idalumne = %s ORDER BY idespecialitat, idany ',
			$_GET['ID']), ARRAY_A);
//		llistat de les especialitats del alumne
	printf('<form method="post" action="" target="_self" name="Baixes" id="baixes">', NULL);
	ricca3_graella( $ricca3_notafmanual, $dades_espec, $token );
	printf('</table>', NULL);
	if(!isset($_POST['accio'])){		
		ricca3_desar('accio', 'notafmanual', __('ajuda-desar-notafmanual', 'ricca3-alum'));
		printf('</td></tr></table></form>', NULL);
	}else{
		if(!isset($_POST['cbox'])){
			ricca3_missatge(__('Escolliu una especialitat si us plau.', 'ricca3-alum'));
			ricca3_desar('accio', 'notafmanual', __('ajuda-desar-notafmanual', 'ricca3-alum'));
			printf('</td></tr></table></form>', NULL);
		}else{
			$row = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_alumespec_view WHERE idalumespec=%s ', $_POST['cbox']), ARRAY_A, 0);
			ricca3_missatge(sprintf('%s %s', __('Entrada manual de nota final per a l\'especialitat','ricca3-alum'), $row['nomespecialitat']));
			printf('<table><tr><td title="%s">%s<INPUT type="text" name="notafmanual" size="5" value="" pattern="[0-9. ]{1,}" /><INPUT type="hidden" name="cbox" value="%s" /> </td></tr></table>',
				__('ajuda-notafmanual', 'ricca3_alum'), __('Nota Manual', 'ricca3-alum'), $_POST['cbox'] );
			ricca3_desar('accio', 'entranota', __('ajuda-desar-entranota', 'ricca3-alum'));
			printf('</td></tr></table></form>', NULL);
		}
	}	
}

#############################################################################################
/**
 * Esborrar alumne
 * shortcode: [ricca3-esborraalumne]
 *
 * @since ricca3.v.2013.32.1
 * @author Efraim Bayarri
 */
#############################################################################################
function ricca3_shortcode_esborraalumne($atts, $content = null) {
	global $wpdb;
	global $ricca3_butons_editardades;
	
//		buscar les dades del alumne
	$row = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_alumne where idalumne = %s ',$_GET['ID']),ARRAY_A,0);
//		missatge de capçalera de la pàgina
	ricca3_missatge(sprintf('%s %s', __('Esborrar dades de l\'Alumne','ricca3-alum'), $row['cognomsinom']));
	
	$token = array( 'espec' => $_GET['espec'], 'grup' => $_GET['grup'], 'any' => $_GET['any'], 'estat' => $_GET['estat'], 'repe' => $_GET['repe']);
//		preparar ajudes als butons
	$ricca3_butons_editardades['texte'][0] = __('ajuda-editardades-especialitats', 'ricca3-alum');
	$ricca3_butons_editardades['texte'][1] = __('ajuda-editardades-dadesalumne',   'ricca3-alum');
	$ricca3_butons_editardades['texte'][2] = __('ajuda-editardades-alumnes', 'ricca3-alum');
//		mostrar la filera de butons
	ricca3_butons( $ricca3_butons_editardades, 6, $token );
	if(isset($_POST['esborrar']) && $_POST['esborrar'] == 'esborrar'){
//		esborrar primer l'historial
		$wpdb->delete('ricca3_historial', array('idalumne' => $_GET['ID']));
//		
		if( $wpdb->delete('ricca3_alumne', array('idalumne' => $_GET['ID']) ) ){
			ricca3_missatge( __('Alumne esborrat amb exit!', 'ricca3-alum'));
		}else{
			ricca3_missatge( __('NO s\'ha pogut esborrar l\'alumne! Comproveu que no té ni crèdits ni especialitats assignades abans d\'esborrar.', 'ricca3-alum'));
		}
	}else{
//	imatge
		$attachment_id = $row['attachment_id'];
		if( strlen($attachment_id < 1 )) $attachment_id = 228;
		$image_attributes = wp_get_attachment_image_src( $attachment_id, 'full' ); // returns an array
		printf('<img src="%s" width="141" height="177">', $image_attributes[0] );
		printf('<form method="post" action="" target="_self" name="editardades" id="myform"><table><tr class="credit"><td>%s %s<button type="submit" name="esborrar" value="esborrar" title="%s"><font size ="1px" face="Arial, Helvetica, sans-serif">%s</font></button></td></tr></table></form>',
			__('Esteu a punt d\'esborrar l\'alumne:', 'ricca3-alum'), $row['cognomsinom'], __('ajuda-esborra-esborra', 'ricca3-alum') , __('Esborrar alumne','ricca3-alum'));
	}
}

#############################################################################################
/**
 * Alumnes sense especialitat
 * shortcode: [ricca3-alumnes-sense-especialitat]
 *
 * @since ricca3.v.2013.32.1
 * @author Efraim Bayarri
 */
#############################################################################################
function ricca3_shortcode_alumnes_sense_especialitat($atts, $content = null) {
	global $wpdb;
	global $ricca3_butons_editardades;
	
	dump_r($_POST);
	
//		missatge de capçalera de la pàgina
	ricca3_missatge(sprintf('%s', __('Alumnes sense especialitat','ricca3-alum')));
	
	$token = array( 'espec' => $_GET['espec'], 'grup' => $_GET['grup'], 'any' => $_GET['any'], 'estat' => $_GET['estat'], 'repe' => $_GET['repe']);
//		preparar ajudes als butons
	$ricca3_butons_editardades['texte'][0] = __('ajuda-editardades-especialitats', 'ricca3-alum');
	$ricca3_butons_editardades['texte'][1] = __('ajuda-editardades-dadesalumne',   'ricca3-alum');
	$ricca3_butons_editardades['texte'][2] = __('ajuda-editardades-alumnes', 'ricca3-alum');
//		mostrar la filera de butons
	ricca3_butons( $ricca3_butons_editardades, 6, $token );
//
	$dades_alum = $wpdb->get_results( 'SELECT * FROM ricca3_alumne ORDER BY idalumne', ARRAY_A);	
	printf('<table>', NULL);
	for( $i=0; $i < count($dades_alum); $i++){
		$result = $wpdb->query( $wpdb->prepare('SELECT * FROM ricca3_alumne_especialitat WHERE idalumne=%s', $dades_alum[$i]['idalumne']));
		if($result == 0){
//			echo 	$dades_alum[$i]['idalumne'],', ';
			printf('<tr><td><a href="%s/%s%s&espec=%s&grup=%s&any=%s&estat=%s&repe=%s">%s</a></td>' ,
				site_url(), 'ricca3-dadesalumne/?ID=', $dades_alum[$i]['idalumne'], $token['espec'], $token['grup'], $token['any'], $token['estat'], $token['repe'], $dades_alum[$i]['idalumne'] );
			printf('<td>%s</td>', $dades_alum[$i]['cognomsinom']);		
			
			printf('</tr>', NULL);
		}
	}
	printf('<table>', NULL);
}

