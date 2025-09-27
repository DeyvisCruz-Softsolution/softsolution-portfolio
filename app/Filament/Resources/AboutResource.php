<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AboutResource\Pages;
use App\Models\About;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AboutResource extends Resource
{
    protected static ?string $model = About::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';
    protected static ?string $navigationGroup = 'Secciones Públicas';
    protected static ?string $navigationLabel = 'About Me';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Título')
                    ->required()
                    ->maxLength(255),

               Forms\Components\RichEditor::make('description')
    ->label('Descripción')
    ->toolbarButtons([
        'bold',
        'italic',
        'underline',
        'strike',
        'h2',
        'h3',
        'bulletList',
        'orderedList',
        'blockquote',
        'link',
        'justify',
        'undo',
        'redo',
    ])
    ->columnSpanFull()
    ->required(),

                Forms\Components\FileUpload::make('image')
                    ->label('Foto / Avatar')
                    ->image()
                    ->directory('about')
                    ->maxSize(2048),

                Forms\Components\FileUpload::make('cv_file')
                    ->label('Archivo CV')
                    ->directory('about/cv')
                    ->acceptedFileTypes(['application/pdf'])
                    ->maxSize(4096),

                Forms\Components\KeyValue::make('social_links')
                    ->label('Redes Sociales')
                    ->keyLabel('Plataforma')
                    ->valueLabel('URL')
                    ->addButtonLabel('Agregar Red')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Foto')
                    ->circular(),

                Tables\Columns\TextColumn::make('title')
                    ->label('Título')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('description')
                    ->label('Descripción')
                    ->limit(50),

                Tables\Columns\TextColumn::make('cv_file')
                    ->label('CV'),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d/m/Y H:i')
                    ->label('Creado'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageAbouts::route('/'),
        ];
    }
}
