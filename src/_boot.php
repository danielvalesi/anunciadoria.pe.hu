<?php

/* Boot Classes */

function _boot($n) { require 'src/front/'.strtolower($n).'.php'; }
spl_autoload_register('_boot');
?>