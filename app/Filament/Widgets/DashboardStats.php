<?php

namespace App\Filament\Widgets;

use App\Models\Appointment;
use App\Models\Invoice;
use App\Models\MedicalRecord;
use App\Models\Patient;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            //
            Stat::make('Total Patients', Patient::count())
                ->description('Total number of registered patients')
                ->icon('heroicon-o-user-group'),

            Stat::make('Total Appointments', Appointment::count())
                ->description('Total number of scheduled appointments')
                ->icon('heroicon-o-calendar'),

            Stat::make('Total Invoices', Invoice::count())
                ->description('Total number of issued invoices')
                ->icon('heroicon-o-credit-card'),

            Stat::make('Total Doctors', User::where('role', 'doctor')->count())
                ->description('Total number of doctors registered')
                ->icon('heroicon-o-user'),

            Stat::make('Total Medical Records', MedicalRecord::count())
                ->description('Total number of medical records')
                ->icon('heroicon-o-document-text'),

            Stat::make('Completed Appointments', Appointment::where('status', 'Completed')->count())
                ->description('Number of completed appointments')
                ->icon('heroicon-o-check-circle'),
        ];
    }
}
