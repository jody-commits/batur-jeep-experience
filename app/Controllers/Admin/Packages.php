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
        $image2Name = null;
        $image3Name = null;
        $image4Name = null;

        $file = $this->request->getFile('thumbnail');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $thumbnailName = $file->getRandomName();
            $file->move(FCPATH . 'assets/images', $thumbnailName);
            $this->resizeImage(FCPATH . 'assets/images/' . $thumbnailName);
        } elseif ($file && !$file->isValid() && $file->getError() !== UPLOAD_ERR_NO_FILE) {
            return redirect()->back()->withInput()->with('error', 'Thumbnail upload failed: ' . $file->getErrorString());
        }
        
        $file2 = $this->request->getFile('image2');
        if ($file2 && $file2->isValid() && !$file2->hasMoved()) {
            $image2Name = $file2->getRandomName();
            $file2->move(FCPATH . 'assets/images', $image2Name);
            $this->resizeImage(FCPATH . 'assets/images/' . $image2Name);
        } elseif ($file2 && !$file2->isValid() && $file2->getError() !== UPLOAD_ERR_NO_FILE) {
            return redirect()->back()->withInput()->with('error', 'Image 2 upload failed: ' . $file2->getErrorString());
        }
        
        $file3 = $this->request->getFile('image3');
        if ($file3 && $file3->isValid() && !$file3->hasMoved()) {
            $image3Name = $file3->getRandomName();
            $file3->move(FCPATH . 'assets/images', $image3Name);
            $this->resizeImage(FCPATH . 'assets/images/' . $image3Name);
        } elseif ($file3 && !$file3->isValid() && $file3->getError() !== UPLOAD_ERR_NO_FILE) {
            return redirect()->back()->withInput()->with('error', 'Image 3 upload failed: ' . $file3->getErrorString());
        }
        
        $file4 = $this->request->getFile('image4');
        if ($file4 && $file4->isValid() && !$file4->hasMoved()) {
            $image4Name = $file4->getRandomName();
            $file4->move(FCPATH . 'assets/images', $image4Name);
            $this->resizeImage(FCPATH . 'assets/images/' . $image4Name);
        } elseif ($file4 && !$file4->isValid() && $file4->getError() !== UPLOAD_ERR_NO_FILE) {
            return redirect()->back()->withInput()->with('error', 'Image 4 upload failed: ' . $file4->getErrorString());
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
            'image2'      => $image2Name,
            'image3'      => $image3Name,
            'image4'      => $image4Name,
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
            $this->resizeImage(FCPATH . 'assets/images/' . $thumbnailName);
            $updateData['thumbnail'] = $thumbnailName;
        } elseif ($file && !$file->isValid() && $file->getError() !== UPLOAD_ERR_NO_FILE) {
            return redirect()->back()->withInput()->with('error', 'Thumbnail upload failed: ' . $file->getErrorString());
        }
        
        $file2 = $this->request->getFile('image2');
        if ($file2 && $file2->isValid() && !$file2->hasMoved()) {
            $image2Name = $file2->getRandomName();
            $file2->move(FCPATH . 'assets/images', $image2Name);
            $this->resizeImage(FCPATH . 'assets/images/' . $image2Name);
            $updateData['image2'] = $image2Name;
        } elseif ($file2 && !$file2->isValid() && $file2->getError() !== UPLOAD_ERR_NO_FILE) {
            return redirect()->back()->withInput()->with('error', 'Image 2 upload failed: ' . $file2->getErrorString());
        }
        
        $file3 = $this->request->getFile('image3');
        if ($file3 && $file3->isValid() && !$file3->hasMoved()) {
            $image3Name = $file3->getRandomName();
            $file3->move(FCPATH . 'assets/images', $image3Name);
            $this->resizeImage(FCPATH . 'assets/images/' . $image3Name);
            $updateData['image3'] = $image3Name;
        } elseif ($file3 && !$file3->isValid() && $file3->getError() !== UPLOAD_ERR_NO_FILE) {
            return redirect()->back()->withInput()->with('error', 'Image 3 upload failed: ' . $file3->getErrorString());
        }
        
        $file4 = $this->request->getFile('image4');
        if ($file4 && $file4->isValid() && !$file4->hasMoved()) {
            $image4Name = $file4->getRandomName();
            $file4->move(FCPATH . 'assets/images', $image4Name);
            $this->resizeImage(FCPATH . 'assets/images/' . $image4Name);
            $updateData['image4'] = $image4Name;
        } elseif ($file4 && !$file4->isValid() && $file4->getError() !== UPLOAD_ERR_NO_FILE) {
            return redirect()->back()->withInput()->with('error', 'Image 4 upload failed: ' . $file4->getErrorString());
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

    /**
     * Resize gambar agar tidak melebihi lebar 1200px.
     * Mencegah timeout 503 saat upload foto beresolusi tinggi ke shared hosting.
     */
    private function resizeImage(string $filePath, int $maxWidth = 1200): void
    {
        if (!file_exists($filePath)) {
            return;
        }

        try {
            $image = \Config\Services::image();

            // Perbaiki orientasi EXIF dulu (foto miring dari HP)
            $image->withFile($filePath)
                  ->reorient()
                  ->save($filePath, 90);

            // Lalu resize jika masih terlalu besar
            $info = \Config\Services::image()->withFile($filePath)->getProperties(true);
            if (isset($info['width']) && $info['width'] > $maxWidth) {
                \Config\Services::image()
                    ->withFile($filePath)
                    ->resize($maxWidth, 0, true, 'width')
                    ->save($filePath, 85);
            }
        } catch (\Throwable $e) {
            // Jika gagal, biarkan file asli tetap ada
            log_message('error', 'Image resize failed for ' . $filePath . ': ' . $e->getMessage());
        }
    }
}