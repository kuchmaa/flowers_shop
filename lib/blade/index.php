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

$engineResolver = new EngineResolver;
$engineResolver->register('blade', fn() => new CompilerEngine($bladeCompiler, $filesystem));

$viewFinder = new FileViewFinder($filesystem, [$viewsPath]);
$blade = new Factory($engineResolver, $viewFinder, $eventDispatcher);
