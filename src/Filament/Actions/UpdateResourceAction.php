<?php

namespace Firsadev\FilamentResourceRole\Filament\Actions;

use Closure;
use Firsadev\FilamentResourceRole\Models\Resource;
use Firsadev\FilamentResourceRole\Helpers\GetModel;
use Filament\Tables\Table;
use Filament\Actions\Action;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Artisan;
use Filament\Actions\Contracts\HasActions;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Actions\Concerns\CanCustomizeProcess;
use Filament\Resources\RelationManagers\RelationManager;

class UpdateResourceAction extends Action
{
    use CanCustomizeProcess;
    
    

    public static function getDefaultName(): ?string
    {
        return ' Update Resource';
    }


    protected function setUp(): void
    {
        parent::setUp();
        $this->successNotificationTitle(__('Updated'));

        $this->action(
            function():void{
            $this->process(function(array $data, HasActions & HasSchemas $livewire, ?Model $record, ?Table $table){
                $models = GetModel::all();
                 /** @disregard P1013 Undefined method */
                $record = $livewire->getOwnerRecord();
                foreach ($models as $key=> $model) {
                    $resource = Resource::updateOrCreate([
                        'name' => $model
                    ]);
                    $record->canAccesResources()->syncWithoutDetaching($resource->id);
    
                    Artisan::call('make:policy',[
                        'name' => $model.'Policy',
                        '--model' => $model
                    ]);
                }

            });
            $this->success();
        }
        );
    }

    
}