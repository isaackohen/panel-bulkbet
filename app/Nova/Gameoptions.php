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

class Gameoptions extends Resource
{

    public static function label()
    {
        return 'Casino';
    }


    public static function authorizedToCreate(Request $request)
    {
        if(auth()->user()->admin !== '1'){
        return false;
        }
    }

    public function authorizedToDelete(Request $request)
    {
        return false;
    }

    public function authorizedToUpdate(Request $request)
    {
        return false;
    }

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Gameoptions::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'apikey';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'user'
    ];
    public static function indexQuery(NovaRequest $request, $query)
    {
        if($request->user()->admin != '1') {
            return $query->where('ownedBy', $request->user()->id);
        } else {
            return $query;
        }
    }

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
            Text::make('Casino ID', 'id')
                ->sortable()
                ->readonly(),
                Text::make('Casino Return URL', 'operatorurl')
                ->hideFromIndex()
                ->rules('required', 'max:128', 'min:3'),
            Text::make('Api Key', 'apikey')
                ->sortable()
                ->default(strtoupper(md5(microtime())))
                ->rules('required', 'max:32', 'min:3')
                ->readonly(function() {
                    return $this->resource->id ? true : false;
                }),
            Text::make('Static Host', 'statichost')
                ->hideFromIndex()
                ->rules('required', 'max:32', 'min:3'),
            Text::make('Callback Base URL', 'callbackurl')
                ->hideFromIndex()
                ->rules('required', 'max:128', 'min:3'),
            Text::make('Callback Prefix Slots', 'slots_prefix')
                ->hideFromIndex()
                ->rules('required', 'max:24', 'min:2'),
            Text::make('Callback Prefix Live Casino', 'livecasino_prefix')
                ->hideFromIndex()
                ->rules('required', 'max:24', 'min:2'),
            Text::make('Bank Group', 'bankgroup')
                ->hideFromIndex()
                ->readonly(function ($request) {
                    return $request->user()->admin != "1";
            })->rules('required', 'max:32', 'min:3'),
            Text::make('Bonus Bank Group', 'bonusbankgroup')
                ->hideFromIndex()->readonly(function ($request) {
                    return $request->user()->admin != "1";
            })->rules('required', 'max:32', 'min:3'),
            Text::make('Session Subdomain', 'sessiondomain')
                ->hideFromIndex()
                ->readonly(function ($request) {
                    return $request->user()->admin != "1";
                })->rules('required', 'max:32', 'min:3'),
            Select::make('Status', 'active')->options([
                '1' => 'Active',
                '0' => 'Inactive'
            ])->displayUsingLabels()->hideFromIndex()->hideFromDetail()->readonly(function ($request) {
                    return $request->user()->admin != "1";
            })->rules('required'),
            Indicator::make('Active', 'active')
                ->labels([
                    '1' => 'Active',
                    '0' => 'Inactive'
                ])
                ->colors([
                    '1' => 'green',
                    '2' => 'red'
                ]),
            Select::make('Live Casino', 'livecasino_enabled')->options([
                '1' => 'Enabled',
                '0' => 'Disabled'
            ])->displayUsingLabels()->hideFromIndex()->hideFromDetail()->readonly(function ($request) {
                    return $request->user()->admin != "1";
            })->rules('required'),
            Indicator::make('Live Casino', 'livecasino_enabled')
                ->labels([
                    '1' => 'Enabled',
                    '0' => 'Disabled'
                ])
                ->colors([
                    '1' => 'green',
                    '2' => 'red'
                ]),
            new Panel('Revenue', $this->addressFields()),

        ];
    }

/**
 * Get the address fields for the resource.
 *
 * @return array
 */
protected function addressFields()
{
    return [
        Money::make('Profit Today', 'USD', 'profitToday'),
        Money::make('Profit Yesterday', 'USD', 'profitYesterday')->hideFromIndex(),
        Money::make('Profit Cycle', 'USD', 'profitCycle')->hideFromIndex(),
        Money::make('Profit Alltime', 'USD', 'profitAlltime')->hideFromIndex(),
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
        return [

            new DownloadExcel,

        ];
    }
}
