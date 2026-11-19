
<?php
$user = $user ?? [];

$name = $user['name'] ?? '';
$email = $user['email'] ?? '';
$role = $user['role'] ?? 'customer';
?>

<div class="container mt-4">

    <div class="form-section col-md-7 mx-auto">

        <h3 class="mb-4">Hồ sơ cá nhân</h3>

        <form method="POST">

            <?= csrf_field() ?>

            <div class="mb-3">

                <label class="form-label">
                    Họ tên
                </label>

                <input
                    type="text"
                    class="form-control"
                    name="name"
                    value="<?= e($name) ?>"
                    placeholder="Nhập họ tên"
                    required
                >

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Email
                </label>

                <input
                    type="email"
                    class="form-control"
                    value="<?= e($email) ?>"
                    readonly
                >

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Vai trò
                </label>

                <input
                    type="text"
                    class="form-control"
                    value="<?= e($role) ?>"
                    readonly
                >

            </div>

            <button
                type="submit"
                class="btn btn-primary"
            >
                Lưu hồ sơ
            </button>

            <a
                href="<?= base_url('') ?>"
                class="btn btn-secondary"
            >
                Quay lại
            </a>

        </form>

    </div>

</div>
