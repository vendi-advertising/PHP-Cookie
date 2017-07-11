<?php

/*
 * PHP-Cookie (https://github.com/delight-im/PHP-Cookie)
 * Copyright (c) delight.im (https://www.delight.im/)
 * Licensed under the MIT License (https://opensource.org/licenses/MIT)
 */

// enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 'stdout');

header('Content-type: text/plain; charset=utf-8');

require __DIR__.'/../src/Cookie.php';
require __DIR__.'/ResponseHeader.php';

global $test_counter;
$test_counter = 0;

/* BEGIN TEST COOKIES */

// start output buffering
ob_start();

testCookie(null);
testCookie(false);
testCookie('');
testCookie(0);
testCookie('hello');
testCookie('hello', false);
testCookie('hello', true);
testCookie('hello', null);
testCookie('hello', '');
testCookie('hello', 0);
testCookie('hello', 1);
testCookie('hello', 'world');
testCookie('hello', 123);
testCookie(123, 'world');
testCookie('greeting', '¡Buenos días!');
testCookie('¡Buenos días!', 'greeting');
testCookie('%a|b}c_$d!f"g-h(i)j$', 'value value value');
testCookie('%a|b}c_$d!f"g-h(i)j$', '%a|b}c_$d!f"g-h(i)j$');
testCookie('hello', 'world', '!');
testCookie('hello', 'world', '');
testCookie('hello', 'world', false);
testCookie('hello', 'world', null);
testCookie('hello', 'world', true);
testCookie('hello', 'world', 0);
testCookie('hello', 'world', '');
testCookie('hello', 'world', -1);
testCookie('hello', 'world', 234234);
testCookie('hello', 'world', time() + 60 * 60 * 24);
testCookie('hello', 'world', time() + 60 * 60 * 24 * 30);
testCookie('hello', 'world', time() + 86400, null);
testCookie('hello', 'world', time() + 86400, false);
testCookie('hello', 'world', time() + 86400, true);
testCookie('hello', 'world', time() + 86400, 0);
testCookie('hello', 'world', time() + 86400, '');
testCookie('hello', 'world', time() + 86400, '/');
testCookie('hello', 'world', time() + 86400, '/foo');
testCookie('hello', 'world', time() + 86400, '/foo/');
testCookie('hello', 'world', time() + 86400, '/buenos/días/');
testCookie('hello', 'world', time() + 86400, '/buenos días/');
testCookie('hello', 'world', time() + 86400, '/foo/', null);
testCookie('hello', 'world', time() + 86400, '/foo/', false);
testCookie('hello', 'world', time() + 86400, '/foo/', true);
testCookie('hello', 'world', time() + 86400, '/foo/', 0);
testCookie('hello', 'world', time() + 86400, '/foo/', '');
testCookie('hello', 'world', time() + 86400, '/foo/', 'example.com');
testCookie('hello', 'world', time() + 86400, '/foo/', '.example.com');
testCookie('hello', 'world', time() + 86400, '/foo/', 'www.example.com');
testCookie('hello', 'world', time() + 86400, '/foo/', 'días.example.com');
testCookie('hello', 'world', time() + 86400, '/foo/', 'localhost');
testCookie('hello', 'world', time() + 86400, '/foo/', '127.0.0.1');
testCookie('hello', 'world', time() + 86400, '/foo/', 'example.com', null);
testCookie('hello', 'world', time() + 86400, '/foo/', 'example.com', false);
testCookie('hello', 'world', time() + 86400, '/foo/', 'example.com', true);
testCookie('hello', 'world', time() + 86400, '/foo/', 'example.com', 0);
testCookie('hello', 'world', time() + 86400, '/foo/', 'example.com', '');
testCookie('hello', 'world', time() + 86400, '/foo/', 'example.com', 'hello');
testCookie('hello', 'world', time() + 86400, '/foo/', 'example.com', 7);
testCookie('hello', 'world', time() + 86400, '/foo/', 'example.com', -7);
testCookie('hello', 'world', time() + 86400, '/foo/', 'example.com', false, null);
testCookie('hello', 'world', time() + 86400, '/foo/', 'example.com', false, false);
testCookie('hello', 'world', time() + 86400, '/foo/', 'example.com', false, true);
testCookie('hello', 'world', time() + 86400, '/foo/', 'example.com', false, 0);
testCookie('hello', 'world', time() + 86400, '/foo/', 'example.com', false, '');
testCookie('hello', 'world', time() + 86400, '/foo/', 'example.com', false, 'hello');
testCookie('hello', 'world', time() + 86400, '/foo/', 'example.com', false, 5);
testCookie('hello', 'world', time() + 86400, '/foo/', 'example.com', false, -5);
testCookie('hello', 'world', time() + 86400, '/foo/', 'example.com', true, null);
testCookie('hello', 'world', time() + 86400, '/foo/', 'example.com', true, false);
testCookie('hello', 'world', time() + 86400, '/foo/', 'example.com', true, true);
testCookie('hello', 'world', time() + 86400, '/foo/', 'example.com', true, 0);
testCookie('hello', 'world', time() + 86400, '/foo/', 'example.com', true, '');
testCookie('hello', 'world', time() + 86400, '/foo/', 'example.com', true, 'hello');
testCookie('hello', 'world', time() + 86400, '/foo/', 'example.com', true, 5);
testCookie('hello', 'world', time() + 86400, '/foo/', 'example.com', true, -5);
testCookie('TestCookie', 'php.net');
testCookie('TestCookie', 'php.net', time() + 3600);
testCookie('TestCookie', 'php.net', time() + 3600, '/~rasmus/', 'example.com', 1);
testCookie('TestCookie', '', time() - 3600);
testCookie('TestCookie', '', time() - 3600, '/~rasmus/', 'example.com', 1);
testCookie('cookie[three]', 'cookiethree');
testCookie('cookie[two]', 'cookietwo');
testCookie('cookie[one]', 'cookieone');
testEqual((new \Delight\Cookie\Cookie('SID'))->setValue('31d4d96e407aad42')->setDomain('localhost')->setSameSiteRestriction('Strict'), 'Set-Cookie: SID=31d4d96e407aad42; path=/; httponly; SameSite=Strict');
testEqual((new \Delight\Cookie\Cookie('key'))->setValue('value')->setDomain('localhost'), 'Set-Cookie: key=value; path=/; httponly; SameSite=Lax');
testEqual((new \Delight\Cookie\Cookie('key'))->setValue('value')->setDomain('.localhost'), 'Set-Cookie: key=value; path=/; httponly; SameSite=Lax');
testEqual((new \Delight\Cookie\Cookie('key'))->setValue('value')->setDomain('127.0.0.1'), 'Set-Cookie: key=value; path=/; httponly; SameSite=Lax');
testEqual((new \Delight\Cookie\Cookie('key'))->setValue('value')->setDomain('.local'), 'Set-Cookie: key=value; path=/; httponly; SameSite=Lax');
testEqual((new \Delight\Cookie\Cookie('key'))->setValue('value')->setDomain('example.com'), 'Set-Cookie: key=value; path=/; domain=.example.com; httponly; SameSite=Lax');
testEqual((new \Delight\Cookie\Cookie('key'))->setValue('value')->setDomain('.example.com'), 'Set-Cookie: key=value; path=/; domain=.example.com; httponly; SameSite=Lax');
testEqual((new \Delight\Cookie\Cookie('key'))->setValue('value')->setDomain('www.example.com'), 'Set-Cookie: key=value; path=/; domain=.example.com; httponly; SameSite=Lax');
testEqual((new \Delight\Cookie\Cookie('key'))->setValue('value')->setDomain('.www.example.com'), 'Set-Cookie: key=value; path=/; domain=.example.com; httponly; SameSite=Lax');
testEqual((new \Delight\Cookie\Cookie('key'))->setValue('value')->setDomain('www.example.com', true), 'Set-Cookie: key=value; path=/; domain=.www.example.com; httponly; SameSite=Lax');
testEqual((new \Delight\Cookie\Cookie('key'))->setValue('value')->setDomain('.www.example.com', true), 'Set-Cookie: key=value; path=/; domain=.www.example.com; httponly; SameSite=Lax');
testEqual((new \Delight\Cookie\Cookie('key'))->setValue('value')->setDomain('blog.example.com'), 'Set-Cookie: key=value; path=/; domain=.blog.example.com; httponly; SameSite=Lax');
testEqual((new \Delight\Cookie\Cookie('key'))->setValue('value')->setDomain('.blog.example.com'), 'Set-Cookie: key=value; path=/; domain=.blog.example.com; httponly; SameSite=Lax');

setcookie('hello', 'world', time() + 86400, '/foo/', 'example.com', true, true);
$cookie = \Delight\Cookie\Cookie::parse(\Delight\Http\ResponseHeader::take('Set-Cookie'));

testEqual($cookie, (new \Delight\Cookie\Cookie('hello'))->setValue('world')->setMaxAge(86400)->setPath('/foo/')->setDomain('example.com')->setHttpOnly(true)->setSecureOnly(true));

($cookie->getName() === 'hello') or fail(__LINE__);
($cookie->getValue() === 'world') or fail(__LINE__);
($cookie->getExpiryTime() === time() + 86400) or fail(__LINE__);
($cookie->getMaxAge() === 86400) or fail(__LINE__);
($cookie->getPath() === '/foo/') or fail(__LINE__);
($cookie->getDomain() === '.example.com') or fail(__LINE__);
($cookie->isHttpOnly() === true) or fail(__LINE__);
($cookie->isSecureOnly() === true) or fail(__LINE__);
($cookie->getSameSiteRestriction() === \Delight\Cookie\Cookie::SAME_SITE_RESTRICTION_LAX) or fail(__LINE__);

/* END TEST COOKIES */

echo 'ALL TESTS PASSED'."\n";

function testCookie($name, $value = null, $expire = 0, $path = null, $domain = null, $secure = false, $httpOnly = false) {
	$actualValue = \Delight\Cookie\Cookie::buildCookieHeader($name, $value, $expire, $path, $domain, $secure, $httpOnly);

	if (is_null($actualValue)) {
		$expectedValue = @simulateSetCookie($name, $value, $expire, $path, $domain, $secure, $httpOnly);
	}
	else {
		$expectedValue = simulateSetCookie($name, $value, $expire, $path, $domain, $secure, $httpOnly);
	}

	testEqual($actualValue, $expectedValue);
}

function testEqual($actualValue, $expectedValue) {
	global $test_counter;
	$test_counter++;

	$actualValue = (string) $actualValue;
	$expectedValue = (string) $expectedValue;

	echo "[$test_counter]";

	echo '[';
	echo $expectedValue;
	echo ']';
	echo "\n";

	if (strcasecmp($actualValue, $expectedValue) !== 0) {
		echo 'FAILED: ';
		echo '[';
		echo $actualValue;
		echo ']';
		echo ' !== ';
		echo '[';
		echo $expectedValue;
		echo ']';
		echo "\n";

		exit;
	}
}

function simulateSetCookie($name, $value = null, $expire = 0, $path = null, $domain = null, $secure = false, $httpOnly = false) {
	setcookie($name, $value, $expire, $path, $domain, $secure, $httpOnly);

	return \Delight\Http\ResponseHeader::take('Set-Cookie');
}

function fail($lineNumber) {
	exit('Error in line '.$lineNumber);
}
