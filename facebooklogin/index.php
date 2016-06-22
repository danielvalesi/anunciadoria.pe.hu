<?php 
require_once("src/facebook.php");

$config = array();
$config['appId'] = '1692271104370843';
$config['secret'] = 'f40c10fa348761d86efc8bd1a0eb2b2f';

$facebook = new Facebook($config);
$params = array (
    'scope' => 'email',
    'redirect_uri' => 'http://www.anunciadoria.96.lt/facebooklogin/registro.php'
);
$loginUrl = $facebook->getLoginUrl($params);
?>
<a href="<?php echo $loginUrl; ?>">Login com Facebook</a>
