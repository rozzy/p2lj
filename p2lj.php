<?php

function p2lj ($username, $password, $subject, $text, $props = false) {
  error_reporting(0);
  global $xmlrpc_internalencoding;
  require 'xmlrpc.inc';

  $xmlrpc_internalencoding = 'UTF-8';
  $time = time();

  $_props = array();
  if ($props) foreach ($props as $key => $value) {
    $_props[$key] = new xmlrpcval($value, 'string');
  };

  $config = array(
    'username' => new xmlrpcval($username, 'string'),
    'password' => new xmlrpcval($password, 'string'),
    'event' => new xmlrpcval($text, 'string'),
    'subject' => new xmlrpcval($subject, 'string'),
    'lineendings' => new xmlrpcval('unix', 'string'),
    'year' => new xmlrpcval(date('Y', $time), 'int'),
    'mon' => new xmlrpcval(date('m', $time), 'int'),
    'day' => new xmlrpcval(date('d', $time), 'int'),
    'hour' => new xmlrpcval(date('G', $time), 'int'),
    'min' => new xmlrpcval(date('i', $time), 'int'),
    'ver' => new xmlrpcval(2, 'int'),
    'props' => new xmlrpcval($_props, 'struct')
 );

  $msg = new xmlrpcmsg('LJ.XMLRPC.postevent', array(
    new xmlrpcval($config, 'struct')
 ));

  $lj = new xmlrpc_client('/interface/xmlrpc', 'www.livejournal.com', 80);
  $lj->request_charset_encoding = $xmlrpc_internalencoding;
  $result = $lj->send($msg);

  return $result->faultCode() ? false : php_xmlrpc_decode($result->value());
}
