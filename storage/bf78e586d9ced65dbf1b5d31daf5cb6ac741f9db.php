<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <base href="<?php echo e(BASE_URL); ?>">
    <link rel="stylesheet" type="text/css" href="public/css/normalize.css">
    <link rel="stylesheet" type="text/css" href="public/css/layout-site-style.css">
    <title><?php echo $__env->yieldContent('title'); ?> | OnlinX Shop</title>
</head>

<body>
    <header>
        <h1><a href="">Welcome to OnlinX Shop</a></h1>
        <nav>
            <ul>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><a href="category/<?php echo e($category->slug); ?>"><?php echo e($category->cate_name); ?>(<?php echo e($category->countProducts()); ?>)</a>
                </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <li><a href="cart-detail">Cart (<?php echo e(getTotalProductInCart()); ?>)</a></li>
            </ul> 
        </nav>
        <div>
            <?php if(isset($_SESSION['user'])): ?>
            <p>
                Hello, <?= $_SESSION['user']['name'] ?>
                <a href="admin" target="_blank"> ↱ Admin site</a>
            </p>
            <a href="logout">Logout</a>
            <?php else: ?>
            <p><a href="login">Login</a></p>
            <?php endif; ?>
        </div>
    </header>
    <main>
        <?php echo $__env->yieldContent('main'); ?>
    </main>
    <footer>
        <p>Online shopping. All rights reserved</p>
    </footer>
</body>

</html><?php /**PATH D:\web development\xampp\htdocs\mvc_v2\views/layouts/page-layout.blade.php ENDPATH**/ ?>