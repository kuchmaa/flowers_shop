<?php

use Illuminate\Events\Dispatcher;
use Illuminate\Filesystem\Filesystem;
use Illuminate\View\FileViewFinder;
use Illuminate\View\Engines\EngineResolver;
use Illuminate\View\Compilers\BladeCompiler;
use Illuminate\View\Engines\CompilerEngine;
use Illuminate\View\Factory;

$viewsPath = $rootPath . '/views';
$cachePath = $rootPath . '/cache';

$filesystem = new Filesystem;
$eventDispatcher = new Dispatcher;
$bladeCompiler = new BladeCompiler($filesystem, $cachePath);

$engineResolver = new EngineResolver;
$engineResolver->register('blade', fn() => new CompilerEngine($bladeCompiler, $filesystem));

$viewFinder = new FileViewFinder($filesystem, [$viewsPath]);
global $blade;
$blade = new Factory($engineResolver, $viewFinder, $eventDispatcher);


$bladeCompiler->directive('vite', function ($expression) {
	return "<?php
        \$__viteAssets = vite({$expression});
        \$__env->startSection('styles');
        echo \$__viteAssets['css'] ?? '';
        \$__env->stopSection();
        \$__env->startSection('scripts');
        echo \$__viteAssets['scripts'] ?? '';
        \$__env->stopSection();
    
?>";;
});

$bladeCompiler->directive('component', function ($expression) {
	// $expression содержит ('Button', ['class' => 'btn-primary'])
	return "<?php
        \$__componentArgs = {$expression};
        \$__componentName = \$__componentArgs[0];
        \$__componentProps = isset(\$__componentArgs[1]) && is_array(\$__componentArgs[1])
            ? \$__componentArgs[1]
            : [];
        ob_start();
    ?>";
});

$bladeCompiler->directive('endcomponent', function () {
	return "<?php
        \$__componentSlot = ob_get_clean();
        echo renderComponent(\$__componentName, \$__componentProps, \$__componentSlot);
    ?>";
});

/**
 * Рендерит Blade-компонент
 *
 * @param string $name имя компонента (Button → views/components/Button.blade.php)
 * @param array $props атрибуты компонента
 * @param string|null $slot содержимое
 * @return string HTML строка
 */
function renderComponent(string $name, array $props = [], ?string $slot = ""): string
{
	global $blade;

	extract($props, EXTR_SKIP);

	return $blade->make("components.$name", array_merge($props, ['slot' => $slot]))->render();
	return "qwe";
}
