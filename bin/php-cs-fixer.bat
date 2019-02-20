@ECHO OFF
setlocal DISABLEDELAYEDEXPANSION
SET BIN_TARGET=%~dp0/php-cs-fixer.phar
path\to\php.exe "%BIN_TARGET%" %*
