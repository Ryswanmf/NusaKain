<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice #{{ $order->order_number }}</title>
    <style>
        body { font-family: 'Helvetica', 'Arial', sans-serif; color: #333; line-height: 1.6; }
        .invoice-box { max-width: 800px; margin: auto; padding: 30px; }
        .header { margin-bottom: 40px; border-bottom: 2px solid #0d9488; padding-bottom: 20px; }
        .logo { font-size: 28px; font-weight: bold; color: #0d9488; }
        .invoice-info { display: table; width: 100%; margin-bottom: 30px; }
        .info-col { display: table-cell; width: 50%; vertical-align: top; }
        .text-right { text-align: right; }
        table { width: 100%; line-height: inherit; text-align: left; border-collapse: collapse; }
        table th { background: #f8fafc; color: #64748b; font-size: 12px; text-transform: uppercase; padding: 12px; border-bottom: 1px solid #e2e8f0; }
        table td { padding: 12px; border-bottom: 1px solid #f1f5f9; }
        .total-section { margin-top: 30px; text-align: right; }
        .total-row { font-size: 14px; margin-bottom: 5px; }
        .grand-total { font-size: 20px; font-weight: bold; color: #0d9488; margin-top: 10px; }
        .badge { padding: 4px 12px; border-radius: 99px; font-size: 10px; font-weight: bold; text-transform: uppercase; }
        .paid { background: #ccfbf1; color: #0f766e; }
        .unpaid { background: #fef3c7; color: #92400e; }
        .footer { margin-top: 50px; text-align: center; font-size: 12px; color: #94a3b8; }
    </style>
</head>
<body>
    <div class="invoice-box">
        <div class="header">
            <div class="invoice-info">
                <div class="info-col">
                    <div class="logo">Nusakain.</div>
                    <p style="margin-top: 5px; font-size: 12px; color: #64748b;">
                        Premium Textile Ecosystem<br>
                        Jakarta, Indonesia
                    </p>
                </div>
                <div class="info-col text-right">
                    <h2 style="margin: 0; font-size: 20px;">INVOICE</h2>
                    <p style="margin: 5px 0 0 0; font-size: 14px; font-weight: bold;">#{{ $order->order_number }}</p>
                    <p style="margin: 0; font-size: 12px; color: #64748b;">{{ $order->created_at->format('d M Y') }}</p>
                </div>
            </div>
        </div>

        <div class="invoice-info">
            <div class="info-col">
                <p style="font-size: 10px; font-weight: bold; color: #94a3b8; text-transform: uppercase; margin-bottom: 5px;">Ditujukan Kepada:</p>
                <p style="margin: 0; font-weight: bold;">{{ $order->receiver_name }}</p>
                <p style="margin: 0; font-size: 12px;">{{ $order->receiver_phone }}</p>
                <p style="margin: 5px 0 0 0; font-size: 12px; color: #64748b; max-width: 250px;">
                    {{ $order->address_detail }}, {{ $order->postal_code }}
                </p>
            </div>
            <div class="info-col text-right">
                <p style="font-size: 10px; font-weight: bold; color: #94a3b8; text-transform: uppercase; margin-bottom: 5px;">Status Pembayaran:</p>
                <span class="badge {{ $order->payment_status === 'paid' ? 'paid' : 'unpaid' }}">
                    {{ $order->payment_status === 'paid' ? 'LUNAS' : 'BELUM BAYAR' }}
                </span>
                <p style="margin-top: 15px; font-size: 10px; font-weight: bold; color: #94a3b8; text-transform: uppercase; margin-bottom: 5px;">Metode Pembayaran:</p>
                <p style="margin: 0; font-size: 12px; font-weight: bold;">Midtrans Payment</p>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Item</th>
                    <th style="text-align: center;">Qty</th>
                    <th style="text-align: right;">Harga Satuan</th>
                    <th style="text-align: right;">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                    <tr>
                        <td>
                            <div style="font-weight: bold;">{{ $item->product->name }}</div>
                            @if($item->variant)
                                <div style="font-size: 10px; color: #64748b;">Varian: {{ $item->variant->name }}</div>
                            @endif
                        </td>
                        <td style="text-align: center;">{{ $item->quantity }}</td>
                        <td style="text-align: right;">{{ number_format($item->unit_price, 0, ',', '.') }}</td>
                        <td style="text-align: right;">{{ number_format($item->unit_price * $item->quantity, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="total-section">
            <div class="total-row">
                <span style="color: #64748b;">Subtotal Produk:</span>
                <span style="font-weight: bold; margin-left: 20px;">Rp{{ number_format($order->total_amount - $order->shipping_cost + $order->discount_amount, 0, ',', '.') }}</span>
            </div>
            @if($order->discount_amount > 0)
                <div class="total-row">
                    <span style="color: #f43f5e;">Diskon Voucher:</span>
                    <span style="font-weight: bold; margin-left: 20px; color: #f43f5e;">-Rp{{ number_format($order->discount_amount, 0, ',', '.') }}</span>
                </div>
            @endif
            <div class="total-row">
                <span style="color: #64748b;">Biaya Pengiriman:</span>
                <span style="font-weight: bold; margin-left: 20px;">Rp{{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
            </div>
            <div class="grand-total">
                <span style="font-size: 12px; font-weight: normal; color: #64748b; vertical-align: middle;">TOTAL PEMBAYARAN:</span>
                <span style="margin-left: 10px;">Rp{{ number_format($order->total_amount, 0, ',', '.') }}</span>
            </div>
        </div>

        <!-- Signature & Stamp Section -->
        <div style="margin-top: 60px; width: 100%;">
            <div style="float: right; width: 200px; text-align: center; position: relative;">
                <p style="font-size: 12px; margin-bottom: 50px;">Hormat kami,</p>
                
                @if($setting->stamp_image && file_exists(storage_path('app/public/' . $setting->stamp_image)))
                    @php
                        $stampData = base64_encode(file_get_contents(storage_path('app/public/' . $setting->stamp_image)));
                        $stampType = pathinfo(storage_path('app/public/' . $setting->stamp_image), PATHINFO_EXTENSION);
                    @endphp
                    <img src="data:image/{{ $stampType }};base64,{{ $stampData }}" 
                         style="position: absolute; width: 100px; opacity: 0.6; top: 20px; left: 20px; z-index: 1;">
                @endif

                @if($setting->signature_image && file_exists(storage_path('app/public/' . $setting->signature_image)))
                    @php
                        $sigData = base64_encode(file_get_contents(storage_path('app/public/' . $setting->signature_image)));
                        $sigType = pathinfo(storage_path('app/public/' . $setting->signature_image), PATHINFO_EXTENSION);
                    @endphp
                    <img src="data:image/{{ $sigType }};base64,{{ $sigData }}" 
                         style="position: relative; width: 120px; z-index: 2;">
                @endif

                <div style="margin-top: 10px; border-top: 1px solid #333; padding-top: 5px;">
                    <p style="font-size: 12px; font-weight: bold; margin: 0;">{{ $setting->site_name }} Admin</p>
                </div>
            </div>
            <div style="clear: both;"></div>
        </div>

        <div class="footer">
            <p>Terima kasih telah berbelanja di Nusakain. Pesanan Anda sangat berarti bagi kami.</p>
            <p style="font-weight: bold;">www.nusakain.com</p>
        </div>
    </div>
</body>
</html>
