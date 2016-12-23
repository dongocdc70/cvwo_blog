<?php
require 'HTMLPurifier.standalone.php';

function removeHTML($html) {
  $config = HTMLPurifier_Config::createDefault();
  $config->set('HTML.Allowed', ''); // Allow Nothing
  $purifier = new HTMLPurifier($config);
  return $purifier->purify($html);
}

?>
