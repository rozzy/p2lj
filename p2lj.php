<?php

function p2lj ($login, $passw, $subj, $text) {
  
  define('PHP_XMLRPC_COMPAT_DIR', dirname(__FILE__).'/lib/');
  @require "xmlrpc.inc";

  $xmlrpc_internalencoding = 'UTF-8';
  $date = time();

  $post = array(
    "username" => new xmlrpcval( $login, "string" ),
    "password" => new xmlrpcval( $passw, "string" ),
    "event" => new xmlrpcval( $text, "string" ),
    "subject" => new xmlrpcval( $subj, "string" ),
    "lineendings" => new xmlrpcval( "unix", "string" ),
    "year" => new xmlrpcval( date( "Y", $date ), "int" ),
    "mon" => new xmlrpcval( date( "m", $date ), "int" ),
    "day" => new xmlrpcval( date( "d", $date ), "int" ),
    "hour" => new xmlrpcval( date( "G", $date ), "int" ),
    "min" => new xmlrpcval( date( "i", $date ), "int" ),
    "ver" => new xmlrpcval( 2, "int" )
  );

  $f = @new xmlrpcmsg( 'LJ.XMLRPC.postevent', array(
    new xmlrpcval( $post, "struct" )
  ));

  $c = @new xmlrpc_client( "/interface/xmlrpc", "www.livejournal.com", 80 );
  @$c->request_charset_encoding = "UTF-8";
  $r = @$c->send( $f );

  if ( !$r->faultCode() ) {
    $v = php_xmlrpc_decode( $r->value() );
    return $v;
  } else return false;

}
