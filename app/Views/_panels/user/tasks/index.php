<?= $this->extend('components/layouts/theme') ?>
<?= $this->section('content') ?>

    <div class="container py-4">
        <div class="mb-3">
            <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#addTaskModal">
                <i class="bi bi-plus-circle"></i> Add Task
            </button>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-6 mb-3">
                <div class="card shadow-sm">
                    <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Tasks</h5>
                    </div>
                    <div class="card-body">
                        <!-- Task List -->
                        <ul class="list-group">
                            <!-- Example Task Item -->
                            <?php if (!$tasks): ?>
                                <p class="text-center">No task found</p>
                            <?php endif ?>

                            <?php foreach ($tasks as $key => $value): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <?= $value['title'] ?>
                                    <p class="text-muted">
                                        <?= nl2br(ellipsize($value['description'], 100)) ?>
                                    </p>
                                </div>
                                <div>
                                    <a class="btn btn-sm btn-light" href="<?= base_url('tasks/edit/'.$value['task_id']) ?>">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                </div>
                            </li>
                            <?php endforeach ?>
                            <!-- Add dynamically generated tasks here -->
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-light text-dark d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Completed</h5>
                    </div>
                    <div class="card-body">
                        <!-- Task List -->
                        <ul class="list-group">
                            <!-- Example Task Item -->
                            <?php if (!$task_completed): ?>
                                <p class="text-center">No task found</p>
                            <?php endif ?>

                            <?php foreach ($task_completed as $key => $value): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="text-decoration-line-through"><?= $value['title'] ?></span>
                                    <p class="text-muted text-decoration-line-through">
                                        <?= nl2br($value['description']) ?>
                                    </p>
                                </div>
                                <div>
                                    <a class="btn btn-sm btn-light me-2" href="<?= base_url('tasks/edit/'.$value['task_id']) ?>">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                </div>
                            </li>
                            <?php endforeach ?>
                            <!-- Add dynamically generated tasks here -->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Task Modal -->
    <div class="modal fade" id="addTaskModal" tabindex="-1" aria-labelledby="addTaskModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTaskModalLabel">Add Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= base_url('tasks') ?>" method="post">
                    <?= csrf_field(); ?>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="taskName" class="form-label">Task Name</label>
                            <input type="text" class="form-control" id="taskName" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="taskDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="taskDescription" name="description" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Task</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Update Task Modal -->
    <div class="modal fade" id="updateTaskModal" tabindex="-1" aria-labelledby="updateTaskModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateTaskModalLabel">Update Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= base_url('tasks/update') ?>" method="post">
                    <?= csrf_field(); ?>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="editTaskName" class="form-label">Task Name</label>
                            <input type="text" class="form-control" id="editTaskName" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="editTaskDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="editTaskDescription" name="description" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update Task</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?= $this->endSection() ?>
