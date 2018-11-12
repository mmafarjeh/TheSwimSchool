<?php

namespace App\Nova;

use App\Library\StripeApiCalls;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Country;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Place;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;

class Swimmer extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Swimmer';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    //public static $title = 'title';

    /**
     * @var string
     */
    public static $name = 'test';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'firstName',
        'lastName',
        'email'
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
            ID::make()->sortable(),
            Text::make('First Name', 'firstName')->sortable(),
            Text::make('Last Name', 'lastName')->sortable(),
            Text::make('Email', function () {
                return view('partials.link', [
                    'link' => 'mailto:'.$this->email,
                    'text' => $this->email
                ])->render();
            })->asHtml()->sortable(),
            Text::make('Phone', function () {
                return view('partials.link', [
                    'link' => 'tel:1'.$this->phone,
                    'text' => $this->phone
                ])->render();
            })->asHtml(),
            Date::make('Date of Birth', 'birthDate')->hideFromIndex(),
            Text::make('Age', function () {
                return view('partials.age', [
                    'birthDate' => $this->birthDate
                ])->render();
            })->hideFromIndex(),
            DateTime::make('Created At')->hideFromIndex(),
            DateTime::make('Updated At')->hideFromIndex(),
            (new Panel('Stripe Payment', $this->paymentInfo())),
            (new Panel('Address', $this->addressFields())),
            (new Panel('Emergency Contact', $this->emergencyContact())),
            (new Panel('Notes', $this->notes())),
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
        return [
            (new Metrics\SwimmersPerDay)->width('2/3'),
            (new Metrics\NewSwimmers)->width('1/3'),
            //(new Metrics\SwimmersPerLevel)->width('1/2')
        ];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [
            new Filters\Paid
        ];
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

    /**
     * Get the address fields for the resource.
     *
     * @return array
     */
    protected function addressFields()
    {
        return [
            Place::make('Address', 'street')->hideFromIndex(),
            Text::make('City', 'city')->hideFromIndex(),
            Text::make('State', 'state')->hideFromIndex(),
            Text::make('Postal Code', 'zip')->hideFromIndex(),
            Text::make('Country', function () {
                return 'US';
            })->hideFromIndex()
            //Country::make('Country')->hideFromIndex(),
        ];
    }


    /**
     * Get the address fields for the resource.
     *
     * @return array
     */
    protected function emergencyContact()
    {
        return [
            Text::make('Name', 'emergencyName')->hideFromIndex(),
            Text::make('Relationship', 'emergencyRelationship')->hideFromIndex(),
            Text::make('Phone', 'emergencyPhone')->hideFromIndex()
        ];
    }

    /**
     * Get the address fields for the resource.
     *
     * @return array
     */
    protected function paymentInfo()
    {
        return [
            Text::make('Charge Id', function () {
                return view('partials.link', [
                    'link' => config('nova.path').'/nova-stripe/charge/'.$this->stripeChargeId,
                    'text' => $this->stripeChargeId
                ])->render();
            })->asHtml()->hideFromIndex()
        ];
    }

    /**
     * Get the value that should be displayed to represent the resource.
     *
     * @return string
     */
    public function title()
    {
        return "$this->firstName $this->lastName";
    }

    /**
     * @return string
     */
    public static function label() {
        return 'Group Swimmers';
    }

    /**
     * Get the address fields for the resource.
     *
     * @return array
     */
    protected function notes()
    {
        return [
            Text::make('Notes', 'notes')->hideFromIndex(),
        ];
    }
}