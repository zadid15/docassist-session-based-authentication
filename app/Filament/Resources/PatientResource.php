<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PatientResource\Pages;
use App\Models\Patient;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PatientResource extends Resource
{
    protected static ?string $model = Patient::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'System Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Name')
                    ->required()
                    ->maxLength(255),

                TextInput::make('phone')
                    ->label('Phone')
                    ->required()
                    ->tel()

                    ->maxLength(15),

                TextInput::make('address')
                    ->label('Address')
                    ->required()
                    ->maxLength(255),

                DatePicker::make('dob')
                    ->label('Date of Birth')
                    ->required(),

                Select::make('gender')
                    ->label('Gender')
                    ->options([
                        'male' => 'Male',
                        'female' => 'Female',
                    ])
                    ->required(),

                Hidden::make('user_id')
                    ->label('User ID')
                    ->default(fn () => auth()->id()), 
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Name')
                    ->sortable()
                    ->searchable()
                    ->limit(50),

                TextColumn::make('address')
                    ->label('Address')
                    ->sortable()
                    ->searchable()
                    ->limit(50),

                TextColumn::make('dob')
                    ->label('Date of Birth')
                    ->sortable()
                    ->date(),

                TextColumn::make('gender')
                    ->label('Gender'),
            ])
            ->filters([
                // Tambahkan filter di sini jika perlu
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(), // Delete dalam grup bulk actions
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // Tambahkan Relation Managers jika ada
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPatients::route('/'),
            'create' => Pages\CreatePatient::route('/create'),
            'edit' => Pages\EditPatient::route('/{record}/edit'),
        ];
    }
}
