<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ReviewModel;

class Reviews extends BaseController
{
    protected ReviewModel $reviewModel;

    public function __construct()
    {
        $this->reviewModel = new ReviewModel();
    }

    public function index()
    {
        $data = [
            'title'   => 'Manage Reviews',
            'reviews' => $this->reviewModel->orderBy('created_at', 'DESC')->findAll(),
            'adminName' => session()->get('user_name') ?? 'Administrator'
        ];

        return view('admin/reviews', $data);
    }

    public function updateStatus($id)
    {
        $status = $this->request->getPost('status');
        if (in_array($status, ['pending', 'approved', 'rejected'])) {
            $this->reviewModel->update($id, ['status' => $status]);
            return redirect()->to('/admin/reviews')->with('success', 'Review status updated successfully.');
        }
        return redirect()->to('/admin/reviews')->with('error', 'Invalid status.');
    }

    public function delete($id)
    {
        $this->reviewModel->delete($id);
        return redirect()->to('/admin/reviews')->with('success', 'Review deleted successfully.');
    }
}
