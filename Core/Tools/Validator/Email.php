<?php
namespace ProjectA\Core\Tools\Validator;

class Email
{
	protected const CONFIG_CHECKS = [
		'regex' => true,
		'domain' => true,
		'characters' => true,
	];

	public static function checkMail(string $email = '') : bool
	{
		$checkValue = trim($email);
		if ($checkValue === '') { return false; }

		$results = [];
		foreach (self::CONFIG_CHECKS as $checkType => $checks)
		{
			if ($checks !== true) { continue; }
			$result = match ($checkType)
			{
				'regex' => self::checkRegex($checkValue),
				'domain' => self::checkDomain($checkValue),
				'characters' => !self::checkCharacters($checkValue),
				default => false,
			};

			$results[$checkType] = $result;

			if (!$result && $checkType !== 'domain')
			{
				return false;
			}
		}

		return !in_array(false, $results, true);
	}

	protected static function checkRegex(string $email = '') : bool
	{
		$pattern = '/^(?!.*\.\.)(?!.*--)[a-zA-Z0-9][a-zA-Z0-9._%+-]*@[a-zA-Z0-9][a-zA-Z0-9.]*[a-zA-Z0-9]\.[a-zA-Z]{2,}$/';
		return preg_match($pattern, $email) === 1;
	}

	protected static function checkDomain(string $email = '') : bool
	{
		$domain = substr(strrchr($email, "@"), 1);
		return !empty($domain) && checkdnsrr($domain, 'MX');
	}

	protected static function checkCharacters(string $email = '') : bool
	{
		$parts = explode('@', $email);
		$pattern = '/[!#$%^&*()]/';
		$resultFirst = preg_match($pattern, $parts[0]) === 1;
		$resultSecond = preg_match($pattern, $parts[1]) === 1;

		return $resultFirst || $resultSecond;
	}
}
