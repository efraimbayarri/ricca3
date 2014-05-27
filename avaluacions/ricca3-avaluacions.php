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
//	preparar ajudes als butons
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
					printf('<table class="center"><tr><td><font face="Arial, Helvetica, sans-serif">%s</font></td></tr></table>', __('ACTA D\'AVALUACIÓ','ricca3-aval'));
					printf('<table class="cap"><tr><td>%s %s</td></tr></table>',       __('CRÉDIT:','ricca3-aval'), $dades_pla[$i]['nomcredit']);
					printf('<table class="cap"><tr><td width="400px">%s %s</td>',      __('CURS:','ricca3-aval'), $dades_pla[$i]['any'] );
					printf('                       <td width="400px">%s %s</td></tr>', __('DATA:','ricca3-aval'), $_GET['data']);
					printf('                   <tr><td              >%s %s</td>',      __('ESPECIALITAT:','ricca3-aval'), $dades_pla[$i]['nomespecialitat']);
					printf('                       <td              >%s %s</td></tr>', __('GRUP:','ricca3-aval'), $dades_pla[$i]['grup'] );
					printf('                   <tr><td              >%s %s</td>',      __('PROFESSOR/A:','ricca3-aval'), $dades_pla[$i]['nomicognoms']);
					printf('                       <td              >%s %s</td></tr>', __('TUTOR/A:','ricca3-aval'), $dades_pla[$i]['nomicognomstut']);
					printf('                   <tr><td align="center" colspan="2"> %s</td></tr></table>',$row_aval['nomaval']);
				}
				if($j == 0 || $j == 20 ){
					$table = " class=\"cos\" style=\"page-break-after: always;\" ";
				}else{
					$table=" class=\"cos\" ";
				}
				if($j == 0 || $j == 20){
					printf('<table %s>', $table);
					printf('<tr><td width="560px" align="center">%s</td>',      __('Alumnes','ricca3-aval'));
					printf('    <td width="120px" align="center">%s</td>',      __('Qualificació','ricca3-aval') );
					printf('    <td width="120px" align="center">%s</td></tr>', __('Actitud','ricca3-aval'));
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
			printf('<table class="center"><tr><td><font face="Arial, Helvetica, sans-serif">%s</font></td></tr></table>',  __('ACTA D\'AVALUACIÓ','ricca3-aval'));
			printf('<table class="cap"><tr><td>%s %s</td></tr></table>',       __('CRÉDIT:','ricca3-aval'), $dades[0]['nomccomp'] );
			printf('<table class="cap"><tr><td width="400px">%s %s</td>',      __('CURS:','ricca3-aval'), $dades[0]['any']);
			printf('                       <td width="400px">%s %s</td></tr>', __('DATA:','ricca3-aval'), $_GET['data'] );
			printf('                   <tr><td              >%s %s</td>',      __('ESPECIALITAT:','ricca3-aval'), $dades[0]['nomespecialitat'] );
			printf('                       <td              >%s %s</td></tr>', __('GRUP:','ricca3-aval'), $dades[0]['grup'] );
			printf('                   <tr><td              >%s %s</td>',      __('PROFESSOR/A:','ricca3-aval'), $dades[0]['nomicognoms']);
			printf('                       <td              >%s %s</td></tr>', __('TUTOR/A:','ricca3-aval'), $dades[0]['nomicognomstut']);
			printf('                   <tr><td align="center" colspan="2">%s</td></tr></table>',$row_aval['nomaval']);
			$table = " class=\"cos\" style=\"page-break-after: always;\" ";
			if($i == count($dades_ccomp) - 1) $table=" class=\"cos\" ";
			printf('<table %s border="1" >', $table);
			printf('', NULL);
			printf('<tr><td width="560px" align="center">%s</td>',      __('Alumnes','ricca3-aval'));
			printf('    <td width="120px" align="center">%s</td>',      __('Qualificació','ricca3-aval') );
			printf('    <td width="120px" align="center">%s</td></tr>', __('Actitud','ricca3-aval'));
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
		if( $row_grup['idgrup'] == 17 ){
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
				'WHERE ricca3_credits_avaluacions.idccomp = %s AND ricca3_credits_avaluacions.idany = %s AND idestat_es = 1 ORDER BY cognomsinom ASC ',
				$_POST['ccomp'], $row_any['idany'] );
		}else{
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
				'WHERE ricca3_credits_avaluacions.idccomp = %s AND ricca3_credits_avaluacions.idany = %s AND idestat_es = 1 AND ricca3_alumne_especialitat.idany = %s ORDER BY cognomsinom ASC ',
				$_POST['ccomp'], $row_any['idany'], $row_any['idany'] );
		}

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
					printf('<td><INPUT type="text" name="nota1[]" value="%s" autocomplete="off" tabindex=%s></td>', $dades_cred[$i]['nota1'], $i + 1);
					printf('<td><INPUT type="text" name="act1[]"  value="%s" autocomplete="off" tabindex=%s></td></tr>', $dades_cred[$i]['act1'], $i + count($dades_cred) + 1);
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
					printf('<td>%s</td><td>%s</td><td> - </td><td><INPUT type="text" name="nota2[]" value="%s" autocomplete="off" tabindex=%s></td>', 
						$dades_cred[$i]['nota1'], $dades_cred[$i]['act1'], $dades_cred[$i]['nota2'],$i + 1);
					printf('<td><INPUT type="text" name="act2[]"  value="%s" autocomplete="off" tabindex=%s></td></tr>', 
						$dades_cred[$i]['act2'], $i + count($dades_cred) + 1);
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
					printf('<td>%s</td><td>%s</td><td> - </td><td>%s</td><td>%s</td><td> - </td><td><INPUT type="text" name="nota3[]" value="%s" autocomplete="off" tabindex=%s></td>', 
						$dades_cred[$i]['nota1'], $dades_cred[$i]['act1'], $dades_cred[$i]['nota2'], $dades_cred[$i]['act1'], $dades_cred[$i]['nota3'],$i + 1);
					printf('<td><INPUT type="text" name="actf[]"  value="%s" autocomplete="off" tabindex=%s></td></tr>', $dades_cred[$i]['actf'], $i + count($dades_cred) + 1);
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
						printf('<td>%s</td><td>%s</td><td> - </td><td>%s</td><td>%s</td><td> - </td><td>%s</td><td>%s</td><td> - </td><td><INPUT type="text" name="notaf_cc[]" value="%s" ><INPUT type="hidden" name="notaf_cr[]" value="%s" autocomplete="off" tabindex=%s></td></tr>', 
							$dades_cred[$i]['nota1'], $dades_cred[$i]['act1'], $dades_cred[$i]['nota2'], $dades_cred[$i]['act1'], $dades_cred[$i]['nota3'], $dades_cred[$i]['actf'], $dades_cred[$i]['notaf_cc'], $dades_cred[$i]['notaf_cr'],$i + 1);
						$z++;
					}
				}
			}else{
				printf('<table><tr><th>%s</th><th>%s</th><th>%s</th><th></th><th>%s</th><th>%s</th><th></th><th>%s</th><th>%s</th><th></th><th>%s</th><th>%s</th></tr>',
				__('Alumne','ricca3-aval'), __('N1', 'ricca3-aval'), __('A1', 'ricca3-aval'), __('N2', 'ricca3-aval'), __('A2', 'ricca3-aval'), __('N3', 'ricca3-aval'), __('A3', 'ricca3-aval'), __('Nota Final C. Comp.', 'ricca3-aval'),__('Nota Final Crèdit', 'ricca3-aval') );
				for( $i=0; $i < count($dades_cred); $i++){
					if( ($dades_cred[$i]['repe'] != 'R' && $_POST['repe'] != 'si') || ($dades_cred[$i]['repe'] == 'R' && $_POST['repe'] == 'si') ){
						printf('<tr><td>%s - %s</td>', $z+1,$dades_cred[$i]['cognomsinom'] );
						printf('<td>%s</td><td>%s</td><td> - </td><td>%s</td><td>%s</td><td> - </td><td>%s</td><td>%s</td><td> - </td><td><INPUT type="text" name="notaf_cc[]" value="%s" autocomplete="off" tabindex=%s></td><td><INPUT type="text" name="notaf_cr[]" value="%s" autocomplete="off" tabindex=%s></td></tr>',
						$dades_cred[$i]['nota1'], $dades_cred[$i]['act1'], $dades_cred[$i]['nota2'], $dades_cred[$i]['act1'], $dades_cred[$i]['nota3'], $dades_cred[$i]['actf'], $dades_cred[$i]['notaf_cc'],$i + 1, $dades_cred[$i]['notaf_cr'], $i + count($dades_cred) + 1);
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
//		dump_r($_POST);
		$quants = count( $_POST['RECORD'] );
		$row_ccomp  = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_ccomp WHERE idccomp = %s', $_POST['ccomp']),  ARRAY_A, 0);
		for( $i = 0; $i < $quants; $i++){
			$count = $wpdb->query($wpdb->prepare('SELECT * FROM ricca3_ccomp WHERE idcredit=%s AND idgrup=%s ', $row_ccomp['idcredit'], $row_ccomp['idgrup']));
//			dump_r($row_ccomp);
			if($count=='1')$_POST['notaf_cr'][$i]=$_POST['notaf_cc'][$i];
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
			printf('<tr><td>%s</td><td><textarea accesskey="" cols="60" rows="3" name="observ3" title="observ3" style="font-family:Arial; font-size:10pt" >%s</textarea>',
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
			ricca_missatge( __('No hi han alumnes seleccionats. Si us plau selecioneu-ne un.','ricca3-aval'));
			return;
		}
		$row_any  = $wpdb->get_row( 'SELECT * FROM ricca3_any WHERE actual = 1',  ARRAY_A, 0);
		$row_alum = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_alumne WHERE idalumne=%s', $_POST['cbox']), ARRAY_A, 0);
		$row = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_alumne_especialitat WHERE idalumne=%s AND idany=%s', $_POST['cbox'], $row_any['idany']), ARRAY_A, 0);
		printf('<form method="post" action="" name="cercar"><table>', NULL);
		printf('<tr><td>%s %s %s</td><td><textarea accesskey="" cols="60" rows="3" name="observ1" title="observ1" style="font-family:Arial; font-size:10pt">%s</textarea></td></tr>',
			__('Observacions de l\'alumne','ricca3-aval'), $row_alum['cognomsinom'], __('per a la primera avaluació','ricca3-aval'), $row["observ1"]);
		printf('<tr><td>%s %s %s</td><td><textarea accesskey="" cols="60" rows="3" name="observ2" title="observ2" style="font-family:Arial; font-size:10pt">%s</textarea></td></tr>',
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
		ricca3_missatge(sprintf('%s %s %s %s', __('Certificats de','ricca3-aval'), $row_grup['grup'], __('amb data','ricca3-aval'), $_POST['data']) );
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
		printf('<table class="cap"><tr><td>&nbsp</td></tr></table>');
		printf('<table class="cap"><tr><td><IMG SRC="%s/ricca3/imatges/ricca3-logo.jpg" ALIGN=left><IMG SRC="%s/ricca3/imatges/ricca3-adreca.png" ALIGN=left></td></tr></table>', WP_PLUGIN_URL, WP_PLUGIN_URL );
		printf('<table class="center"><tr><td>&nbsp</td></tr><tr><td><font face="Arial, Helvetica, sans-serif">%s</font></td></tr><tr><td>&nbsp</td></tr></table>',
			__('BUTLLETÍ DE NOTES','ricca3-aval'));
		printf('<table class="cap"><tr><td width="80%%">%s %s</td><td width="20%%">', 
			__('ESPECIALITAT:','ricca3-aval'), $dades_espec[$i]['nomespecialitat']);
		printf('%s %s</td></tr><tr><tr><td>&nbsp</td></tr><td width="80%%">',
			__('ANY:','ricca3-aval'), $row_any['any'] );
		printf('%s %s</td><td width="20%%"></td></tr><tr><td></td><td></td></tr><tr><td>&nbsp</td></tr><tr><td width="80%%">', 
			__('CURS:','ricca3-aval'), $dades_espec[$i]['curs'] );
		printf('%s %s</td><td></td></tr><tr><td>&nbsp</td></tr></table>',
			__('ALUMNE/A:','ricca3-aval'), $dades_espec[$i]['cognomsinom']);
##
##	FINAL DE CAPÇALERA
##
		printf('<table class="cos"><tr><td align="center" width="70%%">%s', __('Nom del crèdit','ricca3-aval'));
		printf('</td><td align="center" width="10%%">%s', __('1ª ava.','ricca3-aval'));
		printf('</td><td align="center" width="10%%">%s', __('2ª ava.','ricca3-aval'));
		printf('</td><td align="center" width="10%%">%s', __('Actitud','ricca3-aval'));
		printf('</td></tr>', NULL);
			
		$dades_grup = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_grups WHERE idgrup=%s ', $_GET['grup']), ARRAY_A, 0);
		
		$dades_ccomp = $wpdb->get_results( $wpdb->prepare('SELECT * FROM ricca3_credits_avaluacions '.
			'INNER JOIN ricca3_ccomp ON ricca3_ccomp.idccomp = ricca3_credits_avaluacions.idccomp '.
			'INNER JOIN ricca3_credits ON ricca3_credits.idcredit = ricca3_ccomp.idcredit '.
//			'WHERE idany=%s AND idgrup=%s and idalumne=%s ORDER BY ordre_cr',
//			$_GET['any'], $_GET['grup'], $dades_espec[$i]['idalumne']), ARRAY_A);
			'WHERE idany=%s AND idespecialitat=%s and idalumne=%s ORDER BY ordre_cr',
			$_GET['any'], $dades_grup['idespecialitat'], $dades_espec[$i]['idalumne']), ARRAY_A);
		
//		dump_r($dades_grup);
//		dump_r($dades_ccomp);
		
		$queaval="1";
		for( $j=0; $j < count($dades_ccomp); $j++ ){
			printf('<tr><td>%s</td><td align="center">%s</td><td align="center">%s</td><td align="center">',
				$dades_ccomp[$j]['nomccomp'], $dades_ccomp[$j]['nota1'], $dades_ccomp[$j]['nota2']);
			if( $dades_ccomp[$j]['act2'] != ""){
				echo $dades_ccomp[$j]['act2'];
				$queaval="2";
			}else{
				echo $dades_ccomp[$j]['act1'];
			}
			printf('</td></tr>', NULL);
		}
		printf('</table>');
##
##	PEU DE PAGINA
##
		printf('<table class="cap"><tr><td>&nbsp</td></tr><tr><td>%s', 
			__('VALORACIÓ DE L\'ACTITUD ( A: Molt bona, B: Bona, C: Normal, D: Passiva, E: Negativa)','ricca3-aval'));
		printf('</td></tr><tr><td>&nbsp</td></tr><tr><td>&nbsp</td></tr></table><table class="cap"><tr><td>%s', 
			__('OBSERVACIONS:','ricca3-aval'));
		printf('</td><td></td></tr><tr><td></td><td>%s</td></tr><tr><td></td><td></td></tr>', 
			$dades_espec[$i]['observ3']);
		if($queaval=="1"){
			printf('<tr><td align="right"></td><td>%s</td></tr>', 
				$dades_espec[$i]['observ1']);
		}
		printf('<tr><td align="right"></td><td>%s</td></tr></table><table class="cap"><tr><td>&nbsp</td></tr><tr><td>', 
			$dades_espec[$i]['observ2']);
		printf('%s %s</td></tr></table>',  
			__('Barcelona, a','ricca3-aval'), $_GET['data']);
		$table=" class=\"cap\" style=\"page-break-after: always;\" ";
		if($i == count($dades_espec) - 1) $table=" class=\"cap\" ";
		printf('<table %s><tr><td>&nbsp</td></tr><tr><td width="80%%">',$table);
		printf('%s</td><td width="20%%">', __('Vist i plau','ricca3-aval'));
		printf('%s</td></tr><tr><td>',     __('Segell del centre','ricca3-aval'));
		printf('%s</td></tr></table>',     __('Direcció Docent','ricca3-aval'));
	}	
}

#############################################################################################
/**
 * entrada impresió certificats 1 curs
 * shortcode: [ricca3-certifcurs1]
 *
 * @since ricca3.v.2013.32.3
 * @author Efraim Bayarri
 */
#############################################################################################
function ricca3_shortcode_certifcurs1($atts, $content = null) {
	global $wpdb;
	global $ricca3_butons_actes;
	
	ricca3_missatge( __('Certificats Primer Curs','ricca3-aval'));
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
	$data_grup = $wpdb->get_results('SELECT * FROM ricca3_grups INNER JOIN ricca3_especialitats ON ricca3_grups.idespecialitat = ricca3_especialitats.idespecialitat '.
		'WHERE actiu_gr = 1 AND idcurs=1 AND cursos=2 ORDER BY grup ', ARRAY_A );
	ricca3_drop( __('Grup:','ricca3-aval'), 'grup',  $data_grup,  'idgrup', 'grup',  __('ajuda_notes_grup', 'ricca3-aval'), TRUE );
//	
	if( !isset( $_POST['data'] ) ){
		$data = strftime("%d/%m/%Y");
	}else{
		$data = $_POST['data'];
	}
	printf('<td><INPUT type="text" name="data"	size=15 value="%s"></td>', $data);
	
	if( isset( $_POST['cast']) && $_POST['cast'] == 'si'){
		printf('<td>%s<input type="checkbox" accesskey="" name="cast" value="si" title="" class="" checked></td>' , __('Cast','ricca3-aval') );
	}else{
		printf('<td>%s<input type="checkbox" accesskey="" name="cast" value="si" title="" class="" ></td>' , __('Cast','ricca3-aval') );
		$_POST['cast'] = 'no';
	}
	
	printf('</tr></table></form>', NULL);
//
	if( isset( $_POST['grup'] ) && $_POST['grup'] != '-1'){
		$row_grup = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_grups WHERE idgrup = %s', $_POST['grup'] ), ARRAY_A, 0 );
		ricca3_missatge(sprintf('%s %s %s %s', __('Certificats de','ricca3-aval'), $row_grup['grup'], __('amb data','ricca3-aval'), $_POST['data']) );
		printf('<table><tr>', NULL);
		printf('<td><a href="%s/%s/?grup=%s&any=%s&data=%s&local=%s" target="POPUPW" onsubmit="POPUPW = window.open("about:blank","POPUPW","width=800,height=650" >',
		site_url(), 'ricca3-impcertifcurs1', $_POST['grup'], $_POST['any'], $_POST['data'], $_POST['cast']);
		printf('<button type="button"><img src="%s/ricca3/imatges/ricca3-%s.png" border=0 /></button></a></td>',WP_PLUGIN_URL, 'impassist');
		printf('</tr></table>', NULL);
	}
}

#############################################################################################
/**
 * impresió certificats 1 curs
 * shortcode: [ricca3-impcertifcurs1]
 *
 * @since ricca3.v.2013.32.3
 * @author Efraim Bayarri
 */
#############################################################################################
function ricca3_shortcode_impcertifcurs1($atts, $content = null) {
	global $wpdb;
	
//	$row_any  = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_any   WHERE idkey  = %s', $_GET['any'] ), ARRAY_A, 0);
	$row_grup = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_grups WHERE idgrup = %s', $_GET['grup'] ), ARRAY_A, 0 );
	
	$query_alum  = $wpdb->prepare( 'SELECT * FROM ricca3_alumespec_view WHERE idany = %s AND idgrup = %s AND idestat_es=1 AND repeteix !="R" ORDER BY cognomsinom ASC ',$_GET['any'], $_GET['grup'] );
	$dades_alum = $wpdb->get_results( $query_alum, ARRAY_A);
//
	$cicle =  __('CICLE FORMATIU DE GRAU SUPERIOR','ricca3-aval');
	$curs  =  __('CURS ACADÈMIC:','ricca3-aval');
	$alumne = __('ALUMNE/A:','ricca3-aval');
	$curs2 =  __('CURS:','ricca3-aval');
	$primer = __('1er','ricca3-aval');
	$linea1 = __('L\'alumne/a ha realitzat els següents crèdits durant el curs acadèmic','ricca3-aval');
	$modul1 = __('L\'alumne/a ha realitzat els següents mòduls durant el curs acadèmic','ricca3-aval');
	$linea2 = __('i ha obtingut les següents qualificacions:','ricca3-aval');
	$capmodul = __('MÒDUL','ricca3-aval');
	$nommodul = __('NOM DEL MÒDUL','ricca3-aval');
	$capcredit = __('CRÈDIT','ricca3-aval');
	$nomcredit = __('NOM DEL CRÈDIT','ricca3-aval');
	$hores     = __('HORES','ricca3-aval');
	$data      = __('Data:','ricca3-aval');
	$segell    = __('Segell del Centre', 'ricca3-aval');
	if( $_GET['local'] == 'si'){
		$cicle =  __('CICLO FORMATIVO DE GRADO SUPERIOR','ricca3-aval');
		$curs  =  __('CURSO ACADÉMICO:','ricca3-aval');
		$alumne = __('ALUMNO/A:','ricca3-aval');
		$curs2 =  __('CURSO:','ricca3-aval');
		$primer = __('1º','ricca3-aval');
		$linea1 = __('El alumno/a ha realizado los seguientes créditos durante el curso académico','ricca3-aval');
		$modul1 = __('El alumno/a ha realizado los seguientes módulos durante el curso académico','ricca3-aval');
		$linea2 = __('y ha obtenido las siguientes calificaciones:','ricca3-aval');
		$capmodul = __('MÓDULO','ricca3-aval');
		$nommodul = __('NOMBRE DEL MÓDULO','ricca3-aval');
		$capcredit = __('CRÉDITO','ricca3-aval');
		$nomcredit = __('NOMBRE DEL CRÉDITO','ricca3-aval');
		$hores     = __('HORAS','ricca3-aval');
		$data      = __('Fecha:','ricca3-aval');
		$segell    = __('Sello del Centro', 'ricca3-aval');
	}
	for( $i = 0; $i < count($dades_alum); $i++){
		printf('<table class="cap"><tr><td><IMG SRC="%s/ricca3/imatges/ricca3-logo.jpg" ALIGN=left><IMG SRC="%s/ricca3/imatges/ricca3-adreca.png" ALIGN=left></td></tr></table>', WP_PLUGIN_URL, WP_PLUGIN_URL );
		printf('<br /><table class="center"><tr><td><font face="Arial, Helvetica, sans-serif"><b>%s ',	$cicle);
//
		if($_GET['local'] != 'si' && ($_GET['grup'] == '7' || $_GET['grup'] == '9')){
			printf('D\'', NULL);
		}else{
			printf('DE ', NULL);
		}
		printf('%s</b></font></td></tr></table>', $dades_alum[$i]['nomespecialitat']);
		printf('<br /><table><tr><td><font face="Arial, Helvetica, sans-serif"><b>%s %s</b></font></td></tr></table>', $curs, $dades_alum[$i]['any']);
		printf('<br /><table><tr><td><font face="Arial, Helvetica, sans-serif"><b>%s %s </b></font></td></tr></table>', $alumne, mb_strtoupper($dades_alum[$i]["cognomsinom"], "utf-8"));
		printf('<table><tr><td><font face="Arial, Helvetica, sans-serif"><b>%s %s</b></font></td></tr></table>', __('DNI:','ricca3-aval'), $dades_alum[$i]['dni']);
		printf('<table><tr><td><font face="Arial, Helvetica, sans-serif"><b>%s %s</b></font></td></tr></table>', $curs2, $primer);
// diferencia entre modul i crèdit
		if($_GET['grup'] == '1' || $_GET['grup'] == '4'){
			printf('<table><tr><td> &nbsp;</td></tr><tr><td><font face="Arial, Helvetica, sans-serif"><b>%s %s %s</b></font></td></tr></table>', $modul1, $dades_alum['any'], $linea2 );
		}else{
			printf('<table><tr><td> &nbsp;</td></tr><tr><td><font face="Arial, Helvetica, sans-serif"><b>%s %s %s</b></font></td></tr></table>', $linea1, $row['any'], $linea2);
		}
##
##	FINAL DE CAPÇALERA
##
// diferencia entre modul i crèdit
		if($_GET['grup'] == '1' || $_GET['grup'] == '10'){
			printf('<table class="cos"><tr><td align="center" width="15%%">%s</td>', $capmodul);
			printf('<td align="center" width="65%%">%s</td>',                        $nommodul);
		}else{
			printf('<table class="cos"><tr><td align="center" width="15%%">%s</td>', $capcredit);
			printf('<td align="center" width="65%%">%s</td>',                        $nomcredit);
		}
		printf('<td align="center" width="10%%">%s</td>',                        $hores);
		printf('<td align="center" width="10%%">%s</td></tr>',                   __('NOTA','ricca3-aval'));
//	
	$query_cred = $wpdb->prepare('SELECT DISTINCT ordre_cr, credit, hores_cr, notaf_cr FROM ricca3_credits_avaluacions '.
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
		'WHERE ricca3_credits_avaluacions.idany=%s AND ricca3_especialitats.idespecialitat=%s and ricca3_alumne.idalumne=%s ORDER BY ordre_cr ASC, nomccomp ASC ', 
		$_GET['any'], $row_grup['idespecialitat'], $dades_alum[$i]['idalumne']);
	
		$dades_cred = $wpdb->get_results( $query_cred, ARRAY_A);
		for ( $j = 0; $j < count($dades_cred); $j++){
//	no incloure el crèdit d'informàtica a pròtesis primer
			if($dades_cred[$j]['ordre_cr'] == '20' && $_GET['grup'] == '1'){
//	fi de no incloure
			}else{
				if($dades_cred[$j]['ordre_cr'] == '20'){
					printf('<tr><td align="center"><b></b><br /></td><td>%s</td><td align="center">%s</td><td align="center">%s</td></tr>',
						$dades_cred[$j]['credit'], $dades_cred[$j]['hores_cr'], $dades_cred[$j]['notaf_cr']);
				}else{
					printf('<tr><td align="center"><b>%s</b><br /></td><td>%s</td><td align="center">%s</td><td align="center">%s</td></tr>',
						$dades_cred[$j]['ordre_cr'], $dades_cred[$j]['credit'], $dades_cred[$j]['hores_cr'], $dades_cred[$j]['notaf_cr']);
				}
			}
		}
	printf('</table>', NULL);
##
##	PEU DE PAGINA
##
	printf('<table class="cap"><tr><td width="81%%"> &nbsp; </td><td> &nbsp; </td></tr><tr><td>%s %s</td><td></td></tr>',
			$data, $_GET['data']);
	printf('<tr><td> &nbsp; </td><td></td></tr><tr><td> &nbsp; </td><td></td></tr><tr><td>%s</td><td>%s</td></tr></table>',
			__('El/la director/a','ricca3-aval'), $segell);
	
	$table=" class=\"cap\" style=\"page-break-after: always;\" ";
	if($i == $result_alum - 1) $table=" class=\"cap\" ";
		printf('<table %s><tr><td></td></tr></table>',$table);
	}	
}

#############################################################################################
/**
 * entrada impresió certificats final
 * shortcode: [ricca3-certiffinal]
 *
 * @since ricca3.v.2013.47.1
 * @author Efraim Bayarri
 */
#############################################################################################
function ricca3_shortcode_certiffinal($atts, $content = null) {
	global $wpdb;
	global $ricca3_butons_actes;

	ricca3_missatge(__('Certificats Final','ricca3-aval'));	
	ricca3_butons( $ricca3_butons_actes, 6 );
//	
	printf('<form method="post" action="" name="cercar"><table dir="ltr" class="menucurt800"><tr>', NULL);
	printf('<td><button type="submit" name="cercar" value="grup"><img src=%s/ricca3/imatges/ricca3-escollirgrup.png " border="0" /></button></td>',WP_PLUGIN_URL);
//	
//		drop per el any
	$data_any = $wpdb->get_results('SELECT * FROM ricca3_any', ARRAY_A );
	ricca3_drop_any( __('Any:','ricca3-aval'), 'any', $data_any, 'idany', 'any', __('ajuda_notes_any', 'ricca3-aval'), 'actual' );
//		drop per el grup
	$data_grup = $wpdb->get_results('SELECT * FROM ricca3_grups INNER JOIN ricca3_especialitats ON ricca3_grups.idespecialitat = ricca3_especialitats.idespecialitat '.
		'WHERE actiu_gr = 1 AND ( idcurs=2 OR ricca3_grups.idespecialitat=6 OR ricca3_grups.idespecialitat=7) ORDER BY grup ', ARRAY_A );
	ricca3_drop( __('Grup:','ricca3-aval'), 'grup',  $data_grup,  'idgrup', 'grup',  __('ajuda_notes_grup', 'ricca3-aval'), TRUE );
//	
	if( !isset( $_POST['data'] ) ){
		$data = strftime("%d/%m/%Y");
	}else{
		$data = $_POST['data'];
	}
	printf('<td><INPUT type="text" name="data"	size=15 value="%s"></td>', $data);
	
	
	if( isset( $_POST['cast']) && $_POST['cast'] == 'si'){
		printf('<td>%s<input type="checkbox" accesskey="" name="cast" value="si" title="" class="" checked></td>' , __('Cast','ricca3-aval') );
	}else{
		printf('<td>%s<input type="checkbox" accesskey="" name="cast" value="si" title="" class="" ></td>' , __('Cast','ricca3-aval') );
		$_POST['cast'] = 'no';
	}
	
	printf('</tr></table></form>', NULL);
	if( isset( $_POST['grup'] ) && $_POST['grup'] != '-1'){
		$row_grup = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_grups WHERE idgrup = %s', $_POST['grup'] ), ARRAY_A, 0 );
		ricca3_missatge(sprintf('%s %s %s %s', __('Certificats finals de','ricca3-aval'), $row_grup['grup'], __('amb data','ricca3-aval'), $_POST['data']) );
		printf('<table><tr>', NULL);
		printf('<td><a href="%s/%s/?grup=%s&any=%s&data=%s&local=%s" target="POPUPW" onsubmit="POPUPW = window.open("about:blank","POPUPW","width=800,height=650" >',
		site_url(), 'ricca3-impcertiffinal', $_POST['grup'], $_POST['any'], $_POST['data'], $_POST['cast']);
		printf('<button type="button"><img src="%s/ricca3/imatges/ricca3-%s.png" border=0 /></button></a></td>',WP_PLUGIN_URL, 'impassist');
		printf('</tr></table>', NULL);
	}
}

#############################################################################################
/**
 * impresió certificats finals
 * shortcode: [ricca3-impcertiffinal]
 *
 * @since ricca3.v.2013.32.3
 * @author Efraim Bayarri
 */
#############################################################################################
function ricca3_shortcode_impcertiffinal($atts, $content = null) {
	global $wpdb;
//localització
	$certif      = __('Certificat d\'estudis complerts de CFGS, per a l\'accès a estudis universitaris','ricca3-aval');
	$dadescentre = __('Dades del Centre','ricca3-aval');
	$codicentre  = __('Codi','ricca3-aval');
	$nomcentre   = __('Nom del centre','ricca3-aval');
	$adreca      = __('Adreça','ricca3-aval');
	$municipi    = __('Municipi','ricca3-aval');
	$carles      = __('CARLOS AYLAGAS MOLERO, secretari de centre ESCOLA RAMON I CAJAL, d\'acord amb la documentació que hi ha disponible en aquesta secretaria,','ricca3-aval');
	$dni         = __('amb DNI/NIE/Passaport Nº','ricca3-aval');
	$numdni      = __('amb el document de identificació','ricca3-aval');
	$cursat      = __('ha cursat i superat el cicle formatiu','ricca3-aval');
	$reial1      = __('regulat pel Reial decret número','ricca3-aval');
	$reial2      = __('/1995 de data 7 d\'abril','ricca3-aval');
	$qualifica   = __('l\'alumne/a ha obtingut la qualificació final de:','ricca3-aval');
	$consti      = __('I, per que consti, signo aquest certificat, amb el vist i plau de la directora del centre.','ricca3-aval');
	$firma       = __('Signatura del secretari','ricca3-aval');
	$vistiplau   = __('Vist i plau de la directora','ricca3-aval');
	$nom         = __('Nom i cognoms','ricca3-aval');
	$segell      = __('SEGELL DEL CENTRE','ricca3-aval');
//
	$histo       = __('Historial acadèmic','ricca3-aval');
	$resultats   = __('Resultats de l\'avaluació dels crèdits','ricca3-aval');
	$forma       = __('Formació professional inicial','ricca3-aval');
	$dadesalum   = __('Dades de l\'alumne/a','ricca3-aval');
	$cognoms     = __('Cognoms i nom','ricca3-aval');
	$passap      = __('DNI/NIE/passaport','ricca3-aval');
	$numident    = __('Núm. d\'identificació','ricca3-aval');
	$dadesacad   = __('Dades acadèmiques','ricca3-aval');
	$codicicle   = __('Codi','ricca3-aval');
	$nomcicle    = __('Nom del cicle formatiu','ricca3-aval');
	$grau        = __('Grau','ricca3-aval');
	$quali       = __('Qualificacions','ricca3-aval');
	$nomcredit   = __('Crèdit','ricca3-aval');
	$hores       = __('Hores','ricca3-aval');
	$convo       = __('Convocatoria','ricca3-aval');
	$qualicred   =  __('Qualificació','ricca3-aval');
	$qualicf     = __('Qualificació final del cicle formatíu','ricca3-aval');
	$observa     = __('Observacions','ricca3-aval');
	$dili        = __('Diligència de la validesa de l\'historial acadèmic','ricca3-aval');
	$carles2     = __('CARLOS AYLAGAS MOLERO Secretari del centre ESCOLA RAMON I CAJAL amb codi 08035672 certifica que les dades que figuren en aquest historial 	reflecteixen les que consten en la documentació dipositada a la secretaria d\'aquest centre.', 'ricca3-aval');
	$llocidata   = __('Lloc i data','ricca3-aval');
	if( $_GET['local'] == 'si'){
		$certif      = __('Certificado de estudios cumpletados de CFGS para el acceso a estudios universitarios','ricca3-aval');
		$dadescentre = __('Datos del Centro','ricca3-aval');
		$codicentre  = __('Código','ricca3-aval');
		$nomcentre   = __('Nombre del centro','ricca3-aval');
		$adreca      = __('Dirección','ricca3-aval');
		$municipi    = __('Municipio','ricca3-aval');
		$carles      = __('CARLOS AYLAGAS MOLERO, secretario del centro ESCOLA RAMON I CAJAL, de acuerdo con la documentación que hay disponible en esta secretaría,','ricca3-aval');
		$dni         = __('con DNI/NIE/Pasaporte Nº','ricca3-aval');
		$numdni      = __('con el número de identificación','ricca3-aval');
		$cursat      = __('ha cursado y superado el ciclo formativo','ricca3-aval');
		$reial1      = __('regulado por el Real decreto número','ricca3-aval');
		$reial2      = __('/1995 de fecha 7 de Abril','ricca3-aval');
		$qualifica   = __('El alumno/a ha obtenido la calificación final de:','ricca3-aval');
		$consti      = __('Y, para que conste, firmo este certificado, con el visto bueno de la directora del centro.','ricca3-aval');
		$firma       = __('Firma del secretario','ricca3-aval');
		$vistiplau   = __('Visto bueno de la directora','ricca3-aval');
		$nom         = __('Nombre y apellidos','ricca3-aval');
		$segell      = __('SELLO DEL CENTRO','ricca3-aval');
//
		$histo       = __('Historial académico','ricca3-aval');
		$resultats   = __('Resultados de la evaluación de los créditos','ricca3-aval');
		$forma       = __('Formación profesional inicial','ricca3-aval');
		$dadesalum   = __('Datos del alumno/a','ricca3-aval');
		$cognoms     = __('Apellidos y nombre','ricca3-aval');
		$passap      = __('DNI/NIE/pasaporte','ricca3-aval');
		$numident    = __('Núm. de identificación','ricca3-aval');
		$dadesacad   = __('Datos académicos','ricca3-aval');
		$codicicle   = __('Código','ricca3-aval');
		$nomcicle    = __('Nombre del ciclo formativo','ricca3-aval');
		$grau        = __('Grado','ricca3-aval');
		$quali       = __('Calificaciones','ricca3-aval');
		$nomcredit   = __('Crédito','ricca3-aval');
		$hores       = __('Horas','ricca3-aval');
		$convo       = __('Convocatoria','ricca3-aval');
		$qualicred   = __('Calificación','ricca3-aval');
		$qualicf     = __('Calificación final del ciclo formativo','ricca3-aval');
		$observa     = __('Observaciones','ricca3-aval');
		$dili        = __('Diligencia de la validez del historial académico','ricca3-aval');
		$carles2     = __('CARLOS AYLAGAS MOLERO Secretario del centro ESCOLA RAMON I CAJAL con código 08035672 certifica que los datos que figuran en este historial reflejan los que constan en la documentación depositada en la secretaría de este centro.', 'ricca3-aval');
		$llocidata   = __('Lugar y fecha','ricca3-aval');
	}
//
	$row_any  = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_any   WHERE idany  = %s', $_GET['any'] ), ARRAY_A, 0);
	$row_grup = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_grups WHERE idgrup = %s', $_GET['grup'] ), ARRAY_A, 0 );
	$query_alum  = $wpdb->prepare( 'SELECT * FROM ricca3_alumespec_view WHERE idany = %s AND idgrup = %s AND estat="Alta" ORDER BY cognomsinom ASC ',$row_any['idany'], $_GET['grup'] );
	$result_alum = $wpdb->query( $query_alum );
//	echo $query_alum;
	for( $i = 0; $i < $result_alum; $i++){
		$row_alumespec = $wpdb->get_row( $query_alum, ARRAY_A, $i);
		$row_alum = $wpdb->get_row( $wpdb->prepare( 'SELECT * FROM ricca3_alumne WHERE idalumne=%s', $row_alumespec['idalumne']), ARRAY_A, 0);
		printf('<table class="cap"> <tr><td><IMG SRC="%s/ricca3/imatges/ricca3-logo.jpg" ALIGN=left><IMG SRC="%s/ricca3/imatges/ricca3-adreca.png" ALIGN=left></td></tr></table><br />', WP_PLUGIN_URL, WP_PLUGIN_URL );
		printf('<table class="cap"><tr><td width="680px" colspan="3" class="gran"><b>%s</b></td></tr>',	$histo );
		printf('                   <tr><td width="460px" colspan="2"><b>%s</b></td><td width="230px" class="dereta"><b>%s</b></td>',
		$resultats, $forma );
		printf('                   <tr class="linea"><td colspan="3" width="680px" class="petit"><IMG SRC="%s/ricca3/imatges/ricca3-linea-mitja.png"></td></tr></table>', WP_PLUGIN_URL);
//	dades del alumne
		printf('<table class="cap"><tr><td width="230px" colspan="3"><b>%s</b></td></tr>', $dadesalum );
		printf('                   <tr class="linea"><td colspan="3" width="680px" class="petit"><IMG SRC="%s/ricca3/imatges/ricca3-linea-mitja.png"></td></tr>', WP_PLUGIN_URL);
		printf('                   <tr><td width="340px">%s</td><td width="170px">%s</td><td width="170px">%s</td></tr>',
		$cognoms, $passap, $numident );
		printf('<tr><td class="gran">%s</td><td class="gran">%s</td><td class="gran">%s</td></tr>',
		$row_alum['cognomsinom'], $row_alum['dni'], $row_alum['idalumne'] );
		printf('                   <tr class="linea"><td colspan="3" width="680px" class="petit"><IMG SRC="%s/ricca3/imatges/ricca3-linea-mitja.png"></td></tr></table>', WP_PLUGIN_URL);
//	dades acadèmiques
		$row_espec = $wpdb->get_row( $wpdb->prepare( 'SELECT * FROM ricca3_especialitats WHERE idespecialitat= %s', $row_alumespec['idespecialitat']), ARRAY_A, 0);
		printf('<table class="cap"><tr><td width="680px" colspan="4"><b>%s</b></td></tr>', $dadesacad );
		printf('                   <tr class="linea"><td colspan="4" width="680px" class="petit"><IMG SRC="%s/ricca3/imatges/ricca3-linea-mitja.png"></td></tr>', WP_PLUGIN_URL);
		printf('                   <tr><td width="100px">%s</td><td width="480px" colspan="2">%s</td><td width="100px">%s</td></tr>',
		$codicicle, $nomcicle, $grau );
		printf('<tr><td class="gran">%s</td>', $row_espec['codiespecialitat']);
		if( $_GET['local'] == 'si'){
			printf('<td class="gran" colspan="2">%s</td>',$row_espec['nomespecialitat_cast']);
		}else{
			printf('<td class="gran" colspan="2">%s</td>',$row_espec['nomespecialitat']);
		}
		printf('<td class="gran">%s</td></tr>', __('SUPERIOR','ricca3-alum') );
		printf('                   <tr class="linea"><td colspan="4" width="680px" class="petit"><IMG SRC="%s/ricca3/imatges/ricca3-linea-mitja.png"></td></tr></table>', WP_PLUGIN_URL);
//	qualificacions
		printf('<table class="cap"><tr><td width="680px" colspan="4"><b>%s</b></td></tr>', $quali);
		printf('                   <tr class="linea"><td colspan="4" width="680px" class="petit"><IMG SRC="%s/ricca3/imatges/ricca3-linea-mitja.png"></td></tr>', WP_PLUGIN_URL);
		printf('                   <tr><td width="380px">%s</td><td width="100px" >%s</td><td width="100px" >%s</td><td width="100px" >%s</td></tr>',
		$nomcredit, $hores, $convo, $qualicred );
		printf('                   <tr class="linea"><td colspan="4" width="680px" class="petit"><IMG SRC="%s/ricca3/imatges/ricca3-linea-estreta.png"></td></tr>', WP_PLUGIN_URL);
//	entrada qualificacions
		$query  = $wpdb->prepare('SELECT * FROM ricca3_credits WHERE idespecialitat = %s ORDER BY ordre_cr ',$row_alumespec['idespecialitat']);
		$result = $wpdb->query( $query );
//			mirem si l'alumne te resultats del crèdit
		for( $j = 0; $j < $result; $j++ ){
			$row_cred = $wpdb->get_row( $query, ARRAY_A, $j);
//			$query_cre  = $wpdb->prepare('SELECT * FROM ricca3_alumcredit_view WHERE idalumne = %s AND idespecialitat = %s AND idcredit = %s ORDER BY idany DESC ',
//					$row_alumespec['idalumne'], $row_alumespec['idespecialitat'], $row_cred['idcredit']);
			$query_cre = $wpdb->prepare('SELECT ricca3_credits_avaluacions.idcredaval, '.
										'ricca3_credits_avaluacions.idany, '.
										'ricca3_credits_avaluacions.idalumne, '.
										'ricca3_credits_avaluacions.idccomp, '.
										'ricca3_credits_avaluacions.convord, '.
										'ricca3_credits_avaluacions.notaf_cr, '.
										'ricca3_ccomp.idcredit, '.
										'ricca3_credits.idcredit, '.
										'ricca3_credits.nomcredit, '.
										'ricca3_credits.hores_cr, '.
										'ricca3_credits.idespecialitat '.
										'FROM ricca3_credits_avaluacions '.
										'INNER JOIN ricca3_ccomp ON ricca3_ccomp.idccomp = ricca3_credits_avaluacions.idccomp '.
										'INNER JOIN ricca3_credits ON ricca3_credits.idcredit = ricca3_ccomp.idcredit '.
										'INNER JOIN ricca3_especialitats ON ricca3_especialitats.idespecialitat = ricca3_credits.idespecialitat '.
										'WHERE idalumne = %s AND ricca3_credits.idespecialitat = %s AND ricca3_ccomp.idcredit = %s ORDER BY idany DESC ',
										$row_alumespec['idalumne'], $row_alumespec['idespecialitat'], $row_cred['idcredit']);
//			echo $query_cre;
			$result_cre = $wpdb->query( $query_cre );
//			echo '<br />',$row_cred['idcredit'],' -> ', $result_cre;
			if( $result_cre > 0){
				$row = $wpdb->get_row( $query_cre, ARRAY_A, 0 );
				if( $_GET['local'] == 'si'){
					$row_local=$wpdb->get_row($wpdb->prepare('SELECT * FROM ricca3_credits WHERE idcredit=%s', $row_cred['idcredit']), ARRAY_A,0);
					printf('<tr><td width="380px" >%s</td>',$row_local['nomcredit_cast']);
				}else{
					printf('<tr><td width="380px" >%s</td>',$row['nomcredit']);
				}
				printf('<td width="100px" >%s</td><td width="100px" >%s</td>',
				$row['hores_cr'], $row['convord'] );
				if( $_GET['local'] == 'si' && ( strtoupper($row['notaf_cr']) == 'APTE: MOLT BÉ' || strtoupper($row['notaf_cr']) == 'APTE: BÉ') ){
					if( strtoupper($row['notaf_cr']) == 'APTE: MOLT BÉ' ) printf('<td width="100px" >%s</td></tr>', 'APTO: MUY BIEN');
					if( strtoupper($row['notaf_cr']) == 'APTE: BÉ' )      printf('<td width="100px" >%s</td></tr>', 'APTO: BIEN');
				}else{
					printf('<td width="100px" >%s</td></tr>', $row['notaf_cr']);
				}
			}
		}
		for( $k = $j; $k < 14; $k++ ){
			printf('<tr><td width="680px" colspan="4">&nbsp;</td></tr>', NULL );
		}
		printf('</table>', NULL);
//	qualificació final
		printf('<table class="cap"><tr class="linea"><td colspan="3" width="680px" class="petit"><IMG SRC="%s/ricca3/imatges/ricca3-linea-mitja.png"></td></tr>', WP_PLUGIN_URL);
		printf('<tr><td width="680px" colspan="3">&nbsp;</td></tr>', NULL);
		if(strlen($row_alumespec['notaf_es_manual']) > 1){
			printf('                   <tr><td width="400px"></td><td width="200px"><b>%s</b></td><td width="80px" rowspan="2" class="notaf">&nbsp; %s</td></tr>',
			$qualicf, $row_alumespec['notaf_es_manual'] );
		}elseif (strlen($row_alumespec['notaf_es']) > 1){
			printf('                   <tr><td width="400px"></td><td width="200px"><b>%s</b></td><td width="80px" rowspan="2" class="notaf">&nbsp; %s</td></tr>',
			$qualicf, $row_alumespec['notaf_es'] );
		}
		printf('                   <tr><td width="400px"><b>%s</b></td><td width="200px"></td></tr></table>', $observa );
		printf('                   <tr class="linea"><td colspan="3" width="680px" class="petit"><IMG SRC="%s/ricca3/imatges/ricca3-linea-mitja.png"></td></tr></table>', WP_PLUGIN_URL);
		printf('<br /><br /><br /><br />', NULL);
//	diligencia
		printf('<table class="cap"><tr class="linea"><td colspan="3" width="680px" class="petit"><IMG SRC="%s/ricca3/imatges/ricca3-linea-mitja.png"></td></tr></table>', WP_PLUGIN_URL);
		printf('<table class="cap"><tr><td width="680px"><b>%s</b></td></tr>', $dili );
		printf('<table class="cap"><tr class="linea"><td width="680px" class="petit"><IMG SRC="%s/ricca3/imatges/ricca3-linea-mitja.png"></td></tr></table>', WP_PLUGIN_URL);
		printf('<table class="cap"><tr><td>%s</td></tr></table>', $carles2);
//	peu de pàgina
		printf('<table class="cap"><tr class="linea"><td colspan="3" width="680px" class="petit"><IMG SRC="%s/ricca3/imatges/ricca3-linea-mitja.png"></td></tr>', WP_PLUGIN_URL);
		printf('                   <tr><td width="230px">%s</td><td width="230px">%s</td><td width="230px">%s</td></tr>',
		$firma, $segell, $vistiplau );
		printf('                   <tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr>', NULL);
		printf('                   <tr><td width="230px">%s</td><td width="230px"></td><td width="230px">%s</td></tr>',
		$nom, $nom );
		printf('                   <tr><td width="230px">%s</td><td width="230px"></td><td width="230px">%s</td></tr>',
		__('Carlos Aylagas Molero','ricca3-aval'), __('Teresa Llirinós Sopena','ricca3-aval') );
		printf('                   <tr class="linea"><td colspan="3" width="680px" class="petit"><IMG SRC="%s/ricca3/imatges/ricca3-linea-estreta.png"></td></tr>', WP_PLUGIN_URL);
		printf('                   <tr><td width="230px">%s</td><td width="460" colspan="2">%s %s</tr>',
		$llocidata, __('Barcelona, a'), $_GET['data']);
		printf('                   <tr class="linea"><td colspan="3" width="680px" class="petit"><IMG SRC="%s/ricca3/imatges/ricca3-linea-ampla.png"></td></tr></table>', WP_PLUGIN_URL);
		printf('<table style="page-break-after: always;"><tr><td class="dereta" width="680px">%s</td></tr></table>', __('___/___', 'ricca3-aval'));
	}		
//	segona fulla
	for( $i = 0; $i < $result_alum; $i++){
		$row_alumespec = $wpdb->get_row( $query_alum, ARRAY_A, $i);
		$row_alum = $wpdb->get_row( $wpdb->prepare( 'SELECT * FROM ricca3_alumne WHERE idalumne=%s', $row_alumespec['idalumne']), ARRAY_A, 0);
		if( $row_alumespec['notaf_es'] > 0 ){
			printf('<table class="cap"> <tr><td><IMG SRC="%s/ricca3/imatges/ricca3-logo.jpg" ALIGN=left><IMG SRC="%s/ricca3/imatges/ricca3-adreca.png" ALIGN=left></td></tr></table><br />', WP_PLUGIN_URL, WP_PLUGIN_URL );
			printf('<br /><br /><br /><br />', NULL);
			printf('<table class="cap"><tr><td class="gran"><b>%s</b></td></tr>',$certif);
			printf('                   <tr class="linea"><td width="680px" class="petit"><IMG SRC="%s/ricca3/imatges/ricca3-linea-estreta.png"></td></tr></table><br />', WP_PLUGIN_URL);
			printf('<table class="cap"><tr><td><b>%s</b></td></tr>', $dadescentre);
			printf('                   <tr class="linea"><td width="680px" class="petit"><IMG SRC="%s/ricca3/imatges/ricca3-linea-estreta.png"></td></tr></table>', WP_PLUGIN_URL);
//	Dades del centre
			printf('<table class="cap"><tr><td width="50px">%s</td><td width="150px"><b>%s</b></td><td width="150px">%s</td><td width="330px"><b>%s</b></td></tr>',
			$codicentre, __('08035672','ricca3-aval'), $nomcentre, __('ESCOLA RAMON I CAJAL','ricca3-aval'));
			printf('                   <tr><td width="50px">%s</td><td width="150px"><b>%s</b></td><td width="150px">%s</td><td width="330px"><b>%s</b></td></tr>',
			$adreca, __('Rosselló, 303','ricca3-aval'), $municipi, __('Barcelona','ricca3-aval'));
			printf('                   <tr class="linea"><td width="680px" colspan="4" class="petit"><IMG SRC="%s/ricca3/imatges/ricca3-linea-estreta.png"></td></tr></table><br />', WP_PLUGIN_URL);
//	diligencia
			printf('<table class="cap"><tr><td class="gran">%s</td></tr></table><br />', $carles);
//	certifico
			printf('<table class="cap"><tr><td class="gran"><b>%s</b></td></tr>', __('Certifico','ricca3-aval') );
			printf('                  <tr class="linea"><td width="680px" class="petit"><IMG SRC="%s/ricca3/imatges/ricca3-linea-estreta.png"></td></tr><br />', WP_PLUGIN_URL);
			printf('                  <tr><td class="gran">%s <b>%s,</b> %s <b>%s</b> %s %s %s %s',
			__('Que','ricca3-aval'), $row_alum['nomicognoms'], $dni, $row_alum['dni'], $numdni,$row_alum['idalumne'],$cursat, $row_espec['codiespecialitat']);
			if( $_GET['local'] == 'si'){
				printf( ' %s %s %s%s</td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr>'
						, $row_espec['nomespecialitat_cast'], $reial1, $row_espec['reialdecret'], $reial2 );
			}else{
				printf( ' %s %s %s%s</td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr>'
						, $row_espec['nomespecialitat'], $reial1, $row_espec['reialdecret'], $reial2 );
			}
			if(strlen($row_alumespec['notaf_es_manual']) > 1){
				printf('                  <tr><td class="gran"><b>%s&nbsp;&nbsp; %s</b></td></tr>', $qualifica, $row_alumespec['notaf_es_manual']);
			}elseif (strlen($row_alumespec['notaf_es']) > 1){
				printf('                  <tr><td class="gran"><b>%s&nbsp;&nbsp; %s</b></td></tr>', $qualifica, $row_alumespec['notaf_es']);
			}
//			printf('                  <tr><td class="gran"><b>%s&nbsp;&nbsp; %s</b></td></tr>', $qualifica, $row_alumespec['nota']);
			printf('                  <tr class="linea"><td width="680px" class="petit"><IMG SRC="%s/ricca3/imatges/ricca3-linea-estreta.png"></td></tr></table><br />', WP_PLUGIN_URL);
//	signatures
			printf('<br /><br /><br /><table class="cap"><tr><td class="gran">%s</td></tr></table>', $consti);
			printf('<br /><br /><table class="cap"> <tr class="linea"><td width="680px" class="petit"><IMG SRC="%s/ricca3/imatges/ricca3-linea-estreta.png"></td></tr></table><br />', WP_PLUGIN_URL);
			printf('<table class="cap"><tr><td class="gran" width="340px">%s</td><td class="gran" width="340px">%s</td></tr></table>',
			$firma, $vistiplau);
			printf('<br /><br /><br /><br /><br /><table class="cap"><tr><td class="gran" width="340px">%s</td><td class="gran" width="340px">%s</td></tr>',
			$nom, $nom);
			printf('                                           <tr><td class="gran" width="340px">%s</td><td class="gran" width="340px">%s</td></tr></table>',
			__('Carlos Aylagas Molero','ricca3-aval'), __('Teresa Llirinós Sopena','ricca3-aval'));
//	data i peu
			printf('<br /><br /><br /><br /><table class="cap"><tr><td class="gran" width="70px">%s,</td><td class="gran" width="610px">%s</td></tr></table>',
			__('Barcelona','ricca3-aval'), $_GET['data']);
			printf('<br /><br /><br /><br /><table class="cap"><tr><td class="gran" width="340px"></td><td class="gran" width="340px">%s</td></tr></table>',
			$segell);
			printf('<table style="page-break-after: always;"><tr><td class="dereta" width="680px"></td></tr></table>', NULL);
		}
	}
}

#############################################################################################
/**
 * Calcular nota final
 * shortcode: [ricca3-calcularnotaf]
 *
 * @since ricca3.v.2014.6.4
 * @author Efraim Bayarri
 */
#############################################################################################
function ricca3_shortcode_calcularnotaf($atts, $content = null) {
	global $wpdb;
	global $ricca3_butons_notaalumne;
	
//	dump_r($_POST);
	
	ricca3_missatge(__('Calcular nota final','ricca3-aval'));
	$ricca3_butons_actes['texte'][0] = __('ajuda-aval-aval', 'ricca3-aval');
//		butons
	ricca3_butons( $ricca3_butons_notaalumne, 6 );
	
	printf('<form method="post" action="" name="cercar"><table dir="ltr" class="cercar"><tr>', NULL);
	printf('<td><button type="submit" name="cercar" value="actualitzar" title="%s">%s</td>',
	__('ajuda-actes-escollir', 'ricca3-aval'), __('escollir', 'ricca3-aval'));
//		drop per el any
	$data_any = $wpdb->get_results('SELECT * FROM ricca3_any', ARRAY_A );
	ricca3_drop_any( __('Any:','ricca3-aval'), 'any', $data_any, 'idany', 'any', __('ajuda_actes_any', 'ricca3-aval'), 'actual' );
//		drop per el grup
	$data_grup = $wpdb->get_results('SELECT * FROM ricca3_grups '.
		'INNER JOIN ricca3_especialitats ON ricca3_especialitats.idespecialitat = ricca3_grups.idespecialitat '.
		'WHERE actiu_gr = 1 AND (cursos=1 OR idcurs=2) ORDER BY grup ', ARRAY_A );
	ricca3_drop( __('Grup:','ricca3-aval'), 'grup',  $data_grup,  'idgrup', 'grup',  __('ajuda_actes_grup', 'ricca3-aval'), TRUE );
//		tanquem la barra de selecció
	printf('</tr></table></form>', NULL);
	if( isset( $_POST['grup'] ) && $_POST['grup'] != '-1'){
//	busquem la definicio del grup
		$row_grup = $wpdb->get_row( $wpdb->prepare(  'SELECT * FROM ricca3_grups WHERE idgrup=%s', $_POST['grup']), ARRAY_A, 0);
//	busquem l'especialitat del grup
		$row_espec = $wpdb->get_row( $wpdb->prepare( 'SELECT * FROM ricca3_especialitats WHERE idespecialitat=%s', $row_grup['idespecialitat']), ARRAY_A, 0);
//	comprovem que el grup es del ultim curs de l'especialitat
		if(($row_espec['cursos'] == '2' && $row_grup['idcurs'] == '2') || ($row_espec['cursos'] == '1' && $row_grup['idcurs'] == '1')){
			ricca3_missatge(__('Calculant la nota final','ricca3-aval'));
			$query = $wpdb->prepare('SELECT * FROM ricca3_alumne '.
				'INNER JOIN ricca3_alumne_especialitat on ricca3_alumne_especialitat.idalumne=ricca3_alumne.idalumne '.
				'INNER JOIN ricca3_any ON ricca3_any.idany = ricca3_alumne_especialitat.idany '.
				'INNER JOIN ricca3_grups ON ricca3_grups.idgrup = ricca3_alumne_especialitat.idgrup '.
				'INNER JOIN ricca3_cursos ON ricca3_cursos.idcurs = ricca3_grups.idcurs '.
			 	'INNER JOIN ricca3_especialitats ON ricca3_especialitats.idespecialitat = ricca3_grups.idespecialitat '.
				'INNER JOIN ricca3_estat ON ricca3_estat.idestat = ricca3_alumne_especialitat.idestat_es '.
				'WHERE ricca3_grups.idgrup=%s AND ricca3_any.idany=%s AND idestat_es=1 '.
				'ORDER BY cognomsinom ',
				$_POST['grup'], $_POST['any']);
			$dades = $wpdb->get_results( $query, ARRAY_A );
			printf('<table id="nom" class="petit">', NULL);
			for( $i = 0; $i < count($dades); $i++){
				ricca3_notafinal($dades[$i]['idalumne'], $dades[$i]['idespecialitat'], $_POST['any']);
			}
			printf('</table>', NULL);
			ricca3_missatge(sprintf('%s <b>%s</b> %s', __('Calculada la Nota Final per a','ricca3-aval'), count($dades), __('alumnes.','ricca3-aval')));
		}else{
			ricca3_missatge(__('No és l\'últim curs i no es pot calcular la nota final','ricca3-aval'));
		}
	}
}

#############################################################################################
/**
 * Calcular nota final alumne
 * shortcode: [ricca3-notaalumne]
 *
 * @since ricca3.v.2014.7.1
 * @author Efraim Bayarri
 */
#############################################################################################
function ricca3_shortcode_notaalumne($atts, $content = null) {
	global $wpdb;
	global $current_user;
	global $ricca3_butons_actes;
	global $ricca3_notaalumne;
	
//	dump_r($_POST);
	
	ricca3_missatge(__('Nota final per alumne','ricca3-aval'));
	ricca3_butons( $ricca3_butons_actes, 6 );
//
	printf('<form method="post" action="" name="cercar"><table dir="ltr" class="cercar">', NULL);
//		radio per els grups
	if(!isset($_POST['tipus']) || (isset($_POST['tipus']) && $_POST['tipus'] == 'grup')){
		printf('<tr><td><INPUT type="radio" name="tipus" value="grup" title="%s" checked /></td><td> ', __('ajuda-obser-grup', 'ricca3-aval'));
	}else{
		printf('<tr><td><INPUT type="radio" name="tipus" value="grup" title="%s" /></td><td> ', __('ajuda-obser-grup', 'ricca3-aval'));
	}
	printf('%s</td>', __('Per grup','ricca3-aval'));
//		drop per el grup
	$data_grup = $wpdb->get_results('SELECT * FROM ricca3_grups '.
			'INNER JOIN ricca3_especialitats ON ricca3_especialitats.idespecialitat = ricca3_grups.idespecialitat '.
			'WHERE actiu_gr = 1 AND (cursos=1 OR idcurs=2) ORDER BY grup ', ARRAY_A );
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
	if(isset($_POST['cercar']) && $_POST['cercar'] == 'actualitzar'){
		if($_POST['tipus'] == 'grup'){
			$row_any = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_any WHERE actual = 1', NULL),ARRAY_A,0);
			$query= $wpdb->prepare('SELECT * FROM ricca3_alumespec_view WHERE idany=%s AND idgrup=%s AND idestat_es=1 ORDER BY cognomsinom', 
					$row_any['idany'], $_POST['grup']);
			$data_view = $wpdb->get_results( $query, ARRAY_A);
			ricca3_graella( $ricca3_notaalumne, $data_view, $token );
			ricca3_desar('accio', 'calcularnota_grup', __('ajuda-calcularnota', 'ricca3-aval'));
		}
	}
	if(isset($_POST['accio']) && $_POST['accio'] == 'calcularnota_grup'){
		$row_any = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_any WHERE actual = 1', NULL),ARRAY_A,0);
		$espec = $wpdb->get_row( $wpdb->prepare('SELECT * FROM ricca3_grups WHERE idgrup = %s', $_POST['grup']),ARRAY_A,0);
		
		ricca3_notafinal($_POST['cbox'],$espec['idespecialitat'],$row_any['idany']);
	}
	printf('</form>', NULL);
}
