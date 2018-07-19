<?php

function greet() {
	return 'Hello, World!';
}

/**
 * 배열을 추가합니다.
 */
if (!function_exists('_array_KeyAppend')) {
    function _array_KeyAppend($src, $key, $arr) {
		// echo "배열 데이터를 추가합니다.<br>";
		if (is_array($src)) {
			foreach ($arr as $k => $value) {
				$src[$key][$k] = $value;
			}
			return $src;
		}
        
    }
}


