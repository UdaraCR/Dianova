<?=  $this->extend('layouts/default.php') ?>
<?=  $this->section('section') ?>

<div class="container mt-5 bg-light p-5 rounded shadow">
    <h1 class="text-secondary text-center fw-bold">Login Now</h2>
    
    <form action="<?= base_url('doLogin') ?>" method="post">
        <div class="form-group mb-3">
            <label for="">Email</label>
            <input type="text" class="form-control" name="email" required>
        </div>
        <div class="form-group  mb-3">
            <label for="">Password</label>
            <input type="password" class="form-control" name="password" required>
        </div>       
        <button type="submit" class="btn btn-primary mb-3">Login</button>
    </form>

    Don't have an account? <a href="<?= base_url('register') ?>">Register Here</a>

    <?php if (isset($validation)): ?>
        <div class="alert alert-danger mt-3" role="alert">
            <?= $validation->listErrors() ?>
        </div>
    <?php endif; ?>
</div>

<?=  $this->endSection() ?>
