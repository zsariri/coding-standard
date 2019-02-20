@ECHO OFF
setlocal DISABLEDELAYEDEXPANSION
SET BIN_TARGET=%~dp0/phpcs.phar
path\to\php.exe "%BIN_TARGET%" %*
