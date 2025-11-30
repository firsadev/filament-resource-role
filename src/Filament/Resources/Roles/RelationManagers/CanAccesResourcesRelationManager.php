<?php

namespace Firsadev\FilamentResourceRole\Filament\Resources\Roles\RelationManagers;

use Firsadev\FilamentResourceRole\Models\Resource;
use Firsadev\FilamentResourceRole\Helpers\GetModel;
use Filament\Tables\Table;
use Filament\Actions\Action;
use Filament\Schemas\Schema;
use Filament\Actions\EditAction;
use Filament\Actions\AttachAction;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DetachAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DetachBulkAction;
use Filament\Forms\Components\Checkbox;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Artisan;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\CheckboxColumn;
use Firsadev\FilamentResourceRole\Filament\Actions\UpdateResourceAction;
use Filament\Resources\RelationManagers\RelationManager;

class CanAccesResourcesRelationManager extends RelationManager
{
    protected static string $relationship = 'canAccesResources';


    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
            TextColumn::make('name')
            ->searchable(),
              CheckboxColumn::make('viewAny'),
              CheckboxColumn::make('view'),
              CheckboxColumn::make('create'),
              CheckboxColumn::make('update'),
              CheckboxColumn::make('delete'),   
              CheckboxColumn::make('restore'), 
              CheckboxColumn::make('forceDelete'), 
            ])
            ->filters([
                //
            ])
            ->headerActions([
                    UpdateResourceAction::make()
            ])
            ->recordActions([
                $this->checkOrUncheck()
                // DetachAction::make()
            ])
            ->toolbarActions([]);
    }

    public function checkOrUncheck() : Action 
    {
        return  Action::make('CheckOrUncheck All Record Resource')
        ->iconButton()
        ->label('Check or Uncheck All Record Resource')
        ->icon(function(Model $record):string{
            $trueorfalse = $record->viewAny&&$record->view&&$record->create&&$record->update&&$record->delete&&$record->restore&&$record->forceDelete;   
            return $trueorfalse ?'heroicon-m-x-mark':'heroicon-m-check';
            })
        ->action(
            function (Model $record) {
                    $trueorfalse = $record->viewAny&&$record->view&&$record->create&&$record->update&&$record->delete&&$record->restore&&$record->forceDelete;   
                    $record->roles()->updateExistingPivot(
                    $record->role_id,
                    [
                        'viewAny' => $trueorfalse?false:true,
                        'view' => $trueorfalse?false:true,
                        'create' => $trueorfalse?false:true,
                        'update' => $trueorfalse?false:true,
                        'delete' => $trueorfalse?false:true,
                        'restore' => $trueorfalse?false:true,
                        'forceDelete' => $trueorfalse?false:true,
                    ]
                );
            }
        );
    }

    
}
