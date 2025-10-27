

<?php $__env->startSection('title', 'О нас'); ?>

<?php $__env->startSection('content'); ?>
    <h2>О компании</h2>
    <p>Мы делаем классные вещи!</p>
	123
<?php $__env->stopSection(); ?>
<?php
        $__viteAssets = vite(['src/pages/test.ts']);
        $__env->startSection('styles');
        echo $__viteAssets['css'] ?? '';
        $__env->stopSection();
        $__env->startSection('scripts');
        echo $__viteAssets['scripts'] ?? '';
        $__env->stopSection();
    
?>
<?php echo $__env->make('layouts.App', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\VPN\www\flowers_shop\views/pages/about.blade.php ENDPATH**/ ?>