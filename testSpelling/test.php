<?php 
$pspell_link = pspell_new ("fr");

if (pspell_check($pspell_link, "testt")) {
	echo 'L\'orthographe est exacte';
} else {
	echo 'Désolé, mauvaise orthographe';
}
?>