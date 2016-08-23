#!/usr/bin/env php
<?php
/**
 * Search engine is a little search engine.
 * Using a target.txt file it will scan every target,
 * and search given strings.
 *
 */


require(__DIR__ . "/lib/TargetsFinder.php");

$targetsFinder = new TargetsFinder();
$targets = $targetsFinder->findTargets()->clearNotUrl()->getTargets();

var_dump($targets);
