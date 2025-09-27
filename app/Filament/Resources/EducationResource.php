<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EducationResource\Pages;
use App\Models\Education;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class EducationResource extends Resource
{
    protected static ?string $model = Education::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationLabel = 'Educación';
    protected static ?string $pluralLabel = 'Estudios';
    protected static ?string $modelLabel = 'Estudio';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\TextInput::make('institution')
                ->label('Institución')
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('degree')
                ->label('Título / Grado')
                ->required()
                ->maxLength(255),

            Forms\Components\DatePicker::make('start_date')
                ->label('Fecha de inicio')
                ->required(),

            Forms\Components\DatePicker::make('end_date')
                ->label('Fecha de fin')
                ->nullable(),

            Forms\Components\Select::make('category')
                ->label('Categoría')
                ->options([
                    'education' => 'Educación Formal',
                    'course' => 'Curso Avanzado',
                ])
                ->default('education')
                ->required(),

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
        ]);
}

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('institution')->label('Institución')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('degree')->label('Título')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('start_date')->label('Inicio')->date(),
                Tables\Columns\TextColumn::make('end_date')->label('Fin')->date(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEducations::route('/'),
            'create' => Pages\CreateEducation::route('/create'),
            'edit' => Pages\EditEducation::route('/{record}/edit'),
        ];
    }
}
