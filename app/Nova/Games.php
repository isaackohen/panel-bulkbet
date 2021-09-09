<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Text;
class Games extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */

    public static $model = \App\Models\Games::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    protected $primaryKey = 'game_id';

    public static $title = 'game_id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'game_id', 'game_name', 'game_provider',
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
           /** //ID::make(__('Internal ID'), 'id')->sortable(),
            BelongsTo::make(__('Provider'), 'game_provider', Provider::class)
            ->display(function ($provider) {
                return $provider->name;
            }), 
                 */
            ID::make(__('ID'), 'game_id'),
            Text::make('Game Name', 'game_name'),
            Text::make('Game Description', 'game_desc'),

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
