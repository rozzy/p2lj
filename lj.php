<!DOCTYPE HTML>
<html lang="en-US">
<head>
  <meta charset="UTF-8">
  <title></title>
</head>
<body>
  <?php
function E2toLJ ($login, $passw, $subj, $text) {
  @include "lib/xmlrpc.inc";
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
  if ($_POST) {
    $post = E2toLJ($_POST['login'], $_POST['password'], $_POST['subject'], $_POST['message']);
    echo is_array($post) ? $post['url'] : 'Пост не опубликован';
  }
?>
<form action="" method="post">
  <input name="login" type="text" placeholder="Логин"/><br/>
  <input type="password" name="password" placeholder="Пароль">
  <br>
  <input type="" name="subject" placeholder="Тема"><br/>
  <textarea name="message" id="" cols="30" rows="10" placeholder="Текст"></textarea>
  <br/> <input type="submit" value="Отправить">
</form>
</body>
</html>
