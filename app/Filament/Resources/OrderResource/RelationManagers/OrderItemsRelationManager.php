<?php

namespace App\Filament\Resources\OrderResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class OrderItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'orderItems';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('product_name')
                    ->required()
                    ->maxLength(255)
                    ->disabled(),

                Forms\Components\TextInput::make('quantity')
                    ->required()
                    ->numeric()
                    ->disabled(),

                Forms\Components\TextInput::make('unit_price')
                    ->required()
                    ->numeric()
                    ->prefix('SAR')
                    ->disabled(),

                Forms\Components\TextInput::make('total')
                    ->required()
                    ->numeric()
                    ->prefix('SAR')
                    ->disabled(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('product_name')
            ->columns([
                Tables\Columns\TextColumn::make('product_name'),
                Tables\Columns\TextColumn::make('quantity'),
                Tables\Columns\TextColumn::make('unit_price')->money('sar'),
                Tables\Columns\TextColumn::make('total')->money('sar'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // No create action
            ])
            ->actions([
                // No edit or delete actions
            ])
            ->bulkActions([
                // No bulk actions
            ]);
    }
}
