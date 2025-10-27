

<?php $__env->startSection('title', 'Главная'); ?>

<?php $__env->startSection('content'); ?>
    <h2>Добро пожаловать!</h2>
    <p>Это главная страница.</p>
	123
<?php $__env->stopSection(); ?>
<?php
        $__viteAssets = vite(['src/pages/home.ts']);
        $__env->startSection('styles');
        echo $__viteAssets['css'] ?? '';
        $__env->stopSection();
        $__env->startSection('scripts');
        echo $__viteAssets['scripts'] ?? '';
        $__env->stopSection();
    ?>
<?php echo $__env->make('layouts.App', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\VPN\www\flowers_shop\views/pages/home.blade.php ENDPATH**/ ?>