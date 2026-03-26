<?= $this->extend('layouts/default.php') ?>
<?= $this->section('section') ?>

<div class="container mt-5">

    <!-- HEADER -->
    <div class="text-center mb-4">
        <h2 class="fw-bold">🩸 Blood Glucose Monitor</h2>
        <p class="text-muted">Track and manage your sugar levels</p>
    </div>

    <!-- ADD FORM -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <h5>Add New Reading</h5>

            <form action="<?= base_url('sugar/store') ?>" method="post" class="row g-3">

                <div class="col-md-5">
                    <input type="number" name="level" class="form-control" placeholder="Glucose Level (mg/dL)" required>
                </div>

                <div class="col-md-5">
                    <input type="datetime-local" name="recorded_at" class="form-control" required>
                </div>

                <div class="col-md-2 d-grid">
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>

            </form>
        </div>
    </div>

    <!-- TABLE -->
    <div class="card shadow">
        <div class="card-body">

            <h5 class="mb-3">Your Records</h5>

            <div class="table-responsive">
                <table class="table table-bordered table-hover text-center">

                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Level(mg/dL)</th>
                            <th>Date & Time</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if (!empty($sugarData)): ?>
                            <?php foreach ($sugarData as $row): ?>
                                <tr>
                                    <td><?= $row['id'] ?></td>
                                    <td>
                                        <?php if ($row['level'] > 180): ?>
                                            <span class="badge bg-danger"><?= $row['level'] ?></span>
                                        <?php elseif ($row['level'] < 70): ?>
                                            <span class="badge bg-warning text-dark"><?= $row['level'] ?></span>
                                        <?php else: ?>
                                            <span class="badge bg-success"><?= $row['level'] ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= $row['recorded_at'] ?></td>
                                    <td>
                                        <a href="<?= base_url('sugar/edit/'.$row['id']) ?>" class="btn btn-sm btn-warning">Edit</a>
                                        <a href="<?= base_url('sugar/delete/'.$row['id']) ?>" 
                                           class="btn btn-sm btn-danger"
                                           onclick="return confirm('Delete this record?')">
                                           Delete
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4">No records found</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>

                </table>
            </div>

        </div>
    </div>

</div>

<?= $this->endSection() ?>