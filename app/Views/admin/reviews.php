<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<div class="admin-header">
    <div class="admin-header-left">
        <h1 class="admin-page-title">Manage Reviews</h1>
        <p class="admin-page-desc">Approve, reject, or delete user reviews.</p>
    </div>
</div>

<?php if (session()->getFlashdata('success')): ?>
<div class="alert alert-success" style="padding: 1rem; background: #d1fae5; color: #065f46; border-radius: 8px; margin-bottom: 1.5rem;">
    <?= session()->getFlashdata('success') ?>
</div>
<?php endif; ?>

<div class="admin-card">
    <div class="table-responsive">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Reviewer</th>
                    <th>Package</th>
                    <th>Rating</th>
                    <th>Review</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($reviews)): ?>
                    <?php foreach ($reviews as $rev): ?>
                    <tr>
                        <td>
                            <strong><?= esc($rev['name']) ?></strong><br>
                            <span style="font-size:0.8rem; color:#6b7280;"><?= esc($rev['location']) ?></span>
                        </td>
                        <td><?= esc($rev['package_name']) ?></td>
                        <td><?= $rev['rating'] ?> <i class="fa-solid fa-star" style="color: #fbbf24;"></i></td>
                        <td>
                            <div style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" title="<?= esc($rev['review_text']) ?>">
                                "<?= esc($rev['review_text']) ?>"
                            </div>
                        </td>
                        <td>
                            <?php 
                            $badge = 'background: #f3f4f6; color: #1f2937;';
                            if ($rev['status'] === 'approved') $badge = 'background: #d1fae5; color: #065f46;';
                            if ($rev['status'] === 'rejected') $badge = 'background: #fee2e2; color: #991b1b;';
                            ?>
                            <span style="padding: 0.2rem 0.6rem; border-radius: 99px; font-size: 0.75rem; font-weight: 600; <?= $badge ?>">
                                <?= ucfirst($rev['status']) ?>
                            </span>
                        </td>
                        <td><?= date('d M Y', strtotime($rev['created_at'])) ?></td>
                        <td>
                            <form action="<?= base_url('admin/reviews/updateStatus/'.$rev['id']) ?>" method="post" style="display:inline-block;">
                                <?= csrf_field() ?>
                                <select name="status" onchange="this.form.submit()" style="padding: 0.3rem; border: 1px solid #d1d5db; border-radius: 4px; font-size: 0.8rem;">
                                    <option value="pending" <?= $rev['status'] === 'pending' ? 'selected' : '' ?>>Pending</option>
                                    <option value="approved" <?= $rev['status'] === 'approved' ? 'selected' : '' ?>>Approve</option>
                                    <option value="rejected" <?= $rev['status'] === 'rejected' ? 'selected' : '' ?>>Reject</option>
                                </select>
                            </form>
                            
                            <a href="<?= base_url('admin/reviews/delete/'.$rev['id']) ?>" class="btn btn--sm" style="color:#ef4444; border: 1px solid #ef4444; padding: 0.3rem 0.5rem; border-radius: 4px; font-size:0.8rem;" onclick="return confirm('Are you sure you want to delete this review?');" title="Delete">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="7" style="text-align:center;">No reviews found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
