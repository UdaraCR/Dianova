<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dianova</title>

    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/icons/bootstrap-icons.css') ?>">

    <style>
        body {
            background: #f4f6f9;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .main-wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 260px;
            background: linear-gradient(180deg, #1f1f1f, #2d2d2d);
            color: #fff;
            padding: 25px 15px;
            box-shadow: 2px 0 10px rgba(0,0,0,0.15);
        }

        .sidebar h3 {
            font-weight: bold;
            text-align: center;
            margin-bottom: 30px;
            color: #fff;
        }

        .sidebar .nav-link {
            color: #dcdcdc;
            padding: 12px 15px;
            border-radius: 10px;
            margin-bottom: 10px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 15px;
        }

        .sidebar .nav-link:hover {
            background: rgba(255,255,255,0.1);
            color: #fff;
            transform: translateX(5px);
        }

        .sidebar .nav-link.active {
            background: #0d6efd;
            color: #fff;
        }

        /* Content area */
        .content-area {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        /* Topbar */
        .topbar {
            background: #ffffff;
            padding: 15px 30px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .topbar h4 {
            margin: 0;
            font-weight: 600;
            color: #333;
        }

        .topbar .user-info {
            font-size: 14px;
            color: #666;
        }

        .page-content {
            padding: 30px;
        }

        /* Dashboard cards */
        .dashboard-card {
            border: none;
            border-radius: 18px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
        }

        .dashboard-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 28px rgba(0,0,0,0.18);
        }

        .bg-gradient-primary {
            background: linear-gradient(135deg, #4e73df, #224abe);
            color: white;
        }

        .bg-gradient-success {
            background: linear-gradient(135deg, #1cc88a, #13855c);
            color: white;
        }

        .bg-gradient-warning {
            background: linear-gradient(135deg, #f6c23e, #dda20a);
            color: #212529;
        }

        .bg-gradient-danger {
            background: linear-gradient(135deg, #e74a3b, #be2617);
            color: white;
        }

        /* Mobile */
        @media (max-width: 991px) {
            .main-wrapper {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                box-shadow: none;
            }

            .topbar {
                padding: 15px 20px;
            }

            .page-content {
                padding: 20px;
            }
        }

        .dashboard-card .card-text {
            min-height: 220px;
        }
    </style>
</head>
<body>

<div class="main-wrapper">

    <!-- Sidebar -->
    <aside class="sidebar">
        <h3><i class="bi bi-heart-pulse-fill"></i> Dianova</h3>

        <nav class="nav flex-column">
            <a href="<?= base_url('dashboard') ?>" class="nav-link">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>

            <a href="<?= base_url('dashboard/sugar') ?>" class="nav-link">
                <i class="bi bi-droplet-half"></i> Sugar Levels
            </a>

            <a href="<?= base_url('dashboard/nutrition') ?>" class="nav-link">
                <i class="bi bi-egg-fried"></i> Nutrition Table
            </a>

            <a href="<?= base_url('dashboard/exercise') ?>" class="nav-link">
                <i class="bi bi-activity"></i> Exercise
            </a>

            <a href="<?= base_url('dashboard/medication') ?>" class="nav-link">
                <i class="bi bi-capsule-pill"></i> Medication
            </a>

            <a href="<?= base_url('dashboard/healthAdvice') ?>" class="nav-link">
                <i class="bi bi-chat-dots"></i> Advice & Support
            </a>

            <hr class="text-light">

            <a href="<?= base_url('logout') ?>" class="nav-link">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>
        </nav>
    </aside>

    <!-- Main content -->
    <div class="content-area">

        <!-- Topbar -->
        <div class="topbar">
            <h4>Blood Sugar Monitor System</h4>
            <div class="user-info">
                Welcome, <strong><?= session()->get('username') ?></strong>
                <?php if (session()->get('role')): ?>
                    | Role: <strong><?= session()->get('role') ?></strong>
                <?php endif; ?>
            </div>
        </div>

        <!-- Page content -->
        <main class="page-content">
            <?= $this->renderSection('section') ?>
        </main>
    </div>

</div>

<script src="<?= base_url('assets/js/bootstrap.bundle.js') ?>"></script>
</body>
</html>