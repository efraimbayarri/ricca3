<?php
## Release build 2013.27.5
######################################################
##
## GRAELLES
##
######################################################
$ricca3_alumespec=array(
	"tipus"   =>array("ordre", "bd",       "token",                   "bd",          "bd",      "bd",          "bd",    "bd",   "bd",       "miniatura"),
	"nombd"   =>array("",      "idalumne", "",                        "cognomsinom", "telefon", "telefonfixe", "email", "estat","repeteix", ""),
	"visual"  =>array("",      "ID",       "",                        "Nom",         "Telefon", "Telefon",     "email", "",     "R",        ""),
	"enllac"  =>array("",      "",         "ricca3-dadesalumne/?ID=", "",            "",        "",            "",      "",     "",         "ricca3-dadesalumne/?ID="),
	"camp"    =>array("",      "",         "idalumne",                "",            "",        "",            "",      "",     "",         "idalumne"),
	"texte"   =>array("",      "",         "veure",                   "",            "",        "",            "",      "",     "",         ""),
	"ajuda"   =>array("",      "",         "",                        "",            "",        "",            "",      "",     "",         "")
); 

#############################################################################################
/**   */
#############################################################################################
$ricca3_mailings=array(
		"tipus"     =>array("ordre", "checkall", "bd",          "bd",    "bd",   "miniatura"),
		"nombd"		=>array("",      "idalumne", "cognomsinom", "email", "grup", ""),
		"visual"	=>array("",      "",         "Nom",         "email", "Grup", ""),
		"camp"	    =>array("",      "",         "",            "",      "",     "idalumne"),
		"enllac"    =>array("",      "",         "",            "",      "",     "ricca3-dadesalumne/?ID="),
		"ajuda"     =>array("",      "",         "",            "",      "",     "")
);

#############################################################################################
/**   */
#############################################################################################
$ricca3_cercalumne=array(
	"tipus"   =>array("ordre","bd",       "token",                   "bd",          "bd",      "bd",          "bd",    "miniatura"),
	"nombd"   =>array("",     "idalumne", "",                        "cognomsinom", "telefon", "telefonfixe", "email", ""),
	"visual"  =>array("",     "ID",       "",                        "Nom",         "Telefon", "Telefon",     "email", ""),
	"enllac"  =>array("",     "",         "ricca3-dadesalumne/?ID=", "",            "",        "",            "",      "ricca3-dadesalumne/?ID="),
	"camp"    =>array("",     "",         "idalumne",                "",            "",        "",            "",      "idalumne"),
	"texte"   =>array("",     "",         "veure",                   "",            "",        "",            "",      ""),
	"ajuda"   =>array("",     "",         "",                        "",            "",        "",            "",      "")
);

#############################################################################################
/**   */
#############################################################################################
$ricca3_alumcol=array(
	"tipus"     =>array("bd",    "bd",        "bd",        "bd",                "bd",                           "bd",                "bd",                   "bd",                  "bd",                  "bd",             "bd",    "bd",                 "bd",             "bd",                "bd",         "bd",      "bd",           "bd",              "bd",                "bd",             "bd",               "bd"),
	"nombd"     =>array("nom",   "cognom1",   "cognom2",   "dni",               "SII_TipusDocumentIdentitat",   "datanai",           "SII_Sexe",             "llocnai",             "provnai",             "paisnai",        "email", "residenciahabitual", "ciutathabitual", "provinciahabitual", "codipostal", "telefon", "telefonfixe",  "datainscripcio",  "estudisrealitzats", "centreea",       "poblacioea",       "abonament"),
	"visual"    =>array("Nom",   "1er Cognom","2on Cognom","DNI/NIE/passaport", "Tipus-> DNI:A NIE:B Passa.:C", "Data de naixement", "Sexe-> Home:H Dona:D", "Localitat naixement", "Província naixement", "País naixement", "email", "Domicili",           "Ciutat",         "Província",         "C.P.",       "Telefon", "Telefon fixe", "Inscripció",      "Estudis",           "Centre estudis", "Població estudis", "Abonament"),
	"nomform"   =>array("Nom",   "Cog1",      "Cog2",      "DNI",               "TipusDNI",                     "FN",                "Sexe",                 "LocN",                "ProvN",               "PaisN",          "Email", "Resi",               "Ciutat",         "Prov",              "CP",         "Telf",    "Telf2",        "Insc",            "EstudA",            "CentEA",         "PobEA",            "Abono"),
	"nomes-az"  =>array(false,   false,       false,       false,               true,                           false,               true,                   true,                  true,                  true,             false,   false,                true,             true,                false,        false,     false,          false,             false,               false,            true,               false),
	"obliga"    =>array(true,    true,        false,	   true,                false,                          true,                true,                   false,                 false,                 false,            false,   false,                false,            false,               false,        false,     false,          false,             false,               false,            false,              false),
	"data"      =>array(false,   false,       false,       false,               false,                          true,                false,                  false,                 false,                 false,            false,   false,                false,            false,               false,        false,     false,          true,              false,               false,            false,              false),
	"nomeslect" =>array(false,   false,       false,       false,               true,                           false,               false,                  false,                 false,                 false,            false,   false,                false,            false,               false,        false,     false,          true,              false,               false,            false,              true)
);

#############################################################################################
/**   */
#############################################################################################
$ricca3_especalum=array(
	"tipus"   =>array("any",   "bd",              "bd",   "bd",    "notaf",           "bd",      "hist"),
	"nombd"	  =>array("idany", "nomespecialitat", "grup", "estat", "notaf_es",        "repeteix",""),
	"visual"  =>array("Any",   "Especialitat",    "Grup", "Estat", "Nota",            "R",       ""),
	"notam"   =>array("",      "",                "",     "",      "notaf_es_manual", "",        ""),
	"ajuda"   =>array("",      "",                "",     "",      "",                "",        "")
);

#############################################################################################
/**   */
#############################################################################################
$ricca3_baixaespec=array(
		"tipus"     =>array("checkall",    "bd",          "bd",          "bd",  "bd",              "bd",   "bd"),
		"nombd"     =>array("idalumespec", "motiubaixa",  "cognomsinom", "any", "nomespecialitat", "grup", "estat"),
		"visual"    =>array("",            "Motiu Baixa", "Nom",         "Any", "Especialitat",    "Grup", "Estat"),
		"nomeslect" =>array(true,          true,          true,          true,  true,              true,   true),
		"tamany"    =>array(0,             30,            0,             0,     0,                 0,      0),
		"ajuda"     =>array("",            "",            "",            "",    "",                "",     "")
);

#############################################################################################
/**   */
#############################################################################################
$ricca3_notafmanual=array(
		"tipus"     =>array("radio",       "bd",          "bd",  "bd",              "bd",   "bd",             "bd"),
		"nombd"     =>array("idalumespec", "cognomsinom", "any", "nomespecialitat", "grup", "notaf_es",       "notaf_es_manual"),
		"visual"    =>array("",            "Nom",         "Any", "Especialitat",    "Grup", "Nota Calculada", "Nota Manual"),
		"radio"     =>array("",            "",            "",    "",                "",     "",               ""),
		"ajuda"     =>array("",            "",            "",    "",                "",     "",               "")
);

#############################################################################################
/**   */
#############################################################################################
$ricca3_alumcreacred=array(
		"tipus"   =>array("checkall",    "bd",          "bd",  "bd",              "bd",   "bd"),
		"nombd"	  =>array("idalumespec", "cognomsinom", "any", "nomespecialitat", "grup", "estat"),
		"visual"  =>array("",            "",            "any", "especialitat",    "Grup", "Estat"),
		"ajuda"   =>array("",            "",            "",    "",                "",     "")
);

#############################################################################################
/**   */
#############################################################################################
$ricca3_credalu=array(
		"tipus"     =>array( "hidden",     "bd",   "bd",     "bd",        "bd",    "bd",   "bd",    "bd",   "bd",    "bd",   "bd",    "bd",       "bd",       "bd",    "bd",   "bd",          "bd",       "bd"),
		"nombd"     =>array( "idcredaval", "any",  "grup",   "nomcredit", "nota1", "act1", "nota2", "act2", "nota3", "actf", "recup", "notaf_cc", "notaf_cr", "pendi", "repe", "nomicognoms", "hores_cc", "hores_cr"),// update
		"nomupdate" =>array( "",           "any",  "grup",   "nomcredit", "nota1", "act1", "nota2", "act2", "nota3", "actf", "recup", "notaf_cc", "notaf_cr", "pendi", "repe", "nomicognoms", "hores_cc", "hores_cr"), //view
		"visual"    =>array( "",           "Any",  "Grup",   "Crèdit",    "N1",    "A1",   "N2",    "A2",   "N3",    "A3",   "RE",    "NFCC",     "NFCR",     "P",     "R" ,   "",            "HCC",      "HCR"),
		"nomeslect" =>array( true,         true,   true,     true,        false,   false,  false,   false,  false,   false,  false,   false,      false,      false,   false,  true,          true,       true),
		"tamany"    =>array( 0,            0,      0,        0,           2,       1,      2,       1,      2,       2,      1,       2,          2,          2,       2,      0,             0,          0),
		"pattern"   =>array("",            "",     "",       "",          "",      "",     "",      "",     "",      "",     "",      "",         "",         "",      "",     "",            "",         ""),
		"ajuda"     =>array("",            "",     "",       "",          "",      "",     "",      "",     "",      "",     "",      "",         "",         "",      "",     "",            "",         "")
);

#############################################################################################
/**   */
#############################################################################################
$ricca3_especrepe=array(
		"tipus"   =>array("checkall",    "bd",  "bd",              "bd",   "bd",    "bd"),
		"nombd"	  =>array("idalumespec", "any", "nomespecialitat", "grup", "estat", "repeteix"),
		"visual"  =>array("",            "Any", "Especialitat",    "Grup", "Estat", "R"),
		"ajuda"   =>array("",            "",    "",                "",     "",      "")
);

#############################################################################################
/**   */
#############################################################################################
$ricca3_canviany=array(
		"tipus"   =>array("radio",       "bd",  "bd",              "bd",   "bd",    "bd"),
		"nombd"	  =>array("idalumespec", "any", "nomespecialitat", "grup", "estat", "repeteix"),
		"visual"  =>array("",            "Any", "Especialitat",    "Grup", "Estat", "Repetidor"),
		"radio"   =>array("",            "",   "",                  "",      "",    ""),
		"ajuda"   =>array("",            "",   "",                  "",      "",    "")
);

#############################################################################################
/**   */
#############################################################################################
$ricca3_alumpendi=array(
		"tipus"   => array( 'ordre', 'checkall',   'bd',       'token',                 'bd',          'bd',  'bd',   'bd'),
		"nombd"	  => array( "",      "idcredaval", "idalumne", "",                      "cognomsinom", "any", "grup", "nomccomp"),
		"visual"  => array( "",      "",           "ID",       "",                      "Nom",         "Any", "grup", "Crèdit"),
		"enllac"  => array( "",      "",           "",         "ricca3-especalum/?ID=", "",            "",    "",     ""),
		"camp"    => array( "",      "",           "",         "idalumne",              "",            "",    "",     ""),
		"texte"   => array( "",      "",           "",         "veure",                 "",            "",    "",     ""),
		"ajuda"   => array( "",      "",           "",         "",                      "",            "",    "",     "")
);

#############################################################################################
/**   */
#############################################################################################
$ricca3_obseralum=array(
		"tipus"   =>array( "radio",    "bd",       "bd",          "bd",  "miniatura"),
		"nombd"   =>array( "idalumne", "idalumne", "cognomsinom", "dni", ""),
		"visual"  =>array( "",         "",         "nom",         "DNI", ""),
		"radio"   =>array( "",         "",         "",            "",    ""),
		"enllac"  =>array( "",         "",         "",            "",    ""),
		"camp"    =>array( "",         "",         "",            "",    "idalumne")
);

#############################################################################################
/**   */
#############################################################################################
$ricca3_listespec=array(
		"tipus"  => array('bd',             'bd',              'bd',  'bd',       'bd',               'bd',     'bd',       'bd',        'bd'),
		"nombd"	 => array('idespecialitat', 'nomespecialitat', 'pla', 'actiu_es', 'codiespecialitat', 'cursos', 'ordre_es', 'professio', 'duracio'),
		"visual" => array('id',             'Especialitat',    'Pla', 'Actiu', '  Codi',              'Cur.',   'Ord.',     'Professió', 'Hores')
);

#############################################################################################
/**   */
#############################################################################################
$ricca3_editespec=array(
		"tipus"     => array('bd',             'bd',              'bd',  'bd',       'bd',               'bd',     'bd',       'bd',        'bd'),
		"nombd"	    => array('idespecialitat', 'nomespecialitat', 'pla', 'actiu_es', 'codiespecialitat', 'cursos', 'ordre_es', 'professio', 'duracio'),
		"visual"    => array('id',             'Especialitat',    'Pla', 'Actiu', '  Codi',              'Cur.',   'Ord.',     'Professió', 'Hores'),
		"obliga"    => array(true,             true,              false, true,       false,              true,     true,       true,        true),
		"nomeslect" => array(false,            false,             false, false,      false,              false,    false,      false,       false),
		"tamany"    => array(5,                30,                10,    5,          6,                  4,        4,          30,          5)
);

#############################################################################################
/**   */
#############################################################################################
$ricca3_listcredit=array(
		"tipus"  => array('bd',       'bd',        'bd',       'bd',         'bd',             'bd',     'bd',       'bd',       'bd'),
		"nombd"	 => array('idcredit', 'nomcredit', 'actiu_cr', 'aval3nomes', 'idespecialitat', 'idcurs', 'hores_cr', 'ordre_cr', 'credit'),
		"visual" => array('id',       'Nom',       'Act.',     '3ava.',      'Espec.',         'Curs',   'hores',    'ord.',     '..')
);

#############################################################################################
/**   */
#############################################################################################
$ricca3_editcredit=array(
		"tipus"     => array('bd',       'bd',        'bd',       'bd',         'bd',             'bd',     'bd',       'bd',       'bd'),
		"nombd"	    => array('idcredit', 'nomcredit', 'actiu_cr', 'aval3nomes', 'idespecialitat', 'idcurs', 'hores_cr', 'ordre_cr', 'credit'),
		"visual"    => array('id',       'Nom',       'Act.',     '3ava.',      'Espec.',         'Curs',   'hores',    'ord.',     '..'),
		"nomeslect" => array(false,      false,       false,      false,        false,            false,    false,      false,      false),
		"tamany"    => array(5,          45,          5,          5,            5,                10,        5,         5,          45)
);

#############################################################################################
/**   */
#############################################################################################
$ricca3_listgrups=array(
		"tipus"  => array('bd',     'bd',   'bd',       'bd',             'bd',       'bd',     'bd',   ),
		"nombd"	 => array('idgrup', 'grup', 'actiu_gr', 'idespecialitat', 'ordre_gr', 'idcurs', 'sessio'),
		"visual" => array('id',     'grup', 'actiu',    'Espec.',         'Ord.',     'curs',   'sessio')
);

#############################################################################################
/**   */
#############################################################################################
$ricca3_editgrups=array(
		"tipus"     => array('bd',     'bd',   'bd',       'bd',             'bd',       'bd',     'bd',   ),
		"nombd"	    => array('idgrup', 'grup', 'actiu_gr', 'idespecialitat', 'ordre_gr', 'idcurs', 'sessio'),
		"visual"    => array('id',     'grup', 'actiu',    'Espec.',         'Ord.',     'curs',   'sessio'),
		"nomeslect" => array(false,    false,  false,      false,            false,      false,    false),
		"tamany"    => array(5,        35,     5,          5,                5,          5,        10)
);

#############################################################################################
/**   */
#############################################################################################
$ricca3_listprof=array(
		"tipus"  => array('bd',     'bd',          'bd',           'bd',       'bd',       'bd',       'bd'   ),
		"nombd"	 => array('idprof', 'nomicognoms', 'telcasa',      'telcont1', 'telcont2', 'telcont3', 'email'),
		"visual" => array('id',     'nom',         'telèfon casa', '.',        '.',        '.',        'email')
);

#############################################################################################
/**   */
#############################################################################################
$ricca3_editprof=array(
		"tipus"     => array('bd',     'bd',          'bd',           'bd',       'bd',       'bd',       'bd'   ),
		"nombd"	    => array('idprof', 'nomicognoms', 'telcasa',      'telcont1', 'telcont2', 'telcont3', 'email'),
		"visual"    => array('id',     'nom',         'telèfon casa', '.',        '.',        '.',        'email'),
		"nomeslect" => array(false,    false,          false,         false,      false,      false,      false),
		"tamany"    => array(5,        45,             20,            20,         20,         20,         40)
);

#############################################################################################
/**   */
#############################################################################################
$ricca3_listccomp=array(
		"tipus"  => array( 'bd',      'bd',       'bd',     'bd',   'bd',       'bd',       'bd',          'bd',          'bd',      'bd',             'bd',       'bd',       'bd',       'bd',       'bd',       'bd' ),
		"nombd"	 => array( 'idccomp', 'idcredit', 'idgrup', 'grup', 'hores_cc', 'hores_cr', 'idprofessor', 'nomicognoms', 'idtutor', 'nomicognomstut', 'actiu_cc', 'actiu_cr', 'actiu_gr', 'actiu_es', 'nomccomp', 'nomcredit'),
		"visual" => array( 'id',      'idc',      'idg',    'grup', 'hcc',      'hcr',      'idp',         'prof',        'idt',     'tut',            'cc',       'cr',       'gr',       'es',       'nomccomp', 'nomcred')
);

#############################################################################################
/**   */
#############################################################################################
$ricca3_editccomp=array(
		"tipus"     => array( 'bd',      'bd',       'bd',     'bd',       'bd',       'bd',          'bd',      'bd',       'bd',       'bd' ),
		"nombd"	    => array( 'idccomp', 'idcredit', 'idgrup', 'hores_cc', 'hores_cr', 'idprofessor', 'idtutor', 'actiu_cc', 'nomccomp', 'nomcredit'),
		"visual"    => array( 'id',      'idc',      'idg',    'hcc',      'hcr',      'idp',         'idt',     'cc',       'nomccomp', 'nomcred'),
		"nomeslect" => array( false,     false,      false,    false,      true,      false,         false,     false,      false,      true),
		"tamany"    => array( 5,         5,          5,        5,          5,          5,             5,         5,          100,        100)
);

#############################################################################################
/**   */
#############################################################################################
$ricca3_listpla=array(
		"tipus"  => array('bd',      'bd',              'bd',       'bd',   'bd',       'bd',       'bd',          'bd'),
		"nombd"	 => array('idccomp', 'nomespecialitat', 'nomccomp', 'grup', 'hores_cc', 'hores_cr', 'nomicognoms', 'nomicognomstut'),
		"visual" => array('idccomp', 'especialitat',    'crèdit',   'grup', 'hcc',      'ht',       'professor',   'tutor')
);

#############################################################################################
/**   */
#############################################################################################
$ricca3_editcredespec=array(
		"tipus"     => array('bd',          'bd',             'bd',       'bd',        'bd',          'bd'),
		"nombd"	    => array('idcredespec', 'idespecialitat', 'idcredit', 'nomcredit', 'ordre_cr_es', 'numero'),
		"visual"    => array('id',          'idespecialitat', 'idcredit', 'crèdit',    'ordre',       '..'),
		"nomeslect" => array( false,        false,            false,      true,        false,         false),
		"tamany"    => array( 5,            5,                5,          5,           5,             15)
);

#############################################################################################
/**   */
#############################################################################################
$ricca3_listcredespec=array(
		"tipus"  => array('bd',          'bd',             'bd',       'bd',        'bd',          'bd'),
		"nombd"	 => array('idcredespec', 'idespecialitat', 'idcredit', 'nomcredit', 'ordre_cr_es', 'numero'),
		"visual" => array('id',          'idespecialitat', 'idcredit', 'crèdit',    'ordre',       '..')
);

#############################################################################################
/**   */
#############################################################################################
$ricca3_afegircredit=array(
		"tipus"   =>array( "radio",      "bd",      "bd",       "bd",   "bd", ),
		"nombd"   =>array( "idcredaval", "convord", "nomccomp", "grup", "nomicognoms" ),
		"visual"  =>array( "",           "",        "crèdit",   "grup", "professor" ),
		"radio"   =>array( "",           "",        "",         "",     "" ),
		"enllac"  =>array( "",           "",        "",         "",     "" ),
		"camp"    =>array( "",           "",        "",         "",     "" )
);

#############################################################################################
/**   */
#############################################################################################
$ricca3_afegircredit_sinradio=array(
		"tipus"   =>array( "bd",      "bd",       "bd",   "bd" ),
		"nombd"   =>array( "convord", "nomccomp", "grup", "nomicognoms" ),
		"visual"  =>array( "",        "crèdit",   "grup", "professor" ),
		"radio"   =>array( "",        "",         "",     "" ),
		"enllac"  =>array( "",        "",         "",     "" ),
		"camp"    =>array( "",        "",         "",     "" )
);

#############################################################################################
/**   */
#############################################################################################
$ricca3_afegircredit_ccomp=array(
		"tipus"   =>array( "radio",   "bd",       "bd",   "bd",          "bd",       "bd" ),
		"nombd"   =>array( "idccomp", "nomccomp", "grup", "nomicognoms", "hores_cc", "hores_cr" ),
		"visual"  =>array( "",        "crèdit",   "grup", "professor",   "hores CC", "hores crèdit"),
		"radio"   =>array( "",        "",         "",     "",            "",         "" ),
		"enllac"  =>array( "",        "",         "",     "",            "",         "" ),
		"camp"    =>array( "",        "",         "",     "",            "",         "" )
);

#############################################################################################
/**   */
#############################################################################################
$ricca3_sii_modif=array(
		"tipus"     =>array("ordre", "hidden",   "bd",       "bd",          "bd",  "bd",                         "bd",       "bd",      "bd",                        "bd",      "bd",                         "bd",      "bd",                    "bd",                   "bd",                 "bd",             "bd",               "bd",         "bd",           "bd"),
		"nombd"     =>array("",      "idalumne", "idalumne", "cognomsinom", "dni", "SII_TipusDocumentIdentitat", "SII_Sexe", "llocnai", "SII_CodiMunicipiNaixement", "provnai", "SII_CodiProvinciaNeixement", "paisnai", "SII_CodiPaisNeixement", "SII_CodiNacionalitat", "residenciahabitual", "ciutathabitual", "SII_CodiMunicipi", "codipostal", "SII_CodiPais", "SII_SituacioLaboral"),
		"nomupdate" =>array("",      "idalumne", "idalumne", "cognomsinom", "dni", "SII_TipusDocumentIdentitat", "SII_Sexe", "llocnai", "SII_CodiMunicipiNaixement", "provnai", "SII_CodiProvinciaNeixement", "paisnai", "SII_CodiPaisNeixement", "SII_CodiNacionalitat", "residenciahabitual", "ciutathabitual", "SII_CodiMunicipi", "codipostal", "SII_CodiPais", "SII_SituacioLaboral"),
		"visual"    =>array("",      "",         "ID",       "Nom",         "DNI", "Tipus",                      "Sexe",     "MunNaix", "CMunNaix",                  "ProvNai", "CProvNai",                   "PaisNai", "CPaisNai",              "CNacio",               "Adreça",             "Municipi",       "CMun",             "CP",         "País",          "Treball"),
		"enllac"    =>array("",      "",         "",         "",            "",    "",                           "",         "",        "",                          "",        "",                           "",        "",                      "",                     "",                   "",               "",                 "",           "",              ""),
		"camp"      =>array("",      "",         "",         "",            "",    "",                           "",         "",        "",                          "",        "",                           "",        "",                      "",                     "",                   "",               "",                 "",           "",              ""),
		"texte"     =>array("",      "",         "",         "",            "",    "",                           "",         "",        "",                          "",        "",                           "",        "",                      "",                     "",                   "",               "",                 "",           "",              ""),
		"nomeslect" =>array(true,    true,       true,       true,          false, false,                        false,      false,     false,                       false,     false,                        false,     false,                   false,                  true,                 false,            false,              false,        false,           false),
		"tamany"    =>array(5,       5,          5,          5,             9,     3,                            3,          30,        5,                           9,         2,                            5,         3,                       3,                      5,                    9,                5,                  5,            3,               1),
		"ajuda"     =>array("",      "",         "",         "",            "",    "",                           "",         "",        "",                          "",        "",                           "",        "",                      "",                     "",                   "",               "",                 "",           "",              "")
);

#############################################################################################
/**   */
#############################################################################################
$ricca3_sii_fitxers=array(
		"tipus"     =>array("checkall", "ordre", "bd",          "bd",   "bd",     "bd",  "bd",                         "bd",       "bd",                        "bd",                         "bd",                    "bd",                   "bd",               "bd",         "bd",           "bd"),
		"nombd"     =>array("idalumespec", "",   "cognomsinom", "grup", "idgrup", "dni", "SII_TipusDocumentIdentitat", "SII_Sexe", "SII_CodiMunicipiNaixement", "SII_CodiProvinciaNeixement", "SII_CodiPaisNeixement", "SII_CodiNacionalitat", "SII_CodiMunicipi", "codipostal", "SII_CodiPais", "SII_SituacioLaboral"),
		"nomupdate" =>array("",         "",      "cognomsinom", "grup", "idgrup", "dni", "SII_TipusDocumentIdentitat", "SII_Sexe", "SII_CodiMunicipiNaixement", "SII_CodiProvinciaNeixement", "SII_CodiPaisNeixement", "SII_CodiNacionalitat", "SII_CodiMunicipi", "codipostal", "SII_CodiPais", "SII_SituacioLaboral"),
		"visual"    =>array("",         "",      "Nom",         "grup", "idgrup", "DNI", "Tipus",                      "Sexe",     "CMunNaix",                  "CProvNai",                   "CPaisNai",              "CNacio",               "CMun",             "CP",         "País",          "Treball"),
		"unic"      =>array(false,      false,   true,          false,  false,    false,                               false,      false,                       false,                        false,                   false,                  false,              false,        false,           false),
		"enllac"    =>array("",         "",      "",            "",     "",       "",    "",                           "",         "",                          "",                           "",                      "",                     "",                 "",           "",              ""),
		"camp"      =>array("",         "",      "",            "",     "",       "",    "",                           "",         "",                          "",                           "",                      "",                     "",                 "",           "",              ""),
		"texte"     =>array("",         "",      "",            "",     "",       "",    "",                           "",         "",                          "",                           "",                      "",                     "",                 "",           "",              ""),
		"nomeslect" =>array(false,      true,    true,          true,   true,     true,  true,                         true,       true,                        true,                         true,                    true,                   true,               true,         true,            true),
		"tamany"    =>array(0,          5,       5,             5,      2,        5,     3,                            3,          5,                           2,                            3,                       3,                      5,                  5,            3,               1),
		"ajuda"     =>array("",         "",      "",            "",     "",       "",    "",                           "",         "",                          "",                           "",                      "",                     "",                 "",           "",              "")
);

######################################################
######################################################
##
##	BUTONS
##
######################################################
######################################################
$ricca3_butons_alumnes=array(
	"imatge" =>array("cercar",            "noualumne",        "llistatassistencia", "mailings",        "creditspendents",     "inscripcions"),
	"enllac" =>array("ricca3-cercalumne", "ricca3-noualumne", "ricca3-assist",      "ricca3-mailings", "ricca3-credpendents", "ricca3-pregrup"),
	"id"     =>array(false,               false,              false,                false,             false,                 false),
	"texte"  =>array("",                  "" ,                "",                   "",                "",                    "")
);

#############################################################################################
/**   */
#############################################################################################
$ricca3_butons_cercalumne=array(
	"imatge" =>array("alumnes",        "buid",           "buid",           "buid",           "buid",           "buid"),
	"enllac" =>array("ricca3-alumnes", "ricca3-alumnes", "ricca3-alumnes", "ricca3-alumnes", "ricca3-alumnes", "ricca3-alumnes"),
	"id"     =>array(false,            false,            false,            false,            false,             false),
	"texte"  =>array("",               "" ,              "",               "",               "",                "")
);

#############################################################################################
/**   */
#############################################################################################
$ricca3_butons_credpendents=array(
"imatge" =>array("alumnes",        "pendactual",        "buid",           "buid",           "buid",           "buid"),
"enllac" =>array("ricca3-alumnes", "ricca3-pendactual", "ricca3-alumnes", "ricca3-alumnes", "ricca3-alumnes", "ricca3-alumnes"),
"id"     =>array(false,            false,               false,            false,            false,             false),
"texte"  =>array("",               "" ,                 "",               "",               "",                "")
);

#############################################################################################
/**   */
#############################################################################################
$ricca3_butons_noualumne=array(
	"imatge" =>array("especalum",        "buid",           "buid",           "buid",           "buid",           "buid"),
	"enllac" =>array("ricca3-especalum", "ricca3-alumnes", "ricca3-alumnes", "ricca3-alumnes", "ricca3-alumnes", "ricca3-alumnes"),
	"id"     =>array(true,               false,            false,            false,            false,            false),
	"texte"  =>array("",                 "" ,              "",               "",               "",                "")
);

#############################################################################################
/**   */
#############################################################################################
$ricca3_butons_dadesalumne=array(
	"imatge" =>array("especalum",        "editardades",        "esborraalumne",        "alumnes",        "buid",                              "buid"),
	"enllac" =>array("ricca3-especalum", "ricca3-editardades", "ricca3-esborraalumne", "ricca3-alumnes", "ricca3-alumnes-sense-especialitat", "ricca3-alumnes"),
	"id"     =>array(true,               true,                 true,                   false,            true,                                false),
	"texte"  =>array("",                 "" ,                  "",                     "",               "",                                  "")
);

#############################################################################################
/**   */
#############################################################################################
$ricca3_butons_editardades=array(
	"imatge" =>array("especalum",        "dadesalumne",        "alumnes",        "buid",           "buid",           "buid"),
	"enllac" =>array("ricca3-especalum", "ricca3-dadesalumne", "ricca3-alumnes", "ricca3-alumnes", "ricca3-alumnes", "ricca3-alumnes"),
	"id"     =>array(true,               true,                 false,            false,            false,            false),
	"texte"  =>array("",                 "" ,                  "",               "",               "",               "")
);

#############################################################################################
/**   */
#############################################################################################
$ricca3_butons_especalum=array(
	"imatge" =>array("afegirespecialitat", "baixaespecialitat", "creditsalumne",  "aplicarpla",          "dadesalumne",        "alumnes",        "butlleti",        "caratula",        "especrepe",        "canviany",        "afegircredit",        "notafinal"),
	"enllac" =>array("ricca3-novaespec",   "ricca3-baixaespec", "ricca3-credalu", "ricca3-alumcreacred", "ricca3-dadesalumne", "ricca3-alumnes", "ricca3-butlleti", "ricca3-caratula", "ricca3-especrepe", "ricca3-canviany", "ricca3-afegircredit", "ricca3-notafinal"),
	"id"     =>array(true,                 true,                true,             true,                  true,                 false,            true,              true,              true,               true,              true,                  true),
	"nova"   =>array(false,                false,               false,            false,                 false,                false,            false,             false,             false,              false,             false,                 false),
	"texte"  =>array("",                   "" ,                 "",               "",                    "",                   "",               "",                "" ,               "",                 "",                "",                    "")
);

#############################################################################################
/**   */
#############################################################################################
$ricca3_butons_avaluacions=array(
	"imatge" =>array("actes",        "notes",        "observacions", "calcularnotaf",      "veurecalculs",       "buid",               "certifaval",    "certifcurs1",        "certiffinal",        "buid",               "buid",               "buid"),
	"enllac" =>array("ricca3-actes", "ricca3-notes", "ricca3-obser", "ricca3-avaluacions", "ricca3-avaluacions", "ricca3-avaluacions", "ricca3-certif", "ricca3-certifcurs1", "ricca3-certiffinal", "ricca3-avaluacions", "ricca3-avaluacions", "ricca3-avaluacions"),
	"id"     =>array(false,          false,          false,          false,                false,                false,                false,           false,                false,                false,                false,                false),
	"nova"   =>array(false,          false,          false,          false,                false,                false,                false,           false,                false,                false,                false,                false),
	"texte"  =>array("",             "" ,            "",             "",                   "",                   "",                   "",              "" ,                  "",                   "",                   "",                   "")
);

#############################################################################################
/**   */
#############################################################################################
$ricca3_butons_actes=array(
	"imatge" =>array("avaluacions",        "buid",               "buid",               "buid",               "buid",               "buid"),
	"enllac" =>array("ricca3-avaluacions", "ricca3-avaluacions", "ricca3-avaluacions", "ricca3-avaluacions", "ricca3-avaluacions", "ricca3-avaluacions"),
	"id"     =>array(false,                false,                false,                false,                false,                false),
	"texte"  =>array("",                   "" ,                  "",                   "",                   "",                   "")
);

#############################################################################################
/**   */
#############################################################################################
$ricca3_butons_dades=array(
	"imatge" =>array("especialitats", "credits",     "grups",        "professors",   "ccomp",        "creditsespec",     "pla",        "guardarpla",        "plallista",         "sensepla",        "buid",         "buid"),
	"enllac" =>array("ricca3-espec",  "ricca3-cred", "ricca3-grups", "ricca3-prof",  "ricca3-ccomp", "ricca3-credespec", "ricca3-pla", "ricca3-guardarpla", "ricca3-llistarpla", "ricca3-sensepla", "ricca3-dades", "ricca3-notafinalalumne"),
	"id"     =>array(false,           false,         false,          false,          false,          false,              false,        false,               false,               false,             false,          false),
	"nova"   =>array(false,           false,         false,          false,          false,          false,              false,        false,               false,               false,             false,          false),
	"texte"  =>array("",              "" ,           "",             "",             "",             "",                 "",           "" ,                 "",                  "",                "",             "")
);

#############################################################################################
/**   */
#############################################################################################
$ricca3_butons_espec=array(
	"imatge" =>array("dades",        "buid",         "buid",         "buid",         "buid",         "buid"),
	"enllac" =>array("ricca3-dades", "ricca3-dades", "ricca3-dades", "ricca3-dades", "ricca3-dades", "ricca3-dades"),
	"id"     =>array(false,          false,          false,          false,          false,          false),
	"texte"  =>array("",             "" ,            "",             "",             "",             "")
);

#############################################################################################
/**   */
#############################################################################################
$ricca3_butons_sii=array(
	"imatge" =>array("sii-options",        "sii-fitxers",        "sii-modif",        "buid",       "buid",       "buid"),
	"enllac" =>array("ricca3-sii-opcions", "ricca3-sii-fitxers", "ricca3-sii-modif", "ricca3-sii", "ricca3-sii", "ricca3-sii"),
	"id"     =>array(false,                false,                false,              false,        false,        false),
	"nova"   =>array(false,                false,                false,              false,        false,        false),
	"texte"  =>array("",                   "" ,                  "",                 "",           "",           "")
);
