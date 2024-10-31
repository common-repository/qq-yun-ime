<?php

function ime_core($method = '', $char = '') {
	if(empty($method)) {
		$method = get_option('qq_yun_ime_method');
	}
	if(empty($method)) {
		$char = get_option('qq_yun_ime_char');
	}
	if(is_admin()) {
		$class = 'qyime_dashboard';
	} else {
		$class = 'qyime_front';
	}
	if($char == 't' && $method == 'en') {
		$tips = '啟動QQ雲輸入法（英語）';
	} elseif ($char == 't' && $method == 'wb') {
		$tips = '啟動QQ雲輸入法（五筆）';
	} elseif ($char == 't' && $method == 'py') {
		$tips = '啟動QQ雲輸入法（拼音）';
	} elseif ($char == 's' && $method == 'en') {
		$tips = '启动QQ云输入法（英语）';
	} elseif ($char == 's' && $method == 'wb') {
		$tips = '启动QQ云输入法（五笔）';
	} elseif ($char == 's' && $method == 'py') {
		$tips = '启动QQ云输入法（拼音）';
	}
	switch ($method) {
		case 'en';
			$output = "<a id=\"qyime_py\" class=\"{$class}\" title=\"{$tips}\" href=\"javascript:(function(q){!!q?q.toggle():(function(d,j){j=d.createElement('script');j.src='//ime.qq.com/fcgi-bin/getjs';j.setAttribute('ime-cfg','lt=2&im=126');d.getElementsByTagName('head')[0].appendChild(j)})(document)})(window.QQWebIME)\"><span>{$tips}</span></a>";
			break;
		case 'wb';
			$output = "<a id=\"qyime_wb\" class=\"{$class}\" title=\"{$tips}\" href=\"javascript:(function(q){!!q?q.toggle():(function(d,j){j=d.createElement('script');j.src='//ime.qq.com/fcgi-bin/getjs';j.setAttribute('ime-cfg','lt=2&amp;im=212');d.getElementsByTagName('head')[0].appendChild(j)})(document)})(window.QQWebIME)\"><span>{$tips}</span></a>";
			break;
		case 'py';
			$output = "<a id=\"qyime_py\" class=\"{$class}\" title=\"{$tips}\" href=\"javascript:(function(q){!!q?q.toggle():(function(d,j){j=d.createElement('script');j.src='//ime.qq.com/fcgi-bin/getjs';j.setAttribute('ime-cfg','lt=2&im=132');d.getElementsByTagName('head')[0].appendChild(j)})(document)})(window.QQWebIME)\"><span>{$tips}</span></a>";
			break;
	}
	if($char == 't') {
		$output = str_replace("');d.getElementsByTagName", "&tc=1');d.getElementsByTagName", $output);
	}
	return $output;
}

add_action('in_admin_header', 'qq_yun_ime');
function qq_yun_ime () {
	if(is_admin()) {
		echo ime_core();
	} else {
		$char = get_option('qq_yun_ime_char');
		if($char == 's') {
			$tips = '云输入法';
		} elseif($char == 't') {
			$tips = '雲輸入法';
		}
		$output = '<div id="qq_yun_ime">'.$tips;
		$output .= ime_core('py', $char);
		$output .= ime_core('wb', $char);
		$output .= '<div style="clear:both;"></div></div>';
		echo $output;
	}
}

if(get_option('qq_yun_ime_front')) {
	add_action('comment_form', 'qq_yun_ime');
}

?>