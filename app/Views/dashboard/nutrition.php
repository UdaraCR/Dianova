<?= $this->extend('layouts/default.php') ?>
<?= $this->section('section') ?>

<div class="container mt-5">
    <div class="text-center mb-4">
        <h2 class="fw-bold">Nutrition Table</h2>
        <p class="text-muted">Search food nutrition values like calories, carbs, sugar, protein, and fat</p>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="get" action="<?= base_url('dashboard/nutrition') ?>" class="row g-3 position-relative" autocomplete="off">
                <div class="col-md-10 position-relative">
                    <input
                        type="text"
                        id="foodSearch"
                        name="q"
                        class="form-control"
                        placeholder="Search food e.g. apple, rice, milk"
                        value="<?= esc($query ?? '') ?>"
                        required
                    >

                    <div id="suggestionsBox" class="list-group position-absolute w-100 shadow-sm" style="z-index: 1000; top: 100%; display: none;"></div>
                </div>

                <div class="col-md-2 d-grid">
                    <button type="submit" class="btn btn-success">Search</button>
                </div>
            </form>
        </div>
    </div>

    <?php if (!empty($error)): ?>
        <div class="alert alert-warning">
            <?= esc($error) ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($results)): ?>
        <div class="card shadow">
            <div class="card-body">
                <h5 class="mb-3">Search Results for: <strong><?= esc($query) ?></strong></h5>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover text-center align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>Food Name</th>
                                <th>Brand</th>
                                <th>Calories</th>
                                <th>Carbs (g)</th>
                                <th>Sugar (g)</th>
                                <th>Protein (g)</th>
                                <th>Fat (g)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($results as $food): ?>
                                <tr>
                                    <td><?= esc($food['name']) ?></td>
                                    <td><?= esc($food['brand']) ?></td>
                                    <td><?= esc($food['calories']) ?></td>
                                    <td><?= esc($food['carbs']) ?></td>
                                    <td><?= esc($food['sugar']) ?></td>
                                    <td><?= esc($food['protein']) ?></td>
                                    <td><?= esc($food['fat']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    <?php endif; ?>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('foodSearch');
    const suggestionsBox = document.getElementById('suggestionsBox');
    let debounceTimer;

    input.addEventListener('keyup', function () {
        const term = input.value.trim();

        clearTimeout(debounceTimer);

        if (term.length < 2) {
            suggestionsBox.style.display = 'none';
            suggestionsBox.innerHTML = '';
            return;
        }

        debounceTimer = setTimeout(() => {
            fetch(`<?= base_url('dashboard/nutrition-suggest') ?>?term=${encodeURIComponent(term)}`)
                .then(response => response.json())
                .then(data => {
                    suggestionsBox.innerHTML = '';

                    if (data.length === 0) {
                        suggestionsBox.style.display = 'none';
                        return;
                    }

                    data.forEach(item => {
                        const option = document.createElement('button');
                        option.type = 'button';
                        option.className = 'list-group-item list-group-item-action';
                        option.textContent = item.label;

                        option.addEventListener('click', function () {
                            input.value = item.value;

                            suggestionsBox.style.display = 'none';
                            suggestionsBox.innerHTML = '';
                            input.closest('form').submit(); // Automatically submit the form after selection                  
                        });

                        suggestionsBox.appendChild(option);
                    });

                    suggestionsBox.style.display = 'block';
                })
                .catch(() => {
                    suggestionsBox.style.display = 'none';
                });
        }, 300);
    });

    document.addEventListener('click', function (e) {
        if (!suggestionsBox.contains(e.target) && e.target !== input) {
            suggestionsBox.style.display = 'none';
        }
    });
});
</script>

<?= $this->endSection() ?>