
<?php

class AccountController extends Controller
{
    public function profile(): void
    {
        Auth::requireLogin();

        // Lấy thông tin người dùng từ session
        $sessionUser = Auth::user() ?? [];

        $userId = (int)($sessionUser['id'] ?? 0);

        // Tìm người dùng trong database
        $user = null;

        if ($userId > 0) {
            $user = User::find($userId);
        }

        // Nếu database không tìm thấy thì lấy dữ liệu session
        if (!$user) {
            $user = [
                'id' => $userId,
                'name' => $sessionUser['name'] ?? '',
                'email' => $sessionUser['email'] ?? '',
                'role' => $sessionUser['role'] ?? 'customer'
            ];
        }

        // Xử lý cập nhật hồ sơ
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            verify_csrf($_POST['csrf_token'] ?? '');

            $name = trim($_POST['name'] ?? '');

            if ($name === '') {
                flash('error', 'Họ tên không được để trống.');
                $this->redirect('account/profile');
            }

            if (mb_strlen($name, 'UTF-8') < 2) {
                flash('error', 'Họ tên phải có ít nhất 2 ký tự.');
                $this->redirect('account/profile');
            }

            // Kiểm tra tài khoản trong database
            $checkUser = User::find($userId);

            if (!$checkUser) {
                flash('error', 'Không tìm thấy tài khoản trong hệ thống.');
                $this->redirect('account/profile');
            }

            // Cập nhật database
            User::update($userId, [
                'name' => $name
            ]);

            // Cập nhật session
            $_SESSION['user']['name'] = $name;

            flash('success', 'Cập nhật hồ sơ thành công.');

            $this->redirect('account/profile');
        }

        // Hiển thị trang hồ sơ
        $this->view('account/profile', [
            'pageTitle' => 'Hồ sơ cá nhân',
            'user' => $user
        ]);
    }
}
