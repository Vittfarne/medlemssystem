<?php

function escape($string){
	return htmlentities($string, ENT_QUOTES, 'windows-1252');
}