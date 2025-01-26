<?= $this->extend('components/layouts/theme') ?>

<?= $this->section('content') ?>

    <div class="container py-5">
        <?php if (!empty($task_pending)): ?>
            <div class="row mb-5">
                <?php foreach ($task_pending as $task): ?>
                    <div class="col-md-4 mb-3">
                        <div class="card task-card">
                            <div class="card-body">
                                <h6 class="card-title fw-bold"><?= esc($task['title']) ?></h6>
                                <p class="card-text text-muted"><?= nl2br($task['description'] ?: 'No description provided.') ?></p>
                                <small class="text-muted">
                                    Edited <?= date('M d, Y', strtotime($task['updated_at'])) ?>

                                    <span class="badge <?= ($task['status'] == 'completed' ? 'bg-success' : 'bg-light text-dark') ?>">
                                        <?= ucwords($task['status']) ?>
                                    </span>
                                </small>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="text-center">No tasks</p>
        <?php endif; ?>

        <?php if (!empty($task_completed)): ?>
            <div class="row mb-3">
                <h6 class="mb-3">Task completed</h6>
                <?php foreach ($task_completed as $task): ?>
                    <div class="col-md-3 mb-3">
                        <div class="card task-card">
                            <div class="card-body">
                                <h6 class="card-title text-decoration-line-through"><?= esc($task['title']) ?></h6>
                                <p class="card-text text-muted text-decoration-line-through"><?= ($task['description'] ?: 'No description') ?></p>
                                <small class="text-muted">
                                    Edited <?= date('M d, Y', strtotime($task['updated_at'])) ?>
                                    <span class="badge <?= ($task['status'] == 'completed' ? 'bg-success' : 'bg-light text-dark') ?>">
                                        <?= ucwords($task['status']) ?>
                                    </span>
                                </small>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="text-center text-muted">No task completed</p>
        <?php endif; ?>
    </div>

    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .task-card {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            transition: transform 0.2s;
        }
        .task-card:hover {
            transform: scale(1.02);
        }
    </style>

<?= $this->endSection() ?>



   