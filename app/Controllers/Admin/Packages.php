<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PackageModel;

/**
 * Controller: Admin\Packages
 * Admin Area: Manage Packages
 */
class Packages extends BaseController
{
    protected PackageModel $packageModel;

    public function __construct()
    {
        $this->packageModel = new PackageModel();
    }

    public function index(): string
    {
        $adminName = session()->get('user_name') ?? 'Administrator';

        // Fetch dari Database
        $dbPackages = $this->packageModel->findAll();
        
        $total = count($dbPackages);
        $active = 0;
        $pickup = 0;

        $packages = [];
        foreach ($dbPackages as $pkg) {
            if ($pkg['is_active'] == 1) $active++;
            if ($pkg['is_pickup'] == 1) $pickup++;

            $packages[] = [
                'id'        => $pkg['id'],
                'title'     => $pkg['name'],
                'price'     => 'Rp ' . number_format((float) $pkg['price'], 0, ',', '.'),
                'desc'      => substr($pkg['description'], 0, 80) . '...',
                'duration'  => $pkg['duration'],
                'pickup_time'=> $pkg['pickup_time'] ?? '-',
                'guests'    => 'Max ' . $pkg['max_persons'] . ' guests',
                'image'     => $pkg['thumbnail'] ?? 'custom-tour.jpg',
                'is_active' => $pkg['is_active'] == 1,
                'is_pickup' => $pkg['is_pickup'] == 1,
            ];
        }

        $stats = [
            'total'  => $total,
            'active' => $active,
            'pickup' => $pickup,
        ];

        return view('admin/packages', [
            'page_title' => 'Manage Packages',
            'admin_name' => $adminName,
            'stats'      => $stats,
            'packages'   => $packages,
        ]);
    }

    public function create(): string
    {
        $adminName = session()->get('user_name') ?? 'Administrator';
        return view('admin/packages_form', [
            'page_title' => 'Add New Package',
            'admin_name' => $adminName,
            'package'    => null, // Null means create mode
        ]);
    }

    public function store()
    {
        $rules = [
            'name'        => 'required|min_length[3]|max_length[150]',
            'price'       => 'required|numeric',
            'duration'    => 'required|max_length[50]',
            'max_persons' => 'required|integer',
            'description' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $thumbnailName = 'custom-tour.jpg'; // hardcoded default
        $file = $this->request->getFile('thumbnail');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $thumbnailName = $file->getRandomName();
            $file->move(FCPATH . 'assets/images', $thumbnailName);
        }

        $this->packageModel->save([
            'name'        => $this->request->getPost('name'),
            'price'       => $this->request->getPost('price'),
            'duration'    => $this->request->getPost('duration'),
            'max_persons' => $this->request->getPost('max_persons'),
            'description' => $this->request->getPost('description'),
            'pickup_time' => $this->request->getPost('pickup_time'),
            'is_active'   => $this->request->getPost('is_active') ? 1 : 0,
            'is_pickup'   => $this->request->getPost('is_pickup') ? 1 : 0,
            'thumbnail'   => $thumbnailName,
        ]);

        return redirect()->to('/admin/packages')->with('message', 'Package created successfully.');
    }

    public function edit($id): string|\CodeIgniter\HTTP\RedirectResponse
    {
        $package = $this->packageModel->find($id);
        if (!$package) {
            return redirect()->to('/admin/packages')->with('error', 'Package not found.');
        }

        $adminName = session()->get('user_name') ?? 'Administrator';
        return view('admin/packages_form', [
            'page_title' => 'Edit Package',
            'admin_name' => $adminName,
            'package'    => $package,
        ]);
    }

    public function update($id)
    {
        $package = $this->packageModel->find($id);
        if (!$package) {
            return redirect()->to('/admin/packages')->with('error', 'Package not found.');
        }

        $rules = [
            'name'        => 'required|min_length[3]|max_length[150]',
            'price'       => 'required|numeric',
            'duration'    => 'required|max_length[50]',
            'max_persons' => 'required|integer',
            'description' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $updateData = [
            'name'        => $this->request->getPost('name'),
            'price'       => $this->request->getPost('price'),
            'duration'    => $this->request->getPost('duration'),
            'max_persons' => $this->request->getPost('max_persons'),
            'description' => $this->request->getPost('description'),
            'pickup_time' => $this->request->getPost('pickup_time'),
            'is_active'   => $this->request->getPost('is_active') ? 1 : 0,
            'is_pickup'   => $this->request->getPost('is_pickup') ? 1 : 0,
        ];

        $file = $this->request->getFile('thumbnail');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $thumbnailName = $file->getRandomName();
            $file->move(FCPATH . 'assets/images', $thumbnailName);
            $updateData['thumbnail'] = $thumbnailName;
        }

        $this->packageModel->update($id, $updateData);

        return redirect()->to('/admin/packages')->with('message', 'Package updated successfully.');
    }

    public function delete($id)
    {
        $package = $this->packageModel->find($id);
        if (!$package) {
            return redirect()->to('/admin/packages')->with('error', 'Package not found.');
        }

        $this->packageModel->delete($id);
        return redirect()->to('/admin/packages')->with('message', 'Package deleted successfully.');
    }
}