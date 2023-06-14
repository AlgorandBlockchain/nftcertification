<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
//adding config items. get google auth clietn id,secret keys from http://console.developers.google.com
$config['OAUTH2_CLIENT_ID'] = ' AIzaSyCiiApO_FrZ2nLnh6G7DHN6zeGooXSCHk8 '; //your auth 2.0 client id
$config['OAUTH2_CLIENT_SECRET'] = ' AIzaSyCiiApO_FrZ2nLnh6G7DHN6zeGooXSCHk8 ';//your auth 2,0 client secret
$config['REDIRECT_URI'] = 'http://localhost/kabisaku/home/youtube'; //Authorized redirect URIs a callback url which you should save in google console
