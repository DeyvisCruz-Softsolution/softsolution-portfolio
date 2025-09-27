<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SkillResource\Pages;
use App\Models\Skill;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SkillResource extends Resource
{
    protected static ?string $model = Skill::class;

    protected static ?string $navigationIcon = 'heroicon-o-sparkles';
    protected static ?string $navigationLabel = 'Habilidades';
    protected static ?string $pluralLabel = 'Habilidades';
    protected static ?string $modelLabel = 'Habilidad';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nombre')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Select::make('level')
                    ->label('Nivel')
                    ->options([
                        'Básico' => 'Básico',
                        'Intermedio' => 'Intermedio',
                        'Avanzado' => 'Avanzado',
                    ])
                    ->nullable(),

                Forms\Components\TextInput::make('proficiency')
                    ->label('Dominio (%)')
                    ->numeric()
                    ->minValue(0)
                    ->maxValue(100)
                    ->nullable(),
            // Add RichEditor to the form schema instead of table
            Forms\Components\RichEditor::make('description')
                ->label('Descripción')
                ->toolbarButtons([
                    'bold','italic','underline','strike',
                    'bulletList','orderedList','blockquote',
                    'link','undo','redo'
                ])
                ->columnSpanFull()
                ->nullable(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nombre')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('level')
                    ->label('Nivel')
                    ->sortable(),

                Tables\Columns\TextColumn::make('proficiency')
                    ->label('Dominio')
                    ->suffix('%')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Creado')
                    ->date('d/m/Y'),
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
            'index' => Pages\ListSkills::route('/'),
            'create' => Pages\CreateSkill::route('/create'),
            'edit' => Pages\EditSkill::route('/{record}/edit'),
        ];
    }
}
