<?php
require 'HTMLPurifier.standalone.php';

function removeHTML($html) {
  $config = HTMLPurifier_Config::createDefault();
  $config->set('Core.Encoding', 'ISO-8859-1'); // not using UTF-8
  $config->set('HTML.Allowed', ''); // Allow Nothing
  $purifier = new HTMLPurifier($config);
  return $purifier->purify($html);
}

?>
