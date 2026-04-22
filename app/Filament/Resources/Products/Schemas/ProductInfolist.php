<?php

namespace App\Filament\Resources\Products\Schemas;


use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\IconEntry;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class ProductInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
                Tabs::make('Product Tabs')
                    ->tabs([
                        Tab::make('Product Details')
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                TextEntry::make('name')
                                    ->label('Product Name')
                                    ->weight('bold')
                                    ->color('primary'),

                                TextEntry::make('id')
                                    ->label('Product ID'),

                                TextEntry::make('sku')
                                    ->label('Product SKU')
                                    ->badge()
                                    ->color('success'),

                                TextEntry::make('description')
                                    ->label('Product Description'),

                                TextEntry::make('created_at')
                                    ->label('Product Creation Date')
                                    ->date('d M Y')
                                    ->color('info'),
                            ]),

                        Tabs\Tab::make('Pricing & Stock')
                            ->icon('heroicon-o-currency-dollar')
                            ->badge('10')
                            ->badgeColor('info')
                            ->schema([
                                TextEntry::make('price')
                                    ->label('Price')
                                    ->icon('heroicon-o-currency-dollar'),
                                TextEntry::make('stock')
                                    ->label('Stock')
                                    ->color('primary'),
                            ]),
                        Tab::make('Image and Status')
                            ->schema([
                                ImageEntry::make('image')
                                    ->label('Product Image')
                                    ->disk('public'),
                                
                                TextEntry::make('price')
                                    ->label('Product Price')
                                    ->weight('bold')
                                    ->color('primary')
                                    ->icon('heroicon-s-currency-dollar'),
                                
                                TextEntry::make('stock')
                                    ->label('Product Stock')
                                    ->weight('bold')
                                    ->color('primary'),
                                
                                IconEntry::make('is_active')
                                    ->label('Is Active?')
                                    ->boolean(),
                                
                                IconEntry::make('is_featured')
                                    ->label('Is Featured?')
                                    ->boolean(),
                            ])
                    ])->columnSpanFull()
                    ->vertical(),

                Section::make('Product Info')
                    ->schema([
                        TextEntry::make('name')
                            ->label('Product Name')
                            ->weight('bold')
                            ->color('primary'),
                        TextEntry::make('id')
                            ->label('Product ID'),
                        TextEntry::make('sku')
                            ->label('Product SKU')
                            ->badge()
                            ->color(fn(string $state): string => match ($state) {
                                'SKU001' => 'success',
                                'SKU002' => 'danger',
                                default => 'primary',
                            }),
                        TextEntry::make('description')
                            ->label('Product Description'),
                        TextEntry::make('created_at')
                            ->label('Created At')
                            ->date('d m y')
                            ->color('info'),
                    ])
                    ->columnSpanFull(),
                Section::make('Pricing & Stock')
                    ->schema([
                        TextEntry::make('price')
                            ->label('Product Price')
                            // ->icon('heroicon-o-currency-dollar')
                            ->formatStateUsing(fn($state): string => 'Rp ' . number_format($state, 0, ',', '.')),
                        TextEntry::make('stock')
                            ->label('Product Stock')
                            ->icon('heroicon-o-cube') // Icon untuk stock
                            ->iconColor('primary'), // Warna icon 
                    ]),

                Section::make('Image and Status')
                    ->description('')
                    ->schema([
                        ImageEntry::make('image')
                            ->label('Product Image')
                            ->disk('public'),
                        TextEntry::make('price')
                            ->label('Product Price')
                            ->weight('bold')
                            ->color('primary')
                            ->icon('heroicon-s-currency-dollar'),
                        TextEntry::make('stock')
                            ->label('Product Stock')
                            ->weight('bold')
                            ->color('primary'),
                        IconEntry::make('is_active')
                            ->label('Is Active?')
                            ->boolean(),
                        IconEntry::make('is_featured')
                            ->label('Is Featured?')
                            ->boolean(),
                    ])
                    ->columnSpanFull(),
                Section::make('coba')
                    ->schema([
                        IconEntry::make('is_active')
                            ->label('Is Active?')
                            ->boolean(),
                        IconEntry::make('is_featured')
                            ->label('Is Featured?')
                            ->boolean(),
                    ])->columnSpanFull(),
            ]);
    }
}
