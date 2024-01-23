<?php

namespace App\Filament\Resources\AsiggmentResource\Pages;

use App\Filament\Resources\AsiggmentResource;
use App\Models\Tool;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateAsiggment extends CreateRecord
{
    protected static string $resource = AsiggmentResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    protected function getCreatedNotificationTitle(): ?string
    {
       return Notification::make()
           ->title('Asignacion registada corectamente!!')
           ->success()
           ->body('Registro una nueva asignacion ala base se datos')
           ->duration(3000)
           ->send();
    }


}
