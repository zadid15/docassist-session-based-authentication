<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MedicalRecordResource\Pages;
use App\Filament\Resources\MedicalRecordResource\RelationManagers;
use App\Models\MedicalRecord;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MedicalRecordResource extends Resource
{
    protected static ?string $model = MedicalRecord::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'System Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Select::make('patient_id')
                    ->relationship('patient', 'name')
                    ->searchable()
                    ->required(),

                TextInput::make('diagnosis')
                    ->required()
                    ->maxLength(1000),

                TextInput::make('prescription')
                    ->required()
                    ->maxLength(1000),

                TextInput::make('notes')
                    ->required()
                    ->maxLength(1000),

                Hidden::make('doctor_id')
                    ->default(fn() => auth()->id()),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('patient.name')
                    ->label('Patient Name')
                    ->sortable()
                    ->searchable()
                    ->limit(50),

                TextColumn::make('diagnosis')
                    ->label('Diagnosis')
                    ->limit(20),

                TextColumn::make('doctor.name')
                    ->label('Assigned Doctor')
                    ->limit(20)
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ])->authorize(fn() => auth()->user()->hasRole('admin') && auth()->user()->is_active),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMedicalRecords::route('/'),
            'create' => Pages\CreateMedicalRecord::route('/create'),
            'edit' => Pages\EditMedicalRecord::route('/{record}/edit'),
        ];
    }
}
