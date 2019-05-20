<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clés secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur
 * {@link http://codex.wordpress.org/fr:Modifier_wp-config.php Modifier
 * wp-config.php}. C’est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define( 'DB_NAME', 'FooDog' );

/** Utilisateur de la base de données MySQL. */
define( 'DB_USER', 'massart' );

/** Mot de passe de la base de données MySQL. */
define( 'DB_PASSWORD', 'user' );

/** Adresse de l’hébergement MySQL. */
define( 'DB_HOST', 'localhost' );

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Type de collation de la base de données.
  * N’y touchez que si vous savez ce que vous faites.
  */
define('DB_COLLATE', '');

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '=Pd<}<7jxA8#4OJjElBk]/Cc@MN*#R!S$4}I@2xUZHIB7Qp)o~=Vz.>< :D3K$q)' );
define( 'SECURE_AUTH_KEY',  '2N;,u[/gBKeea(mqpNAzf*Rc^K-d)/PCxXC9ET -2W=4{H)bIA#,0a9r_V4J.g{*' );
define( 'LOGGED_IN_KEY',    'j`t9E287~kX49^4}viGiJHS])|EQ4%CR^_<hyFHY4F*_cDj)V)87nW[!;fwD7fEt' );
define( 'NONCE_KEY',        'r gUrEIP9Z3JihNV=D~mnn>5+(+aj},oJsI<XfY3}wHrS<kME.!Ys?@Sw1I546l>' );
define( 'AUTH_SALT',        'PS@({t4jL6yFICEl$hwQ >iMpLWCWV&x&#+L>_Cg;&viXZgNU;fS#c*)PZ4$o5/p' );
define( 'SECURE_AUTH_SALT', '0=R#7sTva%H0x,&Rmf LIQ9hi(qYhnGSL=wkl22>?BS8N[;8,,P[WCRH%5@M0tiO' );
define( 'LOGGED_IN_SALT',   'Suai2dxJ3*aB0ue}{cm)pHPU$E}}=tQfV2EB|pj=$zLxC)7ML)KoW1_:$prZKPMu' );
define( 'NONCE_SALT',       '=.Fvok%2KHe;|9#=H;bxCSQt4FU!C*qCfOnT(nU4)uP_inC~!CRxbWHyXHJ~hc^7' );
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix = 'wp_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortemment recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* C’est tout, ne touchez pas à ce qui suit ! Bonne publication. */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');
define('FS_METHOD','direct');
