<?php

namespace App\Filament\Resources\MessageResource\Pages;

use App\Filament\Resources\MessageResource;
use Filament\Resources\Pages\CreateRecord;
use App\Mail\ContactMessageMail;
use Illuminate\Support\Facades\Mail;

class CreateMessage extends CreateRecord
{
    protected static string $resource = MessageResource::class;

    protected function afterCreate(): void
    {
        // Enviar correo al admin
        Mail::to('softsolution.eu.software@gmail.com')
            ->send(new ContactMessageMail($this->record));
    }
}
