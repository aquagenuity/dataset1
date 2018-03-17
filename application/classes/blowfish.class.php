<?php

	class Blowfish{

		static function Encrypt($text){
			$td = mcrypt_module_open(MCRYPT_BLOWFISH, '', 'ecb', '');
			$iv_size = mcrypt_enc_get_iv_size ($td);
			$key_size = mcrypt_enc_get_key_size ($td);
			srand((double) microtime() * 1000000);
			$iv = mcrypt_create_iv( $iv_size, MCRYPT_RAND);
			$enc = mcrypt_encrypt(MCRYPT_BLOWFISH, BLOWFISH_KEY, $text, MCRYPT_MODE_ECB, $iv);
			$ret = base64_encode($enc);
			return $ret;
		}

		static function Decrypt($text){
			$td = mcrypt_module_open(MCRYPT_BLOWFISH, '', 'ecb', '');
			$iv_size = mcrypt_enc_get_iv_size ($td);
			$key_size = mcrypt_enc_get_key_size ($td);
			srand((double) microtime() * 1000000);
			$iv = mcrypt_create_iv( $iv_size, MCRYPT_RAND);
			$dec = mcrypt_decrypt(MCRYPT_BLOWFISH, BLOWFISH_KEY, base64_decode($text), MCRYPT_MODE_ECB, $iv);
			$ret = trim($dec);
			return $ret;
		}
	}
?>
