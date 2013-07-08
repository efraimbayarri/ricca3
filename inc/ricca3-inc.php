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
			printf('<th><input type="checkbox" value="on" name="allbox" onclick="checkAll();"/></th>');
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
					printf('<td>%s</td>', $data[ $i ][ $matriu['nombd'][ $j ] ]);
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

