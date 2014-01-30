<?php
## Release build 2013.27.5
#############################################################################################
/**
 * Sistema d'Intercanvi d'Informació (SII)
 * shortcode: [ricca3-sii]
 *
 * @since ricca3.v.2013.51.1
 * @author Efraim Bayarri
 */
#############################################################################################
function ricca3_shortcode_sii($atts, $content = null) {
	global $ricca3_butons_sii;	
	
	ricca3_missatge(__('Sistema d\'Intercanvi d\'Informació (SII)','ricca3-sii'));	
	
	ricca3_butons( $ricca3_butons_sii, 6 );
	##	BEGIN debug
	//	print_r($_POST);
	//	dump($_POST);
	//	dump_r($_POST);
	##	END debug
	
}

#############################################################################################
/**
 * Sistema d'Intercanvi d'Informació (SII) - OPCIONS
 * shortcode: [ricca3-sii-options]
 *
 * @since ricca3.v.2013.51.1
 * @author Efraim Bayarri
 */
#############################################################################################
function ricca3_shortcode_sii_opcions($atts, $content = null) {
	global $ricca3_butons_sii;
	global $wpdb;
	
	ricca3_missatge(__('Sistema d\'Intercanvi d\'Informació (SII) - OPCIONS','ricca3-sii'));
	ricca3_butons( $ricca3_butons_sii, 6 );
}

#############################################################################################
/**
 * Sistema d'Intercanvi d'Informació (SII) - FITXERS
 * shortcode: [ricca3-sii-fitxers]
 *
 * @since ricca3.v.2013.51.1
 * @author Efraim Bayarri
 */
#############################################################################################
function ricca3_shortcode_sii_fitxers($atts, $content = null) {
	global $ricca3_butons_sii;
	global $ricca3_sii_fitxers;
	global $wpdb;
	dump_r($_POST);
	ricca3_missatge(__('Sistema d\'Intercanvi d\'Informació (SII) - FITXERS','ricca3-sii'));
	ricca3_butons( $ricca3_butons_sii, 6 );
	$row_any = $wpdb->get_row('SELECT * FROM ricca3_any where actual = 1 ',ARRAY_A,0);
	$query = $wpdb->prepare('SELECT * FROM ricca.ricca3_alumne_especialitat '.
			'INNER JOIN ricca3_alumne ON ricca3_alumne.idalumne=ricca3_alumne_especialitat.idalumne '.
			'INNER JOIN ricca3_any ON ricca3_any.idany = ricca3_alumne_especialitat.idany '.
			'INNER JOIN ricca3_grups ON ricca3_grups.idgrup = ricca3_alumne_especialitat.idgrup '.
			'INNER JOIN ricca3_cursos ON ricca3_cursos.idcurs = ricca3_grups.idcurs '.
			'INNER JOIN ricca3_especialitats ON ricca3_especialitats.idespecialitat = ricca3_grups.idespecialitat '.
			'INNER JOIN ricca3_estat ON ricca3_estat.idestat = ricca3_alumne_especialitat.idestat_es '. 
			'WHERE ricca3_alumne_especialitat.idany=%s AND ricca3_alumne_especialitat.idestat_es=1 '.
			'ORDER BY cognomsinom ',$row_any['idany']
			);
//	fem el query i guardem tots els resultats a $data_view
	$data_view = $wpdb->get_results( $query, ARRAY_A);
//		
	printf('<form method="post" action="" name="cercar"><table dir="ltr" class="cercar"><tr><td></td></tr></table></form>', NULL);
//	llistat del alumnes del filtre
	printf('<form method="post" action="%s/ricca3-sii-xml" name="cercar"><table dir="ltr" class="cercar"><tr>', site_url());
	ricca3_graella( $ricca3_sii_fitxers, $data_view );
	printf('<tr>', NULL);
//	ricca3_desar('accio', 'actualitzartot', __('ajuda-tab-credits-tots-desar', 'ricca3-sii'));
	printf('<td><button type="submit" name="cercar" value="actualitzar" title="%s"><img src=%s/ricca3/imatges/ricca3-sii-XML.png  border="0" /></button></td>', __('ajuda-llistar-alumnes', 'ricca3-sii'), WP_PLUGIN_URL);
}

#############################################################################################
/**
 * Sistema d'Intercanvi d'Informació (SII) - Modificacions
 * shortcode: [ricca3-sii-modif]
 *
 * @since ricca3.v.2013.51.1
 * @author Efraim Bayarri
 */
#############################################################################################
function ricca3_shortcode_sii_modif($atts, $content = null) {
	global $ricca3_butons_sii;
	global $ricca3_sii_modif;
	global $wpdb;
	global $current_user;
//	dump_r($_POST);
	get_currentuserinfo();
//		comprovar si hem de guardar les dades de tots el crèdits
	$num_cols=count($ricca3_sii_modif,1)/count($ricca3_sii_modif,0)-1;
	if( isset( $_POST['accio'] ) && $_POST['accio'] == 'actualitzartot'){
		for( $i=0; $i < count($_POST['idalumne']); $i++){
			for( $j=0; $j < $num_cols; $j++){
				if(!$ricca3_sii_modif['nomeslect'][$j]){
					$result = $wpdb->update('ricca3_alumne',
						array( $ricca3_sii_modif['nomupdate'][$j] => stripslashes(strtoupper($_POST[$ricca3_sii_modif['nombd'][$j]][$i])), 'stampuser' => $current_user->user_login, 'stampplace' => 'ricca_shortcode_sii_modif' ),
						array('idalumne' => $_POST['idalumne'][$i]) );
				}
			}
		}
	}
//	
	ricca3_missatge(__('Sistema d\'Intercanvi d\'Informació (SII) - MODIFICACIONS','ricca3-sii'));
	ricca3_butons( $ricca3_butons_sii, 6 );
//
	printf('<form method="post" action="" name="cercar"><table dir="ltr" class="cercar"><tr>', NULL);
	printf('<td><button type="submit" name="cercar" value="actualitzar" title="%s"><img src=%s/ricca3/imatges/ricca3-llistar.png  border="0" /></button></td>', __('ajuda-llistar-alumnes', 'ricca3-sii'), WP_PLUGIN_URL);	
//		drop per el any
	$data_any = $wpdb->get_results('SELECT * FROM ricca3_any', ARRAY_A );
	ricca3_drop_any( __('Any:','ricca3-alum'), 'any', $data_any, 'idany', 'any', __('ajuda_drop_any', 'ricca3-alum'), 'actual' );
//		drop per el grup
	$data_grup = $wpdb->get_results('SELECT * FROM ricca3_grups WHERE actiu_gr = 1 ORDER BY grup ', ARRAY_A );
	ricca3_drop( __('Grup:','ricca3-alum'), 'grup',  $data_grup,  'idgrup', 'grup',  __('ajuda_drop_ grup', 'ricca3-alum'), FALSE );	
//		tanquem la barra de selecció
	printf('</tr></table></form>', NULL);	
//		Si ja hem fet la cerca, mostrar els resultats
	if( isset( $_POST['cercar'] ) && $_POST['cercar'] == "actualitzar" ){
		$query = $wpdb->prepare('SELECT * FROM ricca.ricca3_alumne '.
				'INNER JOIN ricca3_alumne_especialitat on ricca3_alumne_especialitat.idalumne=ricca3_alumne.idalumne '.
				'INNER JOIN ricca3_any ON ricca3_any.idany = ricca3_alumne_especialitat.idany '.
				'INNER JOIN ricca3_grups ON ricca3_grups.idgrup = ricca3_alumne_especialitat.idgrup '.
				'INNER JOIN ricca3_cursos ON ricca3_cursos.idcurs = ricca3_grups.idcurs '.
				'INNER JOIN ricca3_especialitats ON ricca3_especialitats.idespecialitat = ricca3_grups.idespecialitat '.
				'INNER JOIN ricca3_estat ON ricca3_estat.idestat = ricca3_alumne_especialitat.idestat_es '.
				'WHERE ricca3_alumne_especialitat.idany=%s AND idestat_es=1 ',$_POST['any']);
		if( $_POST['grup']  != "-1") $query = substr_replace( $query," AND ricca3_grups.idgrup='" .$_POST['grup']."' ", strlen( $query ) , 0 );
		$query=substr_replace( $query," ORDER BY ricca3_especialitats.idespecialitat, cognomsinom ",strlen( $query ), 0 );
//	fem el query i guardem tots els resultats a $data_view
		$data_view = $wpdb->get_results( $query, ARRAY_A);
//	llistat del alumnes del filtre
		printf('<form method="post" action="" target="_self" name="creadlu" id="especformtot">', NULL);
		ricca3_graella( $ricca3_sii_modif, $data_view );
		printf('</table>', NULL);
		ricca3_desar('accio', 'actualitzartot', __('ajuda-tab-credits-tots-desar', 'ricca3-sii'));
		printf('</td><td><INPUT type="hidden" name="any" value="%s" /></td><td><INPUT type="hidden" name="grup" value="%s" /></td><td><INPUT type="hidden" name="cercar" value="%s" /></td></tr></table></form>', $_POST['any'], $_POST['grup'], $_POST['cercar']);
	}
}

#############################################################################################
/**
 * Sistema d'Intercanvi d'Informació (SII) - Fitxer XML
 * shortcode: [ricca3-sii-xml]
 *
 * @since ricca3.v.2014.4.4
 * @author Efraim Bayarri
 */
#############################################################################################
function ricca3_shortcode_sii_xml($atts, $content = null) {
	global $wpdb;
//	dump_r($_POST);
	$row_any = $wpdb->get_row('SELECT * FROM ricca3_any where actual = 1 ',ARRAY_A,0);
//		CAPÇALERA	
	printf('<table><tr><td>', NULL);
	printf('%s?xml version="1.0" encoding="UTF-8" ?%s', '&lt;', '&gt;');
	printf('</td></tr><tr><td>');
	printf('%sp:Centre xmlns:p="http://educacio.gencat.cat/sii/fp/models/v1/"', '&lt;');
	printf('</td></tr><tr><td>');
	printf('xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"');
	printf('</td></tr><tr><td>');
	printf('xsi:schemaLocation="http://educacio.gencat.cat/sii/fp/models/v1/EsquemaDadesFP.xsd"%s', '&gt;');
//		CODICENTRE
	printf('</td></tr><tr><td>');
	printf('%sp:CodiCentre%s08035672%s/p:CodiCentre%s', '&lt;', '&gt;', '&lt;', '&gt;');
//		ANYACADEMIC
	printf('</td></tr><tr><td>');
	printf('%sp:AnyAcademic%s%s%s/p:AnyAcademic%s', '&lt;', '&gt;', $row_any['SII_AnyAcademic'], '&lt;', '&gt;');
//		ALUMNES	
	printf('</td></tr><tr><td>');
	printf('%sp:Alumnes%s', '&lt;', '&gt;');
//		LOOP DE TOTS ELS ALUMNES SELECCIONATS	
	$numeroalumnes=count($_POST['cbox']);
	for($i=0;$i<$numeroalumnes;$i++){
		$query = $wpdb->prepare('SELECT * FROM ricca.ricca3_alumne_especialitat '.
				'INNER JOIN ricca3_alumne ON ricca3_alumne.idalumne=ricca3_alumne_especialitat.idalumne '.
				'INNER JOIN ricca3_any ON ricca3_any.idany = ricca3_alumne_especialitat.idany '.
				'INNER JOIN ricca3_grups ON ricca3_grups.idgrup = ricca3_alumne_especialitat.idgrup '.
				'INNER JOIN ricca3_cursos ON ricca3_cursos.idcurs = ricca3_grups.idcurs '.
				'INNER JOIN ricca3_especialitats ON ricca3_especialitats.idespecialitat = ricca3_grups.idespecialitat '.
				'INNER JOIN ricca3_estat ON ricca3_estat.idestat = ricca3_alumne_especialitat.idestat_es '.
				'WHERE ricca3_alumne_especialitat.idalumespec=%s ',
				$_POST['cbox'][$i] );
//	fem el query i guardem tots els resultats a $data_view
		$data_view = $wpdb->get_results( $query, ARRAY_A);		
//		ALUMNE
			printf('</td></tr><tr><td>');
			printf('%sp:Alumne%s', '&lt;', '&gt;');
//	#########		Dades Alumne
			printf('</td></tr><tr><td>');
			printf('%sp:DadesAlumne%s', '&lt;', '&gt;');		
//	TipusDocumentIdentitat
			printf('</td></tr><tr><td>');
			printf('%sp:TipusDocumentIdentitat%s%s%s/p:TipusDocumentIdentitat%s', '&lt;', '&gt;',$data_view[0]['SII_TipusDocumentIdentitat'], '&lt;', '&gt;');
//	NumeroDocumentIdentitat
			printf('</td></tr><tr><td>');
			printf('%sp:NumeroDocumentIdentitat%s%s%s/p:NumeroDocumentIdentitat%s', '&lt;', '&gt;',$data_view[0]['dni'], '&lt;', '&gt;');
//	CIP
			printf('</td></tr><tr><td>');
			printf('%sp:CIP xsi:nil="true"/%s', '&lt;', '&gt;');
//	NomAlumne
			printf('</td></tr><tr><td>');
			printf('%sp:NomAlumne%s%s%s/p:NomAlumne%s', '&lt;', '&gt;',strtoupper($data_view[0]['nom']), '&lt;', '&gt;');
//	PrimerCognomAlumne
			printf('</td></tr><tr><td>');
			printf('%sp:PrimerCognomAlumne%s%s%s/p:PrimerCognomAlumne%s', '&lt;', '&gt;',strtoupper($data_view[0]['cognom1']), '&lt;', '&gt;');
//	SegonCognomAlumne
			printf('</td></tr><tr><td>');
			if(strlen($data_view[0]['cognom2'])!=0){
				printf('%sp:SegonCognomAlumne%s%s%s/p:SegonCognomAlumne%s', '&lt;', '&gt;',strtoupper($data_view[0]['cognom2']), '&lt;', '&gt;');
			}else{
				printf('%sp:SegonCognomAlumne xsi:nil="true"/%s', '&lt;', '&gt;');
			}
//	Sexe
			printf('</td></tr><tr><td>');
			printf('%sp:Sexe%s%s%s/p:Sexe%s', '&lt;', '&gt;',$data_view[0]['SII_Sexe'], '&lt;', '&gt;');
//	DataNaixement
			$DataNaixement=date('dmY', strtotime( $data_view[0]['datanai']));
			printf('</td></tr><tr><td>');
			printf('%sp:DataNaixement%s%s%s/p:DataNaixement%s', '&lt;', '&gt;',$DataNaixement, '&lt;', '&gt;');
//	CodiMunicipiNaixement
			printf('</td></tr><tr><td>');
			printf('%sp:CodiMunicipiNaixement%s%s%s/p:CodiMunicipiNaixement%s', '&lt;', '&gt;',$data_view[0]['SII_CodiMunicipiNaixement'], '&lt;', '&gt;');
//	NomMunicipiNaixementFora
			if($data_view[0]['SII_CodiPaisNeixement'] != "108"){
				printf('</td></tr><tr><td>');
				printf('%sp:NomMunicipiNaixementFora%s%s%s/p:NomMunicipiNaixementFora%s', '&lt;', '&gt;',substr($data_view[0]['llocnai'],0,30), '&lt;', '&gt;');
			}else{
				printf('</td></tr><tr><td>');
				printf('%sp:NomMunicipiNaixementFora xsi:nil="true"/%s', '&lt;', '&gt;');
			}
//	CodiProvinciaNaixement
			printf('</td></tr><tr><td>');
			printf('%sp:CodiProvinciaNaixement%s%s%s/p:CodiProvinciaNaixement%s', '&lt;', '&gt;',$data_view[0]['SII_CodiProvinciaNeixement'], '&lt;', '&gt;');
//	CodiPaisNaixement
			printf('</td></tr><tr><td>');
			printf('%sp:CodiPaisNaixement%s%s%s/p:CodiPaisNaixement%s', '&lt;', '&gt;',$data_view[0]['SII_CodiPaisNeixement'], '&lt;', '&gt;');
//	CodiNacionalitat
			printf('</td></tr><tr><td>');
			printf('%sp:CodiNacionalitat%s%s%s/p:CodiNacionalitat%s', '&lt;', '&gt;',$data_view[0]['SII_CodiNacionalitat'], '&lt;', '&gt;');
//	Adreca
			printf('</td></tr><tr><td>');
			printf('%sp:Adreca%s%s%s/p:Adreca%s', '&lt;', '&gt;',substr($data_view[0]['residenciahabitual'],0,30), '&lt;', '&gt;');
//	CodiMunicipi
			printf('</td></tr><tr><td>');
			printf('%sp:CodiMunicipi%s%s%s/p:CodiMunicipi%s', '&lt;', '&gt;',$data_view[0]['SII_CodiMunicipi'], '&lt;', '&gt;');
//	CodiPostal
			printf('</td></tr><tr><td>');
			printf('%sp:CodiPostal%s%s%s/p:CodiPostal%s', '&lt;', '&gt;',$data_view[0]['codipostal'], '&lt;', '&gt;');
//	CodiPais
			printf('</td></tr><tr><td>');
			printf('%sp:CodiPais%s%s%s/p:CodiPais%s', '&lt;', '&gt;',$data_view[0]['SII_CodiPais'], '&lt;', '&gt;');
//	Telefon ++VOID++
			printf('</td></tr><tr><td>');
			printf('%sp:Telefon xsi:nil="true"/%s', '&lt;', '&gt;');
//	NEE
			printf('</td></tr><tr><td>');
			printf('%sp:NEE%s%s%s/p:NEE%s', '&lt;', '&gt;','e', '&lt;', '&gt;');
//	ACI
			printf('</td></tr><tr><td>');
			printf('%sp:ACI xsi:nil="true"/%s', '&lt;', '&gt;');
//	SituacioLaboral
			printf('</td></tr><tr><td>');
			printf('%sp:SituacioLaboral%s%s%s/p:SituacioLaboral%s', '&lt;', '&gt;','D', '&lt;', '&gt;');
//	#########		FI Dades Alumne
			printf('</td></tr><tr><td>');
			printf('%s/p:DadesAlumne%s', '&lt;', '&gt;');
//	#########		Curriculum
			printf('</td></tr><tr><td>');
			printf('%sp:Matricules%s', '&lt;', '&gt;');
			printf('</td></tr><tr><td>');
			printf('%sp:Matricula%s', '&lt;', '&gt;');
// MarcNormatiu
			printf('</td></tr><tr><td>');
			$MarcNormatiu='L';
			if($data_view[0]['pla']=='LOGSE')$MarcNormatiu='LG';
			printf('%sp:MarcNormatiu%s%s%s/p:MarcNormatiu%s', '&lt;', '&gt;',$MarcNormatiu, '&lt;', '&gt;');
//	CodiEnsenyament			
			printf('</td></tr><tr><td>');
			printf('%sp:CodiEnsenyament%sCFPS&nbsp;&nbsp;&nbsp;&nbsp;%s%s/p:CodiEnsenyament%s', '&lt;', '&gt;',$data_view[0]['codiespecialitat'], '&lt;', '&gt;');
//  ******************************************************
//  ******************************************************
//	DataMatricula   **************************************
			printf('</td></tr><tr><td>');
			printf('%sp:DataMatricula%s%s%s/p:DataMatricula%s', '&lt;', '&gt;','16092013', '&lt;', '&gt;');
//	CursAcademicIniciCicle
			printf('</td></tr><tr><td>');
			$CursAcademicIniciCicle='1213';
			if($data_view[0]['idcurs']==1)$CursAcademicIniciCicle='1314';
			printf('%sp:CursAcademicIniciCicle%s%s%s/p:CursAcademicIniciCicle%s', '&lt;', '&gt;',$CursAcademicIniciCicle, '&lt;', '&gt;');
//  ******************************************************
//  ******************************************************			

//	Nivell
			printf('</td></tr><tr><td>');
			$Nivell='2';
			if($data_view[0]['idcurs']==1)$Nivell='1';
			printf('%sp:Nivell%s%s%s/p:Nivell%s', '&lt;', '&gt;',$Nivell, '&lt;', '&gt;');
//	ModalitatCursa
			printf('</td></tr><tr><td>');
			printf('%sp:ModalitatCursa%s%s%s/p:ModalitatCursa%s', '&lt;', '&gt;','P', '&lt;', '&gt;');
//	EscolaritzacioCompartida
			printf('</td></tr><tr><td>');
			printf('%sp:EscolaritzacioCompartida%s%s%s/p:EscolaritzacioCompartida%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
//	CodiCentreExpedient	++VOID
			printf('</td></tr><tr><td>');
			printf('%sp:CodiCentreExpedient xsi:nil="true"/%s', '&lt;', '&gt;');
//	AlumneConveni ++VOID
			printf('</td></tr><tr><td>');
			printf('%sp:AlumneConveni%s%s%s/p:AlumneConveni%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
//	NIFEntitatConveni ++VOID
			printf('</td></tr><tr><td>');
			printf('%sp:NIFEntitatConveni xsi:nil="true"/%s', '&lt;', '&gt;');			
//	Torn
			printf('</td></tr><tr><td>');
			$Torn='M';
			if($data_view[0]['sessio']=='Tarda')$Torn='V';
			printf('%sp:Torn%s%s%s/p:Torn%s', '&lt;', '&gt;',$Torn, '&lt;', '&gt;');
//	RequisitsAcademicsAcces
			printf('</td></tr><tr><td>');
			if(strncmp(strtolower($data_view[0]['estudisrealitzats']),"batxi",5)==0){
				printf('%sp:RequisitsAcademicsAcces%s%s%s/p:RequisitsAcademicsAcces%s', '&lt;', '&gt;','K', '&lt;', '&gt;');
			}elseif(strncmp(strtolower($data_view[0]['estudisrealitzats']),"cfgs",4)==0){
				printf('%sp:RequisitsAcademicsAcces%s%s%s/p:RequisitsAcademicsAcces%s', '&lt;', '&gt;','Q', '&lt;', '&gt;');
			}elseif(strncmp(strtolower($data_view[0]['estudisrealitzats']),"cou",3)==0){
				printf('%sp:RequisitsAcademicsAcces%s%s%s/p:RequisitsAcademicsAcces%s', '&lt;', '&gt;','K', '&lt;', '&gt;');
			}elseif(strncmp(strtolower($data_view[0]['estudisrealitzats']),"homol",5)==0){
				printf('%sp:RequisitsAcademicsAcces%s%s%s/p:RequisitsAcademicsAcces%s', '&lt;', '&gt;','E', '&lt;', '&gt;');
			}else{
				printf('%sp:RequisitsAcademicsAcces%s%s%s/p:RequisitsAcademicsAcces%s', '&lt;', '&gt;','1', '&lt;', '&gt;');
			}
//	UltimEstudiMatriculat
			printf('</td></tr><tr><td>');
			printf('%sp:UltimEstudiMatriculat%s%s%s/p:UltimEstudiMatriculat%s', '&lt;', '&gt;','9', '&lt;', '&gt;');
//	CursUltimEstudiMatriculat	++VOID
			printf('</td></tr><tr><td>');
			printf('%sp:CursUltimEstudiMatriculat xsi:nil="true"/%s', '&lt;', '&gt;');
//	CodiPaisUltimEstudiMatriculat	++VOID
			printf('</td></tr><tr><td>');
			printf('%sp:CodiPaisUltimEstudiMatriculat xsi:nil="true"/%s', '&lt;', '&gt;');
//	TipusPrograma	++VOID
			printf('</td></tr><tr><td>');
			printf('%sp:Programa xsi:nil="true"/%s', '&lt;', '&gt;');
//	GrupEnsenyamentAlumne
			printf('</td></tr><tr><td>');
			printf('%sp:GrupEnsenyamentAlumne%s%s%s/p:GrupEnsenyamentAlumne%s', '&lt;', '&gt;','1', '&lt;', '&gt;');
//	DataBaixa	++VOID
			printf('</td></tr><tr><td>');
			printf('%sp:DataBaixa xsi:nil="true"/%s', '&lt;', '&gt;');
//	#########		Credits i Moduls			
//	Moduls
			printf('</td></tr><tr><td>');
			printf('%sp:Moduls%s', '&lt;', '&gt;');
//			Any actual
			$row_any = $wpdb->get_row('SELECT * FROM ricca3_any where actual = 1 ',ARRAY_A,0);
//	Moduls de l'especialitat
			$query = $wpdb->prepare('SELECT idcredit, SII_CodiModul, SII_NombreHoresModul, SII_CodiCredit, SII_NombreHoresCredit '.
					'FROM ricca3_credits WHERE idespecialitat=%s AND actiu_cr=1 ORDER BY SII_CodiModul, SII_CodiCredit', $data_view[0]['idespecialitat']	);
			$data_modul = $wpdb->get_results($query, ARRAY_A);
//	Crèdits de l'alumne			
			$query = $wpdb->prepare('SELECT DISTINCT ricca3_ccomp.idcredit '.
					'FROM ricca.ricca3_credits_avaluacions '. 
					'INNER JOIN ricca3_ccomp ON ricca3_ccomp.idccomp = ricca3_credits_avaluacions.idccomp '.
					'WHERE idalumne=%s AND idany=%s ORDER BY idcredit',
					$data_view[0]['idalumne'],$row_any['idany']);
			$data_credit = $wpdb->get_results( $query, ARRAY_A);
//			
			dump_r($data_credit);
			dump_r($data_modul);
//	LOGSE
			if($data_view[0]['pla'] == 'LOGSE'){
				for($j=0; $j<count($data_credit); $j++){
				
					
					
				}					
//	LOE				
			}else{

				
				
				
				
			}	
//	######### FI MODULS			
			printf('</td></tr><tr><td>');
			printf('%s/p:Moduls%s', '&lt;', '&gt;');			
//	#########		FI Curriculum
			printf('</td></tr><tr><td>');
			printf('%s/p:Matricula%s', '&lt;', '&gt;');
			printf('</td></tr><tr><td>');
			printf('%s/p:Matricules%s', '&lt;', '&gt;');
//	#########		AVALUACIONS
			printf('</td></tr><tr><td>');
			printf('%sp:Avaluacions xsi:nil="true"/%s', '&lt;', '&gt;');			
//		TANQUEM ALUMNE
			printf('</td></tr><tr><td>');
			printf('%s/p:Alumne%s', '&lt;', '&gt;');
	}
//		TANQUEM ALUMNES	
	printf('</td></tr><tr><td>');
	printf('%s/p:Alumnes%s', '&lt;', '&gt;');
//		TANQUEM CENTRE	
	printf('</td></tr><tr><td>');
	printf('%s/p:Centre%s', '&lt;', '&gt;');
//	
	printf('</table>');	
}