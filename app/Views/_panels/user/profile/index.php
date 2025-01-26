<?= $this->extend('components/layouts/theme') ?> 
<?= $this->section('content') ?> 
<div class="container py-5">
    <div class="row">
        <!-- Profile Card -->
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <img src="https://ui-avatars.com/api/name=<?= urlencode($user['username']) ?>" alt="Avatar" class="rounded-circle mb-3" width="150" height="150">
                    <h4 class="mb-0"> <?= esc($user['username'] ?? '-') ?> </h4>
                    <p class="text-muted"> <?= esc($user['email'] ?? '-') ?> </p>
                    <a href="<?= base_url('/logout') ?>" class="btn btn-danger btn-sm">
                        <i class="bi bi-box-arrow-right"></i> Logout 
                    </a>
                </div>
            </div>
        </div>
        <!-- Profile Details -->
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-light text-dark">
                    <h5 class="mb-0">Profile Details</h5>
                </div>
                <div class="card-body">
                    <?php if (session()->has('errors')): ?>
                        <div class="alert alert-danger">
                            <?= session()->get('errors') ?>
                        </div>
                    <?php endif; ?>

                    <?php if (session()->has('success')): ?>
                        <div class="alert alert-success">
                            <?= session()->get('success') ?>
                        </div>
                    <?php endif; ?>

                    <div class="row">
                        <div class="col-md-6">
                            <form action="<?= base_url('profile/update/'.session()->get('user.user_id')) ?>" method="post">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Full Name</label>
                                    <input type="text" class="form-control" id="name" name="fullname" value="<?= esc($user['fullname'] ?? '') ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="bio" class="form-label">Bio</label>
                                    <textarea class="form-control" id="bio" name="bio" rows="3"><?= esc($user['bio'] ?? '') ?></textarea>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-save"></i> Save Changes 
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <form action="<?= base_url('profile/update/'.session()->get('user.user_id')) ?>" method="post">
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password">
                                </div>
                                <div class="mb-3">
                                    <label for="password_confirm" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" id="password_confirm" name="password_confirm">
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-save"></i> Save Changes 
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div> 
</div>
<?= $this->endSection() ?>