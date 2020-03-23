<?php $__env->startSection('title', 'Homepage'); ?>

<?php $__env->startSection('main'); ?>
<section class="product-list">
    <?php if(isset($category_name)): ?>
    <h2>Category: <?php echo e($category_name); ?></h2>
    <?php else: ?>
    <h2>New Products</h2>
    <?php endif; ?>

    <ul>
        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li>
            <a href="product/<?php echo e($product->id); ?>">
                <img src="<?php echo e($product->image); ?>" alt="">
            </a>
            <div>
                <a href="product/<?php echo e($product->id); ?>">
                    <h3><?php echo e($product->name); ?></h3>
                </a>
                <p><?php echo e(number_format($product->price)); ?>$</p>
                <a class= 'buy' href="cart/<?php echo e($product->id); ?>">Add to cart</a>
            </div>
        </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </ul>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.page-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web development\xampp\htdocs\mvc_v2\views/site/index.blade.php ENDPATH**/ ?>