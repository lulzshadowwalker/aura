<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Order Details')
                    ->description('View order information and status.')
                    ->aside()
                    ->schema([
                        Forms\Components\TextInput::make('order_number')
                            ->required()
                            ->disabled()
                            ->helperText('The unique identifier for this order.'),

                        Forms\Components\Select::make('status')
                            ->options([
                                'yes' => 'Yes',
                                'no' => 'No',
                            ])
                            ->required()
                            ->helperText('The current status of the order.'),

                        Forms\Components\TextInput::make('promo_code')
                            ->disabled()
                            ->helperText('The promo code used for this order, if any.'),
                    ]),

                Forms\Components\Section::make('Financials')
                    ->description('View the financial details of the order.')
                    ->aside()
                    ->schema([
                        Forms\Components\TextInput::make('subtotal')
                            ->required()
                            ->numeric()
                            ->prefix('SAR')
                            ->disabled(),

                        Forms\Components\TextInput::make('discount_amount')
                            ->required()
                            ->numeric()
                            ->prefix('SAR')
                            ->disabled(),

                        Forms\Components\TextInput::make('total')
                            ->required()
                            ->numeric()
                            ->prefix('SAR')
                            ->disabled(),
                    ]),

                Forms\Components\Section::make('Customer')
                    ->description('The customer who placed the order.')
                    ->aside()
                    ->schema([
                        Forms\Components\Select::make('customer_id')
                            ->relationship('customer.user', 'name')
                            ->required()
                            ->disabled()
                            ->helperText('The customer associated with this order.'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order_number')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('customer.user.name')
                    ->searchable()
                    ->sortable()
                    ->tooltip(fn (Order $record) => $record->customer->user->name),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'yes' => 'success',
                        'no' => 'danger',
                        default => 'secondary',
                    }),

                Tables\Columns\TextColumn::make('total')
                    ->money('sar')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'yes' => 'Yes',
                        'no' => 'No',
                    ])
                    ->multiple(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->slideOver(),
                Tables\Actions\EditAction::make()->slideOver(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\OrderItemsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', 'pending')->count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return static::getModel()::where('status', 'pending')->count() > 0 ? 'warning' : 'primary';
    }
}
