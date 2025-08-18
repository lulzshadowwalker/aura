<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProduct extends EditRecord
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    /**
     * Mutate form data before filling the form, for Livewire compatibility.
     */
    protected function mutateFormDataBeforeFill(array $data): array
    {
        $before = $data;
        if (isset($data['amount'])) {
            $data['price'] = $data['amount'];
        }

        if (isset($data['sale_amount'])) {
            $data['sale_price'] = $data['sale_amount'];
        }

        return $data;
    }
}
