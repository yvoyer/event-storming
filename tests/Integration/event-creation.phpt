--TEST--
Create events of different types
--FILE--
<?php
$_SERVER['argv'][] = 'event:create';
$_SERVER['argv'][] = 'name';

require __DIR__ . '/../../bin/console';
?>
--EXPECTF--
#!/usr/bin/env php
%s-%s-%s-%s
