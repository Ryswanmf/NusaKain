<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Placeholder;
use Filament\Schemas\Schema;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Dasar')
                    ->columns(2)
                    ->components([
                        TextInput::make('order_number')
                            ->label('Nomor Pesanan')
                            ->disabled()
                            ->dehydrated(false),
                        Select::make('user_id')
                            ->label('Pelanggan')
                            ->relationship('user', 'name')
                            ->searchable()
                            ->required(),
                        Select::make('status')
                            ->label('Status Pesanan')
                            ->options([
                                'pending' => 'Pending',
                                'processing' => 'Processing',
                                'shipped' => 'Shipped',
                                'completed' => 'Completed',
                                'cancelled' => 'Cancelled',
                            ])
                            ->required()
                            ->native(false),
                        Select::make('payment_status')
                            ->label('Status Pembayaran')
                            ->options([
                                'unpaid' => 'Belum Bayar',
                                'pending' => 'Menunggu Pembayaran',
                                'paid' => 'Sudah Bayar',
                                'failed' => 'Gagal',
                                'expired' => 'Kedaluwarsa',
                            ])
                            ->required()
                            ->native(false),
                    ]),

                Section::make('Rincian Pembayaran & Pengiriman')
                    ->columns(3)
                    ->components([
                        TextInput::make('total_amount')
                            ->label('Total Pembayaran')
                            ->numeric()
                            ->prefix('Rp')
                            ->required(),
                        TextInput::make('shipping_cost')
                            ->label('Ongkos Kirim')
                            ->numeric()
                            ->prefix('Rp')
                            ->default(0),
                        TextInput::make('courier')
                            ->label('Kurir')
                            ->disabled(),
                        TextInput::make('shipping_service')
                            ->label('Layanan')
                            ->disabled(),
                        TextInput::make('total_weight')
                            ->label('Total Berat (gr)')
                            ->numeric()
                            ->default(0),
                    ]),

                Section::make('Detail Penerima')
                    ->columns(2)
                    ->components([
                        TextInput::make('receiver_name')
                            ->label('Nama Penerima')
                            ->required(),
                        TextInput::make('receiver_phone')
                            ->label('No. WhatsApp')
                            ->tel()
                            ->required(),
                        Textarea::make('address_detail')
                            ->label('Alamat Lengkap')
                            ->required()
                            ->columnSpanFull(),
                        TextInput::make('postal_code')
                            ->label('Kode Pos')
                            ->required(),
                        Textarea::make('notes')
                            ->label('Catatan Pesanan')
                            ->columnSpanFull(),
                    ]),

                Section::make('Daftar Produk yang Dipesan')
                    ->collapsible()
                    ->components([
                        Repeater::make('items')
                            ->relationship('items')
                            ->columns(4)
                            ->schema([
                                Select::make('product_id')
                                    ->label('Produk')
                                    ->relationship('product', 'name')
                                    ->required()
                                    ->disabled(),
                                Select::make('product_variant_id')
                                    ->label('Varian')
                                    ->relationship('variant', 'name')
                                    ->disabled(),
                                TextInput::make('quantity')
                                    ->label('Jumlah')
                                    ->numeric()
                                    ->required(),
                                TextInput::make('unit_price')
                                    ->label('Harga Per Satuan')
                                    ->numeric()
                                    ->prefix('Rp')
                                    ->required(),
                            ])
                            ->disabled()
                            ->dehydrated(false)
                            ->addable(false)
                            ->deletable(false),
                    ]),
            ]);
    }
}
