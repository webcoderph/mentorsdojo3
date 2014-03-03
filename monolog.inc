spl_autoload_register(function ($class) {
  $file = $__DIR__.'/relative/path/to/Monolog/src/'.strtr($class, '\\', '/').'.php';
  if (file_exists($file)) {
    require $file;
    return true;
  }
});
