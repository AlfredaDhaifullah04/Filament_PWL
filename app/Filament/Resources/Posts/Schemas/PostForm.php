<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DateTimePicker;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Group;


class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // KIRI: Fields utama (2/3)
                Section::make("Post Details")
                    ->description("Isi detail utama post")
                    ->icon("heroicon-o-document-text")
                    ->schema([
                        Group::make([
                            TextInput::make('title')
                                ->rules(["required", "min:5", "max:50"])
                                ->validationMessages([
                                    'unique' => 'Title harus unik dan tidak boleh sama.',
                                ]),
                            // ->rules ('required', 'min:3', 'max:10'),
                            TextInput::make('slug')
                                ->rules(["required", "min:3", "max:50"])
                                ->unique()
                                ->validationMessages([
                                    'unique' => 'Slug harus unik dan tidak boleh sama.',
                                ]),
                            Select::make("category_id")
                                ->relationship("category", "name")
                                ->rules(["required"])
                                ->validationMessages(['required' => 'Kategori wajib dipilih.'])
                                ->preload()
                                ->searchable(),
                            ColorPicker::make("color"),
                        ])->columns(2),
                        MarkdownEditor::make("content")
                            ->columns(2), //->columnSpanFull(),
                    ])
                    ->columnSpan(2),

                // KANAN: Meta & Media (1/3)
                Group::make([
                    Section::make("Media / Image")
                        ->icon("heroicon-o-photo")
                        ->schema([
                            FileUpload::make("image")
                                ->required()
                                ->validationMessages(['required' => 'Gambar wajib diupload.'])
                                ->disk("public")
                                ->directory("posts"),
                        ]),
                    Section::make("Meta Information")
                        ->icon("heroicon-o-information-circle")
                        ->schema([
                            TagsInput::make("tags"),
                            Checkbox::make("published"),
                            DateTimePicker::make("published_at"),
                        ]),
                ])
                    ->columnSpan(1),
            ])
            ->columns(3);
    }
}
