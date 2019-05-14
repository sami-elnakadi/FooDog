<?php

$social_profile_url = 'https://plus.google.com/' . $apsc_settings[ 'social_profile' ][ 'googlePlus' ][ 'page_id' ];
$default_count = isset( $apsc_settings[ 'social_profile' ][ 'googlePlus' ][ 'default_count' ] ) && $apsc_settings[ 'social_profile' ][ 'googlePlus' ][ 'default_count' ] != '' ? $apsc_settings[ 'social_profile' ][ 'googlePlus' ][ 'default_count' ] : '0';

$googlePlus_count = get_transient( 'apsc_googlePlus' );
if ( false === $googlePlus_count ) {
     $api_url = 'https://www.googleapis.com/plus/v1/people/' . $apsc_settings[ 'social_profile' ][ 'googlePlus' ][ 'page_id' ] . '?key=' . $apsc_settings[ 'social_profile' ][ 'googlePlus' ][ 'api_key' ];
     $params = array(
         'sslverify' => false,
         'timeout' => 60
     );
     $connection = wp_remote_get( $api_url, $params );

     if ( is_wp_error( $connection ) ) {
          $count = $default_count;
     } else {
          $_data = json_decode( $connection[ 'body' ], true );

          if ( isset( $_data[ 'circledByCount' ] ) ) {
               $count = (intval( $_data[ 'circledByCount' ] ));
               set_transient( 'apsc_googlePlus', $count, $cache_period );
          } else {
               $count = $default_count;
          }
     }
} else {
     $count = $googlePlus_count;
}
