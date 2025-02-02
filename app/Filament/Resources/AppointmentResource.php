<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AppointmentResource\Pages;
use App\Filament\Resources\AppointmentResource\RelationManagers;
use App\Models\Appointment;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\IconPosition;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Date;

class AppointmentResource extends Resource
{
    protected static ?string $model = Appointment::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    protected static ?string $navigationGroup = 'System Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Select::make('patient_id')
                    ->label('Patient Name')
                    ->relationship('patient', 'name')
                    ->searchable()
                    ->required(),

                DatePicker::make('appointment_date')
                    ->label('Appointment Date')
                    ->required(),

                Select::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Pending',
                        'accepted' => 'Accepted',
                        'rejected' => 'Rejected',
                        'completed' => 'Completed',
                    ])
                    ->required(),

                Select::make('doctor_id')
                    ->label('Doctor')
                    ->relationship('doctor', 'name') // Relasi yang benar
                    ->required()
                    ->options(function () {
                        return User::where('role', 'doctor')->pluck('name', 'id'); // Ambil ID dan nama dokter
                    })


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('patient.name')
                    ->label('Patient Name')
                    ->sortable(),

                TextColumn::make('appointment_date')
                    ->label('Appointment Date')
                    ->date(),

                TextColumn::make('status')
                    ->label('Status')
                    ->formatStateUsing(fn(string|int|null $state): string => match ($state) {
                        'pending' => 'Pending',
                        'accepted' => 'Accepted',
                        'rejected' => 'Rejected',
                        'completed' => 'Completed',
                    })
                    ->badge()
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'accepted',
                        'danger' => 'rejected',
                        'info' => 'completed',
                    ]),

                TextColumn::make('doctor.name')
                    ->label('Doctor')
                    ->limit(20),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Edit')
                    ->iconPosition(IconPosition::After)
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
            'index' => Pages\ListAppointments::route('/'),
            'create' => Pages\CreateAppointment::route('/create'),
            'edit' => Pages\EditAppointment::route('/{record}/edit'),
        ];
    }
}
