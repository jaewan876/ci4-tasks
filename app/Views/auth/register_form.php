<?= $this->extend('components/layouts/_theme') ?>

<?= $this->section('content') ?>

    <div class="d-flex align-items-center justify-content-center vh-100 bg-light">
        <div class="card shadow-sm p-4" style="width: 100%; max-width: 400px;">
            <h3 class="text-center mb-4">Create an Account</h3>

            <!-- Display general success or error messages -->
            <?php if (session()->has('success')): ?>
                <div class="alert alert-success">
                    <?= session()->get('success') ?>
                </div>
            <?php elseif (session()->has('errors')): ?>
                <div class="alert alert-danger">
                    <?= session()->get('errors') ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('register'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Register</button>
            </form>
            <div class="mt-3 text-center">
                <p class="mb-0">Already have an account?</p>
                <a href="<?= base_url('/'); ?>" class="text-decoration-none">
                    <i class="bi bi-box-arrow-in-right"></i> Login Here
                </a>
            </div>
        </div>
    </div>

<?= $this->endSection() ?>
