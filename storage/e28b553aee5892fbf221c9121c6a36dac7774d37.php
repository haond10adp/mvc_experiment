<?php $__env->startSection('title', 'Login'); ?>
<?php $__env->startSection('main'); ?>
<div class="login">
	<h3>Login</h3>
	<form action="post-login" method="post">
		<div>
			<label for='username'>Username</label>
			<input name="username" id='username' <?php if(isset($username)): ?> value="<?php echo e($username); ?>" <?php endif; ?>>
			
			<?php if(isset($errors['username'])): ?>
			<ul class="error">
				<?php $__currentLoopData = $errors['username']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<li><?php echo e($error); ?></li>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</ul>
			<?php endif; ?>
		</div>
		<div>
			<label for='password'>Password</label>
			<input name="password" type="password" id='password' <?php if(isset($password)): ?> value="<?php echo e($password); ?>" <?php endif; ?>>
			
			<?php if(isset($errors['password'])): ?>
			<ul class="error">
				<?php $__currentLoopData = $errors['password']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<li><?php echo e($error); ?></li>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</ul>
			<?php endif; ?>
		</div>
		<p>
			<button type="submit">Login</button>
		</p>
		<p><?= $_GET['error'] ?? "" ?></p>
	</form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.page-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web development\xampp\htdocs\mvc_v2\views/account/login.blade.php ENDPATH**/ ?>