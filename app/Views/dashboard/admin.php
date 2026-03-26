<?= $this->extend('layouts/default.php') ?>
<?= $this->section('section') ?>

<div class="container mt-5">

    <div class="text-center mb-4">
        <h2 class="fw-bold">Dashboard</h2>
        </p>
    </div>

    <hr class="mb-4">

    <!-- Summary Cards -->
    <div class="row g-4 align-items-stretch mb-5">
        <div class="col-md-4 d-flex">
            <div class="card shadow-sm w-100 h-100 text-center">
                <div class="card-body d-flex flex-column justify-content-center">
                    <h5 class="card-title">Total Readings</h5>
                    <h2 class="fw-bold"><?= esc($total ?? 0) ?></h2>
                </div>
            </div>
        </div>

        <div class="col-md-4 d-flex">
            <div class="card shadow-sm w-100 h-100 text-center">
                <div class="card-body d-flex flex-column justify-content-center">
                    <h5 class="card-title">Average Sugar</h5>
                    <h2 class="fw-bold"><?= esc($average ?? 0) ?></h2>
                </div>
            </div>
        </div>

        <div class="col-md-4 d-flex">
            <div class="card shadow-sm w-100 h-100 text-center">
                <div class="card-body d-flex flex-column justify-content-center">
                    <h5 class="card-title">Latest Reading</h5>
                    <h2 class="fw-bold"><?= esc($latest ?? 'No data') ?></h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Feature Cards -->
    <div class="row g-4 align-items-stretch">

        <div class="col-md-4 d-flex">
            <div class="card dashboard-card bg-gradient-success text-white shadow w-100 h-100">
                <div class="card-body d-flex flex-column text-center">
                    <h5 class="card-title">Blood Glucose Levels</h5>
                    <p class="card-text flex-grow-1">
                        Blood glucose levels are a measure of the amount of glucose present in the blood.
                        They are typically measured in milligrams per deciliter (mg/dL) or millimoles per liter (mmol/L).
                        Normal blood glucose levels can vary depending on factors such as age, time of day, and whether you
                        have eaten recently. Generally, fasting blood glucose levels should be between 70 and 99 mg/dL
                        (3.9 to 5.5 mmol/L), while post-meal levels should be less than 140 mg/dL (7.8 mmol/L).
                    </p>
                    <a href="<?= base_url('dashboard/sugar') ?>" class="btn btn-primary mt-auto">View Details</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 d-flex">
            <div class="card dashboard-card bg-gradient-success text-white shadow w-100 h-100">
                <div class="card-body d-flex flex-column text-center">
                    <h5 class="card-title">Nutrition Table</h5>
                    <p class="card-text flex-grow-1">
                        Nutrition is the process by which organisms take in and utilize food substances. It involves
                        the intake of nutrients such as carbohydrates, proteins, fats, vitamins, and minerals that are
                        essential for growth, energy production, and overall health. Proper nutrition is crucial for
                        maintaining a healthy body and preventing various diseases.
                    </p>
                    <a href="<?= base_url('dashboard/nutrition') ?>" class="btn btn-primary mt-auto">View Details</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 d-flex">
            <div class="card dashboard-card bg-gradient-success text-white shadow w-100 h-100">
                <div class="card-body d-flex flex-column text-center">
                    <h5 class="card-title">Exercise Routines</h5>
                    <p class="card-text flex-grow-1">
                        Exercise routines are structured plans of physical activities designed to improve fitness,
                        health, and overall well-being. They can include a variety of exercises such as cardiovascular
                        workouts, strength training, flexibility exercises, and balance training. Regular exercise
                        routines can help manage weight, reduce the risk of chronic diseases, improve mental health,
                        and enhance quality of life.
                    </p>
                    <a href="<?= base_url('dashboard/exercise') ?>" class="btn btn-primary mt-auto">View Details</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 d-flex">
            <div class="card dashboard-card bg-gradient-success text-white shadow w-100 h-100">
                <div class="card-body d-flex flex-column text-center">
                    <h5 class="card-title">Medication Management</h5>
                    <p class="card-text flex-grow-1">
                        Medication management is the process of overseeing and coordinating the use of medications to
                        ensure they are used safely and effectively. It involves tasks such as prescribing, dispensing,
                        administering, and monitoring medications. Proper medication management can help prevent
                        medication errors, improve patient outcomes, and enhance the overall quality of care.
                    </p>
                    <a href="<?= base_url('dashboard/medication') ?>" class="btn btn-primary mt-auto">View Details</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 d-flex">
            <div class="card dashboard-card bg-gradient-success text-white shadow w-100 h-100">
                <div class="card-body d-flex flex-column text-center">
                    <h5 class="card-title">Health Advice & Support</h5>
                    <p class="card-text flex-grow-1">
                        Health advice is guidance provided by healthcare professionals to help individuals maintain
                        or improve their health. It can include recommendations on diet, exercise, stress management,
                        and other lifestyle factors that contribute to overall well-being.
                    </p>
                    <a href="<?= base_url('dashboard/healthAdvice') ?>" class="btn btn-primary mt-auto">View Details</a>
                </div>
            </div>
        </div>

    </div>

</div>

<?= $this->endSection() ?>