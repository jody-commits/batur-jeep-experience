<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

/**
 * Controller: Admin\Users
 * Admin Area: Manage Users
 */
class Users extends BaseController
{
    public function index(): string
    {
        $adminName = session()->get('user_name') ?? 'Administrator';

        $userModel = new UserModel();
        $dbUsers = $userModel->withDeleted()->findAll();

        $total = 0;
        $active = 0;
        $admins = 0;
        $users = [];

        foreach ($dbUsers as $u) {
            $total++;
            if ($u['is_active'] == 1 && empty($u['deleted_at'])) $active++;
            if ($u['role'] === 'admin') $admins++;

            $users[] = [
                'name' => $u['name'],
                'email' => $u['email'],
                'role' => strtoupper($u['role']),
                'status' => (!empty($u['deleted_at'])) ? 'Deleted' : ($u['is_active'] == 1 ? 'Active' : 'Inactive'),
                'join_date' => date('d M Y', strtotime($u['created_at'])),
                'avatar' => 'default-avatar.png', // Will use UI-avatars fallback
            ];
        }

        $stats = [
            'total' => number_format($total),
            'active' => number_format($active),
            'admins' => number_format($admins),
        ];

        return view('admin/users', [
            'page_title' => 'Manage Users',
            'admin_name' => $adminName,
            'stats' => $stats,
            'users' => $users,
        ]);
    }
}