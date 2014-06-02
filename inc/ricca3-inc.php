<?php
## Release build 2013.27.5
#############################################################################################
/**
 * mostra la capçalera i el cos de la graella pasada
 *
 *
 * @since ricca3.v.2013.13.6
 * @author Efraim Bayarri
 * 
 * @param array $matriu matriu amb els tipus de data, noms dels camps, texte de la graella,..
 * @param array $data matriu amb el resultat del query a la base de dades ($wpdb->get_result);
 * @param string $token camp que conte el token a retornar amb els links (NULL = no hi ha token)
 *
 *  tipus de camps que es procesen:
 *blanc
 *ordre
 *link
 *token
 *bd
 *hidden
 *data
 *checkall
 *radio
 *
 */
#############################################################################################
function ricca3_graella( $matriu, $data, $token = null){
	global $wpdb;
	$num_cols = count( $matriu,1 ) / count( $matriu , 0 ) -1;

	if( count( $data ) == 0 ) return'';
//		capçalera	
	printf('<table id="datatable">', NULL);
	printf('<thead>', NULL);
	printf('<tr>', NULL);
	for( $i = 0; $i < $num_cols; $i++ ){
		if($matriu['tipus'][ $i ] == "checkall" ){
			if($matriu['nomeslect'][$i]){
				printf('<th><input type="checkbox" value="on" name="allbox" onclick="checkAll();"/></th>');
			}else{
				printf('<th><input type="checkbox" value="on" name="allbox" onclick="checkAll2();"/></th>');
			}
		}else{
			if(isset($matriu['ajuda'][ $i ])){
				printf('<th title="%s">%s</th>', $matriu['ajuda'][ $i ], $matriu['visual'][ $i ]);
			}else{
				printf('<th>%s</th>',$matriu['visual'][ $i ]);
			}
		}
	}
	printf('</tr>', NULL);
	printf('</thead>', NULL);
	printf('<tbody>', NULL);
//		cos
	for( $i = 0; $i < count( $data ); $i++) {
		printf('<tr>', NULL);
		for( $j = 0; $j < $num_cols; $j++){
//	blanc
			if ( $matriu['tipus'][ $j ] == 'blanc'){
				printf('<td></td>');
//	ordre
			}elseif( $matriu['tipus'][ $j ] == 'ordre'){
				printf('<td>%s</td>', $i+1);
//	link
			}elseif( $matriu['tipus'][ $j ] == 'link' ){
				if( $matriu['camp'][ $j ]  == "" ){
					printf('<td><a href="%s/%s">%s</a></td>', site_url(), $matriu['enllac'][ $j ], $matriu['texte'][ $j ] );
				}else{
					printf('<td><a href="%s/%s%s">%s</a></td>' , site_url(), $matriu['enllac'][ $j ], $data[ $i ][ $matriu['camp'][ $j ] ], $matriu['texte'][ $j ] );
				}
//token
			}elseif( $matriu['tipus'][ $j ] == 'token' ){
				$ajuda='';
				if(isset( $matriu['ajuda'][ $j ])) $ajuda = $matriu['ajuda'][ $j ];
				if( $matriu['camp'][ $j ]  == "" ){
					printf('<td title="%s"><a href="%s/%s?espec=%s&grup=%s&any=%s&estat=%s&repe=%s">%s</a></td>',    $ajuda, site_url(), $matriu['enllac'][ $j ], $token['espec'], $token['grup'], $token['any'], $token['estat'], $token['repe'], $matriu['texte'][ $j ] );
				}else{
					printf('<td title="%s"><a href="%s/%s%s&espec=%s&grup=%s&any=%s&estat=%s&repe=%s">%s</a></td>' , $ajuda, site_url(), $matriu['enllac'][ $j ], $data[ $i ][ $matriu['camp'][ $j ] ], $token['espec'], $token['grup'], $token['any'], $token['estat'], $token['repe'], $matriu['texte'][ $j ] );
				}
//	bd
			}elseif( $matriu['tipus'][ $j ] == 'bd' ){
				if( isset( $matriu['nomeslect'][ $j ]) && !$matriu['nomeslect'][ $j ] ){
					$ajuda='';
					if(isset( $matriu['ajuda'][ $j ])) $ajuda = $matriu['ajuda'][ $j ];  
					if(isset( $matriu['pattern'][ $j ] ) && strlen($matriu['pattern'][ $j ]) >1  ){
						printf('<td><INPUT type="text" name="%s[]" size="%s" value="%s" title="%s" pattern="%s" /></td>' , $matriu['nombd'][ $j ] , $matriu['tamany'][ $j ] , $data[ $i ][ $matriu['nombd'][ $j ] ], $ajuda, $matriu['pattern'][ $j ]);
					}else{
						printf('<td><INPUT type="text" name="%s[]" size="%s" value="%s" title="%s" /></td>' , $matriu['nombd'][ $j ] , $matriu['tamany'][ $j ] , $data[ $i ][ $matriu['nombd'][ $j ] ], $ajuda);
					}
				}else{
					if( isset($matriu['unic'][ $j ] ) && $matriu['unic'][$j]){
						if(count( $wpdb->get_results( $wpdb->prepare('SELECT * FROM ricca3_alumne_especialitat WHERE idalumne=%s AND idany=13 AND idestat_es=1 ', $data[$i]['idalumne']))) > 1){
 							printf('<td><b>%s</b></td>', $data[ $i ][ $matriu['nombd'][ $j ] ]);
						}else{
							printf('<td>%s</td>', $data[ $i ][ $matriu['nombd'][ $j ] ]);							
						}
					}else{
						printf('<td>%s</td>', $data[ $i ][ $matriu['nombd'][ $j ] ]);
					}
				}
//	hidden
			}elseif( $matriu['tipus'][ $j ] == 'hidden'){
				printf('<td><INPUT type="hidden" name="%s[]" value="%s" /></td>' , $matriu['nombd'][ $j ], $data[ $i ][$matriu['nombd'][ $j ]]);
//	hist
			}elseif( $matriu['tipus'][ $j ] == 'hist'){
//				if(strtolower( $row['idcurs'] ) == 'curs i'){
//					printf('<td><a href="%s/historial/?ID=%s&espec=%s&grup=%s&any=%s&estat=%s&repe=%s ">' , site_url() , $row['idalumne'] , $row['idespecialitat'], $token['grup'], $token['any'], $token['estat'], $token['repe'] );
//					_e('Historial Acadèmic de','ric-ca');
//					printf(' %s</a></td>' , $row['nomespecialitat']);
//					$query_hist = $wpdb->prepare('SELECT * FROM ricca_historial WHERE idalumne = %s AND idespecialitat = %s ', $row['idalumne'] , $row['idespecialitat']);
//					if( $result_hist = $wpdb->query( $query_hist )) printf('<td>si</td>', NULL);
//				}
//	data
			}elseif( $matriu['tipus'][ $j ] == 'data'){
				printf('<td>%s</td>' , date('d/m/Y', strtotime( $data[$i][ $matriu['nombd'][ $j ] ]) ) );
//	checkall
			}elseif($matriu['tipus'][ $j ] == 'checkall'){
				printf('<td><input type="checkbox" accesskey="" name="cbox[]" value="%s" title="" class="" ></td>' , $data[ $i ][ $matriu['nombd'][ $j ] ]);
//	radio
			}elseif( $matriu['tipus'][ $j ] == 'radio'){
				if( $matriu['radio'][ $j ] == ""){
					printf('<td><input type="radio" accesskey="" name="cbox" value="%s" title="" class="" ></td>' , $data[ $i ][ $matriu['nombd'][ $j ] ]);
				}else{
					if( $data[$i][ $matriu['nombd'][ $j ] ] == $matriu['radio'][ $j ] ){
						printf('<td><b>[X]</b></td>');
					}else{
						printf('<td><input disabled type="radio" accesskey="" name="cbox" value="%s" title="" class="" ></td>' , $data[ $i ][ $matriu['nombd'][ $j ] ]);
					}
				}
//	foto miniatura				
			}elseif( $matriu['tipus'][ $j ] == 'miniatura'){
				if( $matriu['camp'][ $j ]  != "" ){
					$image_attributes = ricca3_miniatura( $data[ $i ] [$matriu['camp'][ $j ] ] );
					printf('<td><a href="%s/%s%s&espec=%s&grup=%s&any=%s&estat=%s&repe=%s"><img src="%s" width="%s" height="%s"></a></td>', site_url(), $matriu['enllac'][ $j ], $data[ $i ][ $matriu['camp'][ $j ] ], $token['espec'], $token['grup'], $token['any'], $token['estat'], $token['repe'], $image_attributes[0], $image_attributes[1], $image_attributes[2] );
				}
//	any curs
			}elseif( $matriu['tipus'][ $j ] == 'any'){
				$any = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_any WHERE idany=%s', $data[ $i ][ $matriu['nombd'][ $j ] ] ), ARRAY_A, 0);
				printf('<td>%s</td>', $any['any']);
//	notafinal				
			}elseif( $matriu['tipus'][ $j ] == 'notaf'){
				if( $data[ $i ][ $matriu['notam'][ $j ] ] != 0){
					printf('<td>%s</td>', $data[ $i ][ $matriu['notam'][ $j ] ]);
				}else{
					if( $data[ $i ][ $matriu['nombd'][ $j ] ] < 5){
						printf('<td></td>', NULL);
					}else{
						printf('<td>%s</td>', $data[ $i ][ $matriu['nombd'][ $j ] ]);
					}
				}
			}
		}
		printf('</tr>');
	}
	printf('</tbody>', NULL);
	printf('</table>', NULL);
}


#############################################################################################
/**
 * mostra un missatge a la pàgina
 *
 * @since ricca3.v.2013.13.6
 * @author Efraim Bayarri
 * 
 * @param string $missatge missatge a mostrar
 */
#############################################################################################
function ricca3_missatge($missatge){
	printf('<table id="nom" class="nom"><tr><td align="right" class="nom">%s</td></tr></table>', $missatge);
}

#############################################################################################
/**
 * mostra un missatge a la pàgina
 *
 * @since ricca3.v.2014.6.5
 * @author Efraim Bayarri
 *
 * @param string $missatge missatge a mostrar
 */
#############################################################################################
function ricca3_missatge_petit($missatge){
	printf('<table id="nom" class="petit"><tr><td align="right" class="petit">%s</td></tr></table>', $missatge);
}

#############################################################################################
/**
 * mostra els butons de la pàgina.
 *
 * @since ricca3.v.2013.13.6
 * @author Efraim Bayarri
 * 
 * @param array $matriu matriu amb la definicio de l'imatge, el link, si tenim que incloure el ID de l'alumne i si el link es a la mateixa pàgina o a una nova
 * @param array $num_buttons numero de butons a mostrar (6 una linea, 12 dues linees)
 * @param string $token camp que conte el token a retornar amb els links (NULL = no hi ha token)
 *
 */
#############################################################################################
function ricca3_butons($matriu, $num_butons, $token = null){
	printf('<div id="butons"><table><tr>');
	for( $i = 0; $i < $num_butons; $i++ ){
		if($i == 6)	printf('</tr></tr>');
		if(isset($matriu['nova'][$i]) && $matriu['nova'][$i] ){
			printf('<td><a href="%s/%s/?ID=%s" target="POPUPW" onsubmit="POPUPW = window.open("about:blank","POPUPW","width=800,height=650" ><button type="button" title="%s"><img src="%s/ricca3/imatges/ricca3-%s.png" border=0 /></button></a></td>',site_url(), $matriu['enllac'][$i], $_GET['ID'], $matriu['texte'][$i], WP_PLUGIN_URL, $matriu['imatge'][$i] );
		}else{
			if($matriu['id'][$i]){
				if($token){
					printf('<td><form method="post" action="%s/%s/?ID=%s&espec=%s&grup=%s&any=%s&estat=%s&repe=%s"><button type="submit" title="%s"><img src="%s/ricca3/imatges/ricca3-%s.png" border=0 /></button></form></td>', site_url(), $matriu['enllac'][$i], $_GET['ID'], $token['espec'], $token['grup'], $token['any'], $token['estat'], $token['repe'], $matriu['texte'][$i], WP_PLUGIN_URL, $matriu['imatge'][$i] );
				}else{
					printf('<td><form method="post" action="%s/%s/?ID=%s">                                         <button type="submit" title="%s"><img src="%s/ricca3/imatges/ricca3-%s.png" border=0 /></button></form></td>', site_url(), $matriu['enllac'][$i], $_GET['ID'], $matriu['texte'][$i], WP_PLUGIN_URL, $matriu['imatge'][$i] );
				}
			}else{
				if($token){
					printf('<td><form method="post" action="%s/%s/?espec=%s&grup=%s&any=%s&estat=%s&repe=%s">      <button type="submit" title="%s"><img src="%s/ricca3/imatges/ricca3-%s.png" border=0 /></button></form></td>',site_url(), $matriu['enllac'][$i], $token['espec'], $token['grup'], $token['any'], $token['estat'], $token['repe'], $matriu['texte'][$i], WP_PLUGIN_URL, $matriu['imatge'][$i] );
				}else{
					printf('<td><form method="post" action="%s/%s/">                                               <button type="submit" title="%s"><img src="%s/ricca3/imatges/ricca3-%s.png" border=0 /></button></form></td>',site_url(), $matriu['enllac'][$i], $matriu['texte'][$i], WP_PLUGIN_URL, $matriu['imatge'][$i] );
				}
			}
		}
	}
	printf('</tr></table></div>');
}

#############################################################################################
/**
 * Crea una cel·la de taula amb un drop list amb valors de la base de dades. 
 * Si no s'especifica el tipus, mostra com a primer valor '--qualsevol--'
 *
 * @since ricca3.v.2013.13.6
 * @author Efraim Bayarri
 * 
 * @param string $texte texte del drop
 * @param string $nom_post nom amb el que es retornarà el valor a $_POST
 * @param array $dades array amb els valors del drop
 * @param string $camp_valor camp de la base de dades que contè el valor a retornar
 * @param string $camp_mostra camp de la base de dades que contè el valor a mostrar al drop
 * @param string $ajuda texte a mostrar com ajuda del drop
 * @param boolean $tipus NULL per mostrar l'opció 'qualsevol'
 *  
 */
#############################################################################################
function ricca3_drop($texte, $nom_post, $dades, $camp_valor, $camp_mostra, $ajuda, $tipus = null){
	printf('<td> %s', $texte );
	printf('<select name="%s" title="%s">', $nom_post, $ajuda );
	if( !$tipus) printf('<option value="-1">%s</option>', __('-- qualsevol --','ricca3-inc') );
	for( $i=0; $i < count( $dades ); $i++){
		if(isset($_POST[$nom_post]) && $_POST[$nom_post] != '-1' && $_POST[$nom_post] == $dades[$i][$camp_valor]){
			printf('<option selected="selected" value="%s">%s</option>', $dades[$i][ $camp_valor ] , $dades[$i][ $camp_mostra ] );
		}else{
			printf('<option                     value="%s">%s</option>', $dades[$i][ $camp_valor ] , $dades[$i][ $camp_mostra ] );
		}
	}
	printf('</select></td>');
}

#############################################################################################
/**
 * Crea una cel·la de taula amb un drop list per el any
 * Si no s'especifica el tipus, mostra com a primer valor '--qualsevol--'
 * Posibles valors: FALSE, actual i insc
 *
 * @since ricca3.v.2013.13.6
 * @author Efraim Bayarri
 * 
 * @param string $texte texte del drop
 * @param string $nom_post nom amb el que es retornarà el valor a $_POST
 * @param array $dades array amb els valors del drop
 * @param string $camp_valor camp de la base de dades que contè el valor a retornar
 * @param string $camp_mostra camp de la base de dades que contè el valor a mostrar al drop
 * @param string $ajuda texte a mostrar com ajuda del drop
 * @param mixed $tipus NULL per mostrar l'opció 'qualsevol', 'actiu' per preseleccionar el any actiu i 'insc' per preseleccionar el any d'isncripcions
 */
#############################################################################################
function ricca3_drop_any($texte, $nom_post, $dades, $camp_valor, $camp_mostra, $ajuda, $tipus = null){
	printf('<td> %s' , $texte );
	printf('<select name="%s" title="%s">', $nom_post, $ajuda );
	if( !$tipus) printf('<option value="-1">%s</option>', __('-- qualsevol --','ricca3-inc') );
	for( $i=0; $i < count( $dades ); $i++){
		if( !isset( $_POST['any'] ) && $dades[ $i ]['actual'] == 1 && $tipus == 'actual' ){
			printf('<option selected="selected" value="%s">%s</option>', $dades[ $i ][ $camp_valor ] , $dades[ $i ][ $camp_mostra ] );
		}elseif( !isset( $_POST['any'] ) && $dades[ $i ]['insc'] == 1 && $tipus == 'insc' ){
			printf('<option selected="selected" value="%s">%s</option>', $dades[ $i ][ $camp_valor ] , $dades[ $i ][ $camp_mostra ] );
		}else{
			if( isset($_POST['any']) && $_POST['any'] == $dades[ $i ]['idany']){
				printf('<option selected="selected" value="%s">%s</option>', $dades[ $i ][ $camp_valor ] , $dades[ $i ][ $camp_mostra ] );
			}else{
				printf('<option                     value="%s">%s</option>', $dades[ $i ][ $camp_valor ] , $dades[ $i ][ $camp_mostra ] );
			}
		}
	}
	printf('</select></td>');
}

#############################################################################################
/**
 * Crea una cel·la de taula amb un drop list amb valors passats a la funció
 *
 * @since ricca3.v.2013.13.6
 * @author Efraim Bayarri
 */
#############################################################################################
function ricca3_drop_fixe($texte, $nom_post, $valor_array, $mostra_array, $ajuda , $tipus = null){
	printf('<td> %s' , $texte );
	printf('<select name="%s" title="%s">', $nom_post, $ajuda );
	if( !$tipus) printf('<option value="-1">%s</option>', __('-- qualsevol --','ricca3-inc') );
	for( $i=0; $i < count($valor_array); $i++ ) {
		if(isset($_POST[$nom_post]) && $_POST[$nom_post] != '-1' && $_POST[$nom_post] == $valor_array[$i]){
			printf('<option selected="selected" value="%s">%s</option>', $valor_array[$i] , $mostra_array[$i] );
		}else{
			printf('<option                     value="%s">%s</option>', $valor_array[$i] , $mostra_array[$i] );
		}
	}
	printf('</select></td>');

	// 'Estat:','estat',array("alta","baixa"),array("alta","baixa")
	// 'Repetidors','repe', array("si","no"), array ("si","no")
}

#############################################################################################
/**
 * Crea una taula amb un un buto per desar les dades
 *
 * @since ricca3.v.2013.13.6
 * @author Efraim Bayarri
 * 
 * @param string $name nom del camp al array $_POST
 * @param string $value nom del valor del camp al array $_POST
 * @param string $ajuda texte d'ajuda a mostrar al buto
 * 
 */
#############################################################################################
function ricca3_desar($name, $value, $ajuda ){
	printf('<table><tr><td><button type="submit" name="%s" value="%s" title="%s"><font size ="1px" face="Arial, Helvetica, sans-serif">%s</font></button></td></tr></table>', $name, $value, $ajuda, __('Desar dades','ricca3-inc'));
}

#############################################################################################
/**
 * Crea una taula amb un un buto per desar les dades
 *
 * @since ricca3.v.2013.13.6
 * @author Efraim Bayarri
 *
 * @param string $name nom del camp al array $_POST
 * @param string $value nom del valor del camp al array $_POST
 * @param string $ajuda texte d'ajuda a mostrar al buto
 *
 */
#############################################################################################
function ricca3_desar_color($name, $value, $ajuda ){
	printf('<table><tr class="credit"><td><button type="submit" name="%s" value="%s" title="%s"><font size ="1px" face="Arial, Helvetica, sans-serif">%s</font></button></td></tr></table>', $name, $value, $ajuda, __('Desar dades','ricca3-inc'));
}

#############################################################################################
/**
 * torna els atributs del thumb de la foto del alumne
 *
 * @since ricca3.v.2013.16.1
 * @author Efraim Bayarri
 */
#############################################################################################
function ricca3_miniatura($idalumne){
	global $wpdb;
	$row_alum = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_alumne where idalumne = %s ',$idalumne),ARRAY_A,0);
	$attachment_id = $row_alum['attachment_id'];
	if( strlen($attachment_id < 2 )) $attachment_id = 228;
	$image_attributes = wp_get_attachment_image_src( $attachment_id , 'thumbnail');

	return $image_attributes;
}

#############################################################################################
/**
 * calcul de la nota final d'un crèdit
 *
 * @since ricca3.v.2014.6.1
 * @author Efraim Bayarri
 */
#############################################################################################
function ricca3_notafinal($userid,$idespecialitat,$idany){
	global $wpdb;
	global $current_user;

	get_currentuserinfo();
//	dades del alumne
	$row_alumne = $wpdb->get_row($wpdb->prepare('SELECT * FROM ricca3_alumne WHERE idalumne=%s', $userid), ARRAY_A, 0);
//	buscar especialitats del alumne
	$query = $wpdb->prepare( 'SELECT * FROM ricca3_alumne_especialitat '. 
		'INNER JOIN ricca3_grups ON ricca3_grups.idgrup =ricca3_alumne_especialitat.idgrup '.
		'WHERE idalumne=%s AND idany=%s AND idespecialitat=%s AND idestat_es=1 ',
		$userid, $idany, $idespecialitat);		
	$dades = $wpdb->get_results( $query, ARRAY_A );
	for( $i = 0; $i < count($dades); $i++ ){
//	buscar pla d'estudis de l'especialitat per saber quins credits ha de tenir el alumne
		$query = $wpdb->prepare('SELECT * FROM ricca3_credits_especialitat WHERE idespecialitat = %s ORDER BY ordre_cr_es', $dades[$i]['idespecialitat']);
		$dades_esp = $wpdb->get_results( $query, ARRAY_A );
##
//		dump_r($dades_esp);
##		
		
//	inicialitzar variables
		$aprovat = 1;
		$hores = 0;
		$acumulat = 0;
		$calcul = array();
		$suspes = 0;
		$np = 0;
		$sensenota = 0;
		$faltencreds = 0;
//	comprovar que el alumne te tots els credits amb nota final
		for ( $j = 0; $j < count($dades_esp); $j++ ){
			$query = $wpdb->prepare( 'SELECT * FROM ricca3_credits_avaluacions '.
				'INNER JOIN ricca3_ccomp ON ricca3_ccomp.idccomp = ricca3_credits_avaluacions.idccomp '.
				'INNER JOIN ricca3_grups ON ricca3_grups.idgrup = ricca3_ccomp.idgrup '.
				'INNER JOIN ricca3_especialitats ON ricca3_especialitats.idespecialitat = ricca3_grups.idespecialitat '.
				'WHERE idalumne=%s and idcredit=%s and pendi!="R" ORDER BY notaf_cr DESC', 
				$userid, $dades_esp[$j]['idcredit']);
			$res_cred = $wpdb->get_results( $query, ARRAY_A );
//	omplir nota final crèdits compartits
			if(count($res_cred) == 2 ){			
##
//				dump_r($query);
//				dump_r($res_cred);
##	
				if($res_cred[0]['notaf_cr'] == 0){
					$cc_notaf=0;
					$cc_nota=0;
					$cc_hores=0;
					$cc_tot=1;
					for( $k = 0; $k < count($res_cred); $k++){
						if(is_numeric($res_cred[$k]['notaf_cc']) && $cc_tot == 1){
							$cc_tot=1;
							$cc_nota = $cc_nota + ( $res_cred[$k]['notaf_cc'] * $res_cred[$k]['hores_cc']);
							$cc_hores = $cc_hores + $res_cred[$k]['hores_cc'];
						}else{
							$cc_tot=0;
						}
					}
//					echo '<br/>CC_TOT:',$cc_tot,' CC_NOTA:', $cc_nota,' CC_HORES:',$cc_hores;
					if($cc_tot == 1){
						$cc_notaf=sprintf('%01.0f', $cc_nota/$cc_hores);
//						echo ' CC_NOTAF:', $cc_notaf;
						for( $k = 0; $k < count($res_cred); $k++){
//							$wpdb->update('ricca3_credits_avaluacions', array( 'notaf_cr' => $cc_notaf ), array( 'idcredaval' => $res_cred[$k]['idcredaval']));
							ricca3_dbupdate('ricca3_credits_avaluacions', array( 'notaf_cr' => $cc_notaf ), array( 'idcredaval' => $res_cred[$k]['idcredaval']));
							$res_cred = $wpdb->get_results( $query, ARRAY_A );
						}
					}
				}else{
					for( $k = 0; $k < count($res_cred); $k++)
//						$wpdb->update('ricca3_credits_avaluacions', array( 'notaf_cr' => $res_cred[0]['notaf_cr'] ), array( 'idcredaval' => $res_cred[$k]['idcredaval']));
						ricca3_dbupdate('ricca3_credits_avaluacions', array( 'notaf_cr' => $res_cred[0]['notaf_cr'] ), array( 'idcredaval' => $res_cred[$k]['idcredaval']));
				}
			}
//
			if( count($res_cred) > 0 ){
				$row_credit = $wpdb->get_row($wpdb->prepare('SELECT * FROM ricca3_credits WHERE idcredit=%s', $res_cred[0]['idcredit']), ARRAY_A, 0);
				if(is_numeric($res_cred[0]['notaf_cr'])){
					$notaf = intval( $res_cred[0]['notaf_cr'] );
					if($notaf >= 5 ){
//						$wpdb->update('ricca3_credits_avaluacions', array( 'pendi' => '' ), array( 'idcredaval' => $res_cred[0]['idcredaval']) );
						ricca3_dbupdate('ricca3_credits_avaluacions', array( 'pendi' => '' ), array( 'idcredaval' => $res_cred[0]['idcredaval']) );
						$punts = ($notaf * $row_credit['hores_cr'])/10;
						$acumulat = $acumulat + $punts;
##
						printf('<br /> Crèdit %s de l\'especialitat %s aprovat amb un - %d , un total de %d hores amb %s punts (%s)',
							$row_credit['nomcredit'],$res_cred[0]['nomespecialitat'], $notaf, $row_credit['hores_cr'], $punts , $acumulat);
##
						$hores = $hores + $row_credit['hores_cr'];
						$calcul['nomcredit'][] = $row_credit['nomcredit'];
						$calcul['notaf'][] = $notaf;
						$calcul['hores'][] = $row_credit['hores_cr'];
						$calcul['punts'][] = $punts;
					}else{
//						dump_r($res_cred);
//						$wpdb->update('ricca3_credits_avaluacions', array( 'pendi' => 'P' ), array( 'idcredaval' => $row_credit['idcredaval']) );
						ricca3_dbupdate('ricca3_credits_avaluacions', array( 'pendi' => 'P' ), array( 'idcredaval' => $res_cred[0]['idcredaval']) );
##
					printf('<br /> Crèdit %s de l\'especialitat %s <b>suspes</b> amb un - %d',$row_credit['nomcredit'],$res_cred[0]['nomespecialitat'], $notaf);
##
						$aprovat = 0;
						$suspes = 1;
					}
				}else{
					if(strtolower($res_cred[0]['notaf_cr']) == 'co' || strncmp( strtolower( $res_cred[0]['notaf_cr']), 'apt', 3 ) == 0){
//						$wpdb->update('ricca3_credits_avaluacions', array( 'pendi' => '' ), array( 'idcredaval' => $res_cred[0]['idcredaval']) );
						ricca3_dbupdate('ricca3_credits_avaluacions', array( 'pendi' => '' ), array( 'idcredaval' => $res_cred[0]['idcredaval']) );
##
						printf('<br /> Crèdit %s de l\'especialitat %s aprovat amb un - %s',
							$row_credit['nomcredit'],$res_cred[0]['nomespecialitat'], $res_cred[0]['notaf_cr']);
##
						$calcul['nomcredit'][] = $row_credit['nomcredit'];
						$calcul['notaf'][] = $res_cred[0]['notaf_cr'];
						$calcul['hores'][] = $row_credit['hores_cr'];
						$calcul['punts'][] = '';
					}elseif( strtolower( $res_cred[0]['notaf_cr'] ) == 'np' || strtolower( $res_cred[0]['notaf_cr'] ) == 'pfct'){
//						$wpdb->update('ricca3_credits_avaluacions', array( 'pendi' => 'P' ), array( 'idcredaval' => $res_cred[0]['idcredaval']) );
						ricca3_dbupdate('ricca3_credits_avaluacions', array( 'pendi' => 'P' ), array( 'idcredaval' => $res_cred[0]['idcredaval']) );
##
						printf('<br /> Crèdit %s de l\'especialitat %s <b>suspes</b> amb un - %s',$row_credit['nomcredit'],$res_cred[0]['nomespecialitat'], $res_cred[0]['notaf_cr']);
##
						$aprovat = 0;
						$np = 1;
					}else{
##
						printf('<br /> Crèdit %s de l\'especialitat %s <b>sense aprovar</b>  - %s',$row_credit['nomcredit'],$res_cred[0]['nomespecialitat'], $res_cred[0]['notaf_cr']);
##
						$aprovat = 0;
						$sensenota = 1;
					}
				}
			}else{
				$aprovat = 0;
				$faltencreds = 1;
			}
		}
		if( $hores > 0) $notafinal = sprintf('%01.3f', ($acumulat*10)/$hores);
		$texte = '';
		if( $aprovat     == 1) $texte = sprintf('%s %s', __(', ha aprovat:', 'ricca3-inc'), $notafinal);
		if( $suspes      == 1) $texte = sprintf('%s', __(', té assignatures suspeses.', 'ricca3-inc'));
		if( $np          == 1) $texte = sprintf('%s %s',$texte , __(', té crèdits sense presentar.', 'ricca3-inc'));
		if( $sensenota   == 1) $texte = sprintf('%s %s',$texte , __(', té crèdits sense nota.', 'ricca3-inc'));
		if( $faltencreds == 1) $texte = sprintf('%s %s',$texte , __(', té crèdits sense fer.', 'ricca3-inc'));
		ricca3_missatge_petit(sprintf('%s %s <b>%s</b>',__('El alumne','ricca3-inc'), $row_alumne['cognomsinom'], $texte ));
//	guardar notaf al registre de ricca_alumne_especialitat
		if($aprovat == 1){
			$query = $wpdb->prepare('SELECT * FROM ricca3_alumne_especialitat WHERE idalumne=%s AND idgrup=%s ORDER BY idany DESC',
					$dades[0]['idalumne'], $dades[0]['idgrup']);
			$result = $wpdb->get_results($query, ARRAY_A );
//			$wpdb->update('ricca3_alumne_especialitat', array( 'notaf_es' => $notafinal ), array( 'idalumespec' => $result[0]['idalumespec']));
			ricca3_dbupdate('ricca3_alumne_especialitat', array( 'notaf_es' => $notafinal ), array( 'idalumespec' => $result[0]['idalumespec']));
		}
	}
}
