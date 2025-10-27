<!DOCTYPE html>
<html>
<head>
    <title><?php echo $__env->yieldContent('title', 'Мой сайт'); ?></title>
	 <?php echo $__env->yieldContent('styles'); ?>
	  <?php echo $__env->yieldContent('scripts'); ?>
</head>
<body>
    <header>
        <h1>Шапка сайта</h1>
        <nav>
            <a href="/">Home</a> |
            <a href="/about">About</a>
        </nav>
    </header>
    <main>
		123312312
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <footer>
        <p>© 2025 MySite</p>
    </footer>
</body>
</html>
<?php /**PATH E:\VPN\www\flowers_shop\views/layouts/App.blade.php ENDPATH**/ ?>