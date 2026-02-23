<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VoucherResource\Pages;
use App\Models\Voucher;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class VoucherResource extends Resource
{
    protected static ?string $model = Voucher::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-ticket';

    protected static string|\UnitEnum|null $navigationGroup = 'Master Data';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\Section::make('Informasi Voucher')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('code')
                            ->label('Kode Voucher')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->placeholder('MISAL: PROMO10'),
                        Forms\Components\Select::make('type')
                            ->label('Tipe Potongan')
                            ->options([
                                'fixed' => 'Nominal Tetap (Rp)',
                                'percentage' => 'Persentase (%)',
                            ])
                            ->required()
                            ->default('fixed'),
                        Forms\Components\TextInput::make('value')
                            ->label('Nilai Potongan')
                            ->required()
                            ->numeric()
                            ->prefix('Nilai'),
                        Forms\Components\TextInput::make('min_order_amount')
                            ->label('Minimal Pembelian')
                            ->required()
                            ->numeric()
                            ->default(0)
                            ->prefix('Rp'),
                    ]),

                Forms\Components\Section::make('Batasan & Waktu')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('limit_per_user')
                            ->label('Limit Per Pengguna')
                            ->required()
                            ->numeric()
                            ->default(1),
                        Forms\Components\TextInput::make('max_uses')
                            ->label('Total Kuota Voucher')
                            ->numeric()
                            ->helperText('Kosongkan jika tidak terbatas'),
                        Forms\Components\DateTimePicker::make('start_date')
                            ->label('Mulai Berlaku'),
                        Forms\Components\DateTimePicker::make('end_date')
                            ->label('Berakhir Pada'),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Status Aktif')
                            ->required()
                            ->default(true),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->label('Kode')
                    ->searchable()
                    ->fontFamily('mono'),
                Tables\Columns\TextColumn::make('type')
                    ->label('Tipe')
                    ->badge(),
                Tables\Columns\TextColumn::make('value')
                    ->label('Nilai')
                    ->formatStateUsing(fn ($state, Voucher $record) => $record->type === 'fixed' ? 'Rp ' . number_format($state, 0, ',', '.') : $state . '%'),
                Tables\Columns\TextColumn::make('used_count')
                    ->label('Terpakai')
                    ->suffix(fn (Voucher $record) => $record->max_uses ? ' / ' . $record->max_uses : ''),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),
                Tables\Columns\TextColumn::make('end_date')
                    ->label('Kadaluwarsa')
                    ->dateTime()
                    ->color(fn ($state) => $state && now()->gt($state) ? 'danger' : 'gray'),
            ])
            ->filters([
                Tables\Filters\ToggledFilter::make('is_active'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVouchers::route('/'),
            'create' => Pages\CreateVoucher::route('/create'),
            'edit' => Pages\EditVoucher::route('/{record}/edit'),
        ];
    }
}
