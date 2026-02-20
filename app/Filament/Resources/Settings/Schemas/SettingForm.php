<?php

namespace App\Filament\Resources\Settings\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class SettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Hero Section')
                    ->columns(2)
                    ->components([
                        TextInput::make('hero_badge')
                            ->required(),
                        TextInput::make('hero_title_primary')
                            ->required(),
                        TextInput::make('hero_title_italic')
                            ->required(),
                        Textarea::make('hero_description')
                            ->columnSpanFull()
                            ->required(),
                        FileUpload::make('hero_image')
                            ->image()
                            ->columnSpanFull(),
                        TextInput::make('hero_button_primary_text'),
                        TextInput::make('hero_button_primary_url'),
                        TextInput::make('hero_button_secondary_text'),
                        TextInput::make('hero_button_secondary_url'),
                    ]),
                
                Section::make('Sosial Media')
                    ->description('Masukkan URL lengkap (misal: https://instagram.com/nusakain)')
                    ->columns(3)
                    ->components([
                        TextInput::make('whatsapp')
                            ->label('WhatsApp Number/Link')
                            ->placeholder('628123456789'),
                        TextInput::make('instagram')
                            ->label('Instagram URL'),
                        TextInput::make('facebook')
                            ->label('Facebook URL'),
                    ]),

                Section::make('Call to Action (CTA)')
                    ->columns(2)
                    ->components([
                        TextInput::make('cta_title'),
                        Textarea::make('cta_description')
                            ->columnSpanFull(),
                        TextInput::make('cta_button_text'),
                        TextInput::make('cta_button_url'),
                    ]),
            ]);
    }
}
