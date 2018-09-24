--TEST--
Format command help
--FILE--
<?php
$_SERVER['argv'][] = '--help';
$_SERVER['argv'][] = '--no-ansi';

require __DIR__ . '/../../bin/console';
?>
--EXPECTF--
#!/usr/bin/env php
Usage:
  format <event>

Arguments:
  event                 The event name

Options:
  -h, --help            Display this help message
  -q, --quiet           Do not output any message
  -V, --version         Display this application version
      --ansi            Force ANSI output
      --no-ansi         Disable ANSI output
  -n, --no-interaction  Do not ask any interactive question
  -v|vv|vvv, --verbose  Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
