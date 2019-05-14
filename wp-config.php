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
define( 'DB_USER', 'sami' );

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
define( 'AUTH_KEY',         '^TAsBbn-a&:TJY!.?]LY7t|zD?)t[ZTY8:) 3O_Yd#B0UzTv6U.2)&eM{APn;aDd' );
define( 'SECURE_AUTH_KEY',  'fTL>W..@]vDUj%ySnHrbIug1h!93AtS]mQNGB $Aw({^|0}s#TSyj=VUO0z}(>gX' );
define( 'LOGGED_IN_KEY',    'zy^|A)y=C55!vbk}8^<?;Jt){X$hC.<q}}^,Tc@T19y~(E]Gu/I2v:fNrDK;/<wI' );
define( 'NONCE_KEY',        'a]dxL{%ENKyA!sQfUi 9zW;]d-t47&GAhfiYm>@HYKT:D%8An.FYql3l3C5OK)I^' );
define( 'AUTH_SALT',        '`*dfi2yfgZ?tv>r;cP;B(%rCi_#A8$T#nQ}s+*0;UC|8&nl}~EJ[u&lmC)za,$5[' );
define( 'SECURE_AUTH_SALT', 'js9K1]y]gB/~i@?823:(bwc3`T^J@X`&dzIs&Hi|?tU2b{9yo+UJ$2Pg7z2v,R$9' );
define( 'LOGGED_IN_SALT',   'iR)om[kbV53^O~MR`w;^RZ$Eb{AxJ4;R{0{n2PE}d=Dl^K3qYz?q^2S>Je+(=~1O' );
define( 'NONCE_SALT',       'J[[*9:5$sdt&u^|z.|S#ycP>8SBIL24,}d5r0(@juan_c!$:496>8jFX}8/jNb|N' );
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