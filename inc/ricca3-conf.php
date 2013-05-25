<?php
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
		"enllac"    =>array("",      "",         "",            "",      "",     ""),
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
	"tipus"     =>array("bd",    "bd",        "bd",        "bd",                "bd",               "bd",                  "bd",                  "bd",             "bd",    "bd",                 "bd",             "bd",                "bd",         "bd",      "bd",           "bd",              "bd",                "bd",             "bd",               "bd"),
	"nombd"     =>array("nom",   "cognom1",   "cognom2",   "dni",               "datanai",          "llocnai",             "provnai",             "paisnai",        "email", "residenciahabitual", "ciutathabitual", "provinciahabitual", "codipostal", "telefon", "telefonfixe",  "datainscripcio",  "estudisanteriors",  "centreea",       "poblacioea",       "abonament"),
	"visual"    =>array("Nom",   "1er Cognom","2on Cognom","DNI/NIE/passaport", "Data de naixement","Localitat naixement", "Província naixement", "País naixement", "email", "Domicili",           "Ciutat",         "Província",         "C.P.",       "Telefon", "Telefon fixe", "Inscripció",      "Estudis",           "Centre estudis", "Població estudis", "Abonament"),
	"nomform"   =>array("Nom",   "Cog1",      "Cog2",      "DNI",               "FN",               "LocN",                "ProvN",               "PaisN",          "Email", "Resi",               "Ciutat",         "Prov",              "CP",         "Telf",    "Telf2",        "Insc",            "EstudA",            "CentEA",         "PobEA",            "Abono"),
	"nomes-az"  =>array(true,    true,        true,        false,               false,              true,                  true,                  true,             false,   false,                true,             true,                false,        false,     false,          false,             false,               false,            true,               false),
	"obliga"    =>array(true,    true,        false,	   true,                true,               false,                 false,                 false,            false,   false,                false,            false,               false,        false,     false,          false,             false,               false,            false,              false),
	"data"      =>array(false,   false,       false,       false,               true,               false,                 false,                 false,            false,   false,                false,            false,               false,        false,     false,          true,              false,               false,            false,              false),
	"nomeslect" =>array(false,   false,       false,       false,               false,              false,                 false,                 false,            false,   false,                false,            false,               false,        false,     false,          true,              false,               false,            false,              true)
);

#############################################################################################
/**   */
#############################################################################################
$ricca3_especalum=array(
	"tipus"   =>array("any",   "bd",              "bd",   "bd",    "notaf",    "bd",      "hist"),
	"nombd"	  =>array("idany", "nomespecialitat", "grup", "estat", "notaf_es", "repeteix",""),
	"visual"  =>array("Any",   "Especialitat",    "Grup", "Estat", "Nota",     "R",       ""),
	"ajuda"   =>array("",      "",                "",     "",      "",         "",        "")
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
		"tipus"   => array( 'ordre', 'checkall',   'bd',          'bd',  'bd'),
		"nombd"	  => array( "",      "idcredaval", "cognomsinom", "any", "nomccomp"),
		"visual"  => array( "",      "",           "Nom",         "Any", "Crèdit"),
		"ajuda"   => array( "",      "",           "",            "",    "")
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
$ricca3_butons_noualumne=array(
	"imatge" =>array("especalum",            "buid",           "buid",           "buid",           "buid",           "buid"),
	"enllac" =>array("ricca3-especalumnova", "ricca3-alumnes", "ricca3-alumnes", "ricca3-alumnes", "ricca3-alumnes", "ricca3-alumnes"),
	"id"     =>array(true,                   false,            false,            false,            false,            false),
	"texte"  =>array("",                     "" ,              "",               "",               "",                "")
);

#############################################################################################
/**   */
#############################################################################################
$ricca3_butons_dadesalumne=array(
	"imatge" =>array("especalum",        "editardades",        "esborraalumne",        "alumnes",        "buid",           "buid"),
	"enllac" =>array("ricca3-especalum", "ricca3-editardades", "ricca3-esborraalumne", "ricca3-alumnes", "ricca3-alumnes", "ricca3-alumnes"),
	"id"     =>array(true,               true,                 true,                   false,            false,            false),
	"texte"  =>array("",                 "" ,                  "",                     "",               "",               "")
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
	"imatge" =>array("afegirespecialitat", "baixaespecialitat", "creditsalumne",  "aplicarpla",          "dadesalumne",        "alumnes",        "butlleti",        "caratula",        "especrepe",        "canviany",        "buid",             "buid"),
	"enllac" =>array("ricca3-novaespec",   "ricca3-baixaespec", "ricca3-credalu", "ricca3-alumcreacred", "ricca3-dadesalumne", "ricca3-alumnes", "ricca3-butlleti", "ricca3-caratula", "ricca3-especrepe", "ricca3-canviany", "ricca3-especalum", "ricca3-especalum"),
	"id"     =>array(true,                 true,                true,             true,                  true,                 false,            true,              true,              true,               true,              true,               true),
	"nova"   =>array(false,                false,               false,            false,                 false,                false,            false,             true,              false,              false,             false,              false),
	"texte"  =>array("",                   "" ,                 "",               "",                    "",                   "",               "",                "" ,               "",                 "",                "",                 "")
);

#############################################################################################
/**   */
#############################################################################################
$ricca3_butons_avaluacions=array(
	"imatge" =>array("actes",        "notes",        "observacions", "calcularnotaf",      "veurecalculs",       "buid",               "certifaval",    "certifcurs1",        "certiffinal",        "buid",               "buid",               "buid"),
	"enllac" =>array("ricca3-actes", "ricca3-notes", "ricca3-obser", "ricca3-avaluacions", "ricca3-avaluacions", "ricca3-avaluacions", "ricca3-certif", "ricca3-avaluacions", "ricca3-avaluacions", "ricca3-avaluacions", "ricca3-avaluacions", "ricca3-avaluacions"),
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
	"imatge" =>array("especialitats", "credits",     "grups",        "professors",   "ccomp",        "buid",         "pla",        "guardarpla",        "plallista",         "sensepla",        "buid",         "buid"),
	"enllac" =>array("ricca3-espec",  "ricca3-cred", "ricca3-grups", "ricca3-prof",  "ricca3-ccomp", "ricca3-dades", "ricca3-pla", "ricca3-guardarpla", "ricca3-llistarpla", "ricca3-sensepla", "ricca3-dades", "ricca3-notafinalalumne"),
	"id"     =>array(false,           false,         false,          false,          false,          false,          false,        false,               false,               false,             false,          false),
	"nova"   =>array(false,           false,         false,          false,          false,          false,          false,        false,               false,               false,             false,          false),
	"texte"  =>array("",              "" ,           "",             "",             "",             "",             "",           "" ,                 "",                  "",                "",             "")
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