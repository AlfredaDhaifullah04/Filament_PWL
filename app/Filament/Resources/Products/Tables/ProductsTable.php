<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

//tugas soal
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\Layout\Grid;
use Filament\Tables\Columns\Layout\Split;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('sku')
                    ->badge() // Badge untuk SKU
                    ->color(fn($state): string => match (true) {
                        str_starts_with($state, '00') => 'danger',    // SKU diawali 00 -> Merah
                        str_starts_with($state, '1') => 'success',    // SKU diawali 1 -> Hijau
                        str_starts_with($state, '2') => 'warning',    // SKU diawali 2 -> Kuning
                        str_starts_with($state, '3') => 'info',      // SKU diawali 10 -> Biru
                        default => 'gray',                             // Default -> Abu-abu
                    })
                    ->searchable(),
                TextColumn::make('price')
                    ->formatStateUsing(fn($state): string => 'Rp ' . number_format($state, 0, ',', '.')),
                TextColumn::make('stock')
                    ->badge() // Mengubah menjadi badge
                    ->icon('heroicon-o-cube')
                    ->iconColor(fn($state): string => match (true) {
                        $state <= 0 => 'danger',
                        $state <= 300 => 'warning',
                        $state <= 400 => 'info',
                        default => 'success',
                    })
                    ->color(fn($state): string => match (true) { // Warna badge berdasarkan stok
                        $state <= 0 => 'danger',      // Merah: Stok habis
                        $state <= 300 => 'warning',    // Kuning: Stok menipis
                        $state <= 400 => 'info',      // Biru: Stok sedang
                        default => 'success',         // Hijau: Stok banyak
                    })
                    ->formatStateUsing(fn($state): string => match (true) { // Teks badge
                        $state <= 0 => 'Habis',
                        $state <= 300=> 'Menipis (' . $state . ')',
                        $state <= 400 => 'Sedang (' . $state . ')',
                        default => 'Tersedia (' . $state . ')',
                    }),
                ImageColumn::make('image')
                    ->disk('public'),
                TextColumn::make('is_active')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn($state) => $state ? 'Aktif' : 'Nonaktif')
                    ->color(fn($state) => $state ? 'success' : 'danger'),
            ])
            
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
