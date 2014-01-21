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

//	dump_r($_POST);

	ricca3_missatge(__('Sistema d\'Intercanvi d\'Informació (SII) - FITXERS','ricca3-sii'));
	ricca3_butons( $ricca3_butons_sii, 6 );
//
//		comprovar si hem de guardar les dades i crear el fitxer XML
//	$num_cols=count($ricca3_sii_modif,1)/count($ricca3_sii_modif,0)-1;
	if( isset( $_POST['accio'] ) && $_POST['accio'] == 'actualitzartot'){
		ricca3_missatge(sprintf('%s', __('Crear fitxer SII','ricca3-sii') ) );
//		printf('<form method="post" action="%s/ricca3-sii-xml" name="cercar"><table dir="ltr" class="cercar"><tr>', site_url());
//		printf('<td><button type="submit" name="cercar" value="actualitzar" title="%s"><img src=%s/ricca3/imatges/ricca3-sii-XML.png  border="0" /></button></td>', __('ajuda-llistar-alumnes', 'ricca3-sii'), WP_PLUGIN_URL);
//		printf('<form method="post" ><table><tr>', NULL);
//		printf('<td><a href="%s/%s" target="POPUPW" onsubmit="POPUPW = window.open("about:blank","POPUPW","width=800,height=650" >',site_url(), 'ricca3-sii-xml');
//		printf('<button type="button"><img src="%s/ricca3/imatges/ricca3-sii-XML.png" border=0 /></button></a></td>',WP_PLUGIN_URL );
//		printf('</tr></table></form>', NULL);
		printf('<table><tr><td>', NULL);
		printf('%s?xml version="1.0" encoding="UTF-8" ?%s', '&lt;', '&gt;');
		printf('</td></tr><tr><td>');
		printf('%sp:Centre xmlns:p="http://educacio.gencat.cat/sii/fp/models/v1/"', '&lt;');
		printf('</td></tr><tr><td>');
		printf('xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"');
		printf('</td></tr><tr><td>');
		printf('xsi:schemaLocation="http://educacio.gencat.cat/sii/fp/models/v1/EsquemaDadesFP.xsd"%s', '&gt;');
				
				
		printf('</td></tr><tr><td>');
		printf('%sp:CodiCentre%s08035672%s/p:CodiCentre%s', '&lt;', '&gt;', '&lt;', '&gt;');
		printf('</td></tr><tr><td>');
		printf('%sp:AnyAcademic%s1314%s/p:AnyAcademic%s', '&lt;', '&gt;', '&lt;', '&gt;');
		printf('</td></tr><tr><td>');
		printf('%sp:Alumnes%s', '&lt;', '&gt;');
		$numeroalumnes=count($_POST['cbox']);
		for($i=0;$i<$numeroalumnes;$i++){
//			$query = $wpdb->prepare('SELECT * FROM ricca.ricca3_alumne WHERE idalumne=%s', $_POST['cbox'][$i]);
			$query = $wpdb->prepare('SELECT * FROM ricca3_alumne '.
					'INNER JOIN ricca3_alumne_especialitat on ricca3_alumne_especialitat.idalumne=ricca3_alumne.idalumne '.
					'INNER JOIN ricca3_any ON ricca3_any.idany = ricca3_alumne_especialitat.idany '.
					'INNER JOIN ricca3_grups ON ricca3_grups.idgrup = ricca3_alumne_especialitat.idgrup '.
					'INNER JOIN ricca3_cursos ON ricca3_cursos.idcurs = ricca3_grups.idcurs '.
					'INNER JOIN ricca3_especialitats ON ricca3_especialitats.idespecialitat = ricca3_grups.idespecialitat '.
					'INNER JOIN ricca3_estat ON ricca3_estat.idestat = ricca3_alumne_especialitat.idestat_es '.
					'WHERE ricca3_alumne.idalumne=%s AND ricca3_grups.idgrup=%s', $_POST['cbox'][$i], $_POST['idgrup'][$i]);
			$data_view = $wpdb->get_results( $query, ARRAY_A);
//				
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
//				printf('%sp:NomMunicipiNaixementFora%s%s%s/p:NomMunicipiNaixementFora%s', '&lt;', '&gt;','' , '&lt;', '&gt;');
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
			if($data_view[0]['pla']=='LOGSE'){					
				printf('</td></tr><tr><td>');
				printf('%sp:MarcNormatiu%s%s%s/p:MarcNormatiu%s', '&lt;', '&gt;','LG', '&lt;', '&gt;');
			}else{
				printf('</td></tr><tr><td>');
				printf('%sp:MarcNormatiu%s%s%s/p:MarcNormatiu%s', '&lt;', '&gt;','L', '&lt;', '&gt;');
			}
//	CodiEnsenyament
//	***** Imatge
			if($data_view[0]['idgrup']==7 || $data_view[0]['idgrup']==9 || $data_view[0]['idgrup']==10 || $data_view[0]['idgrup']==12){
				printf('</td></tr><tr><td>');
				printf('%sp:CodiEnsenyament%s%s%s/p:CodiEnsenyament%s', '&lt;', '&gt;','CFPS&nbsp;&nbsp;&nbsp;&nbsp1660', '&lt;', '&gt;');
			}
//	***** Laboratori
			if($data_view[0]['idgrup']==13 || $data_view[0]['idgrup']==14 ){
				printf('</td></tr><tr><td>');
				printf('%sp:CodiEnsenyament%s%s%s/p:CodiEnsenyament%s', '&lt;', '&gt;','CFPS&nbsp;&nbsp;&nbsp;&nbsp1654', '&lt;', '&gt;');
			}
//	***** Ortesis
			if($data_view[0]['idgrup']==15 || $data_view[0]['idgrup']==16 ){
				printf('</td></tr><tr><td>');
				printf('%sp:CodiEnsenyament%s%s%s/p:CodiEnsenyament%s', '&lt;', '&gt;','CFPS&nbsp;&nbsp;&nbsp;&nbsp1657', '&lt;', '&gt;');
			}
//	***** Dietètica
			if($data_view[0]['idgrup']==17 || $data_view[0]['idgrup']==18 ){
				printf('</td></tr><tr><td>');
				printf('%sp:CodiEnsenyament%s%s%s/p:CodiEnsenyament%s', '&lt;', '&gt;','CFPS&nbsp;&nbsp;&nbsp;&nbsp1651', '&lt;', '&gt;');
			}
//	***** Higiene
			if($data_view[0]['idgrup']==19 || $data_view[0]['idgrup']==20 ){
				printf('</td></tr><tr><td>');
				printf('%sp:CodiEnsenyament%s%s%s/p:CodiEnsenyament%s', '&lt;', '&gt;','CFPS&nbsp;&nbsp;&nbsp;&nbsp1652', '&lt;', '&gt;');
			}
//	***** Documentació
			if($data_view[0]['idgrup']==23 ){
				printf('</td></tr><tr><td>');
				printf('%sp:CodiEnsenyament%s%s%s/p:CodiEnsenyament%s', '&lt;', '&gt;','CFPS&nbsp;&nbsp;&nbsp;&nbsp1658', '&lt;', '&gt;');
			}
//	***** Pròtesis
			if($data_view[0]['idgrup']==37 || $data_view[0]['idgrup']==38 ){
				printf('</td></tr><tr><td>');
				printf('%sp:CodiEnsenyament%s%s%s/p:CodiEnsenyament%s', '&lt;', '&gt;','CFPS&nbsp;&nbsp;&nbsp;&nbspSAA0', '&lt;', '&gt;');
			}
//	***** Pròtesis LOGSE
			if($data_view[0]['idgrup']==1 || $data_view[0]['idgrup']==4 ){
				printf('</td></tr><tr><td>');
				printf('%sp:CodiEnsenyament%s%s%s/p:CodiEnsenyament%s', '&lt;', '&gt;','CFPS&nbsp;&nbsp;&nbsp;&nbsp1656', '&lt;', '&gt;');
			}			
//	DataMatricula
//			$DataMatricula=date('dmY', strtotime( $data_view[0]['datainscripcio']));
			printf('</td></tr><tr><td>');
			printf('%sp:DataMatricula%s%s%s/p:DataMatricula%s', '&lt;', '&gt;','16092013', '&lt;', '&gt;');
//	CursAcademicIniciCicle i Nivell
			if($data_view[0]['idcurs']==1){
				printf('</td></tr><tr><td>');
				printf('%sp:CursAcademicIniciCicle%s%s%s/p:CursAcademicIniciCicle%s', '&lt;', '&gt;','1314', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:Nivell%s%s%s/p:Nivell%s', '&lt;', '&gt;','1', '&lt;', '&gt;');
			}else{
				printf('</td></tr><tr><td>');
				printf('%sp:CursAcademicIniciCicle%s%s%s/p:CursAcademicIniciCicle%s', '&lt;', '&gt;','1213', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:Nivell%s%s%s/p:Nivell%s', '&lt;', '&gt;','2', '&lt;', '&gt;');	
			}
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
//			printf('%sp:AlumneConveni xsi:nil="true"/%s', '&lt;', '&gt;');
//	NIFEntitatConveni ++VOID
			printf('</td></tr><tr><td>');
			printf('%sp:NIFEntitatConveni xsi:nil="true"/%s', '&lt;', '&gt;');
//	Torn
			if($data_view[0]['sessio']=='Tarda'){
				printf('</td></tr><tr><td>');
				printf('%sp:Torn%s%s%s/p:Torn%s', '&lt;', '&gt;','V', '&lt;', '&gt;');
			}else{
				printf('</td></tr><tr><td>');
				printf('%sp:Torn%s%s%s/p:Torn%s', '&lt;', '&gt;','M', '&lt;', '&gt;');
			}
//	RequisitsAcademicsAcces
//			printf('</td></tr><tr><td>');
//			printf('%sp:RequisitsAcademicsAcces%s%s%s/p:RequisitsAcademicsAcces%s', '&lt;', '&gt;',strtolower($data_view[0]['estudisrealitzats']), '&lt;', '&gt;');
			if(strncmp(strtolower($data_view[0]['estudisrealitzats']),"prova",5)==0){
				printf('</td></tr><tr><td>');
				printf('%sp:RequisitsAcademicsAcces%s%s%s/p:RequisitsAcademicsAcces%s', '&lt;', '&gt;','1', '&lt;', '&gt;');
			}elseif(strncmp(strtolower($data_view[0]['estudisrealitzats']),"acc",3)==0){
				printf('</td></tr><tr><td>');
				printf('%sp:RequisitsAcademicsAcces%s%s%s/p:RequisitsAcademicsAcces%s', '&lt;', '&gt;','1', '&lt;', '&gt;');
			}elseif(strncmp(strtolower($data_view[0]['estudisrealitzats']),"batxi",5)==0){
				printf('</td></tr><tr><td>');
				printf('%sp:RequisitsAcademicsAcces%s%s%s/p:RequisitsAcademicsAcces%s', '&lt;', '&gt;','K', '&lt;', '&gt;');
			}elseif(strncmp(strtolower($data_view[0]['estudisrealitzats']),"cfgs",4)==0){
				printf('</td></tr><tr><td>');
				printf('%sp:RequisitsAcademicsAcces%s%s%s/p:RequisitsAcademicsAcces%s', '&lt;', '&gt;','Q', '&lt;', '&gt;');
			}elseif(strncmp(strtolower($data_view[0]['estudisrealitzats']),"cou",3)==0){
				printf('</td></tr><tr><td>');
				printf('%sp:RequisitsAcademicsAcces%s%s%s/p:RequisitsAcademicsAcces%s', '&lt;', '&gt;','K', '&lt;', '&gt;');
			}elseif(strncmp(strtolower($data_view[0]['estudisrealitzats']),"homol",5)==0){
				printf('</td></tr><tr><td>');
				printf('%sp:RequisitsAcademicsAcces%s%s%s/p:RequisitsAcademicsAcces%s', '&lt;', '&gt;','E', '&lt;', '&gt;');
			}elseif(strncmp(strtolower($data_view[0]['estudisrealitzats']),"prova",5)==0){
				printf('</td></tr><tr><td>');
				printf('%sp:RequisitsAcademicsAcces%s%s%s/p:RequisitsAcademicsAcces%s', '&lt;', '&gt;','1', '&lt;', '&gt;');
			}else{
				printf('</td></tr><tr><td>');
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
//	################### fixe per el curs 2013-2014 ########### canviar a contigut de base de dades amb unitats formatives per LOE
//	
//	Moduls
			printf('</td></tr><tr><td>');
			printf('%sp:Moduls%s', '&lt;', '&gt;');
//	***** 1 Imatge
			if($data_view[0]['idgrup']==7 || $data_view[0]['idgrup']==9){

//	Modul	MP02
				printf('</td></tr><tr><td>');
				printf('%sp:Modul%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CodiModul%s%s%s/p:CodiModul%s', '&lt;', '&gt;','MP02', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:ModulPropi%s%s%s/p:ModulPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresModul%s%s%s/p:NombreHoresModul%s', '&lt;', '&gt;','390', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
//	Credit	C02				
				printf('%sp:Credit%s', '&lt;', '&gt;');
				printf('%sp:CodiCredit%s%s%s/p:CodiCredit%s', '&lt;', '&gt;','C02', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CreditPropi%s%s%s/p:CreditPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresCredit%s%s%s/p:NombreHoresCredit%s', '&lt;', '&gt;','120', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Credit%s', '&lt;', '&gt;');
//	Credit	C03
				printf('%sp:Credit%s', '&lt;', '&gt;');
				printf('%sp:CodiCredit%s%s%s/p:CodiCredit%s', '&lt;', '&gt;','C03', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CreditPropi%s%s%s/p:CreditPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresCredit%s%s%s/p:NombreHoresCredit%s', '&lt;', '&gt;','210', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Credit%s', '&lt;', '&gt;');				
//	Credit	C04
				printf('%sp:Credit%s', '&lt;', '&gt;');
				printf('%sp:CodiCredit%s%s%s/p:CodiCredit%s', '&lt;', '&gt;','C04', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CreditPropi%s%s%s/p:CreditPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresCredit%s%s%s/p:NombreHoresCredit%s', '&lt;', '&gt;','60', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Credit%s', '&lt;', '&gt;');	
//
				printf('</td></tr><tr><td>');
				printf('%s/p:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Modul%s', '&lt;', '&gt;');
//	Modul	MP05
				printf('</td></tr><tr><td>');
				printf('%sp:Modul%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CodiModul%s%s%s/p:CodiModul%s', '&lt;', '&gt;','MP05', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:ModulPropi%s%s%s/p:ModulPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresModul%s%s%s/p:NombreHoresModul%s', '&lt;', '&gt;','90', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
//	Credit	C08
				printf('%sp:Credit%s', '&lt;', '&gt;');
				printf('%sp:CodiCredit%s%s%s/p:CodiCredit%s', '&lt;', '&gt;','C08', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CreditPropi%s%s%s/p:CreditPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresCredit%s%s%s/p:NombreHoresCredit%s', '&lt;', '&gt;','90', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Credit%s', '&lt;', '&gt;');
//
				printf('</td></tr><tr><td>');
				printf('%s/p:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Modul%s', '&lt;', '&gt;');			
//	Modul	MP06
				printf('</td></tr><tr><td>');
				printf('%sp:Modul%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CodiModul%s%s%s/p:CodiModul%s', '&lt;', '&gt;','MP06', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:ModulPropi%s%s%s/p:ModulPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresModul%s%s%s/p:NombreHoresModul%s', '&lt;', '&gt;','150', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
//	Credit	C09
				printf('%sp:Credit%s', '&lt;', '&gt;');
				printf('%sp:CodiCredit%s%s%s/p:CodiCredit%s', '&lt;', '&gt;','C09', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CreditPropi%s%s%s/p:CreditPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresCredit%s%s%s/p:NombreHoresCredit%s', '&lt;', '&gt;','150', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Credit%s', '&lt;', '&gt;');
//
				printf('</td></tr><tr><td>');
				printf('%s/p:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Modul%s', '&lt;', '&gt;');
//	Modul	MP07
				printf('</td></tr><tr><td>');
				printf('%sp:Modul%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CodiModul%s%s%s/p:CodiModul%s', '&lt;', '&gt;','MP07', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:ModulPropi%s%s%s/p:ModulPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresModul%s%s%s/p:NombreHoresModul%s', '&lt;', '&gt;','60', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
//	Credit	C08
				printf('%sp:Credit%s', '&lt;', '&gt;');
				printf('%sp:CodiCredit%s%s%s/p:CodiCredit%s', '&lt;', '&gt;','C10', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CreditPropi%s%s%s/p:CreditPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresCredit%s%s%s/p:NombreHoresCredit%s', '&lt;', '&gt;','60', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Credit%s', '&lt;', '&gt;');
//
				printf('</td></tr><tr><td>');
				printf('%s/p:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Modul%s', '&lt;', '&gt;');				
			}				
//	***** 2 Imatge
			if($data_view[0]['idgrup']==10 || $data_view[0]['idgrup']==12){
//	Modul	MP01
				printf('</td></tr><tr><td>');
				printf('%sp:Modul%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CodiModul%s%s%s/p:CodiModul%s', '&lt;', '&gt;','MP01', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:ModulPropi%s%s%s/p:ModulPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresModul%s%s%s/p:NombreHoresModul%s', '&lt;', '&gt;','60', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
//	Credit	C01
				printf('%sp:Credit%s', '&lt;', '&gt;');
				printf('%sp:CodiCredit%s%s%s/p:CodiCredit%s', '&lt;', '&gt;','C01', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CreditPropi%s%s%s/p:CreditPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresCredit%s%s%s/p:NombreHoresCredit%s', '&lt;', '&gt;','60', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Credit%s', '&lt;', '&gt;');
//
				printf('</td></tr><tr><td>');
				printf('%s/p:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Modul%s', '&lt;', '&gt;');
//	Modul	MP03
				printf('</td></tr><tr><td>');
				printf('%sp:Modul%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CodiModul%s%s%s/p:CodiModul%s', '&lt;', '&gt;','MP03', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:ModulPropi%s%s%s/p:ModulPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresModul%s%s%s/p:NombreHoresModul%s', '&lt;', '&gt;','120', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
//	Credit	C05
				printf('%sp:Credit%s', '&lt;', '&gt;');
				printf('%sp:CodiCredit%s%s%s/p:CodiCredit%s', '&lt;', '&gt;','C05', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CreditPropi%s%s%s/p:CreditPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresCredit%s%s%s/p:NombreHoresCredit%s', '&lt;', '&gt;','60', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Credit%s', '&lt;', '&gt;');
//	Credit	C06
				printf('%sp:Credit%s', '&lt;', '&gt;');
				printf('%sp:CodiCredit%s%s%s/p:CodiCredit%s', '&lt;', '&gt;','C06', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CreditPropi%s%s%s/p:CreditPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresCredit%s%s%s/p:NombreHoresCredit%s', '&lt;', '&gt;','60', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Credit%s', '&lt;', '&gt;');
//
				printf('</td></tr><tr><td>');
				printf('%s/p:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Modul%s', '&lt;', '&gt;');
//	Modul	MP04
				printf('</td></tr><tr><td>');
				printf('%sp:Modul%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CodiModul%s%s%s/p:CodiModul%s', '&lt;', '&gt;','MP04', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:ModulPropi%s%s%s/p:ModulPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresModul%s%s%s/p:NombreHoresModul%s', '&lt;', '&gt;','100', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
//	Credit	C07
				printf('%sp:Credit%s', '&lt;', '&gt;');
				printf('%sp:CodiCredit%s%s%s/p:CodiCredit%s', '&lt;', '&gt;','C07', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CreditPropi%s%s%s/p:CreditPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresCredit%s%s%s/p:NombreHoresCredit%s', '&lt;', '&gt;','100', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Credit%s', '&lt;', '&gt;');
//
				printf('</td></tr><tr><td>');
				printf('%s/p:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Modul%s', '&lt;', '&gt;');
//	Modul	MP09
				printf('</td></tr><tr><td>');
				printf('%sp:Modul%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CodiModul%s%s%s/p:CodiModul%s', '&lt;', '&gt;','MP09', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:ModulPropi%s%s%s/p:ModulPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresModul%s%s%s/p:NombreHoresModul%s', '&lt;', '&gt;','710', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
//	Credit	C13
				printf('%sp:Credit%s', '&lt;', '&gt;');
				printf('%sp:CodiCredit%s%s%s/p:CodiCredit%s', '&lt;', '&gt;','C13', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CreditPropi%s%s%s/p:CreditPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresCredit%s%s%s/p:NombreHoresCredit%s', '&lt;', '&gt;','710', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Credit%s', '&lt;', '&gt;');
//
				printf('</td></tr><tr><td>');
				printf('%s/p:Credits%s', '&lt;', '&gt;');
  				printf('</td></tr><tr><td>');
				printf('%s/p:Modul%s', '&lt;', '&gt;');
//	Modul	ANATOMIA
				printf('</td></tr><tr><td>');
				printf('%sp:Modul%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CodiModul xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:ModulPropi xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresModul xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
//	Credit	C11
				printf('%sp:Credit%s', '&lt;', '&gt;');
				printf('%sp:CodiCredit%s%s%s/p:CodiCredit%s', '&lt;', '&gt;','C11', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CreditPropi%s%s%s/p:CreditPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresCredit%s%s%s/p:NombreHoresCredit%s', '&lt;', '&gt;','60', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Credit%s', '&lt;', '&gt;');
//	Credit	C14
				printf('%sp:Credit%s', '&lt;', '&gt;');
				printf('%sp:CodiCredit%s%s%s/p:CodiCredit%s', '&lt;', '&gt;','C14', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CreditPropi%s%s%s/p:CreditPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresCredit%s%s%s/p:NombreHoresCredit%s', '&lt;', '&gt;','60', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Credit%s', '&lt;', '&gt;');
//
				printf('</td></tr><tr><td>');
				printf('%s/p:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Modul%s', '&lt;', '&gt;');
			}				
//	***** 1 Laboratori
			if($data_view[0]['idgrup']==13){
//	Modul	MP01
				printf('</td></tr><tr><td>');
				printf('%sp:Modul%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CodiModul%s%s%s/p:CodiModul%s', '&lt;', '&gt;','MP01', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:ModulPropi%s%s%s/p:ModulPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresModul%s%s%s/p:NombreHoresModul%s', '&lt;', '&gt;','60', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
//	Credit	C01
				printf('%sp:Credit%s', '&lt;', '&gt;');
				printf('%sp:CodiCredit%s%s%s/p:CodiCredit%s', '&lt;', '&gt;','C01', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CreditPropi%s%s%s/p:CreditPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresCredit%s%s%s/p:NombreHoresCredit%s', '&lt;', '&gt;','60', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Credit%s', '&lt;', '&gt;');
//
				printf('</td></tr><tr><td>');
				printf('%s/p:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Modul%s', '&lt;', '&gt;');
//	Modul	MP02
				printf('</td></tr><tr><td>');
				printf('%sp:Modul%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CodiModul%s%s%s/p:CodiModul%s', '&lt;', '&gt;','MP02', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:ModulPropi%s%s%s/p:ModulPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresModul%s%s%s/p:NombreHoresModul%s', '&lt;', '&gt;','180', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
//	Credit	C02
				printf('%sp:Credit%s', '&lt;', '&gt;');
				printf('%sp:CodiCredit%s%s%s/p:CodiCredit%s', '&lt;', '&gt;','C02', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CreditPropi%s%s%s/p:CreditPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresCredit%s%s%s/p:NombreHoresCredit%s', '&lt;', '&gt;','180', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Credit%s', '&lt;', '&gt;');
//
				printf('</td></tr><tr><td>');
				printf('%s/p:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Modul%s', '&lt;', '&gt;');
//	Modul	MP03
				printf('</td></tr><tr><td>');
				printf('%sp:Modul%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CodiModul%s%s%s/p:CodiModul%s', '&lt;', '&gt;','MP03', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:ModulPropi%s%s%s/p:ModulPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresModul%s%s%s/p:NombreHoresModul%s', '&lt;', '&gt;','420', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
//	Credit	C03
				printf('%sp:Credit%s', '&lt;', '&gt;');
				printf('%sp:CodiCredit%s%s%s/p:CodiCredit%s', '&lt;', '&gt;','C03', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CreditPropi%s%s%s/p:CreditPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresCredit%s%s%s/p:NombreHoresCredit%s', '&lt;', '&gt;','210', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Credit%s', '&lt;', '&gt;');
//	Credit	C04
				printf('%sp:Credit%s', '&lt;', '&gt;');
				printf('%sp:CodiCredit%s%s%s/p:CodiCredit%s', '&lt;', '&gt;','C04', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CreditPropi%s%s%s/p:CreditPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresCredit%s%s%s/p:NombreHoresCredit%s', '&lt;', '&gt;','210', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Credit%s', '&lt;', '&gt;');
//
				printf('</td></tr><tr><td>');
				printf('%s/p:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Modul%s', '&lt;', '&gt;');
//	Modul	MP04
				printf('</td></tr><tr><td>');
				printf('%sp:Modul%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CodiModul%s%s%s/p:CodiModul%s', '&lt;', '&gt;','MP04', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:ModulPropi%s%s%s/p:ModulPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresModul%s%s%s/p:NombreHoresModul%s', '&lt;', '&gt;','300', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
//	Credit	C06
				printf('%sp:Credit%s', '&lt;', '&gt;');
				printf('%sp:CodiCredit%s%s%s/p:CodiCredit%s', '&lt;', '&gt;','C06', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CreditPropi%s%s%s/p:CreditPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresCredit%s%s%s/p:NombreHoresCredit%s', '&lt;', '&gt;','300', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Credit%s', '&lt;', '&gt;');
//
				printf('</td></tr><tr><td>');
				printf('%s/p:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Modul%s', '&lt;', '&gt;');
//	Modul	ANATOMIA
				printf('</td></tr><tr><td>');
				printf('%sp:Modul%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CodiModul xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:ModulPropi xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresModul xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
//	Credit	C14
				printf('%sp:Credit%s', '&lt;', '&gt;');
				printf('%sp:CodiCredit%s%s%s/p:CodiCredit%s', '&lt;', '&gt;','C08', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CreditPropi%s%s%s/p:CreditPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresCredit%s%s%s/p:NombreHoresCredit%s', '&lt;', '&gt;','60', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Credit%s', '&lt;', '&gt;');
//
				printf('</td></tr><tr><td>');
				printf('%s/p:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Modul%s', '&lt;', '&gt;');				
			}
//	***** 2 Laboratori
			if($data_view[0]['idgrup']==14){
//	Modul	MP02
				printf('</td></tr><tr><td>');
				printf('%sp:Modul%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CodiModul%s%s%s/p:CodiModul%s', '&lt;', '&gt;','MP02', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:ModulPropi%s%s%s/p:ModulPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresModul%s%s%s/p:NombreHoresModul%s', '&lt;', '&gt;','180', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
//	Credit	C02
				printf('%sp:Credit%s', '&lt;', '&gt;');
				printf('%sp:CodiCredit%s%s%s/p:CodiCredit%s', '&lt;', '&gt;','C02', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CreditPropi%s%s%s/p:CreditPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresCredit%s%s%s/p:NombreHoresCredit%s', '&lt;', '&gt;','180', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Credit%s', '&lt;', '&gt;');
//
				printf('</td></tr><tr><td>');
				printf('%s/p:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Modul%s', '&lt;', '&gt;');
//	Modul	MP03
				printf('</td></tr><tr><td>');
				printf('%sp:Modul%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CodiModul%s%s%s/p:CodiModul%s', '&lt;', '&gt;','MP03', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:ModulPropi%s%s%s/p:ModulPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresModul%s%s%s/p:NombreHoresModul%s', '&lt;', '&gt;','420', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
//	Credit	C08
				printf('%sp:Credit%s', '&lt;', '&gt;');
				printf('%sp:CodiCredit%s%s%s/p:CodiCredit%s', '&lt;', '&gt;','C04', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CreditPropi%s%s%s/p:CreditPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresCredit%s%s%s/p:NombreHoresCredit%s', '&lt;', '&gt;','210', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Credit%s', '&lt;', '&gt;');
//
				printf('</td></tr><tr><td>');
				printf('%s/p:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Modul%s', '&lt;', '&gt;');
//	Modul	MP04
				printf('</td></tr><tr><td>');
				printf('%sp:Modul%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CodiModul%s%s%s/p:CodiModul%s', '&lt;', '&gt;','MP04', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:ModulPropi%s%s%s/p:ModulPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresModul%s%s%s/p:NombreHoresModul%s', '&lt;', '&gt;','300', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
//	Credit	C06
				printf('%sp:Credit%s', '&lt;', '&gt;');
				printf('%sp:CodiCredit%s%s%s/p:CodiCredit%s', '&lt;', '&gt;','C06', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CreditPropi%s%s%s/p:CreditPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresCredit%s%s%s/p:NombreHoresCredit%s', '&lt;', '&gt;','90', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Credit%s', '&lt;', '&gt;');
//
				printf('</td></tr><tr><td>');
				printf('%s/p:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Modul%s', '&lt;', '&gt;');
//	Modul	MP06
				printf('</td></tr><tr><td>');
				printf('%sp:Modul%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CodiModul%s%s%s/p:CodiModul%s', '&lt;', '&gt;','MP06', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:ModulPropi%s%s%s/p:ModulPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresModul%s%s%s/p:NombreHoresModul%s', '&lt;', '&gt;','60', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
//	Credit	C09
				printf('%sp:Credit%s', '&lt;', '&gt;');
				printf('%sp:CodiCredit%s%s%s/p:CodiCredit%s', '&lt;', '&gt;','C09', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CreditPropi%s%s%s/p:CreditPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresCredit%s%s%s/p:NombreHoresCredit%s', '&lt;', '&gt;','60', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Credit%s', '&lt;', '&gt;');
//
				printf('</td></tr><tr><td>');
				printf('%s/p:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Modul%s', '&lt;', '&gt;');
//	Modul	MP07
				printf('</td></tr><tr><td>');
				printf('%sp:Modul%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CodiModul%s%s%s/p:CodiModul%s', '&lt;', '&gt;','MP07', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:ModulPropi%s%s%s/p:ModulPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresModul%s%s%s/p:NombreHoresModul%s', '&lt;', '&gt;','440', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
//	Credit	C10
				printf('%sp:Credit%s', '&lt;', '&gt;');
				printf('%sp:CodiCredit%s%s%s/p:CodiCredit%s', '&lt;', '&gt;','C10', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CreditPropi%s%s%s/p:CreditPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresCredit%s%s%s/p:NombreHoresCredit%s', '&lt;', '&gt;','440', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Credit%s', '&lt;', '&gt;');
//
				printf('</td></tr><tr><td>');
				printf('%s/p:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Modul%s', '&lt;', '&gt;');
//	Modul	SINTESI
				printf('</td></tr><tr><td>');
				printf('%sp:Modul%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CodiModul xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:ModulPropi xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresModul xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
//	Credit	C11
				printf('%sp:Credit%s', '&lt;', '&gt;');
				printf('%sp:CodiCredit%s%s%s/p:CodiCredit%s', '&lt;', '&gt;','C11', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CreditPropi%s%s%s/p:CreditPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresCredit%s%s%s/p:NombreHoresCredit%s', '&lt;', '&gt;','60', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Credit%s', '&lt;', '&gt;');
//
				printf('</td></tr><tr><td>');
				printf('%s/p:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Modul%s', '&lt;', '&gt;');
			}				
//	***** 1 Ortesis
			if($data_view[0]['idgrup']==15){
//	Modul	MP01
				printf('</td></tr><tr><td>');
				printf('%sp:Modul%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CodiModul%s%s%s/p:CodiModul%s', '&lt;', '&gt;','MP01', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:ModulPropi%s%s%s/p:ModulPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresModul%s%s%s/p:NombreHoresModul%s', '&lt;', '&gt;','60', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
//	Credit	C01
				printf('%sp:Credit%s', '&lt;', '&gt;');
				printf('%sp:CodiCredit%s%s%s/p:CodiCredit%s', '&lt;', '&gt;','C01', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CreditPropi%s%s%s/p:CreditPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresCredit%s%s%s/p:NombreHoresCredit%s', '&lt;', '&gt;','60', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Credit%s', '&lt;', '&gt;');
//
				printf('</td></tr><tr><td>');
				printf('%s/p:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Modul%s', '&lt;', '&gt;');
//	Modul	MP03
				printf('</td></tr><tr><td>');
				printf('%sp:Modul%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CodiModul%s%s%s/p:CodiModul%s', '&lt;', '&gt;','MP03', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:ModulPropi%s%s%s/p:ModulPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresModul%s%s%s/p:NombreHoresModul%s', '&lt;', '&gt;','90', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
//	Credit	C03
				printf('%sp:Credit%s', '&lt;', '&gt;');
				printf('%sp:CodiCredit%s%s%s/p:CodiCredit%s', '&lt;', '&gt;','C03', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CreditPropi%s%s%s/p:CreditPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresCredit%s%s%s/p:NombreHoresCredit%s', '&lt;', '&gt;','90', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Credit%s', '&lt;', '&gt;');
//
				printf('</td></tr><tr><td>');
				printf('%s/p:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Modul%s', '&lt;', '&gt;');
//	Modul	MP06
				printf('</td></tr><tr><td>');
				printf('%sp:Modul%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CodiModul%s%s%s/p:CodiModul%s', '&lt;', '&gt;','MP06', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:ModulPropi%s%s%s/p:ModulPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresModul%s%s%s/p:NombreHoresModul%s', '&lt;', '&gt;','150', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
//	Credit	C06
				printf('%sp:Credit%s', '&lt;', '&gt;');
				printf('%sp:CodiCredit%s%s%s/p:CodiCredit%s', '&lt;', '&gt;','C06', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CreditPropi%s%s%s/p:CreditPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresCredit%s%s%s/p:NombreHoresCredit%s', '&lt;', '&gt;','150', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Credit%s', '&lt;', '&gt;');
//
				printf('</td></tr><tr><td>');
				printf('%s/p:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Modul%s', '&lt;', '&gt;');
//	Modul	MP07
				printf('</td></tr><tr><td>');
				printf('%sp:Modul%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CodiModul%s%s%s/p:CodiModul%s', '&lt;', '&gt;','MP07', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:ModulPropi%s%s%s/p:ModulPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresModul%s%s%s/p:NombreHoresModul%s', '&lt;', '&gt;','180', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
//	Credit	C07
				printf('%sp:Credit%s', '&lt;', '&gt;');
				printf('%sp:CodiCredit%s%s%s/p:CodiCredit%s', '&lt;', '&gt;','C07', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CreditPropi%s%s%s/p:CreditPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresCredit%s%s%s/p:NombreHoresCredit%s', '&lt;', '&gt;','180', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Credit%s', '&lt;', '&gt;');
//
				printf('</td></tr><tr><td>');
				printf('%s/p:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Modul%s', '&lt;', '&gt;');
//	Modul	MP08
				printf('</td></tr><tr><td>');
				printf('%sp:Modul%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CodiModul%s%s%s/p:CodiModul%s', '&lt;', '&gt;','MP08', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:ModulPropi%s%s%s/p:ModulPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresModul%s%s%s/p:NombreHoresModul%s', '&lt;', '&gt;','60', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
//	Credit	C09
				printf('%sp:Credit%s', '&lt;', '&gt;');
				printf('%sp:CodiCredit%s%s%s/p:CodiCredit%s', '&lt;', '&gt;','C09', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CreditPropi%s%s%s/p:CreditPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresCredit%s%s%s/p:NombreHoresCredit%s', '&lt;', '&gt;','60', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Credit%s', '&lt;', '&gt;');
//
				printf('</td></tr><tr><td>');
				printf('%s/p:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Modul%s', '&lt;', '&gt;');
//	Modul	MP09
				printf('</td></tr><tr><td>');
				printf('%sp:Modul%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CodiModul%s%s%s/p:CodiModul%s', '&lt;', '&gt;','MP09', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:ModulPropi%s%s%s/p:ModulPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresModul%s%s%s/p:NombreHoresModul%s', '&lt;', '&gt;','60', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
//	Credit	C10
				printf('%sp:Credit%s', '&lt;', '&gt;');
				printf('%sp:CodiCredit%s%s%s/p:CodiCredit%s', '&lt;', '&gt;','C10', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CreditPropi%s%s%s/p:CreditPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresCredit%s%s%s/p:NombreHoresCredit%s', '&lt;', '&gt;','60', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Credit%s', '&lt;', '&gt;');
//
				printf('</td></tr><tr><td>');
				printf('%s/p:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Modul%s', '&lt;', '&gt;');
//	Modul	ANATOMIA
				printf('</td></tr><tr><td>');
				printf('%sp:Modul%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CodiModul xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:ModulPropi xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresModul xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
//	Credit	C08
				printf('%sp:Credit%s', '&lt;', '&gt;');
				printf('%sp:CodiCredit%s%s%s/p:CodiCredit%s', '&lt;', '&gt;','C08', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CreditPropi%s%s%s/p:CreditPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresCredit%s%s%s/p:NombreHoresCredit%s', '&lt;', '&gt;','60', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Credit%s', '&lt;', '&gt;');
//
				printf('</td></tr><tr><td>');
				printf('%s/p:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Modul%s', '&lt;', '&gt;');				
			}			
//	***** 2 Ortesis
			if($data_view[0]['idgrup']==16){
//	Modul	MP02
				printf('</td></tr><tr><td>');
				printf('%sp:Modul%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CodiModul%s%s%s/p:CodiModul%s', '&lt;', '&gt;','MP02', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:ModulPropi%s%s%s/p:ModulPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresModul%s%s%s/p:NombreHoresModul%s', '&lt;', '&gt;','210', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
//	Credit	C02
				printf('%sp:Credit%s', '&lt;', '&gt;');
				printf('%sp:CodiCredit%s%s%s/p:CodiCredit%s', '&lt;', '&gt;','C02', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CreditPropi%s%s%s/p:CreditPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresCredit%s%s%s/p:NombreHoresCredit%s', '&lt;', '&gt;','210', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Credit%s', '&lt;', '&gt;');
//
				printf('</td></tr><tr><td>');
				printf('%s/p:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Modul%s', '&lt;', '&gt;');
//	Modul	MP04
				printf('</td></tr><tr><td>');
				printf('%sp:Modul%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CodiModul%s%s%s/p:CodiModul%s', '&lt;', '&gt;','MP04', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:ModulPropi%s%s%s/p:ModulPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresModul%s%s%s/p:NombreHoresModul%s', '&lt;', '&gt;','300', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
//	Credit	C04
				printf('%sp:Credit%s', '&lt;', '&gt;');
				printf('%sp:CodiCredit%s%s%s/p:CodiCredit%s', '&lt;', '&gt;','C04', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CreditPropi%s%s%s/p:CreditPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresCredit%s%s%s/p:NombreHoresCredit%s', '&lt;', '&gt;','300', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Credit%s', '&lt;', '&gt;');
//
				printf('</td></tr><tr><td>');
				printf('%s/p:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Modul%s', '&lt;', '&gt;');
//	Modul	MP05
				printf('</td></tr><tr><td>');
				printf('%sp:Modul%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CodiModul%s%s%s/p:CodiModul%s', '&lt;', '&gt;','MP05', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:ModulPropi%s%s%s/p:ModulPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresModul%s%s%s/p:NombreHoresModul%s', '&lt;', '&gt;','210', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
//	Credit	C05
				printf('%sp:Credit%s', '&lt;', '&gt;');
				printf('%sp:CodiCredit%s%s%s/p:CodiCredit%s', '&lt;', '&gt;','C05', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CreditPropi%s%s%s/p:CreditPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresCredit%s%s%s/p:NombreHoresCredit%s', '&lt;', '&gt;','210', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Credit%s', '&lt;', '&gt;');
//
				printf('</td></tr><tr><td>');
				printf('%s/p:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Modul%s', '&lt;', '&gt;');
//	Modul	MP08
				printf('</td></tr><tr><td>');
				printf('%sp:Modul%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CodiModul%s%s%s/p:CodiModul%s', '&lt;', '&gt;','MP08', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:ModulPropi%s%s%s/p:ModulPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresModul%s%s%s/p:NombreHoresModul%s', '&lt;', '&gt;','60', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
//	Credit	C09
				printf('%sp:Credit%s', '&lt;', '&gt;');
				printf('%sp:CodiCredit%s%s%s/p:CodiCredit%s', '&lt;', '&gt;','C09', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CreditPropi%s%s%s/p:CreditPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresCredit%s%s%s/p:NombreHoresCredit%s', '&lt;', '&gt;','60', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Credit%s', '&lt;', '&gt;');
//
				printf('</td></tr><tr><td>');
				printf('%s/p:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Modul%s', '&lt;', '&gt;');
//	Modul	MP10
				printf('</td></tr><tr><td>');
				printf('%sp:Modul%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CodiModul%s%s%s/p:CodiModul%s', '&lt;', '&gt;','MP10', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:ModulPropi%s%s%s/p:ModulPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresModul%s%s%s/p:NombreHoresModul%s', '&lt;', '&gt;','410', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
//	Credit	C11
				printf('%sp:Credit%s', '&lt;', '&gt;');
				printf('%sp:CodiCredit%s%s%s/p:CodiCredit%s', '&lt;', '&gt;','C11', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CreditPropi%s%s%s/p:CreditPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresCredit%s%s%s/p:NombreHoresCredit%s', '&lt;', '&gt;','410', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Credit%s', '&lt;', '&gt;');
//
				printf('</td></tr><tr><td>');
				printf('%s/p:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Modul%s', '&lt;', '&gt;');
//	Modul	SINTESI
				printf('</td></tr><tr><td>');
				printf('%sp:Modul%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CodiModul xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:ModulPropi xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresModul xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
//	Credit	C12
				printf('%sp:Credit%s', '&lt;', '&gt;');
				printf('%sp:CodiCredit%s%s%s/p:CodiCredit%s', '&lt;', '&gt;','C12', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CreditPropi%s%s%s/p:CreditPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresCredit%s%s%s/p:NombreHoresCredit%s', '&lt;', '&gt;','60', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Credit%s', '&lt;', '&gt;');
				//
				printf('</td></tr><tr><td>');
				printf('%s/p:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Modul%s', '&lt;', '&gt;');				
			}			
//	***** 1 Dietètica
			if($data_view[0]['idgrup']==17){
//	Modul	MP02
				printf('</td></tr><tr><td>');
				printf('%sp:Modul%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CodiModul%s%s%s/p:CodiModul%s', '&lt;', '&gt;','MP02', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:ModulPropi%s%s%s/p:ModulPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresModul%s%s%s/p:NombreHoresModul%s', '&lt;', '&gt;','270', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
//	Credit	C02
				printf('%sp:Credit%s', '&lt;', '&gt;');
				printf('%sp:CodiCredit%s%s%s/p:CodiCredit%s', '&lt;', '&gt;','C02', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CreditPropi%s%s%s/p:CreditPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresCredit%s%s%s/p:NombreHoresCredit%s', '&lt;', '&gt;','270', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Credit%s', '&lt;', '&gt;');
//
				printf('</td></tr><tr><td>');
				printf('%s/p:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Modul%s', '&lt;', '&gt;');
//	Modul	MP04
				printf('</td></tr><tr><td>');
				printf('%sp:Modul%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CodiModul%s%s%s/p:CodiModul%s', '&lt;', '&gt;','MP04', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:ModulPropi%s%s%s/p:ModulPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresModul%s%s%s/p:NombreHoresModul%s', '&lt;', '&gt;','180', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
//	Credit	C04
				printf('%sp:Credit%s', '&lt;', '&gt;');
				printf('%sp:CodiCredit%s%s%s/p:CodiCredit%s', '&lt;', '&gt;','C04', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CreditPropi%s%s%s/p:CreditPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresCredit%s%s%s/p:NombreHoresCredit%s', '&lt;', '&gt;','180', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Credit%s', '&lt;', '&gt;');
//
				printf('</td></tr><tr><td>');
				printf('%s/p:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Modul%s', '&lt;', '&gt;');
//	Modul	MP07
				printf('</td></tr><tr><td>');
				printf('%sp:Modul%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CodiModul%s%s%s/p:CodiModul%s', '&lt;', '&gt;','MP07', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:ModulPropi%s%s%s/p:ModulPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresModul%s%s%s/p:NombreHoresModul%s', '&lt;', '&gt;','240', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
//	Credit	C07
				printf('%sp:Credit%s', '&lt;', '&gt;');
				printf('%sp:CodiCredit%s%s%s/p:CodiCredit%s', '&lt;', '&gt;','C07', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CreditPropi%s%s%s/p:CreditPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresCredit%s%s%s/p:NombreHoresCredit%s', '&lt;', '&gt;','240', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Credit%s', '&lt;', '&gt;');
//
				printf('</td></tr><tr><td>');
				printf('%s/p:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Modul%s', '&lt;', '&gt;');
//	Modul	MP08
				printf('</td></tr><tr><td>');
				printf('%sp:Modul%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CodiModul%s%s%s/p:CodiModul%s', '&lt;', '&gt;','MP08', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:ModulPropi%s%s%s/p:ModulPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresModul%s%s%s/p:NombreHoresModul%s', '&lt;', '&gt;','60', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
//	Credit	C08
				printf('%sp:Credit%s', '&lt;', '&gt;');
				printf('%sp:CodiCredit%s%s%s/p:CodiCredit%s', '&lt;', '&gt;','C08', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CreditPropi%s%s%s/p:CreditPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresCredit%s%s%s/p:NombreHoresCredit%s', '&lt;', '&gt;','60', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Credit%s', '&lt;', '&gt;');
//
				printf('</td></tr><tr><td>');
				printf('%s/p:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Modul%s', '&lt;', '&gt;');
			}			
//	***** 2 Dietètica
			if($data_view[0]['idgrup']==18){
//	Modul	MP02
				printf('</td></tr><tr><td>');
				printf('%sp:Modul%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CodiModul%s%s%s/p:CodiModul%s', '&lt;', '&gt;','MP02', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:ModulPropi%s%s%s/p:ModulPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresModul%s%s%s/p:NombreHoresModul%s', '&lt;', '&gt;','270', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
//	Credit	C02
				printf('%sp:Credit%s', '&lt;', '&gt;');
				printf('%sp:CodiCredit%s%s%s/p:CodiCredit%s', '&lt;', '&gt;','C02', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CreditPropi%s%s%s/p:CreditPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresCredit%s%s%s/p:NombreHoresCredit%s', '&lt;', '&gt;','270', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Credit%s', '&lt;', '&gt;');
//
				printf('</td></tr><tr><td>');
				printf('%s/p:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Modul%s', '&lt;', '&gt;');
//	Modul	MP04
				printf('</td></tr><tr><td>');
				printf('%sp:Modul%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CodiModul%s%s%s/p:CodiModul%s', '&lt;', '&gt;','MP04', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:ModulPropi%s%s%s/p:ModulPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresModul%s%s%s/p:NombreHoresModul%s', '&lt;', '&gt;','180', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
//	Credit	C04
				printf('%sp:Credit%s', '&lt;', '&gt;');
				printf('%sp:CodiCredit%s%s%s/p:CodiCredit%s', '&lt;', '&gt;','C04', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CreditPropi%s%s%s/p:CreditPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresCredit%s%s%s/p:NombreHoresCredit%s', '&lt;', '&gt;','180', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Credit%s', '&lt;', '&gt;');
//
				printf('</td></tr><tr><td>');
				printf('%s/p:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Modul%s', '&lt;', '&gt;');
//	Modul	MP07
				printf('</td></tr><tr><td>');
				printf('%sp:Modul%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CodiModul%s%s%s/p:CodiModul%s', '&lt;', '&gt;','MP07', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:ModulPropi%s%s%s/p:ModulPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresModul%s%s%s/p:NombreHoresModul%s', '&lt;', '&gt;','240', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
//	Credit	C07
				printf('%sp:Credit%s', '&lt;', '&gt;');
				printf('%sp:CodiCredit%s%s%s/p:CodiCredit%s', '&lt;', '&gt;','C07', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CreditPropi%s%s%s/p:CreditPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresCredit%s%s%s/p:NombreHoresCredit%s', '&lt;', '&gt;','240', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Credit%s', '&lt;', '&gt;');
//
				printf('</td></tr><tr><td>');
				printf('%s/p:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Modul%s', '&lt;', '&gt;');
//	Modul	MP08
				printf('</td></tr><tr><td>');
				printf('%sp:Modul%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CodiModul%s%s%s/p:CodiModul%s', '&lt;', '&gt;','MP08', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:ModulPropi%s%s%s/p:ModulPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresModul%s%s%s/p:NombreHoresModul%s', '&lt;', '&gt;','60', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
//	Credit	C08
				printf('%sp:Credit%s', '&lt;', '&gt;');
				printf('%sp:CodiCredit%s%s%s/p:CodiCredit%s', '&lt;', '&gt;','C08', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CreditPropi%s%s%s/p:CreditPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresCredit%s%s%s/p:NombreHoresCredit%s', '&lt;', '&gt;','60', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Credit%s', '&lt;', '&gt;');
//
				printf('</td></tr><tr><td>');
				printf('%s/p:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Modul%s', '&lt;', '&gt;');
//	Modul	MP10
				printf('</td></tr><tr><td>');
				printf('%sp:Modul%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CodiModul%s%s%s/p:CodiModul%s', '&lt;', '&gt;','MP10', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:ModulPropi%s%s%s/p:ModulPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresModul%s%s%s/p:NombreHoresModul%s', '&lt;', '&gt;','410', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
//	Credit	C08
				printf('%sp:Credit%s', '&lt;', '&gt;');
				printf('%sp:CodiCredit%s%s%s/p:CodiCredit%s', '&lt;', '&gt;','C10', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CreditPropi%s%s%s/p:CreditPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresCredit%s%s%s/p:NombreHoresCredit%s', '&lt;', '&gt;','410', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Credit%s', '&lt;', '&gt;');
//
				printf('</td></tr><tr><td>');
				printf('%s/p:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Modul%s', '&lt;', '&gt;');
//	Modul	SINTESI
				printf('</td></tr><tr><td>');
				printf('%sp:Modul%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CodiModul xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:ModulPropi xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresModul xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
//	Credit	C11
				printf('%sp:Credit%s', '&lt;', '&gt;');
				printf('%sp:CodiCredit%s%s%s/p:CodiCredit%s', '&lt;', '&gt;','C11', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CreditPropi%s%s%s/p:CreditPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresCredit%s%s%s/p:NombreHoresCredit%s', '&lt;', '&gt;','60', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Credit%s', '&lt;', '&gt;');
//
				printf('</td></tr><tr><td>');
				printf('%s/p:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Modul%s', '&lt;', '&gt;');				
			}				
//	***** Higiene
			if($data_view[0]['idgrup']==19 || $data_view[0]['idgrup']==20){
//	Modul	MP01
				printf('</td></tr><tr><td>');
				printf('%sp:Modul%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CodiModul%s%s%s/p:CodiModul%s', '&lt;', '&gt;','MP01', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:ModulPropi%s%s%s/p:ModulPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresModul%s%s%s/p:NombreHoresModul%s', '&lt;', '&gt;','60', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
//	Credit	C01
				printf('%sp:Credit%s', '&lt;', '&gt;');
				printf('%sp:CodiCredit%s%s%s/p:CodiCredit%s', '&lt;', '&gt;','C01', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CreditPropi%s%s%s/p:CreditPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresCredit%s%s%s/p:NombreHoresCredit%s', '&lt;', '&gt;','60', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Credit%s', '&lt;', '&gt;');
//
				printf('</td></tr><tr><td>');
				printf('%s/p:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Modul%s', '&lt;', '&gt;');
//	Modul	MP02
				printf('</td></tr><tr><td>');
				printf('%sp:Modul%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CodiModul%s%s%s/p:CodiModul%s', '&lt;', '&gt;','MP02', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:ModulPropi%s%s%s/p:ModulPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresModul%s%s%s/p:NombreHoresModul%s', '&lt;', '&gt;','210', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
//	Credit	C02
				printf('%sp:Credit%s', '&lt;', '&gt;');
				printf('%sp:CodiCredit%s%s%s/p:CodiCredit%s', '&lt;', '&gt;','C02', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CreditPropi%s%s%s/p:CreditPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresCredit%s%s%s/p:NombreHoresCredit%s', '&lt;', '&gt;','210', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Credit%s', '&lt;', '&gt;');
//
				printf('</td></tr><tr><td>');
				printf('%s/p:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Modul%s', '&lt;', '&gt;');
//	Modul	MP03
				printf('</td></tr><tr><td>');
				printf('%sp:Modul%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CodiModul%s%s%s/p:CodiModul%s', '&lt;', '&gt;','MP03', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:ModulPropi%s%s%s/p:ModulPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresModul%s%s%s/p:NombreHoresModul%s', '&lt;', '&gt;','240', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
//	Credit	C03
				printf('%sp:Credit%s', '&lt;', '&gt;');
				printf('%sp:CodiCredit%s%s%s/p:CodiCredit%s', '&lt;', '&gt;','C03', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CreditPropi%s%s%s/p:CreditPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresCredit%s%s%s/p:NombreHoresCredit%s', '&lt;', '&gt;','240', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Credit%s', '&lt;', '&gt;');
//
				printf('</td></tr><tr><td>');
				printf('%s/p:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Modul%s', '&lt;', '&gt;');
//	Modul	MP04
				printf('</td></tr><tr><td>');
				printf('%sp:Modul%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CodiModul%s%s%s/p:CodiModul%s', '&lt;', '&gt;','MP04', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:ModulPropi%s%s%s/p:ModulPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresModul%s%s%s/p:NombreHoresModul%s', '&lt;', '&gt;','120', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
//	Credit	C04
				printf('%sp:Credit%s', '&lt;', '&gt;');
				printf('%sp:CodiCredit%s%s%s/p:CodiCredit%s', '&lt;', '&gt;','C04', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CreditPropi%s%s%s/p:CreditPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresCredit%s%s%s/p:NombreHoresCredit%s', '&lt;', '&gt;','120', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Credit%s', '&lt;', '&gt;');
//
				printf('</td></tr><tr><td>');
				printf('%s/p:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Modul%s', '&lt;', '&gt;');								
//	Modul	MP05
				printf('</td></tr><tr><td>');
				printf('%sp:Modul%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CodiModul%s%s%s/p:CodiModul%s', '&lt;', '&gt;','MP05', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:ModulPropi%s%s%s/p:ModulPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresModul%s%s%s/p:NombreHoresModul%s', '&lt;', '&gt;','90', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
//	Credit	C05
				printf('%sp:Credit%s', '&lt;', '&gt;');
				printf('%sp:CodiCredit%s%s%s/p:CodiCredit%s', '&lt;', '&gt;','C05', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CreditPropi%s%s%s/p:CreditPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresCredit%s%s%s/p:NombreHoresCredit%s', '&lt;', '&gt;','90', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Credit%s', '&lt;', '&gt;');
//
				printf('</td></tr><tr><td>');
				printf('%s/p:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Modul%s', '&lt;', '&gt;');
//	Modul	MP06
				printf('</td></tr><tr><td>');
				printf('%sp:Modul%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CodiModul%s%s%s/p:CodiModul%s', '&lt;', '&gt;','MP06', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:ModulPropi%s%s%s/p:ModulPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresModul%s%s%s/p:NombreHoresModul%s', '&lt;', '&gt;','60', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
//	Credit	C07
				printf('%sp:Credit%s', '&lt;', '&gt;');
				printf('%sp:CodiCredit%s%s%s/p:CodiCredit%s', '&lt;', '&gt;','C07', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CreditPropi%s%s%s/p:CreditPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresCredit%s%s%s/p:NombreHoresCredit%s', '&lt;', '&gt;','60', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Credit%s', '&lt;', '&gt;');
//
				printf('</td></tr><tr><td>');
				printf('%s/p:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Modul%s', '&lt;', '&gt;');
//	Modul	MP07
				printf('</td></tr><tr><td>');
				printf('%sp:Modul%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CodiModul%s%s%s/p:CodiModul%s', '&lt;', '&gt;','MP07', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:ModulPropi%s%s%s/p:ModulPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresModul%s%s%s/p:NombreHoresModul%s', '&lt;', '&gt;','410', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
//	Credit	C08
				printf('%sp:Credit%s', '&lt;', '&gt;');
				printf('%sp:CodiCredit%s%s%s/p:CodiCredit%s', '&lt;', '&gt;','C08', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CreditPropi%s%s%s/p:CreditPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresCredit%s%s%s/p:NombreHoresCredit%s', '&lt;', '&gt;','410', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Credit%s', '&lt;', '&gt;');
//
				printf('</td></tr><tr><td>');
				printf('%s/p:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Modul%s', '&lt;', '&gt;');
//	Modul	ANATOMIA
				printf('</td></tr><tr><td>');
				printf('%sp:Modul%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CodiModul xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:ModulPropi xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresModul xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
//	Credit	C06
				printf('%sp:Credit%s', '&lt;', '&gt;');
				printf('%sp:CodiCredit%s%s%s/p:CodiCredit%s', '&lt;', '&gt;','C06', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CreditPropi%s%s%s/p:CreditPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresCredit%s%s%s/p:NombreHoresCredit%s', '&lt;', '&gt;','60', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Credit%s', '&lt;', '&gt;');
//	Credit	C09
				printf('%sp:Credit%s', '&lt;', '&gt;');
				printf('%sp:CodiCredit%s%s%s/p:CodiCredit%s', '&lt;', '&gt;','C09', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CreditPropi%s%s%s/p:CreditPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresCredit%s%s%s/p:NombreHoresCredit%s', '&lt;', '&gt;','60', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Credit%s', '&lt;', '&gt;');
//
				printf('</td></tr><tr><td>');
				printf('%s/p:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Modul%s', '&lt;', '&gt;');
			}		
//	***** Documentació
			if($data_view[0]['idgrup']==23){
//	Modul	MP01
				printf('</td></tr><tr><td>');
				printf('%sp:Modul%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CodiModul%s%s%s/p:CodiModul%s', '&lt;', '&gt;','MP01', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:ModulPropi%s%s%s/p:ModulPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresModul%s%s%s/p:NombreHoresModul%s', '&lt;', '&gt;','90', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
//	Credit	C01
				printf('%sp:Credit%s', '&lt;', '&gt;');
				printf('%sp:CodiCredit%s%s%s/p:CodiCredit%s', '&lt;', '&gt;','C01', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CreditPropi%s%s%s/p:CreditPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresCredit%s%s%s/p:NombreHoresCredit%s', '&lt;', '&gt;','90', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Credit%s', '&lt;', '&gt;');
//
				printf('</td></tr><tr><td>');
				printf('%s/p:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Modul%s', '&lt;', '&gt;');
//	Modul	MP02
				printf('</td></tr><tr><td>');
				printf('%sp:Modul%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CodiModul%s%s%s/p:CodiModul%s', '&lt;', '&gt;','MP02', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:ModulPropi%s%s%s/p:ModulPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresModul%s%s%s/p:NombreHoresModul%s', '&lt;', '&gt;','90', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
//	Credit	C02
				printf('%sp:Credit%s', '&lt;', '&gt;');
				printf('%sp:CodiCredit%s%s%s/p:CodiCredit%s', '&lt;', '&gt;','C02', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CreditPropi%s%s%s/p:CreditPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresCredit%s%s%s/p:NombreHoresCredit%s', '&lt;', '&gt;','90', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Credit%s', '&lt;', '&gt;');
//
				printf('</td></tr><tr><td>');
				printf('%s/p:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Modul%s', '&lt;', '&gt;');
//	Modul	MP03
				printf('</td></tr><tr><td>');
				printf('%sp:Modul%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CodiModul%s%s%s/p:CodiModul%s', '&lt;', '&gt;','MP03', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:ModulPropi%s%s%s/p:ModulPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresModul%s%s%s/p:NombreHoresModul%s', '&lt;', '&gt;','210', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
//	Credit	C03
				printf('%sp:Credit%s', '&lt;', '&gt;');
				printf('%sp:CodiCredit%s%s%s/p:CodiCredit%s', '&lt;', '&gt;','C03', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CreditPropi%s%s%s/p:CreditPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresCredit%s%s%s/p:NombreHoresCredit%s', '&lt;', '&gt;','210', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Credit%s', '&lt;', '&gt;');
//
				printf('</td></tr><tr><td>');
				printf('%s/p:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Modul%s', '&lt;', '&gt;');
//	Modul	MP04
				printf('</td></tr><tr><td>');
				printf('%sp:Modul%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CodiModul%s%s%s/p:CodiModul%s', '&lt;', '&gt;','MP04', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:ModulPropi%s%s%s/p:ModulPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresModul%s%s%s/p:NombreHoresModul%s', '&lt;', '&gt;','150', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
//	Credit	C04
				printf('%sp:Credit%s', '&lt;', '&gt;');
				printf('%sp:CodiCredit%s%s%s/p:CodiCredit%s', '&lt;', '&gt;','C04', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CreditPropi%s%s%s/p:CreditPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresCredit%s%s%s/p:NombreHoresCredit%s', '&lt;', '&gt;','60', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Credit%s', '&lt;', '&gt;');
//
				printf('</td></tr><tr><td>');
				printf('%s/p:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Modul%s', '&lt;', '&gt;');
//	Modul	MP05
				printf('</td></tr><tr><td>');
				printf('%sp:Modul%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CodiModul%s%s%s/p:CodiModul%s', '&lt;', '&gt;','MP05', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:ModulPropi%s%s%s/p:ModulPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresModul%s%s%s/p:NombreHoresModul%s', '&lt;', '&gt;','120', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
//	Credit	C05
				printf('%sp:Credit%s', '&lt;', '&gt;');
				printf('%sp:CodiCredit%s%s%s/p:CodiCredit%s', '&lt;', '&gt;','C05', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CreditPropi%s%s%s/p:CreditPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresCredit%s%s%s/p:NombreHoresCredit%s', '&lt;', '&gt;','120', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Credit%s', '&lt;', '&gt;');
//
				printf('</td></tr><tr><td>');
				printf('%s/p:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Modul%s', '&lt;', '&gt;');
//	Modul	MP06
				printf('</td></tr><tr><td>');
				printf('%sp:Modul%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CodiModul%s%s%s/p:CodiModul%s', '&lt;', '&gt;','MP06', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:ModulPropi%s%s%s/p:ModulPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresModul%s%s%s/p:NombreHoresModul%s', '&lt;', '&gt;','60', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
//	Credit	C07
				printf('%sp:Credit%s', '&lt;', '&gt;');
				printf('%sp:CodiCredit%s%s%s/p:CodiCredit%s', '&lt;', '&gt;','C07', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CreditPropi%s%s%s/p:CreditPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresCredit%s%s%s/p:NombreHoresCredit%s', '&lt;', '&gt;','60', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Credit%s', '&lt;', '&gt;');
//
				printf('</td></tr><tr><td>');
				printf('%s/p:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Modul%s', '&lt;', '&gt;');
//	Modul	MP07
				printf('</td></tr><tr><td>');
				printf('%sp:Modul%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CodiModul%s%s%s/p:CodiModul%s', '&lt;', '&gt;','MP07', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:ModulPropi%s%s%s/p:ModulPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresModul%s%s%s/p:NombreHoresModul%s', '&lt;', '&gt;','60', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
//	Credit	C08
				printf('%sp:Credit%s', '&lt;', '&gt;');
				printf('%sp:CodiCredit%s%s%s/p:CodiCredit%s', '&lt;', '&gt;','C08', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CreditPropi%s%s%s/p:CreditPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresCredit%s%s%s/p:NombreHoresCredit%s', '&lt;', '&gt;','60', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Credit%s', '&lt;', '&gt;');
//
				printf('</td></tr><tr><td>');
				printf('%s/p:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Modul%s', '&lt;', '&gt;');
//	Modul	MP08
				printf('</td></tr><tr><td>');
				printf('%sp:Modul%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CodiModul%s%s%s/p:CodiModul%s', '&lt;', '&gt;','MP08', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:ModulPropi%s%s%s/p:ModulPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresModul%s%s%s/p:NombreHoresModul%s', '&lt;', '&gt;','410', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
//	Credit	C09
				printf('%sp:Credit%s', '&lt;', '&gt;');
				printf('%sp:CodiCredit%s%s%s/p:CodiCredit%s', '&lt;', '&gt;','C09', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CreditPropi%s%s%s/p:CreditPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresCredit%s%s%s/p:NombreHoresCredit%s', '&lt;', '&gt;','410', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Credit%s', '&lt;', '&gt;');
//
				printf('</td></tr><tr><td>');
				printf('%s/p:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Modul%s', '&lt;', '&gt;');	
//	Modul	ANATOMIA
				printf('</td></tr><tr><td>');
				printf('%sp:Modul%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CodiModul xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:ModulPropi xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresModul xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
//	Credit	C06
				printf('%sp:Credit%s', '&lt;', '&gt;');
				printf('%sp:CodiCredit%s%s%s/p:CodiCredit%s', '&lt;', '&gt;','C06', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CreditPropi%s%s%s/p:CreditPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresCredit%s%s%s/p:NombreHoresCredit%s', '&lt;', '&gt;','60', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
//	Credit	C10
				printf('%sp:Credit%s', '&lt;', '&gt;');
				printf('%sp:CodiCredit%s%s%s/p:CodiCredit%s', '&lt;', '&gt;','C10', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CreditPropi%s%s%s/p:CreditPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresCredit%s%s%s/p:NombreHoresCredit%s', '&lt;', '&gt;','60', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Credit%s', '&lt;', '&gt;');
//
				printf('</td></tr><tr><td>');
				printf('%s/p:Credits%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Modul%s', '&lt;', '&gt;');				
			}
//	***** 1 Pròtesis
			if($data_view[0]['idgrup']==37){
//	Modul	SAA0002
				printf('</td></tr><tr><td>');
				printf('%sp:Modul%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CodiModul%s%s%s/p:CodiModul%s', '&lt;', '&gt;','SAA0002', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:ModulPropi%s%s%s/p:ModulPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresModul%s%s%s/p:NombreHoresModul%s', '&lt;', '&gt;','132', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:UnitatsFormatives%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
//	UF	SAA000201
				printf('%sp:UnitatFormativa%s', '&lt;', '&gt;');
				printf('%sp:CodiUnitatFormativa%s%s%s/p:CodiUnitatFormativa%s', '&lt;', '&gt;','SAA000201', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:UnitatFormativaPropia%s%s%s/p:UnitatFormativaPropia%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresUnitatFormativa%s%s%s/p:NombreHoresUnitatFormativa%s', '&lt;', '&gt;','82', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:UnitatFormativa%s', '&lt;', '&gt;');
//	UF	SAA000202
				printf('%sp:UnitatFormativa%s', '&lt;', '&gt;');
				printf('%sp:CodiUnitatFormativa%s%s%s/p:CodiUnitatFormativa%s', '&lt;', '&gt;','SAA000202', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:UnitatFormativaPropia%s%s%s/p:UnitatFormativaPropia%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresUnitatFormativa%s%s%s/p:NombreHoresUnitatFormativa%s', '&lt;', '&gt;','30', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:UnitatFormativa%s', '&lt;', '&gt;');
//	UF	SAA000203
				printf('%sp:UnitatFormativa%s', '&lt;', '&gt;');
				printf('%sp:CodiUnitatFormativa%s%s%s/p:CodiUnitatFormativa%s', '&lt;', '&gt;','SAA000203', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:UnitatFormativaPropia%s%s%s/p:UnitatFormativaPropia%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresUnitatFormativa%s%s%s/p:NombreHoresUnitatFormativa%s', '&lt;', '&gt;','20', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:UnitatFormativa%s', '&lt;', '&gt;');				
//
				printf('</td></tr><tr><td>');
				printf('%s/p:UnitatsFormatives%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Modul%s', '&lt;', '&gt;');
//	Modul	SAA0003
				printf('</td></tr><tr><td>');
				printf('%sp:Modul%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CodiModul%s%s%s/p:CodiModul%s', '&lt;', '&gt;','SAA0003', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:ModulPropi%s%s%s/p:ModulPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresModul%s%s%s/p:NombreHoresModul%s', '&lt;', '&gt;','165', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:UnitatsFormatives%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
//	UF	SAA000301
				printf('%sp:UnitatFormativa%s', '&lt;', '&gt;');
				printf('%sp:CodiUnitatFormativa%s%s%s/p:CodiUnitatFormativa%s', '&lt;', '&gt;','SAA000301', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:UnitatFormativaPropia%s%s%s/p:UnitatFormativaPropia%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresUnitatFormativa%s%s%s/p:NombreHoresUnitatFormativa%s', '&lt;', '&gt;','80', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:UnitatFormativa%s', '&lt;', '&gt;');
//	UF	SAA000302
				printf('%sp:UnitatFormativa%s', '&lt;', '&gt;');
				printf('%sp:CodiUnitatFormativa%s%s%s/p:CodiUnitatFormativa%s', '&lt;', '&gt;','SAA000302', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:UnitatFormativaPropia%s%s%s/p:UnitatFormativaPropia%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresUnitatFormativa%s%s%s/p:NombreHoresUnitatFormativa%s', '&lt;', '&gt;','65', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:UnitatFormativa%s', '&lt;', '&gt;');
//	UF	SAA000303
				printf('%sp:UnitatFormativa%s', '&lt;', '&gt;');
				printf('%sp:CodiUnitatFormativa%s%s%s/p:CodiUnitatFormativa%s', '&lt;', '&gt;','SAA000303', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:UnitatFormativaPropia%s%s%s/p:UnitatFormativaPropia%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresUnitatFormativa%s%s%s/p:NombreHoresUnitatFormativa%s', '&lt;', '&gt;','20', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:UnitatFormativa%s', '&lt;', '&gt;');
//
				printf('</td></tr><tr><td>');
				printf('%s/p:UnitatsFormatives%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Modul%s', '&lt;', '&gt;');				
//	Modul	SAA0006
				printf('</td></tr><tr><td>');
				printf('%sp:Modul%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CodiModul%s%s%s/p:CodiModul%s', '&lt;', '&gt;','SAA0006', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:ModulPropi%s%s%s/p:ModulPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresModul%s%s%s/p:NombreHoresModul%s', '&lt;', '&gt;','165', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:UnitatsFormatives%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
//	UF	SAA000601
				printf('%sp:UnitatFormativa%s', '&lt;', '&gt;');
				printf('%sp:CodiUnitatFormativa%s%s%s/p:CodiUnitatFormativa%s', '&lt;', '&gt;','SAA000601', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:UnitatFormativaPropia%s%s%s/p:UnitatFormativaPropia%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresUnitatFormativa%s%s%s/p:NombreHoresUnitatFormativa%s', '&lt;', '&gt;','55', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:UnitatFormativa%s', '&lt;', '&gt;');
//	UF	SAA000602
				printf('%sp:UnitatFormativa%s', '&lt;', '&gt;');
				printf('%sp:CodiUnitatFormativa%s%s%s/p:CodiUnitatFormativa%s', '&lt;', '&gt;','SAA000602', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:UnitatFormativaPropia%s%s%s/p:UnitatFormativaPropia%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresUnitatFormativa%s%s%s/p:NombreHoresUnitatFormativa%s', '&lt;', '&gt;','40', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:UnitatFormativa%s', '&lt;', '&gt;');
//	UF	SAA000603
				printf('%sp:UnitatFormativa%s', '&lt;', '&gt;');
				printf('%sp:CodiUnitatFormativa%s%s%s/p:CodiUnitatFormativa%s', '&lt;', '&gt;','SAA000603', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:UnitatFormativaPropia%s%s%s/p:UnitatFormativaPropia%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresUnitatFormativa%s%s%s/p:NombreHoresUnitatFormativa%s', '&lt;', '&gt;','20', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:UnitatFormativa%s', '&lt;', '&gt;');
//	UF	SAA000604
				printf('%sp:UnitatFormativa%s', '&lt;', '&gt;');
				printf('%sp:CodiUnitatFormativa%s%s%s/p:CodiUnitatFormativa%s', '&lt;', '&gt;','SAA000604', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:UnitatFormativaPropia%s%s%s/p:UnitatFormativaPropia%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresUnitatFormativa%s%s%s/p:NombreHoresUnitatFormativa%s', '&lt;', '&gt;','50', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:UnitatFormativa%s', '&lt;', '&gt;');
//
				printf('</td></tr><tr><td>');
				printf('%s/p:UnitatsFormatives%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Modul%s', '&lt;', '&gt;');
//	Modul	SAA0009
				printf('</td></tr><tr><td>');
				printf('%sp:Modul%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CodiModul%s%s%s/p:CodiModul%s', '&lt;', '&gt;','SAA0009', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:ModulPropi%s%s%s/p:ModulPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresModul%s%s%s/p:NombreHoresModul%s', '&lt;', '&gt;','99', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:UnitatsFormatives%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
//	UF	SAA000901
				printf('%sp:UnitatFormativa%s', '&lt;', '&gt;');
				printf('%sp:CodiUnitatFormativa%s%s%s/p:CodiUnitatFormativa%s', '&lt;', '&gt;','SAA000901', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:UnitatFormativaPropia%s%s%s/p:UnitatFormativaPropia%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresUnitatFormativa%s%s%s/p:NombreHoresUnitatFormativa%s', '&lt;', '&gt;','66', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:UnitatFormativa%s', '&lt;', '&gt;');
//	UF	SAA000902
				printf('%sp:UnitatFormativa%s', '&lt;', '&gt;');
				printf('%sp:CodiUnitatFormativa%s%s%s/p:CodiUnitatFormativa%s', '&lt;', '&gt;','SAA000902', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:UnitatFormativaPropia%s%s%s/p:UnitatFormativaPropia%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresUnitatFormativa%s%s%s/p:NombreHoresUnitatFormativa%s', '&lt;', '&gt;','33', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:UnitatFormativa%s', '&lt;', '&gt;');
//
				printf('</td></tr><tr><td>');
				printf('%s/p:UnitatsFormatives%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Modul%s', '&lt;', '&gt;');
//	Modul	SAA0010
				printf('</td></tr><tr><td>');
				printf('%sp:Modul%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CodiModul%s%s%s/p:CodiModul%s', '&lt;', '&gt;','SAA0010', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:ModulPropi%s%s%s/p:ModulPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresModul%s%s%s/p:NombreHoresModul%s', '&lt;', '&gt;','66', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:UnitatsFormatives%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
//	UF	SAA001001
				printf('%sp:UnitatFormativa%s', '&lt;', '&gt;');
				printf('%sp:CodiUnitatFormativa%s%s%s/p:CodiUnitatFormativa%s', '&lt;', '&gt;','SAA001001', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:UnitatFormativaPropia%s%s%s/p:UnitatFormativaPropia%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresUnitatFormativa%s%s%s/p:NombreHoresUnitatFormativa%s', '&lt;', '&gt;','66', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:UnitatFormativa%s', '&lt;', '&gt;');
//
				printf('</td></tr><tr><td>');
				printf('%s/p:UnitatsFormatives%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Modul%s', '&lt;', '&gt;');				
			}			
//	***** 2 Pròtesis
			if($data_view[0]['idgrup']==38){
//	Modul	SAA0001
				printf('</td></tr><tr><td>');
				printf('%sp:Modul%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CodiModul%s%s%s/p:CodiModul%s', '&lt;', '&gt;','SAA0001', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:ModulPropi%s%s%s/p:ModulPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresModul%s%s%s/p:NombreHoresModul%s', '&lt;', '&gt;','66', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:UnitatsFormatives%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
//	UF	SAA000101
				printf('%sp:UnitatFormativa%s', '&lt;', '&gt;');
				printf('%sp:CodiUnitatFormativa%s%s%s/p:CodiUnitatFormativa%s', '&lt;', '&gt;','SAA000101', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:UnitatFormativaPropia%s%s%s/p:UnitatFormativaPropia%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresUnitatFormativa%s%s%s/p:NombreHoresUnitatFormativa%s', '&lt;', '&gt;','33', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:UnitatFormativa%s', '&lt;', '&gt;');
//	UF	SAA000102
				printf('%sp:UnitatFormativa%s', '&lt;', '&gt;');
				printf('%sp:CodiUnitatFormativa%s%s%s/p:CodiUnitatFormativa%s', '&lt;', '&gt;','SAA000102', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:UnitatFormativaPropia%s%s%s/p:UnitatFormativaPropia%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresUnitatFormativa%s%s%s/p:NombreHoresUnitatFormativa%s', '&lt;', '&gt;','33', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:UnitatFormativa%s', '&lt;', '&gt;');
				//
				printf('</td></tr><tr><td>');
				printf('%s/p:UnitatsFormatives%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Modul%s', '&lt;', '&gt;');
//	Modul	SAA0004
				printf('</td></tr><tr><td>');
				printf('%sp:Modul%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CodiModul%s%s%s/p:CodiModul%s', '&lt;', '&gt;','SAA0004', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:ModulPropi%s%s%s/p:ModulPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresModul%s%s%s/p:NombreHoresModul%s', '&lt;', '&gt;','165', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:UnitatsFormatives%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
//	UF	SAA000401
				printf('%sp:UnitatFormativa%s', '&lt;', '&gt;');
				printf('%sp:CodiUnitatFormativa%s%s%s/p:CodiUnitatFormativa%s', '&lt;', '&gt;','SAA000401', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:UnitatFormativaPropia%s%s%s/p:UnitatFormativaPropia%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresUnitatFormativa%s%s%s/p:NombreHoresUnitatFormativa%s', '&lt;', '&gt;','30', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:UnitatFormativa%s', '&lt;', '&gt;');
//	UF	SAA000402
				printf('%sp:UnitatFormativa%s', '&lt;', '&gt;');
				printf('%sp:CodiUnitatFormativa%s%s%s/p:CodiUnitatFormativa%s', '&lt;', '&gt;','SAA000402', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:UnitatFormativaPropia%s%s%s/p:UnitatFormativaPropia%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresUnitatFormativa%s%s%s/p:NombreHoresUnitatFormativa%s', '&lt;', '&gt;','65', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:UnitatFormativa%s', '&lt;', '&gt;');
//	UF	SAA000403
				printf('%sp:UnitatFormativa%s', '&lt;', '&gt;');
				printf('%sp:CodiUnitatFormativa%s%s%s/p:CodiUnitatFormativa%s', '&lt;', '&gt;','SAA000403', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:UnitatFormativaPropia%s%s%s/p:UnitatFormativaPropia%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresUnitatFormativa%s%s%s/p:NombreHoresUnitatFormativa%s', '&lt;', '&gt;','55', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:UnitatFormativa%s', '&lt;', '&gt;');
//	UF	SAA000404
				printf('%sp:UnitatFormativa%s', '&lt;', '&gt;');
				printf('%sp:CodiUnitatFormativa%s%s%s/p:CodiUnitatFormativa%s', '&lt;', '&gt;','SAA000404', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:UnitatFormativaPropia%s%s%s/p:UnitatFormativaPropia%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresUnitatFormativa%s%s%s/p:NombreHoresUnitatFormativa%s', '&lt;', '&gt;','15', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:UnitatFormativa%s', '&lt;', '&gt;');
//
				printf('</td></tr><tr><td>');
				printf('%s/p:UnitatsFormatives%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Modul%s', '&lt;', '&gt;');
//	Modul	SAA0005
				printf('</td></tr><tr><td>');
				printf('%sp:Modul%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CodiModul%s%s%s/p:CodiModul%s', '&lt;', '&gt;','SAA0005', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:ModulPropi%s%s%s/p:ModulPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresModul%s%s%s/p:NombreHoresModul%s', '&lt;', '&gt;','198', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:UnitatsFormatives%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
//	UF	SAA000501
				printf('%sp:UnitatFormativa%s', '&lt;', '&gt;');
				printf('%sp:CodiUnitatFormativa%s%s%s/p:CodiUnitatFormativa%s', '&lt;', '&gt;','SAA000501', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:UnitatFormativaPropia%s%s%s/p:UnitatFormativaPropia%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresUnitatFormativa%s%s%s/p:NombreHoresUnitatFormativa%s', '&lt;', '&gt;','49', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:UnitatFormativa%s', '&lt;', '&gt;');
//	UF	SAA000502
				printf('%sp:UnitatFormativa%s', '&lt;', '&gt;');
				printf('%sp:CodiUnitatFormativa%s%s%s/p:CodiUnitatFormativa%s', '&lt;', '&gt;','SAA000502', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:UnitatFormativaPropia%s%s%s/p:UnitatFormativaPropia%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresUnitatFormativa%s%s%s/p:NombreHoresUnitatFormativa%s', '&lt;', '&gt;','69', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:UnitatFormativa%s', '&lt;', '&gt;');
//	UF	SAA000503
				printf('%sp:UnitatFormativa%s', '&lt;', '&gt;');
				printf('%sp:CodiUnitatFormativa%s%s%s/p:CodiUnitatFormativa%s', '&lt;', '&gt;','SAA000503', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:UnitatFormativaPropia%s%s%s/p:UnitatFormativaPropia%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresUnitatFormativa%s%s%s/p:NombreHoresUnitatFormativa%s', '&lt;', '&gt;','20', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:UnitatFormativa%s', '&lt;', '&gt;');	
//	UF	SAA000504
				printf('%sp:UnitatFormativa%s', '&lt;', '&gt;');
				printf('%sp:CodiUnitatFormativa%s%s%s/p:CodiUnitatFormativa%s', '&lt;', '&gt;','SAA000504', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:UnitatFormativaPropia%s%s%s/p:UnitatFormativaPropia%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresUnitatFormativa%s%s%s/p:NombreHoresUnitatFormativa%s', '&lt;', '&gt;','30', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:UnitatFormativa%s', '&lt;', '&gt;');
//
				printf('</td></tr><tr><td>');
				printf('%s/p:UnitatsFormatives%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Modul%s', '&lt;', '&gt;');				
//	Modul	SAA0007
				printf('</td></tr><tr><td>');
				printf('%sp:Modul%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CodiModul%s%s%s/p:CodiModul%s', '&lt;', '&gt;','SAA0007', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:ModulPropi%s%s%s/p:ModulPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresModul%s%s%s/p:NombreHoresModul%s', '&lt;', '&gt;','165', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:UnitatsFormatives%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
//	UF	SAA000701
				printf('%sp:UnitatFormativa%s', '&lt;', '&gt;');
				printf('%sp:CodiUnitatFormativa%s%s%s/p:CodiUnitatFormativa%s', '&lt;', '&gt;','SAA000701', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:UnitatFormativaPropia%s%s%s/p:UnitatFormativaPropia%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresUnitatFormativa%s%s%s/p:NombreHoresUnitatFormativa%s', '&lt;', '&gt;','40', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:UnitatFormativa%s', '&lt;', '&gt;');
//	UF	SAA000702
				printf('%sp:UnitatFormativa%s', '&lt;', '&gt;');
				printf('%sp:CodiUnitatFormativa%s%s%s/p:CodiUnitatFormativa%s', '&lt;', '&gt;','SAA000702', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:UnitatFormativaPropia%s%s%s/p:UnitatFormativaPropia%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresUnitatFormativa%s%s%s/p:NombreHoresUnitatFormativa%s', '&lt;', '&gt;','65', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:UnitatFormativa%s', '&lt;', '&gt;');
//	UF	SAA000703
				printf('%sp:UnitatFormativa%s', '&lt;', '&gt;');
				printf('%sp:CodiUnitatFormativa%s%s%s/p:CodiUnitatFormativa%s', '&lt;', '&gt;','SAA000703', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:UnitatFormativaPropia%s%s%s/p:UnitatFormativaPropia%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresUnitatFormativa%s%s%s/p:NombreHoresUnitatFormativa%s', '&lt;', '&gt;','60', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:UnitatFormativa%s', '&lt;', '&gt;');
//
				printf('</td></tr><tr><td>');
				printf('%s/p:UnitatsFormatives%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Modul%s', '&lt;', '&gt;');				
//	Modul	SAA0008
				printf('</td></tr><tr><td>');
				printf('%sp:Modul%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CodiModul%s%s%s/p:CodiModul%s', '&lt;', '&gt;','SAA0008', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:ModulPropi%s%s%s/p:ModulPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresModul%s%s%s/p:NombreHoresModul%s', '&lt;', '&gt;','165', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:UnitatsFormatives%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
//	UF	SAA000801
				printf('%sp:UnitatFormativa%s', '&lt;', '&gt;');
				printf('%sp:CodiUnitatFormativa%s%s%s/p:CodiUnitatFormativa%s', '&lt;', '&gt;','SAA000801', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:UnitatFormativaPropia%s%s%s/p:UnitatFormativaPropia%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresUnitatFormativa%s%s%s/p:NombreHoresUnitatFormativa%s', '&lt;', '&gt;','30', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:UnitatFormativa%s', '&lt;', '&gt;');
//	UF	SAA000802
				printf('%sp:UnitatFormativa%s', '&lt;', '&gt;');
				printf('%sp:CodiUnitatFormativa%s%s%s/p:CodiUnitatFormativa%s', '&lt;', '&gt;','SAA000802', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:UnitatFormativaPropia%s%s%s/p:UnitatFormativaPropia%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresUnitatFormativa%s%s%s/p:NombreHoresUnitatFormativa%s', '&lt;', '&gt;','40', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:UnitatFormativa%s', '&lt;', '&gt;');
//	UF	SAA000803
				printf('%sp:UnitatFormativa%s', '&lt;', '&gt;');
				printf('%sp:CodiUnitatFormativa%s%s%s/p:CodiUnitatFormativa%s', '&lt;', '&gt;','SAA000803', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:UnitatFormativaPropia%s%s%s/p:UnitatFormativaPropia%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresUnitatFormativa%s%s%s/p:NombreHoresUnitatFormativa%s', '&lt;', '&gt;','43', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:UnitatFormativa%s', '&lt;', '&gt;');
//	UF	SAA000804
				printf('%sp:UnitatFormativa%s', '&lt;', '&gt;');
				printf('%sp:CodiUnitatFormativa%s%s%s/p:CodiUnitatFormativa%s', '&lt;', '&gt;','SAA000804', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:UnitatFormativaPropia%s%s%s/p:UnitatFormativaPropia%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresUnitatFormativa%s%s%s/p:NombreHoresUnitatFormativa%s', '&lt;', '&gt;','52', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:UnitatFormativa%s', '&lt;', '&gt;');
//
				printf('</td></tr><tr><td>');
				printf('%s/p:UnitatsFormatives%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Modul%s', '&lt;', '&gt;');				
//	Modul	SAA0011
				printf('</td></tr><tr><td>');
				printf('%sp:Modul%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CodiModul%s%s%s/p:CodiModul%s', '&lt;', '&gt;','SAA0011', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:ModulPropi%s%s%s/p:ModulPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresModul%s%s%s/p:NombreHoresModul%s', '&lt;', '&gt;','66', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:UnitatsFormatives%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
//	UF	SAA001101
				printf('%sp:UnitatFormativa%s', '&lt;', '&gt;');
				printf('%sp:CodiUnitatFormativa%s%s%s/p:CodiUnitatFormativa%s', '&lt;', '&gt;','SAA001101', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:UnitatFormativaPropia%s%s%s/p:UnitatFormativaPropia%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresUnitatFormativa%s%s%s/p:NombreHoresUnitatFormativa%s', '&lt;', '&gt;','66', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:UnitatFormativa%s', '&lt;', '&gt;');
//
				printf('</td></tr><tr><td>');
				printf('%s/p:UnitatsFormatives%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Modul%s', '&lt;', '&gt;');			
//	Modul	SAA0012
				printf('</td></tr><tr><td>');
				printf('%sp:Modul%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:CodiModul%s%s%s/p:CodiModul%s', '&lt;', '&gt;','SAA0012', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:ModulPropi%s%s%s/p:ModulPropi%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresModul%s%s%s/p:NombreHoresModul%s', '&lt;', '&gt;','416', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:UnitatsFormatives%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
//	UF	SAA001201
				printf('%sp:UnitatFormativa%s', '&lt;', '&gt;');
				printf('%sp:CodiUnitatFormativa%s%s%s/p:CodiUnitatFormativa%s', '&lt;', '&gt;','SAA001201', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:UnitatFormativaPropia%s%s%s/p:UnitatFormativaPropia%s', '&lt;', '&gt;','N', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:NombreHoresUnitatFormativa%s%s%s/p:NombreHoresUnitatFormativa%s', '&lt;', '&gt;','416', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%sp:IdiomaEstrangerVehicular xsi:nil="true"/%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:UnitatFormativa%s', '&lt;', '&gt;');
//
				printf('</td></tr><tr><td>');
				printf('%s/p:UnitatsFormatives%s', '&lt;', '&gt;');
				printf('</td></tr><tr><td>');
				printf('%s/p:Modul%s', '&lt;', '&gt;');
			}
				
			printf('</td></tr><tr><td>');
			printf('%s/p:Moduls%s', '&lt;', '&gt;');
			
//	#########		FI Curriculum
			printf('</td></tr><tr><td>');
			printf('%s/p:Matricula%s', '&lt;', '&gt;');
			printf('</td></tr><tr><td>');
			printf('%s/p:Matricules%s', '&lt;', '&gt;');
//				
			printf('</td></tr><tr><td>');
			printf('%sp:Avaluacions xsi:nil="true"/%s', '&lt;', '&gt;');
//				
			printf('</td></tr><tr><td>');
			printf('%s/p:Alumne%s', '&lt;', '&gt;');
		}
		printf('</td></tr><tr><td>');
		printf('%s/p:Alumnes%s', '&lt;', '&gt;');
		printf('</td></tr><tr><td>');
		printf('%s/p:Centre%s', '&lt;', '&gt;');
		printf('</table>');
		$_POST['cercar']="";
	}
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
		$query=substr_replace( $query," ORDER BY cognomsinom ",strlen( $query ), 0 );
//	fem el query i guardem tots els resultats a $data_view
		$data_view = $wpdb->get_results( $query, ARRAY_A);	
//	llistat del alumnes del filtre
		printf('<form method="post" action="" target="_self" name="creadlu" id="especformtot">', NULL);
		ricca3_graella( $ricca3_sii_fitxers, $data_view );
		printf('</table>', NULL);
		ricca3_desar('accio', 'actualitzartot', __('ajuda-tab-credits-tots-desar', 'ricca3-sii'));
		printf('</td><td><INPUT type="hidden" name="any" value="%s" /></td><td><INPUT type="hidden" name="grup" value="%s" /></td><td><INPUT type="hidden" name="cercar" value="%s" /></td></tr></table></form>', $_POST['any'], $_POST['grup'], $_POST['cercar']);
//		printf('<form method="post" action="%s/ricca3-sii-xml" name="cercar"><table dir="ltr" class="cercar"><tr>', site_url());
//		printf('<td><button type="submit" name="cercar" value="actualitzar" title="%s"><img src=%s/ricca3/imatges/ricca3-sii-XML.png  border="0" /></button></td>', __('ajuda-llistar-alumnes', 'ricca3-sii'), WP_PLUGIN_URL);
		
	}
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
 * @since ricca3.v.2014.3.4
 * @author Efraim Bayarri
 */
#############################################################################################
function ricca3_shortcode_sii_xml($atts, $content = null) {
	dump_r($_POST);
}