<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Select;
use Inspheric\Fields\Indicator;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;
use Laravel\Nova\Panel;
use Laravel\Nova\Place;
use Vyuldashev\NovaMoneyField\Money;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\DateTime;

class Transactions extends Resource
{
    public static function authorizedToCreate(Request $request)
    {
        return false;
    }

    public function authorizedToDelete(Request $request)
    {
        return false;
    }

    public function authorizedToUpdate(Request $request)
    {
        return false;
    }
    
    public static $model = \App\Models\GameTransactions::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    public static $title = 'Game Transactions';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'casinoid', 'player', 'gameid'
    ];



    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [

            BelongsTo::make('User')->rules('required')
            ->readonly(function ($request) {
                    return $request->user()->admin != "1";
            }),
            Text::make('Casino ID', 'casinoid')
                ->sortable()
                ->readonly(),
            Text::make('Player', 'player'),
                            Text::make('Bet', 'bet', function () {
                return '$'.($this->bet / 100);
                }),
                Text::make('Win', 'win', function () {
                return '$'.(round($this->win / 100, 2));
                }),   
            Text::make('Game ID', 'gameid'),
            DateTime::make(__('Timestamp'), 'created_at')
            ->sortable(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
