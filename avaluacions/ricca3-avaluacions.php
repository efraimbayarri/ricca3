<?php
## Release build 2013.27.5
#############################################################################################
/**
 * Avaluacions
 * shortcode: [ricca3-avaluacions]
 *
 * @since ricca3.v.2013.19.3
 * @author Efraim Bayarri
 */
#############################################################################################
function ricca3_shortcode_avaluacions($atts, $content = null) {
	global $ricca3_butons_avaluacions;

	ricca3_missatge(__('Avaluacions dels alumnes','ricca3-aval'));
//		preparar ajudes als butons
	$ricca3_butons_avaluacions['texte'][0] = __('ajuda-aval-actes', 'ricca3-aval');
	$ricca3_butons_avaluacions['texte'][1] = __('ajuda-aval-notes', 'ricca3-aval');
	$ricca3_butons_avaluacions['texte'][2] = __('ajuda-aval-obs', 'ricca3-aval');
	$ricca3_butons_avaluacions['texte'][3] = __('ajuda-aval-nf', 'ricca3-aval');
	$ricca3_butons_avaluacions['texte'][4] = __('ajuda-aval-veurecalcul', 'ricca3-aval');
	$ricca3_butons_avaluacions['texte'][6] = __('ajuda-aval-certif', 'ricca3-aval');
	$ricca3_butons_avaluacions['texte'][7] = __('ajuda-aval-1curs', 'ricca3-aval');
	$ricca3_butons_avaluacions['texte'][8] = __('ajuda-aval-certfinal', 'ricca3-aval');
//		butons	
	ricca3_butons( $ricca3_butons_avaluacions, 12 );
}

#############################################################################################
/**
 * Actes
 * shortcode: [ricca3-actes]
 *
 * @since ricca3.v.2013.19.3
 * @author Efraim Bayarri
 */
#############################################################################################
function ricca3_shortcode_actes($atts, $content = null) {
	global $wpdb;
	global $ricca3_butons_actes;
	
	ricca3_missatge(__('Actes d\'avaluació','ricca3-aval'));
	$ricca3_butons_actes['texte'][0] = __('ajuda-aval-aval', 'ricca3-aval');
	//		butons
	ricca3_butons( $ricca3_butons_actes, 6 );
	
	printf('<form method="post" action="" name="cercar"><table dir="ltr" class="cercar"><tr>', NULL);
	printf('<td><button type="submit" name="cercar" value="actualitzar" title="%s">%s</td>', 
		__('ajuda-actes-escollir', 'ricca3-aval'), __('escollir', 'ricca3-aval'));
//		drop per el any
	$data_any = $wpdb->get_results('SELECT * FROM ricca3_any', ARRAY_A );
	ricca3_drop_any( __('Any:','ricca3-aval'), 'any', $data_any, 'idany', 'any', __('ajuda_actes_any', 'ricca3-aval'), 'actual' );
//		drop per el grup
	$data_grup = $wpdb->get_results('SELECT * FROM ricca3_grups WHERE actiu_gr = 1 ORDER BY grup ', ARRAY_A );
	ricca3_drop( __('Grup:','ricca3-aval'), 'grup',  $data_grup,  'idgrup', 'grup',  __('ajuda_actes_grup', 'ricca3-aval'), TRUE );
//		drop per l'avaluació	
	$data_aval = $wpdb->get_results('SELECT * FROM ricca3_avaluacions', ARRAY_A );
	ricca3_drop( __('Avaluació:','ricca3-aval'), 'aval',  $data_aval,  'idavaluacio', 'nomaval',  __('ajuda_actes_aval', 'ricca3-aval'), TRUE );
//	
	$data = '';
	if( isset($_POST['data'] ) ) $data = $_POST['data'];
	printf('<td>%s<INPUT type="text" name="data" value="%s" title="%s"/></td>', __('Data','ricca3-aval'), $data, __('ajuda_actes_data','ricca3-aval'));
	if( isset( $_POST['repe']) && $_POST['repe'] == 'si'){
		printf('<td title="%s">%s<input type="checkbox" accesskey="" name="repe" value="si" title="" class="" checked /></td>' , 
			__('ajuda_actes_repe','ricca3-aval'), __('Repetidors','ricca3-aval') );
	}else{
		printf('<td title="%s">%s<input type="checkbox" accesskey="" name="repe" value="si" title="" class="" /></td>' , 
			__('ajuda_actes_repe','ricca3-aval'), __('Repetidors','ricca3-aval') );
	}
//		tanquem la barra de selecció
	printf('</tr></table></form>', NULL);
	if( isset( $_POST['cercar'] )){
		$row_grup = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_grups WHERE idgrup = %s', $_POST['grup']), ARRAY_A, 0);
		$row_aval = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_avaluacions WHERE idavaluacio = %s', $_POST['aval']) ,ARRAY_A, 0);
		$row_any  = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_any WHERE idany=%s', $_POST['any'] ),ARRAY_A,0 );
		if(strlen($_POST['data']) < 2){
			$today = getdate();
			$_POST['data'] = sprintf('%s/%s/%s', $today['mday'], $today['mon'], $today['year']);
		}		
		if(isset( $_POST['repe'] ) && $_POST['repe'] != 'no'){
			ricca3_missatge(sprintf('%s %s,  %s %s,  %s %s - %s', __('Actes de', 'ricca3-aval'),
			$row_aval['nomaval'], $row_grup['grup'], $row_any['any'], __('amb data', 'ricca3-aval'), $_POST['data'], __('REPETIDORS', 'ricca3-aval')));
		}else{
			ricca3_missatge(sprintf('%s %s,  %s %s,  %s %s', __('Actes de', 'ricca3-aval'),
			$row_aval['nomaval'], $row_grup['grup'], $row_any['any'], __('amb data', 'ricca3-aval'), $_POST['data']));
		}
		printf('<table dir="ltr" class="menucurt500"><tr>', NULL);
		if( !isset( $_POST['repe'] ) ) $_POST['repe'] = 'no';
		if($_POST['repe'] == 'no'){
			printf('<td><a href="%s/%s/?any=%s&grup=%s&aval=%s&repe=%s&data=%s" target="POPUPW" onsubmit="POPUPW = window.open("about:blank","POPUPW","width=800,height=650" >',
				site_url(), 'ricca3-imprimiractes', $_POST['any'], $_POST['grup'], $_POST['aval'], $_POST['repe'], $_POST['data']);
			printf('<button type="button">%s</button></a></td></tr></table>', __('Imprimir actes','ricca3-aval'));
		}else{
			printf('<td><a href="%s/%s/?any=%s&grup=%s&aval=%s&repe=%s&data=%s" target="POPUPW" onsubmit="POPUPW = window.open("about:blank","POPUPW","width=800,height=650" >',
				site_url(), 'ricca3-imprimiractesrepe', $_POST['any'], $_POST['grup'], $_POST['aval'], $_POST['repe'], $_POST['data']);
			printf('<button type="button">%s</button></a></td></tr></table>', __('Imprimir actes','ricca3-aval'));
		}
	}
}

#############################################################################################
/**
 * Imprimir les actes d'evaluació NO REPETIDORS
 * shortcode: [ricca3-impactes]
 *
 * @since ricca3.v.2013.19.3
 * @author Efraim Bayarri
 */
#############################################################################################
function ricca3_shortcode_impactes($atts, $content = null) {
	global $wpdb;

	$row_aval = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_avaluacions WHERE idavaluacio = %s', $_GET['aval']) ,ARRAY_A, 0);
//		busquem quins ccomp composen el grup
	if($_GET['aval']=="1" || $_GET['aval']=="2" || $_GET['aval']=="3"){
		$query = $wpdb->prepare('SELECT * FROM ricca3_pla_view WHERE idany = %s AND idgrup = %s AND aval3nomes=0 ORDER BY ordre_cr ', $_GET['any'], $_GET['grup'] );
	}else{
		$query = $wpdb->prepare('SELECT * FROM ricca3_pla_view WHERE idany = %s AND idgrup = %s ORDER BY ordre_cr ', $_GET['any'], $_GET['grup'] );
	}
	$dades_pla = $wpdb->get_results( $query, ARRAY_A);
//		creem un acta per cada un dels crèdits
	for( $i = 0; $i < count($dades_pla); $i++){
		$query = $wpdb->prepare('SELECT * FROM ricca3_credits_avaluacions '.
								'INNER JOIN ricca3_any                 ON ricca3_any.idany                    = ricca3_credits_avaluacions.idany '.
								'INNER JOIN ricca3_ccomp               ON ricca3_ccomp.idccomp                = ricca3_credits_avaluacions.idccomp '.
								'INNER JOIN ricca3_credits             ON ricca3_credits.idcredit             = ricca3_ccomp.idcredit '.
								'INNER JOIN ricca3_grups               ON ricca3_grups.idgrup                 = ricca3_ccomp.idgrup '.
								'INNER JOIN ricca3_professors          ON ricca3_professors.idprof            = ricca3_ccomp.idprofessor '.
								'INNER JOIN ricca3_tutors              ON ricca3_tutors.idprof                = ricca3_ccomp.idtutor '.
								'INNER JOIN ricca3_alumne              ON ricca3_alumne.idalumne              = ricca3_credits_avaluacions.idalumne '.
								'INNER JOIN ricca3_especialitats       ON ricca3_especialitats.idespecialitat = ricca3_credits.idespecialitat '.
								'INNER JOIN ricca3_cursos              ON ricca3_cursos.idcurs                = ricca3_credits.idcurs '.
								'INNER JOIN ricca3_alumne_especialitat ON ricca3_alumne_especialitat.idalumne = ricca3_alumne.idalumne '.
                                'AND ricca3_alumne_especialitat.idgrup   = ricca3_grups.idgrup '.
                                'WHERE ricca3_credits_avaluacions.idccomp = %s AND ricca3_credits_avaluacions.idany = %s AND ricca3_credits_avaluacions.repe != "R" and idestat_es=1 ORDER BY cognomsinom ASC ',
                                $dades_pla[$i]['idccomp'], $dades_pla[$i]['idany'] );
		$dades_ccomp = $wpdb->get_results( $query, ARRAY_A );
//	si hi han alumnes per el crèdit continuem
		if( count($dades_ccomp) > 0){
			for( $j = 0; $j < count($dades_ccomp); $j++){
				if($j == 0 || $j == 20 ){
					printf('<table class="cap">   <tr><td><IMG SRC="%s/ricca3/imatges/ricca3-logo.jpg" ALIGN=left><IMG SRC="%s/ricca3/imatges/ricca3-adreca.png" ALIGN=left></td></tr></table>', WP_PLUGIN_URL, WP_PLUGIN_URL );
					printf('<table class="center"><tr><td><font face="Arial, Helvetica, sans-serif">%s</font></td></tr></table>', __('ACTA D\'AVALUACIÓ','ric-ca-aval'));
					printf('<table class="cap"><tr><td>%s %s</td></tr></table>',       __('CRÉDIT:','ric-ca-aval'), $dades_pla[$i]['nomcredit']);
					printf('<table class="cap"><tr><td width="400px">%s %s</td>',      __('CURS:','ric-ca-aval'), $dades_pla[$i]['any'] );
					printf('                       <td width="400px">%s %s</td></tr>', __('DATA:','ric-ca-aval'), $_GET['data']);
					printf('                   <tr><td              >%s %s</td>',      __('ESPECIALITAT:','ric-ca-aval'), $dades_pla[$i]['nomespecialitat']);
					printf('                       <td              >%s %s</td></tr>', __('GRUP:','ric-ca-aval'), $dades_pla[$i]['grup'] );
					printf('                   <tr><td              >%s %s</td>',      __('PROFESSOR/A:','ric-ca-aval'), $dades_pla[$i]['nomicognoms']);
					printf('                       <td              >%s %s</td></tr>', __('TUTOR/A:','ric-ca-aval'), $dades_pla[$i]['nomicognomstut']);
					printf('                   <tr><td align="center" colspan="2"> %s</td></tr></table>',$row_aval['nomaval']);
				}
				if($j == 0 || $j == 20 ){
					$table = " class=\"cos\" style=\"page-break-after: always;\" ";
				}else{
					$table=" class=\"cos\" ";
				}
				if($j == 0 || $j == 20){
					printf('<table %s>', $table);
					printf('<tr><td width="560px" align="center">%s</td>',      __('Alumnes','ric-ca-aval'));
					printf('    <td width="120px" align="center">%s</td>',      __('Qualificació','ric-ca-aval') );
					printf('    <td width="120px" align="center">%s</td></tr>', __('Actitud','ric-ca-aval'));
				}
				printf('<tr><td height="30">%s - %s</td><td></td><td></td></tr>', $j+1, $dades_ccomp[$j]["cognomsinom"]);
			}
			printf('</table>', NULL);
		}
	}
}

#############################################################################################
/**
 * Imprimir les actes d'evaluació REPETIDORS
 * shortcode: [ricca3-impactesrepe]
 *
 * @since ricca3.v.2013.19.3
 * @author Efraim Bayarri
 */
#############################################################################################
function ricca3_shortcode_impactesrepe($atts, $content = null) {
	global $wpdb;
	
	$row_aval = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_avaluacions WHERE idavaluacio = %s', $_GET['aval']) ,ARRAY_A, 0);
	$row_any  = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_any WHERE idany=%s', $_GET['any'] ),ARRAY_A,0 );
	$dades_ccomp =  $wpdb->get_results( $wpdb->prepare('SELECT DISTINCT idccomp FROM ricca3_alumccomprepe_view WHERE idgrup = %s AND idany = %s ORDER BY ordre_cr', $_GET['grup'], $_GET['any']), ARRAY_A);
	for ( $i = 0; $i < count( $dades_ccomp ); $i++){
		$dades =  $wpdb->get_results( $wpdb->prepare('SELECT * FROM ricca3_alumccomprepe_view WHERE idccomp = %s AND idany = %s ORDER BY ordre_cr', $dades_ccomp[$i]['idccomp'],	 $_GET['any']), ARRAY_A);		
		if($dades[0]['aval3nomes'] == '0' || $_GET['aval'] == '4' || $_GET['aval'] == '5'){
//			dump_r($dades);
			printf('<table class="cap"><tr><td><IMG SRC="%s/ricca3/imatges/ricca3-logo.jpg" ALIGN=left><IMG SRC="%s/ricca3/imatges/ricca3-adreca.png" ALIGN=left></td></tr></table>', WP_PLUGIN_URL, WP_PLUGIN_URL );
			printf('<table class="center"><tr><td><font face="Arial, Helvetica, sans-serif">%s</font></td></tr></table>',  __('ACTA D\'AVALUACIÓ','ric-ca-aval'));
			printf('<table class="cap"><tr><td>%s %s</td></tr></table>',       __('CRÉDIT:','ric-ca-aval'), $dades[0]['nomccomp'] );
			printf('<table class="cap"><tr><td width="400px">%s %s</td>',      __('CURS:','ric-ca-aval'), $dades[0]['any']);
			printf('                       <td width="400px">%s %s</td></tr>', __('DATA:','ric-ca-aval'), $_GET['data'] );
			printf('                   <tr><td              >%s %s</td>',      __('ESPECIALITAT:','ric-ca-aval'), $dades[0]['nomespecialitat'] );
			printf('                       <td              >%s %s</td></tr>', __('GRUP:','ric-ca-aval'), $dades[0]['grup'] );
			printf('                   <tr><td              >%s %s</td>',      __('PROFESSOR/A:','ric-ca-aval'), $dades[0]['nomicognoms']);
			printf('                       <td              >%s %s</td></tr>', __('TUTOR/A:','ric-ca-aval'), $dades[0]['nomicognomstut']);
			printf('                   <tr><td align="center" colspan="2">%s</td></tr></table>',$row_aval['nomaval']);
			$table = " class=\"cos\" style=\"page-break-after: always;\" ";
			if($i == count($dades_ccomp) - 1) $table=" class=\"cos\" ";
			printf('<table %s border="1" >', $table);
			printf('', NULL);
			printf('<tr><td width="560px" align="center">%s</td>',      __('Alumnes','ric-ca-aval'));
			printf('    <td width="120px" align="center">%s</td>',      __('Qualificació','ric-ca-aval') );
			printf('    <td width="120px" align="center">%s</td></tr>', __('Actitud','ric-ca-aval'));
			for( $j = 0; $j < count($dades); $j++){
				printf('<tr><td height="30">%s - %s</td><td></td><td></td></tr>', $j+1, $dades[$j]['cognomsinom']);
			}
			printf('</table>', NULL);
		}
	}
}

#############################################################################################
/**
 * entrada de notes
 * shortcode: [ricca3-notes]
 *
 * @since ricca3.v.2013.20.6
 * @author Efraim Bayarri
 */
#############################################################################################
function ricca3_shortcode_notes($atts, $content = null) {
	global $wpdb;
	global $current_user;
	global $ricca3_butons_actes;

	get_currentuserinfo();

	ricca3_missatge(__('Entrada de notes','ricca3-aval'));
	$ricca3_butons_actes['texte'][0] = __('ajuda-aval-aval', 'ricca3-aval');
//		butons
	ricca3_butons( $ricca3_butons_actes, 6 );
	
	printf('<form method="post" action="" name="cercar"><table dir="ltr" class="menucurt600"><tr>', NULL);
	printf('<td><button type="submit" name="cercar" value="grup" title="%s">%s</td>',
	__('ajuda-notes-escollir', 'ricca3-aval'), __('escollir', 'ricca3-aval'));
//		drop per el any
	$data_any = $wpdb->get_results('SELECT * FROM ricca3_any', ARRAY_A );
	ricca3_drop_any( __('Any:','ricca3-aval'), 'any', $data_any, 'idany', 'any', __('ajuda_notes_any', 'ricca3-aval'), 'actual' );
//		drop per el grup
	$data_grup = $wpdb->get_results('SELECT * FROM ricca3_grups WHERE actiu_gr = 1 ORDER BY grup ', ARRAY_A );
	ricca3_drop( __('Grup:','ricca3-aval'), 'grup',  $data_grup,  'idgrup', 'grup',  __('ajuda_notes_grup', 'ricca3-aval'), TRUE );
//
	if( isset( $_POST['repe']) && $_POST['repe'] == 'si'){
		printf('<td title="%s">%s<input type="checkbox" accesskey="" name="repe" value="si" title="" class="" checked /></td>' ,
			__('ajuda_actes_repe','ricca3-aval'), __('Repetidors','ricca3-aval') );
	}else{
		printf('<td title="%s">%s<input type="checkbox" accesskey="" name="repe" value="si" title="" class="" /></td>' ,
			__('ajuda_actes_repe','ricca3-aval'), __('Repetidors','ricca3-aval') );
	}
//		tanquem la barra de selecció
	printf('</tr></table></form>', NULL);
//		un cop hem escollit el grup, any i avaluació, mostra els credits
	if( isset( $_POST['cercar'] ) && $_POST['cercar'] == 'grup'){
		$query_ccomp = $wpdb->prepare('SELECT * FROM ricca3_ccomp WHERE idgrup = %s AND actiu_cc = 1 ORDER BY nomccomp ASC', $_POST['grup']);
		if(isset($_POST['repe']) && $_POST['repe'] == 'si') $query_ccomp = $wpdb->prepare('SELECT * FROM ricca3_ccomp WHERE idgrup = %s ORDER BY nomccomp ASC', $_POST['grup']);

		$row_grup = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_grups WHERE idgrup=%s ', $_POST['grup'] ), ARRAY_A, 0);
		$row_any  = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_any WHERE idany = %s', $_POST['any'] ),  ARRAY_A, 0);
		printf('<table id="nom" class="nom"><tr><td class="nom">%s %s %s </td></tr></table>',
			$row_grup['grup'], __('del curs','ricca3-aval'), $row_any['any'] );
		
		printf('<form method="post" action="" name="cercar"><table dir="ltr" class="menucurt800"><tr>', NULL);
		printf('<td><INPUT type="hidden" name="any"  value="%s" />',$_POST['any']);
		printf('    <INPUT type="hidden" name="grup" value="%s" />',$_POST['grup']);
		if( isset( $_POST['repe'] ) ) printf('<INPUT type="hidden" name="repe" value=%s />',$_POST['repe']);
		printf('<button type="submit" name="cercar" value="ccomp" title="%s">%s</td>',
			__('ajuda-notes-escollir', 'ricca3-aval'), __('escollir', 'ricca3-aval'));
		$data_ccomp = $wpdb->get_results( $query_ccomp, ARRAY_A);
		ricca3_drop( __('Crèdit:','ricca3-aval'), 'ccomp',  $data_ccomp,  'idccomp', 'nomccomp',  __('ajuda_notes_ccomp', 'ricca3-aval'), TRUE );
		printf('</tr></table></form>', NULL);
	}
	if( isset( $_POST['cercar']) && $_POST['cercar'] == 'ccomp'){
		$row_grup   = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_grups WHERE idgrup=%s ', $_POST['grup'] ),  ARRAY_A, 0);
		$row_any    = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_any WHERE idany = %s', $_POST['any'] ),   ARRAY_A, 0);
		$row_ccomp  = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_ccomp WHERE idccomp = %s', $_POST['ccomp']),  ARRAY_A, 0);
		$query = $wpdb->prepare('SELECT * FROM ricca3_credits_avaluacions '.
				'INNER JOIN ricca3_any                 ON ricca3_any.idany                    = ricca3_credits_avaluacions.idany '.
				'INNER JOIN ricca3_ccomp               ON ricca3_ccomp.idccomp                = ricca3_credits_avaluacions.idccomp '.
				'INNER JOIN ricca3_credits             ON ricca3_credits.idcredit             = ricca3_ccomp.idcredit '.
				'INNER JOIN ricca3_grups               ON ricca3_grups.idgrup                 = ricca3_ccomp.idgrup '.
				'INNER JOIN ricca3_professors          ON ricca3_professors.idprof            = ricca3_ccomp.idprofessor '.
				'INNER JOIN ricca3_tutors              ON ricca3_tutors.idprof                = ricca3_ccomp.idtutor '.
				'INNER JOIN ricca3_alumne              ON ricca3_alumne.idalumne              = ricca3_credits_avaluacions.idalumne '.
				'INNER JOIN ricca3_especialitats       ON ricca3_especialitats.idespecialitat = ricca3_credits.idespecialitat '.
				'INNER JOIN ricca3_cursos              ON ricca3_cursos.idcurs                = ricca3_credits.idcurs '.
				'INNER JOIN ricca3_alumne_especialitat ON ricca3_alumne_especialitat.idalumne = ricca3_alumne.idalumne '.
				'AND ricca3_alumne_especialitat.idgrup   = ricca3_grups.idgrup '.
				'WHERE ricca3_credits_avaluacions.idccomp = %s and ricca3_credits_avaluacions.idany = %s and idestat_es = 1 ORDER BY cognomsinom ASC ',
				$_POST['ccomp'], $row_any['idany'] );
		$dades_cred = $wpdb->get_results( $query, ARRAY_A );
		$row_prof = $wpdb->get_row($wpdb->prepare('SELECT * FROM ricca3_professors WHERE idprof=%s ', $dades_cred[0]['idprofessor']), ARRAY_A, 0);
//
		if( count($dades_cred) > 0){
			printf('<table id="nom" class="nom"><tr><td class="nom">%s ', $row_grup['grup']);
			printf('%s %s </td></tr></table>', __('del curs','ricca3-aval'), $row_any['any'] );
			printf('<table id="nom" class="nom"><tr><td class="nom">', NULL);
			printf('%s %s ',__('CRÉDIT:','ricca3-aval'), $row_ccomp['nomccomp']);
			printf('%s %s</td></tr></table>', __('PROFESSOR:','ricca3-aval'), $row_prof['nomicognoms'] );
//	<!-- the tabs -->
			printf('<div id="tabs">', NULL);
			printf('<ul class="tabs">', NULL);
			printf('<li><a href="#aval1" title="%s">%s</a></li>', __('ajuda-notes-1aval', 'ricca3-aval'), __('Primera Avaluació', 'ricca3-aval'));
			printf('<li><a href="#aval2" title="%s">%s</a></li>', __('ajuda-notes-2aval', 'ricca3-aval'), __('Segona Avaluació', 'ricca3-aval'));
			printf('<li><a href="#aval3" title="%s">%s</a></li>', __('ajuda-notes-3aval', 'ricca3-aval'), __('Tercera Avaluació', 'ricca3-aval'));
			printf('<li><a href="#aval4" title="%s">%s</a></li>', __('ajuda-notes-4aval', 'ricca3-aval'), __('Quarta Avaluació', 'ricca3-aval'));
			printf('</ul>', NULL);
//		<!-- tab "panes" -->
#################################
##//		Primera avaluació
#################################
			printf('<div id="aval1">', NULL);
			$z=0;
			if(!isset($_POST['repe']))$_POST['repe'] = 'no';
			printf('<form method="post" action="" name="cercar"><table><tr><th>%s</th><th>%s</th><th>%s</th></tr>',
				__('Alumne','ricca3-aval'), __('Nota', 'ricca3-aval'), __('Actitud', 'ricca3-aval'));
			for( $i=0; $i < count($dades_cred); $i++){
				if( ($dades_cred[$i]['repe'] != 'R' && $_POST['repe'] != 'si') || ($dades_cred[$i]['repe'] == 'R' && $_POST['repe'] == 'si') ){
					printf('<tr><td><INPUT type="hidden" name="RECORD[]" value="%s"> %s - %s</td>',
						$dades_cred[$i]['idcredaval'],$z+1,$dades_cred[$i]['cognomsinom'] );
					printf('<td><INPUT type="text" name="nota1[]" value="%s" ></td>', $dades_cred[$i]['nota1']);
					printf('<td><INPUT type="text" name="act1[]"  value="%s" ></td></tr>', $dades_cred[$i]['act1']);
					$z++;
				}				
			}
			printf('</table>',NULL);
			ricca3_desar('accio', 'actualitzar', __('ajuda-notes-desar','ricca3-aval'));
			printf('</div>', NULL);
#################################
##//		Segona avaluació
#################################
			printf('<div id="aval2">', NULL);
			$z=0;
			if(!isset($_POST['repe']))$_POST['repe'] = 'no';
			printf('<table><tr><th>%s</th><th>%s</th><th>%s</th><th></th><th>%s</th><th>%s</th></tr>',
				__('Alumne','ricca3-aval'), __('N1', 'ricca3-aval'), __('A1', 'ricca3-aval'), __('Nota', 'ricca3-aval'), __('Actitud', 'ricca3-aval'));
			for( $i=0; $i < count($dades_cred); $i++){
				if( ($dades_cred[$i]['repe'] != 'R' && $_POST['repe'] != 'si') || ($dades_cred[$i]['repe'] == 'R' && $_POST['repe'] == 'si') ){
					printf('<tr><td>%s - %s</td>', $z+1,$dades_cred[$i]['cognomsinom'] );
					printf('<td>%s</td><td>%s</td><td> - </td><td><INPUT type="text" name="nota2[]" value="%s" ></td>', 
						$dades_cred[$i]['nota1'], $dades_cred[$i]['act1'], $dades_cred[$i]['nota2']);
					printf('<td><INPUT type="text" name="act2[]"  value="%s" ></td></tr>', 
						$dades_cred[$i]['act2']);
					$z++;
				}
			}
			printf('</table>',NULL);
			ricca3_desar('accio', 'actualitzar', __('ajuda-notes-desar','ricca3-aval'));
			printf('</div>', NULL);
#################################
##//		Tercera avaluació
#################################
			printf('<div id="aval3">', NULL);
			$z=0;
			if(!isset($_POST['repe']))$_POST['repe'] = 'no';
			printf('<table><tr><th>%s</th><th>%s</th><th>%s</th><th></th><th>%s</th><th>%s</th><th></th><th>%s</th><th>%s</th></tr>',
				__('Alumne','ricca3-aval'), __('N1', 'ricca3-aval'), __('A1', 'ricca3-aval'), __('N2', 'ricca3-aval'), __('A2', 'ricca3-aval'), __('Nota', 'ricca3-aval'), __('Actitud', 'ricca3-aval'));
			for( $i=0; $i < count($dades_cred); $i++){
				if( ($dades_cred[$i]['repe'] != 'R' && $_POST['repe'] != 'si') || ($dades_cred[$i]['repe'] == 'R' && $_POST['repe'] == 'si') ){
					printf('<tr><td>%s - %s</td>', $z+1,$dades_cred[$i]['cognomsinom'] );
					printf('<td>%s</td><td>%s</td><td> - </td><td>%s</td><td>%s</td><td> - </td><td><INPUT type="text" name="nota3[]" value="%s" ></td>', 
						$dades_cred[$i]['nota1'], $dades_cred[$i]['act1'], $dades_cred[$i]['nota2'], $dades_cred[$i]['act1'], $dades_cred[$i]['nota3']);
					printf('<td><INPUT type="text" name="actf[]"  value="%s" ></td></tr>', $dades_cred[$i]['actf']);
					$z++;
				}
			}
			printf('</table>',NULL);
			ricca3_desar('accio', 'actualitzar', __('ajuda-notes-desar','ricca3-aval'));
			printf('</div>', NULL);
#################################
##//		Quarta avaluació
#################################
			printf('<div id="aval4">', NULL);
			$z=0;
			if(!isset($_POST['repe']))$_POST['repe'] = 'no';
			$count = $wpdb->query($wpdb->prepare('SELECT * FROM ricca3_ccomp WHERE idcredit=%s AND idgrup=%s ', $row_ccomp['idcredit'], $row_ccomp['idgrup']));
			if( $count == '1'){
				printf('<table><tr><th>%s</th><th>%s</th><th>%s</th><th></th><th>%s</th><th>%s</th><th></th><th>%s</th><th>%s</th><th></th><th>%s</th></tr>',
					__('Alumne','ricca3-aval'), __('N1', 'ricca3-aval'), __('A1', 'ricca3-aval'), __('N2', 'ricca3-aval'), __('A2', 'ricca3-aval'), __('N3', 'ricca3-aval'), __('A3', 'ricca3-aval'), __('Nota Final', 'ricca3-aval'));
				for( $i=0; $i < count($dades_cred); $i++){
					if( ($dades_cred[$i]['repe'] != 'R' && $_POST['repe'] != 'si') || ($dades_cred[$i]['repe'] == 'R' && $_POST['repe'] == 'si') ){
						printf('<tr><td>%s - %s</td>', $z+1,$dades_cred[$i]['cognomsinom'] );
						printf('<td>%s</td><td>%s</td><td> - </td><td>%s</td><td>%s</td><td> - </td><td>%s</td><td>%s</td><td> - </td><td><INPUT type="text" name="notaf_cc[]" value="%s" ><INPUT type="hidden" name="notaf_cr[]" value="%s" ></td></tr>', 
							$dades_cred[$i]['nota1'], $dades_cred[$i]['act1'], $dades_cred[$i]['nota2'], $dades_cred[$i]['act1'], $dades_cred[$i]['nota3'], $dades_cred[$i]['actf'], $dades_cred[$i]['notaf_cc'], $dades_cred[$i]['notaf_cr']);
						$z++;
					}
				}
			}else{
				printf('<table><tr><th>%s</th><th>%s</th><th>%s</th><th></th><th>%s</th><th>%s</th><th></th><th>%s</th><th>%s</th><th></th><th>%s</th><th>%s</th></tr>',
				__('Alumne','ricca3-aval'), __('N1', 'ricca3-aval'), __('A1', 'ricca3-aval'), __('N2', 'ricca3-aval'), __('A2', 'ricca3-aval'), __('N3', 'ricca3-aval'), __('A3', 'ricca3-aval'), __('Nota Final C. Comp.', 'ricca3-aval'),__('Nota Final Crèdit', 'ricca3-aval') );
				for( $i=0; $i < count($dades_cred); $i++){
					if( ($dades_cred[$i]['repe'] != 'R' && $_POST['repe'] != 'si') || ($dades_cred[$i]['repe'] == 'R' && $_POST['repe'] == 'si') ){
						printf('<tr><td>%s - %s</td>', $z+1,$dades_cred[$i]['cognomsinom'] );
						printf('<td>%s</td><td>%s</td><td> - </td><td>%s</td><td>%s</td><td> - </td><td>%s</td><td>%s</td><td> - </td><td><INPUT type="text" name="notaf_cc[]" value="%s" ></td><td><INPUT type="text" name="notaf_cr[]" value="%s" ></td></tr>',
						$dades_cred[$i]['nota1'], $dades_cred[$i]['act1'], $dades_cred[$i]['nota2'], $dades_cred[$i]['act1'], $dades_cred[$i]['nota3'], $dades_cred[$i]['actf'], $dades_cred[$i]['notaf_cc'], $dades_cred[$i]['notaf_cr']);
						$z++;
					}
				}
			}
			printf('</table><table><tr><td><INPUT type="hidden" name="any"  value="%s" />',$_POST['any']);
			printf('<INPUT type="hidden" name="grup"  value="%s" />',$_POST['grup']);
			printf('<INPUT type="hidden" name="ccomp" value="%s" />',$_POST['ccomp']);
			printf('<INPUT type="hidden" name="repe"  value="%s" /></td></tr></table>',$_POST['repe']);
			ricca3_desar('accio', 'actualitzar', __('ajuda-notes-desar','ricca3-aval'));
			printf('</div>', NULL);
#################################			
//	<!-- Final de tab "panes" -->
#################################
			printf('</form>', NULL);
			printf('</div>', NULL);
		}else{
			ricca3_missatge(__('No hi han dades per la sel·leció','ricca3-aval'));
		}
	}
	if( isset( $_POST['accio']) && $_POST['accio'] == 'actualitzar'){
		$quants = count( $_POST['RECORD'] );
		for( $i = 0; $i < $quants; $i++){
			$result = $wpdb->update('ricca3_credits_avaluacions', 
				array(  'nota1'      => strtoupper($_POST['nota1'][$i]), 
						'act1'       => strtoupper($_POST['act1'][$i]),
						'nota2'      => strtoupper($_POST['nota2'][$i]),
						'act2'       => strtoupper($_POST['act2'][$i]),
						'nota3'      => strtoupper($_POST['nota3'][$i]),
						'actf'       => strtoupper($_POST['actf'][$i]),
						'notaf_cc'   => strtoupper($_POST['notaf_cc'][$i]),
						'notaf_cr'   => strtoupper($_POST['notaf_cr'][$i]),
						'stampuser'  => $current_user->user_login, 
						'stampplace' => 'ricca_shortcode_notes' ), 
				array( 'idcredaval'  => $_POST['RECORD'][$i]) 
			);
		}
	}	
}

#############################################################################################
/**
 * entrada de observacions
 * shortcode: [ricca3-obser]
 *
 * @since ricca3.v.2013.20.7
 * @author Efraim Bayarri
 *
 * observ1 = alumne 1 avaluació
 * observ2 = alumne 2 avaluació
 * observ3 = grup
 */
#############################################################################################
function ricca3_shortcode_obser($atts, $content = null) {
	global $wpdb;
	global $current_user;
	global $ricca3_butons_actes;
	global $ricca3_obseralum;

	get_currentuserinfo();
	ricca3_missatge(__('Entrada observacions en els certificats','ricca3-aval'));
	$ricca3_butons_actes['texte'][0] = __('ajuda-aval-aval', 'ricca3-aval');
//		butons
	ricca3_butons( $ricca3_butons_actes, 6 );
	printf('<form method="post" action="" name="cercar"><table dir="ltr" class="cercar">', NULL);
//		radio per els grups	
	if(!isset($_POST['tipus']) || (isset($_POST['tipus']) && $_POST['tipus'] == 'grup')){
		printf('<tr><td><INPUT type="radio" name="tipus" value="grup" title="%s" checked /></td><td> ', __('ajuda-obser-grup', 'ricca3-aval'));
	}else{
		printf('<tr><td><INPUT type="radio" name="tipus" value="grup" title="%s" /></td><td> ', __('ajuda-obser-grup', 'ricca3-aval'));
	}
	printf('%s</td>', __('Per grup','ricca3-aval'));
//		drop per el grup
	$data_grup = $wpdb->get_results('SELECT * FROM ricca3_grups WHERE actiu_gr = 1 ORDER BY grup ', ARRAY_A );
	ricca3_drop( __('Grup:','ricca3-aval'), 'grup',  $data_grup,  'idgrup', 'grup',  __('ajuda-obser-grup', 'ricca3-aval'), TRUE );
//		radio per els alumnes
	if(isset($_POST['tipus']) && $_POST['tipus'] == 'alumne'){
		printf('   <td><INPUT type="radio" name="tipus" value="alumne" title="%s" checked /></td><td> ', __('ajuda-obser-alumne', 'ricca3-aval'));
	}else{
		printf('   <td><INPUT type="radio" name="tipus" value="alumne" title="%s" /></td><td> ', __('ajuda-obser-alumne', 'ricca3-aval'));
	}
	printf('%s</td>', __('Per Alumne','ricca3-aval'));
	if(isset($_POST['cognom1'])){ $value = $_POST['cognom1'];}else{ $value = "";}
	printf('    <td>1er Cognom: <INPUT type="text" name="cognom1"	size=15 value="%s" title="%s" /></td>', $value, __('ajuda-obser-cognom1', 'ricca3-aval'));
	if(isset($_POST['cognom2'])){ $value = $_POST['cognom2'];}else{ $value = "";}
	printf('    <td>2on Cognom: <INPUT type="text" name="cognom2"	size=15 value="%s" title="%s" /></td>', $value, __('ajuda-obser-cognom2', 'ricca3-aval'));
	if(isset($_POST['nom'])){     $value = $_POST['nom'];    }else{ $value = "";}
	printf('    <td>nom:        <INPUT type="text" name="nom"	    size=15 value="%s" title="%s" /></td>', $value, __('ajuda-obser-nom', 'ricca3-aval'));
	if(isset($_POST['DNI'])){     $value = $_POST['DNI'];    }else{ $value = "";}
	printf('    <td>DNI:        <INPUT type="text" name="DNI"	    size=15 value="%s" title="%s" /></td>', $value, __('ajuda-obser-dni', 'ricca3-aval'));
	if(isset($_POST['ID'])){      $value = $_POST['ID'];     }else{ $value = "";}
	printf('    <td>ID:         <INPUT type="text" name="ID"    	size=15 value="%s" title="%s" /></td>', $value, __('ajuda-obser-id', 'ricca3-aval'));
	printf('</tr></table>', NULL);
//	
	if(!isset($_POST['cercar']))printf('<table><tr><td><button type="submit" name="cercar" value="actualitzar" title="%s">%s</td></tr></table>',
			__('ajuda-obser-escollir', 'ricca3-aval'), __('escollir', 'ricca3-aval')); 
	printf('</form>', NULL);
//		Entrar observacions per grup
	if( isset( $_POST['cercar'] ) && $_POST['cercar'] == 'actualitzar'){
		$row_any  = $wpdb->get_row( 'SELECT * FROM ricca3_any WHERE actual = 1',  ARRAY_A, 0);
		if( isset( $_POST['tipus']) && $_POST['tipus'] == 'grup' ){
			$row = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_alumne_especialitat WHERE idany=%s AND idgrup=%s ORDER BY observ3 ASC',
					$row_any['idany'], $_POST['grup']), ARRAY_A, 0);
			printf('<form method="post" action="" name="cercar"><table>', NULL);
			printf('<tr><td>%s</td><td><textarea accesskey="" cols="60" rows="3" name="observ3" title="observ3" >%s</textarea>',
				__('Observacions del grup','ricca3-aval'), $row["observ3"]);
			printf('<INPUT type="hidden" name="grup" value="%s" >', $_POST['grup']);
			printf('<INPUT type="hidden" name="tipus" value="grup" ></td></tr></table>', NULL);
			ricca3_desar('accio', 'actualitzar', __('ajuda-obser-desar-grup', 'ricca3-aval'));
			printf('</form>', NULL);
		}
//	Mostrar alumnes per l'entrada d'observacions per alumne		
		if( isset( $_POST['tipus']) && $_POST['tipus'] == 'alumne' ){
			if($_POST['cognom1'] == '' && $_POST['cognom2'] == '' && $_POST['nom'] == '' && $_POST['DNI'] == '' && $_POST['ID'] == ''){
				printf('<table id="nom" class="nom"><tr><td align="right" class="nom">%s</td></tr></table>', __('No hi han criteris de cerca. Si us plau afegiu-ne un.','ricca3-aval'));
			}else{
				$data_view = $wpdb->get_results( $wpdb->prepare('SELECT * FROM ricca3_alumne WHERE cognom1 LIKE %s AND cognom2 LIKE %s AND nom LIKE %s AND dni LIKE %s AND idalumne LIKE %s ORDER BY cognomsinom ASC' ,
						'%'.like_escape($_POST['cognom1']).'%' , '%'.like_escape($_POST['cognom2']).'%' , '%'.like_escape($_POST['nom']).'%',
						'%'.like_escape($_POST['DNI']).'%' , '%'.like_escape($_POST['ID']).'%' ), ARRAY_A) ;
//		llistat dels alumnes
				printf('<form method="post" action="" name="cercar"><table>', NULL);
				ricca3_graella( $ricca3_obseralum, $data_view );
				printf('<tr><td><button type="submit" name="input" value="alumne"><font size ="1px" face="Arial, Helvetica, sans-serif">', NULL);
				printf('%s</font></button></td><td><INPUT type="hidden" name="tipus" value="alumne" ></td></tr></table></form>', __('Escollir alumne','ricca3-aval'));
			}
		}
	}
//		Entrar observacions a l'alumne
	if( isset( $_POST['input']) && $_POST['input'] == 'alumne'){
		if(!isset($_POST['cbox'])){
			ricca_missatge( __('No hi han alumnes seleccionats. Si us plau selecioneu-ne un.','ric-ca-aval'));
			return;
		}
		$row_any  = $wpdb->get_row( 'SELECT * FROM ricca3_any WHERE actual = 1',  ARRAY_A, 0);
		$row_alum = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_alumne WHERE idalumne=%s', $_POST['cbox']), ARRAY_A, 0);
		$row = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_alumne_especialitat WHERE idalumne=%s AND idany=%s', $_POST['cbox'], $row_any['idany']), ARRAY_A, 0);
		printf('<form method="post" action="" name="cercar"><table>', NULL);
		printf('<tr><td>%s %s %s</td><td><textarea accesskey="" cols="60" rows="3" name="observ1" title="observ1" >%s</textarea></td></tr>',
			__('Observacions de l\'alumne','ricca3-aval'), $row_alum['cognomsinom'], __('per a la primera avaluació','ricca3-aval'), $row["observ1"]);
		printf('<tr><td>%s %s %s</td><td><textarea accesskey="" cols="60" rows="3" name="observ2" title="observ2" >%s</textarea></td></tr>',
			__('Observacions de l\'alumne','ricca3_aval'), $row_alum['cognomsinom'], __('per a la segona avaluació','ricca3-aval'), $row["observ2"]);
		printf('<tr><td><INPUT type="hidden" name="alumne" value="%s" >', $_POST['cbox']);
		printf('<tr><td><INPUT type="hidden" name="tipus" value="alumne" >', NULL);
		ricca3_desar('accio', 'actualitzar', __('ajuda-obser-desar-alumne','ricca3-aval'));
		printf('</form>', NULL);		
	}
//		actualitzar les dades
	if( isset( $_POST['accio']) && $_POST['accio'] == 'actualitzar'){
		$row_any  = $wpdb->get_row( 'SELECT * FROM ricca3_any WHERE actual = 1',  ARRAY_A, 0);
//		actualitzar grup		
		if( isset( $_POST['tipus']) && $_POST['tipus'] == 'grup' ){
			$dades_grup = $wpdb->get_results( $wpdb->prepare('SELECT * FROM ricca3_alumne_especialitat WHERE idany=%s AND idgrup=%s ORDER BY observ3 ASC',
				$row_any['idany'], $_POST['grup']), ARRAY_A, 0);
			for ( $i=0; $i < count($dades_grup); $i++){
				$wpdb->update('ricca3_alumne_especialitat', array( 'observ3' => stripslashes($_POST['observ3']), 'stampuser' => $current_user->user_login, 'stampplace' => 'ricca_shortcode_obser' ), 
															array( 'idalumespec' => $dades_grup[$i]['idalumespec'] ) );
			}
		}
//		actualitzar alumne			
		if( isset( $_POST['tipus']) && $_POST['tipus'] == 'alumne' ){
			$dades_alum = $wpdb->get_results( $wpdb->prepare('SELECT * FROM ricca3_alumne_especialitat WHERE idalumne=%s AND idany=%s', 
				$_POST['alumne'], $row_any['idany']), ARRAY_A, 0);
			for ( $i=0; $i < count($dades_alum); $i++){
				$wpdb->update('ricca3_alumne_especialitat', array( 'observ1' => stripslashes($_POST['observ1']), 'observ2' => stripslashes($_POST['observ2']), 'stampuser' => $current_user->user_login, 'stampplace' => 'ricca_shortcode_obser' ),
															array( 'idalumespec' => $dades_alum[$i]['idalumespec'] ) );
			}
		}
	}
}

#############################################################################################
/**
 * entrada impresió certificats avaluacions
 * shortcode: [ricca3-certif]
 *
 * @since ricca3.v.2013.20.7
 * @author Efraim Bayarri
 */
#############################################################################################
function ricca3_shortcode_certif($atts, $content = null) {
	global $wpdb;
	global $ricca3_butons_actes;
	
	ricca3_missatge( __('Certificats avaluacions','ricca3-aval'));
	$ricca3_butons_actes['texte'][0] = __('ajuda-aval-aval', 'ricca3-aval');
//		butons
	ricca3_butons( $ricca3_butons_actes, 6 );
//	
	printf('<form method="post" action="" name="cercar"><table dir="ltr" class="menucurt600"><tr>', NULL);
	printf('<td><button type="submit" name="cercar" value="grup" title="%s">%s</td>',
	__('ajuda-notes-escollir', 'ricca3-aval'), __('escollir', 'ricca3-aval'));
//		drop per el any
	$data_any = $wpdb->get_results('SELECT * FROM ricca3_any', ARRAY_A );
	ricca3_drop_any( __('Any:','ricca3-aval'), 'any', $data_any, 'idany', 'any', __('ajuda_notes_any', 'ricca3-aval'), 'actual' );
//		drop per el grup
	$data_grup = $wpdb->get_results('SELECT * FROM ricca3_grups WHERE actiu_gr = 1 ORDER BY grup ', ARRAY_A );
	ricca3_drop( __('Grup:','ricca3-aval'), 'grup',  $data_grup,  'idgrup', 'grup',  __('ajuda_notes_grup', 'ricca3-aval'), TRUE );
//	
	if( !isset( $_POST['data'] ) ){
		$data = strftime("%d/%m/%Y");
	}else{
		$data = $_POST['data'];
	}
	printf('<td><INPUT type="text" name="data"	size=15 value="%s"></td>', $data);
	printf('</tr></table></form>', NULL);
//
	if( isset( $_POST['grup'] ) && $_POST['grup'] != '-1'){
		$row_grup = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_grups WHERE idgrup = %s', $_POST['grup'] ), ARRAY_A, 0 );
		ricca3_missatge(sprintf('%s %s %s %s', __('Certificats de','ric-ca-aval'), $row_grup['grup'], __('amb data','ric-ca-aval'), $_POST['data']) );
		printf('<table><tr>', NULL);
		printf('<td><a href="%s/%s/?grup=%s&any=%s&data=%s" target="POPUPW" onsubmit="POPUPW = window.open("about:blank","POPUPW","width=800,height=650" >',
			site_url(), 'ricca3-impcertif', $_POST['grup'], $_POST['any'], $_POST['data']);
		printf('<button type="button"><img src="%s/ricca3/imatges/ricca3-%s.png" border=0 /></button></a></td>',WP_PLUGIN_URL, 'impassist');
		printf('</tr></table>', NULL);
	}
}

#############################################################################################
/**
 * impresió certificats avaluacions
 * shortcode: [ricca3-impcertif]
 *
 * @since ricca3.v.2013.20.7
 * @author Efraim Bayarri
 */
#############################################################################################
function ricca3_shortcode_impcertif($atts, $content = null) {
	global $wpdb;
	
	$row_any  = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_any  WHERE idany  = %s', $_GET['any'] ), ARRAY_A, 0);
	$dades_espec = $wpdb->get_results( $wpdb->prepare('SELECT * FROM ricca3_alumespec_view WHERE idany=%s AND idgrup=%s AND idestat_es=1 ORDER BY cognomsinom ASC', 
			$_GET['any'], $_GET['grup']), ARRAY_A);
//		loop alumnes	
	for( $i=0; $i < count($dades_espec); $i++){
##
##	CAPÇALERA
##
		printf('<table class="cap"><tr><td><IMG SRC="%s/ricca3/imatges/ricca3-logo.jpg" ALIGN=left><IMG SRC="%s/ricca3/imatges/ricca3-adreca.png" ALIGN=left></td></tr></table>', WP_PLUGIN_URL, WP_PLUGIN_URL );
		printf('<table class="center"><tr><td><font face="Arial, Helvetica, sans-serif">%s',
			__('BUTLLETÍ DE NOTES','ricca3-aval'));
		printf('</font></td></tr></table><table class="cap"><tr><td width="80%%">', NULL);
		printf('%s %s</td><td width="20%%">',
			__('ESPECIALITAT:','ricca3-aval'), $dades_espec[$i]['nomespecialitat']);
		printf('%s %s</td></tr><tr><td width="80%%">',
			__('ANY:','ricca3-aval'), $row_any['any'] );
		printf('%s %s</td><td width="20%%"></td></tr><tr><td></td><td></td></tr><tr><td width="80%%">', 
			__('CURS:','ricca3-aval'), $dades_espec[$i]['curs'] );
		printf('%s %s</td><td></td></tr></table>',
			__('ALUMNE/A:','ric-ca-aval'), $dades_espec[$i]['cognomsinom']);
##
##	FINAL DE CAPÇALERA
##
		printf('<table class="cos"><tr><td align="center" width="70%%">%s', __('Nom del crèdit','ric-ca-aval'));
		printf('</td><td align="center" width="10%%">%s', __('1ª ava.','ric-ca-aval'));
		printf('</td><td align="center" width="10%%">%s', __('2ª ava.','ric-ca-aval'));
		printf('</td><td align="center" width="10%%">%s', __('Actitud','ric-ca-aval'));
		printf('</td></tr>', NULL);
			
		$dades_ccomp = $wpdb->get_results( $wpdb->prepare('SELECT * FROM ricca3_credits_avaluacions '.
			'INNER JOIN ricca3_ccomp ON ricca3_ccomp.idccomp = ricca3_credits_avaluacions.idccomp '.
			'WHERE idany=%s AND idgrup=%s and idalumne=%s',
			$_GET['any'], $_GET['grup'], $dades_espec[$i]['idalumne']), ARRAY_A);
		for( $j=0; $j < count($dades_ccomp); $j++ ){
			printf('<tr><td>%s</td><td align="center">%s</td><td align="center">%s</td><td align="center">',
				$dades_ccomp[$j]['nomccomp'], $dades_ccomp[$j]['nota1'], $dades_ccomp[$j]['nota2']);
			if( $dades_ccomp[$j]['act2'] != ""){
				echo $dades_ccomp[$j]['act2'];
			}else{
				echo $dades_ccomp[$j]['act1'];
			}
			printf('</td></tr>', NULL);
		}
		printf('</table>');
##
##	PEU DE PAGINA
##
		printf('<table class="cap"><tr><td></td></tr><tr><td>%s', 
			__('VALORACIÓ DE L\'ACTITUD ( A: Molt bona, B: Bona, C: Normal, D: Passiva, E: Negativa)','ricca3-aval'));
		printf('</td></tr><tr><td></td></tr><tr><td></td></tr></table><table class="cap"><tr><td>%s', 
			__('OBSERVACIONS:','ricca3-aval'));
		printf('</td><td></td></tr><tr><td></td><td>%s</td></tr><tr><td></td><td></td></tr>', 
			$dades_espec[$i]['observ3']);
		printf('<tr><td align="right"></td><td>%s</td></tr>', 
			$dades_espec[$i]['observ1']);
		printf('<tr><td align="right"></td><td>%s</td></tr></table><table class="cap"><tr><td>', 
			$dades_espec[$i]['observ2']);
		printf('%s %s</td></tr></table>',  
			__('Barcelona, a','ricca3-aval'), $_GET['data']);
		$table=" class=\"cap\" style=\"page-break-after: always;\" ";
		if($i == count($dades_espec) - 1) $table=" class=\"cap\" ";
		printf('<table %s><tr><td></td></tr><tr><td width="80%%">',$table);
		printf('%s</td><td width="20%%">', __('Vist i plau','ric-ca-aval'));
		printf('%s</td></tr><tr><td>',     __('Segell del centre','ric-ca-aval'));
		printf('%s</td></tr></table>',     __('Direcció Docent','ric-ca-aval'));
	}	
}

