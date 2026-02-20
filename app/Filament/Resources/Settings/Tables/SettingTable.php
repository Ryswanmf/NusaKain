<?php

namespace App\Filament\Resources\Settings\Tables;

use Filament\Tables;
use Filament\Tables\Table;

class SettingTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('hero_badge')
                    ->label('Badge')
                    ->searchable(),
                Tables\Columns\TextColumn::make('hero_title_primary')
                    ->label('Judul Hero')
                    ->limit(30),
                Tables\Columns\TextColumn::make('whatsapp')
                    ->label('WA'),
                Tables\Columns\TextColumn::make('instagram')
                    ->label('IG'),
                Tables\Columns\TextColumn::make('facebook')
                    ->label('FB'),
            ]);
    }
}
