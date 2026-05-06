<?php

namespace App\Filament\Resources\Posts\Tables;

use Dom\Text;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Columns\IconColumn;

class PostsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // Kolom dengan search aktif
                TextColumn::make('id')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault:true),
                TextColumn::make('title')
                    ->sortable()
                    ->toggleable()
                    ->searchable(),
                TextColumn::make('slug')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault:true)
                    ->searchable(),
                TextColumn::make('category.name')
                    ->sortable()
                    ->toggleable()
                    ->searchable(),
                // Kolom lain
                ColorColumn::make('color')
                ->toggleable(),
                ImageColumn::make('image')
                    ->toggleable()
                    ->disk('public'),
                IconColumn::make('published')
                    ->boolean()
                    ->toggleable()
                    ->label('Published'),
                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime('d M Y H:i')
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('tags')
                    ->label('Tags')
                    ->toggleable(),
                IconColumn::make('published')
                    ->boolean()
                    ->toggleable
            ])->defaultSort('created_at', 'desc')

            ->filters([
                // Filter tanggal Created At
                Filter::make('created_at')
                    ->label('Creation Date')
                    ->form([
                        DatePicker::make('created_at')
                            ->label('Select Date'),
                    ])
                    ->query(function ($query, $data) {
                        return $query->when(
                            $data['created_at'],
                            fn($query, $date) => $query->whereDate('created_at', $date)
                        );
                    }),
                // Filter kategori dengan SelectFilter
                SelectFilter::make('category_id')
                    ->relationship('category', 'name')
                    ->label('Category')
                    ->preload(),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
