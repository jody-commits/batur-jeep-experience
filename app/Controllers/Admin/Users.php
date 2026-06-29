<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

/**
 * Controller: Admin\Users
 * Admin Area: Manage Users
 */
class Users extends BaseController
{
    public function index(): string
    {
        $adminName = session()->get('user_name') ?? 'Administrator';

        $stats = [
            'total' => '1,284',
            'active' => 342,
            'admins' => 12,
        ];

        $users = [
            [
                'name' => 'Budi Santoso',
                'email' => 'budi.s@example.com',
                'role' => 'ADMIN',
                'status' => 'Active',
                'join_date' => '12 Jan 2024',
                'avatar' => 'user-avatar.png',
            ],
            [
                'name' => 'Sarah Lee',
                'email' => 'sarah.lee@web.com',
                'role' => 'USER',
                'status' => 'Active',
                'join_date' => '05 Feb 2024',
                'avatar' => 'default-avatar-f.png',
            ],
            [
                'name' => 'Made Ari',
                'email' => 'ari.made@bali.id',
                'role' => 'GUIDE',
                'status' => 'Inactive',
                'join_date' => '15 Dec 2023',
                'avatar' => 'default-avatar-m.png',
            ],
        ];

        return view('admin/users', [
            'page_title' => 'Manage Users',
            'admin_name' => $adminName,
            'stats' => $stats,
            'users' => $users,
        ]);
    }
}