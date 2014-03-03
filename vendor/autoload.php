<?php

function __autoload($class_name) {
  
  $file = __DIR__ . '\\' . $class_name . '\\' . $class_name . '.php';
  if(file_exists($file)) { include_once($file); } else {
	throw new Exception("Unable to load $class_name");
  }
}
