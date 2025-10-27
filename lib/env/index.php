<?php

/**
 * Читает .env файл и возвращает массив ключ => значение
 *
 * @param string $path путь к .env файлу
 * @return array
 */
function parseEnvFile(string $path): array
{
	if (!file_exists($path)) {
		throw new RuntimeException("Файл .env не найден: {$path}");
	}

	$lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
	$env = [];

	foreach ($lines as $line) {
		$line = trim($line);

		if ($line === '' || str_starts_with($line, '#')) {
			continue;
		}

		[$key, $value] = array_map('trim', explode('=', $line, 2));

		$value = trim($value, '"\'');

		$env[$key] = $value;
	}

	return $env;
}
