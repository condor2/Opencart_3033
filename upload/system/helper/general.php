<?php
function token($length = 32) {
	if (!isset($length) || intval($length) <= 8) {
		$length = 32;
	}

	$token = bin2hex(random_bytes(($length + 1) / 2));

	return substr($token, 0, $length);
}

/**
 * Backwards support for timing safe hash string comparisons
 *
 * http://php.net/manual/en/function.hash-equals.php
 */

if (!function_exists('hash_equals')) {
	function hash_equals($known_string, $user_string) {
		$known_string = (string)$known_string;
		$user_string = (string)$user_string;

		if (strlen($known_string) != strlen($user_string)) {
			return false;
		} else {
			$res = $known_string ^ $user_string;
			$ret = 0;

			for ($i = strlen($res) - 1; $i >= 0; $i--) $ret |= ord($res[$i]);

			return !$ret;
		}
	}
}

function date_added($date) {
	$second = time() - strtotime($date);

	if ($second < 10) {
		$date_added = 'just now';
	} elseif ($second) {
		$date_added = $second . ' seconds ago';
	}

	$minute = floor($second / 60);

	if ($minute == 1) {
		$date_added = $minute . ' minute ago';
	} elseif ($minute) {
		$date_added = $minute . ' minutes ago';
	}

	$hour = floor($minute / 60);

	if ($hour == 1) {
		$date_added = $hour . ' hour ago';
	} elseif ($hour) {
		$date_added = $hour . ' hours ago';
	}

	$day = floor($hour / 24);

	if ($day == 1) {
		$date_added = $day . ' day ago';
	} elseif ($day) {
		$date_added = $day . ' days ago';
	}

	$week = floor($day / 7);

	if ($week == 1) {
		$date_added = $week . ' week ago';
	} elseif ($week) {
		$date_added = $week . ' weeks ago';
	}

	$month = floor($week / 4);

	if ($month == 1) {
		$date_added = $month . ' month ago';
	} elseif ($month) {
		$date_added = $month . ' months ago';
	}

	$year = floor($week / 52.1429);

	if ($year == 1) {
		$date_added = $year . ' year ago';
	} elseif ($year) {
		$date_added = $year . ' years ago';
	}

	return $date_added;
}