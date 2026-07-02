<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<div class="admin-header-actions">
    <a href="<?= base_url('admin/packages') ?>" class="admin-btn-primary" style="background: var(--admin-sidebar-bg); text-decoration: none;">
        <i class="fa-solid fa-arrow-left"></i> BACK TO PACKAGES
    </a>
</div>

<div class="admin-card" style="max-width: 800px; margin: 0 auto;">
    <div class="admin-card__header">
        <h2 class="admin-card__title"><?= esc($page_title) ?></h2>
    </div>
    
    <div class="admin-card__body">
        <?php if (session()->getFlashdata('errors')): ?>
            <div style="background: #fee2e2; color: #b91c1c; padding: 1rem; border-radius: 4px; margin-bottom: 1.5rem;">
                <ul style="margin: 0; padding-left: 1.5rem;">
                <?php foreach (session()->getFlashdata('errors') as $err): ?>
                    <li><?= esc($err) ?></li>
                <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?= base_url($package ? 'admin/packages/update/'.$package['id'] : 'admin/packages/store') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            
            <div style="margin-bottom: 1.25rem;">
                <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: var(--admin-text-main);">Package Name <span style="color:red;">*</span></label>
                <input type="text" name="name" value="<?= old('name', $package['name'] ?? '') ?>" style="width: 100%; padding: 0.75rem; border: 1px solid var(--admin-border); border-radius: 4px;" required>
            </div>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1.25rem; margin-bottom: 1.25rem;">
                <div>
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: var(--admin-text-main);">Price (IDR) <span style="color:red;">*</span></label>
                    <input type="number" name="price" value="<?= old('price', $package['price'] ?? '') ?>" style="width: 100%; padding: 0.75rem; border: 1px solid var(--admin-border); border-radius: 4px;" required>
                </div>
                <div>
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: var(--admin-text-main);">Pricing Type <span style="color:red;">*</span></label>
                    <select name="pricing_type" style="width: 100%; padding: 0.75rem; border: 1px solid var(--admin-border); border-radius: 4px; background: #fff;" required>
                        <option value="per_jeep" <?= old('pricing_type', $package['pricing_type'] ?? 'per_jeep') == 'per_jeep' ? 'selected' : '' ?>>Per Jeep / Group</option>
                        <option value="per_pax" <?= old('pricing_type', $package['pricing_type'] ?? '') == 'per_pax' ? 'selected' : '' ?>>Per Person (Per Pax)</option>
                    </select>
                </div>
                <div>
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: var(--admin-text-main);">Max Persons <span style="color:red;">*</span></label>
                    <input type="number" name="max_persons" value="<?= old('max_persons', $package['max_persons'] ?? '') ?>" style="width: 100%; padding: 0.75rem; border: 1px solid var(--admin-border); border-radius: 4px;" required>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; margin-bottom: 1.25rem;">
                <div>
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: var(--admin-text-main);">Duration <span style="color:red;">*</span></label>
                    <input type="text" name="duration" value="<?= old('duration', $package['duration'] ?? '') ?>" placeholder="e.g. 4 Jam, 1 Hari" style="width: 100%; padding: 0.75rem; border: 1px solid var(--admin-border); border-radius: 4px;" required>
                </div>
                <div>
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: var(--admin-text-main);">Pickup Time</label>
                    <input type="text" name="pickup_time" value="<?= old('pickup_time', $package['pickup_time'] ?? '') ?>" placeholder="e.g. 03:00 AM" style="width: 100%; padding: 0.75rem; border: 1px solid var(--admin-border); border-radius: 4px;">
                </div>
            </div>

            <div style="margin-bottom: 1.25rem;">
                <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: var(--admin-text-main);">Description <span style="color:red;">*</span></label>
                <textarea name="description" rows="5" style="width: 100%; padding: 0.75rem; border: 1px solid var(--admin-border); border-radius: 4px;" required><?= old('description', $package['description'] ?? '') ?></textarea>
            </div>
            
            <div style="margin-bottom: 1.25rem;">
                <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: var(--admin-text-main);">Package Image (Main / Thumbnail)</label>
                <input type="file" name="thumbnail" accept="image/png, image/jpeg, image/webp" style="width: 100%; padding: 0.5rem; border: 1px solid var(--admin-border); border-radius: 4px; background: #fff;">
                <?php if ($package && !empty($package['thumbnail'])): ?>
                    <div style="margin-top: 0.5rem; font-size: 0.85rem; color: var(--admin-text-mut);">
                        Current image: <?= esc($package['thumbnail']) ?>
                    </div>
                <?php endif; ?>
                <div style="font-size: 0.8rem; color: var(--admin-text-light); margin-top: 0.25rem;">Leave empty to keep current image (if editing) or use default. Max size: 2MB.</div>
            </div>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1.25rem; margin-bottom: 1.25rem;">
                <!-- Image 2 -->
                <div>
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: var(--admin-text-main);">Gallery Image 2</label>
                    <input type="file" name="image2" accept="image/png, image/jpeg, image/webp" style="width: 100%; padding: 0.5rem; border: 1px solid var(--admin-border); border-radius: 4px; background: #fff;">
                    <?php if ($package && !empty($package['image2'])): ?>
                        <div style="margin-top: 0.5rem; font-size: 0.85rem; color: var(--admin-text-mut);">
                            Current: <?= esc($package['image2']) ?>
                        </div>
                    <?php endif; ?>
                </div>
                
                <!-- Image 3 -->
                <div>
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: var(--admin-text-main);">Gallery Image 3</label>
                    <input type="file" name="image3" accept="image/png, image/jpeg, image/webp" style="width: 100%; padding: 0.5rem; border: 1px solid var(--admin-border); border-radius: 4px; background: #fff;">
                    <?php if ($package && !empty($package['image3'])): ?>
                        <div style="margin-top: 0.5rem; font-size: 0.85rem; color: var(--admin-text-mut);">
                            Current: <?= esc($package['image3']) ?>
                        </div>
                    <?php endif; ?>
                </div>
                
                <!-- Image 4 -->
                <div>
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: var(--admin-text-main);">Gallery Image 4</label>
                    <input type="file" name="image4" accept="image/png, image/jpeg, image/webp" style="width: 100%; padding: 0.5rem; border: 1px solid var(--admin-border); border-radius: 4px; background: #fff;">
                    <?php if ($package && !empty($package['image4'])): ?>
                        <div style="margin-top: 0.5rem; font-size: 0.85rem; color: var(--admin-text-mut);">
                            Current: <?= esc($package['image4']) ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <div style="display: flex; gap: 2rem; margin-bottom: 2rem; padding: 1rem; background: #f8fafc; border-radius: 4px; border: 1px solid var(--admin-border);">
                <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer; font-weight: 600;">
                    <input type="checkbox" name="is_active" value="1" <?= old('is_active', $package['is_active'] ?? 1) == 1 ? 'checked' : '' ?> style="width: 1.25rem; height: 1.25rem;">
                    Active Listing
                </label>
                
                <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer; font-weight: 600;">
                    <input type="checkbox" name="is_pickup" value="1" <?= old('is_pickup', $package['is_pickup'] ?? 1) == 1 ? 'checked' : '' ?> style="width: 1.25rem; height: 1.25rem;">
                    Hotel Pickup Included
                </label>
            </div>

            <div style="display: flex; justify-content: flex-end;">
                <button type="submit" class="admin-btn-primary" style="font-size: 1rem; padding: 0.75rem 2rem;">
                    <i class="fa-solid fa-save"></i> <?= $package ? 'UPDATE PACKAGE' : 'SAVE NEW PACKAGE' ?>
                </button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
