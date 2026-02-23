<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Produk')
                    ->columns(2)
                    ->components([
                        TextInput::make('name')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug', \Illuminate\Support\Str::slug($state))),
                        TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true),
                        TextInput::make('category')
                            ->required(),
                        Toggle::make('is_active')
                            ->required()
                            ->default(true),
                        Textarea::make('description')
                            ->columnSpanFull(),
                    ]),

                Section::make('Harga & Stok Dasar')
                    ->description('Harga ini akan digunakan jika variasi tidak memiliki harga khusus.')
                    ->columns(4)
                    ->components([
                        TextInput::make('price')
                            ->label('Harga Jual')
                            ->required()
                            ->numeric()
                            ->prefix('Rp'),
                        TextInput::make('original_price')
                            ->label('Harga Coret')
                            ->numeric()
                            ->prefix('Rp'),
                        TextInput::make('stock')
                            ->label('Total Stok')
                            ->required()
                            ->numeric()
                            ->default(0),
                        TextInput::make('weight')
                            ->label('Berat (gram)')
                            ->numeric()
                            ->default(0)
                            ->suffix('gr'),
                    ]),

                Section::make('Gambar Produk')
                    ->components([
                        FileUpload::make('image')
                            ->label('Gambar Utama')
                            ->image()
                            ->directory('products')
                            ->imageEditor(),
                        FileUpload::make('gallery')
                            ->label('Galeri Foto')
                            ->image()
                            ->multiple()
                            ->directory('products/gallery')
                            ->imageEditor(),
                    ]),

                Section::make('Variasi Produk')
                    ->description('Tambahkan pilihan warna, ukuran, atau jenis grade kain.')
                    ->components([
                        Repeater::make('variants')
                            ->relationship('variants')
                            ->columns(3)
                            ->schema([
                                TextInput::make('name')
                                    ->label('Nama Variasi')
                                    ->placeholder('Misal: Merah, XL, atau Grade A')
                                    ->required(),
                                TextInput::make('sku')
                                    ->label('SKU')
                                    ->placeholder('NK-VAR-001'),
                                TextInput::make('price')
                                    ->label('Harga Khusus')
                                    ->numeric()
                                    ->prefix('Rp'),
                                TextInput::make('stock')
                                    ->label('Stok')
                                    ->required()
                                    ->numeric()
                                    ->default(0),
                                TextInput::make('weight')
                                    ->label('Berat (gram)')
                                    ->numeric()
                                    ->suffix('gr'),
                                FileUpload::make('image')
                                    ->label('Foto Khusus')
                                    ->image()
                                    ->directory('products/variants')
                                    ->imageEditor()
                                    ->columnSpanFull(),
                            ])
                            ->itemLabel(fn (array $state): ?string => $state['name'] ?? null)
                            ->collapsible()
                            ->collapsed(),
                    ]),
            ]);
    }
}
