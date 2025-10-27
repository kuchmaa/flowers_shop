<?php
class ViteManifestEntry
{
	public string $file;
	public string $name;
	public ?string $src;
	public ?string $isEntry;
	public ?array $css;

	public function __construct(array $data)
	{
		$this->file = $data['file'];
		$this->name = $data['name'];
		$this->src = $data['src'] ?? null;
		$this->isEntry = $data['isEntry'] ?? null;
		$this->css = $data['css'] ?? null;
	}
}
class ViteManifest
{
	/** @var ViteManifestProp[] */
	private array $entries = [];
	public function __construct(string $manifestPath)
	{
		if (!file_exists($manifestPath)) {
			throw new Exception("Манифест не найдет. Дура надо npm vite build сделать");
		}
		$manifestData = json_decode(file_get_contents($manifestPath), true);

		foreach ($manifestData as $key => $entryData) {
			$this->entries[$key] = new ViteManifestEntry($entryData);
		}
	}

	public function get(string $key): ?ViteManifestEntry
	{
		return $this->entries[$key] ?? null;
	}
}

function vite(array $entry)
{
	global $env;
	global $rootPath;

	if ($env['development'] == 'true') {
		return viteDev($entry);
	} else {
		$manifestPath = $rootPath . '/dist/.vite/manifest.json';

		$manifest = new ViteManifest($manifestPath);
		$scripts = '';
		$css = '';
		foreach ($entry as $key => $value) {
			if ($file = $manifest->get($value)) {
				$scripts .= "<script src='dist/$file->file' type='module' async></script>" . PHP_EOL;
				if ($file->css) {
					foreach ($file->css as $key => $cssPath) {
						$css .= "<link rel='stylesheet' href='dist/$cssPath'>" . PHP_EOL;
					};
				}
			}
		}
		return [
			'css' => $css,
			'scripts' => $scripts
		];
	}
}
function viteDev(array $entry)
{
	$host = 'http://localhost:5173';
	$src = "<script src='$host/@vite/client' type='module' async></script>\n";
	foreach ($entry as $key => $value) {
		$src .= "<script src='$host/$value' type='module' async></script>\n";
	}
	return ['scripts' => $src];
};
