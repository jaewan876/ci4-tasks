<?= $this->extend('components/layouts/_theme') ?>

<?= $this->section('content') ?>

	<div class="d-flex align-items-center justify-content-center vh-100 bg-light">
		<div class="card shadow-sm p-4" style="width: 100%; max-width: 400px;">
	        <h3 class="text-center mb-4">Login</h3>

	        <!-- Display success or error messages -->
		    <?php if (session()->get('success')): ?>
		        <div class="alert alert-success">
		            <?= session()->get('success') ?>
		        </div>
		    <?php elseif (session()->get('errors')): ?>
		        <div class="alert alert-danger">
		            <?= session()->get('errors') ?>
		        </div>
		    <?php endif; ?>

	        <form action="<?= base_url('login'); ?>" method="post">
	            <?= csrf_field(); ?>
	            <div class="mb-3">
	                <label for="username" class="form-label">Username</label>
	                <input type="text" class="form-control" id="username" name="username" required>
	            </div>
	            <div class="mb-3">
	                <label for="password" class="form-label">Password</label>
	                <input type="password" class="form-control" id="password" name="password" required>
	            </div>
	            <button type="submit" class="btn btn-primary w-100">Login</button>
	        </form>
	        <div class="mt-3 text-center">
	            <p class="mb-0">Don't have an account?</p>
	            <a href="<?= base_url('register'); ?>" class="text-decoration-none">
	                <i class="bi bi-person-plus"></i> Create an Account
	            </a>
	        </div>
	    </div>
	</div>
	
<?= $this->endSection() ?>