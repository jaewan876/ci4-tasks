<?= $this->extend('components/layouts/theme') ?>
<?= $this->section('content') ?>

	<div class="container py-5">
        <h1 class=""><?= esc($task['title']) ?></h1>

        <div class="row">
            <div class="col-md-6 g-3">
                <p>
                    <small class="text-muted">
                        Edited <?= date('M d, Y', strtotime($task['updated_at'])) ?>

                        <span class="badge <?= ($task['status'] == 'completed' ? 'bg-success' : 'bg-light text-dark') ?>">
                            <?= ucwords($task['status']) ?>
                        </span>
                    </small>
                </p>
                <div class="wrap">
                    <?= $task['description'] ?>
                </div>
            </div>
            <div class="col-md-6">
                <?php if (session()->get('errors')): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php foreach (session()->get('errors') as $error): ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('/tasks/update/' . $task['task_id']) ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" name="title" id="title" class="form-control" value="<?= esc($task['title']) ?>" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="editor" class="form-label">Description</label>
                                <textarea name="description" id="editor" class="form-control" rows="10"><?= htmlspecialchars($task['description']) ?></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" id="status" class="form-control" required>
                                    <option value="pending" <?= $task['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                                    <option value="completed" <?= $task['status'] == 'completed' ? 'selected' : '' ?>>Completed</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="task_position" class="form-label">Position</label>
                                <input type="number" name="position" id="task_position" class="form-control" value="<?= esc($task['position']) ?>" required>
                            </div>
                        </div>
                    </div>

                    <div class="">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="<?= base_url('/tasks') ?>" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>

        
   </div>

<?= $this->endSection() ?>