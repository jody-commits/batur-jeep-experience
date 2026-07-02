<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Booking Notification</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            padding: 0;
            color: #333333;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }
        .header {
            background-color: #d97706; /* primary amber color */
            padding: 25px 20px;
            text-align: center;
        }
        .header h1 {
            color: #ffffff;
            margin: 0;
            font-size: 24px;
            letter-spacing: 1px;
        }
        .content {
            padding: 30px;
        }
        .content p {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 20px;
        }
        .details-box {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 20px;
            margin-bottom: 25px;
        }
        .detail-row {
            margin-bottom: 12px;
            display: flex;
        }
        .detail-row:last-child {
            margin-bottom: 0;
        }
        .detail-label {
            font-weight: 600;
            color: #475569;
            width: 140px;
            flex-shrink: 0;
        }
        .detail-value {
            color: #1e293b;
            font-weight: 500;
        }
        .price-highlight {
            color: #059669;
            font-size: 18px;
            font-weight: 700;
        }
        .btn-container {
            text-align: center;
            margin-top: 30px;
        }
        .btn {
            display: inline-block;
            background-color: #d97706;
            color: #ffffff !important;
            text-decoration: none;
            padding: 12px 30px;
            border-radius: 5px;
            font-weight: 600;
            font-size: 16px;
        }
        .footer {
            background-color: #1e293b;
            color: #94a3b8;
            text-align: center;
            padding: 20px;
            font-size: 13px;
        }
        @media only screen and (max-width: 600px) {
            .detail-row {
                flex-direction: column;
            }
            .detail-label {
                width: 100%;
                margin-bottom: 4px;
                color: #64748b;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>New Booking Received! 🚙</h1>
        </div>
        
        <div class="content">
            <p>Halo Admin,</p>
            <p>Anda baru saja menerima pemesanan baru di website Batur Jeep Experience. Berikut adalah rinciannya:</p>
            
            <div class="details-box">
                <div class="detail-row">
                    <div class="detail-label">Booking Code:</div>
                    <div class="detail-value"><?= esc($booking_code) ?></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Customer Name:</div>
                    <div class="detail-value"><?= esc($customer_name) ?></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">WhatsApp:</div>
                    <div class="detail-value"><?= esc($customer_phone) ?></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Email:</div>
                    <div class="detail-value"><?= esc($customer_email) ?></div>
                </div>
                <hr style="border: 0; border-top: 1px solid #e2e8f0; margin: 15px 0;">
                <div class="detail-row">
                    <div class="detail-label">Package:</div>
                    <div class="detail-value"><?= esc($package_name) ?></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Tour Date:</div>
                    <div class="detail-value"><?= date('d F Y', strtotime($tour_date)) ?></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Total Guests:</div>
                    <div class="detail-value"><?= esc($total_persons) ?> Pax</div>
                </div>
                
                <?php if (!empty($hotel_name)): ?>
                <div class="detail-row">
                    <div class="detail-label">Hotel / Pickup:</div>
                    <div class="detail-value"><?= esc($hotel_name) ?></div>
                </div>
                <?php endif; ?>
                
                <?php if (!empty($notes)): ?>
                <div class="detail-row">
                    <div class="detail-label">Notes:</div>
                    <div class="detail-value" style="font-style: italic;"><?= esc($notes) ?></div>
                </div>
                <?php endif; ?>

                <hr style="border: 0; border-top: 1px solid #e2e8f0; margin: 15px 0;">
                <div class="detail-row">
                    <div class="detail-label" style="font-size: 18px; padding-top: 2px;">Total Price:</div>
                    <div class="detail-value price-highlight">Rp <?= number_format($total_price, 0, ',', '.') ?></div>
                </div>
            </div>
            
            <p style="margin-top: 20px;">Silakan login ke halaman Admin untuk menghubungi pelanggan dan mengkonfirmasi pesanan ini.</p>
            
            <div class="btn-container">
                <a href="<?= base_url('admin/bookings') ?>" class="btn">Buka Manage Booking</a>
            </div>
        </div>
        
        <div class="footer">
            <p>&copy; <?= date('Y') ?> Batur Jeep Experience. All rights reserved.</p>
            <p>Email ini dikirim otomatis oleh sistem.</p>
        </div>
    </div>
</body>
</html>
