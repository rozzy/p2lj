<?php

function p2lj ($username, $password, $subject, $text) {
  error_reporting(0);
  global $encoding;
  require 'xmlrpc.inc';

  $encoding = 'UTF-8';
  $date = time();

  $post = array(
    'username' => new xmlrpcval($username, 'string'),
    'password' => new xmlrpcval($password, 'string'),
    'event' => new xmlrpcval($text, 'string'),
    'subject' => new xmlrpcval($subject, 'string'),
    'lineendings' => new xmlrpcval('unix', 'string'),
    'year' => new xmlrpcval(date('Y', $date), 'int'),
    'mon' => new xmlrpcval(date('m', $date), 'int'),
    'day' => new xmlrpcval(date('d', $date), 'int'),
    'hour' => new xmlrpcval(date('G', $date), 'int'),
    'min' => new xmlrpcval(date('i', $date), 'int'),
    'ver' => new xmlrpcval(2, 'int')
  );

  $message = new xmlrpcmsg('LJ.XMLRPC.postevent', array(
    new xmlrpcval($post, 'struct')
  ));

  $client = new xmlrpc_client('/interface/xmlrpc', 'www.livejournal.com', 80);
  $client->request_charset_encoding = $encoding;
  $request = $client->send($message);

  if ($request->faultCode()) return false;
  $answer = php_xmlrpc_decode($request->value());
  return $answer;
}
