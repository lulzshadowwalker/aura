<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReviewResource\Pages;
use App\Models\Review;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ReviewResource extends Resource
{
    protected static ?string $model = Review::class;

    protected static ?string $navigationIcon = 'heroicon-o-star';

    protected static ?string $navigationGroup = 'Customer Engagement';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Review Details')
                    ->description('View the details of the review.')
                    ->aside()
                    ->schema([
                        Forms\Components\TextInput::make('rating')
                            ->required()
                            ->numeric()
                            ->minValue(1)
                            ->maxValue(5)
                            ->disabled()
                            ->helperText('The star rating given by the customer.'),

                        Forms\Components\Textarea::make('content')
                            ->required()
                            ->disabled()
                            ->helperText('The content of the review.')
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Associations')
                    ->description('Product and customer associated with this review.')
                    ->aside()
                    ->schema([
                        Forms\Components\Select::make('product_id')
                            ->relationship('product', 'name')
                            ->required()
                            ->disabled()
                            ->helperText('The product that was reviewed.'),

                        Forms\Components\Select::make('customer_id')
                            ->relationship('customer.user', 'name')
                            ->disabled()
                            ->helperText('The customer who wrote the review.'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('rating')
                    ->numeric()
                    ->sortable()
                    ->formatStateUsing(fn ($state) => str_repeat('★', $state).str_repeat('☆', 5 - $state)),

                Tables\Columns\TextColumn::make('product.name')
                    ->sortable()
                    ->searchable()
                    ->limit(30)
                    ->tooltip(fn (Review $record) => $record->product->name),

                Tables\Columns\TextColumn::make('customer.user.name')
                    ->sortable()
                    ->searchable()
                    ->limit(30)
                    ->tooltip(fn (Review $record) => $record->customer->user->name),

                Tables\Columns\TextColumn::make('content')
                    ->searchable()
                    ->limit(40)
                    ->tooltip(fn (Review $record) => $record->content),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('rating')
                    ->options([
                        5 => '★★★★★',
                        4 => '★★★★☆',
                        3 => '★★★☆☆',
                        2 => '★★☆☆☆',
                        1 => '★☆☆☆☆',
                    ])
                    ->multiple(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->slideOver(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])->defaultSort('created_at', 'desc');
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
            'index' => Pages\ListReviews::route('/'),
            'edit' => Pages\EditReview::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return static::getModel()::count() > 0 ? 'primary' : 'gray';
    }
}
