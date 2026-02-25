<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Penjualan Nusakain</title>
    <style>
        body { font-family: 'Helvetica', 'Arial', sans-serif; font-size: 12px; color: #333; }
        .header { text-align: center; border-bottom: 2px solid #0d9488; padding-bottom: 20px; margin-bottom: 20px; }
        .logo { font-size: 24px; font-weight: bold; color: #0d9488; }
        .title { font-size: 18px; font-weight: bold; margin-top: 10px; }
        .stats-grid { width: 100%; margin-bottom: 30px; }
        .stat-box { background: #f8fafc; padding: 15px; border-radius: 10px; border: 1px solid #e2e8f0; text-align: center; }
        .stat-label { font-size: 10px; color: #64748b; font-weight: bold; text-transform: uppercase; margin-bottom: 5px; }
        .stat-value { font-size: 16px; font-weight: bold; color: #0f172a; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { background: #0d9488; color: white; text-align: left; padding: 10px; text-transform: uppercase; font-size: 10px; }
        td { padding: 10px; border-bottom: 1px solid #f1f5f9; font-size: 10px; }
        .text-right { text-align: right; }
        .footer { margin-top: 30px; text-align: center; color: #94a3b8; font-size: 10px; }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">Nusakain.</div>
        <div class="title">LAPORAN PENJUALAN</div>
        <p>Periode: Per Tanggal {{ now()->format('d F Y') }}</p>
    </div>

    <table class="stats-grid">
        <tr>
            <td width="33%">
                <div class="stat-box">
                    <div class="stat-label">Total Pesanan</div>
                    <div class="stat-value">{{ number_format($stats['total_orders']) }}</div>
                </div>
            </td>
            <td width="33%">
                <div class="stat-box">
                    <div class="stat-label">Omzet Terbayar</div>
                    <div class="stat-value">Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}</div>
                </div>
            </td>
            <td width="33%">
                <div class="stat-box">
                    <div class="stat-label">Total Kain Terjual</div>
                    <div class="stat-value">{{ (float)$stats['total_items'] }} Meter</div>
                </div>
            </td>
        </tr>
    </table>

    <table>
        <thead>
            <tr>
                <th>No. Pesanan</th>
                <th>Tanggal</th>
                <th>Pelanggan</th>
                <th>Status</th>
                <th class="text-right">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td style="font-weight: bold;">#{{ $order->order_number }}</td>
                    <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                    <td>{{ $order->user->name ?? $order->receiver_name }}</td>
                    <td>{{ strtoupper($order->status) }}</td>
                    <td class="text-right" style="font-weight: bold;">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Laporan digenerate otomatis oleh Sistem Nusakain pada {{ now()->format('d/m/Y H:i') }}</p>
    </div>
</body>
</html>
