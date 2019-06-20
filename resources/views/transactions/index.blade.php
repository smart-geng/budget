@extends('layout')

@section('title', __('models.transactions'))

@section('body')
    <div class="wrapper my-3">
        <div class="row mb-3">
            <div class="row__column row__column--middle">
                <h2>{{ __('models.transactions') }}</h2>
            </div>
            <div class="row__column row__column--compact row__column--middle">
                <a href="/transactions/create" class="button">{{ __('actions.create') }} {{ __('models.transactions') }}</a>
            </div>
        </div>
        <div class="row row--responsive">
            <div class="row__column mr-3" style="max-width: 300px;">
                <div class="box">
                    <div class="box__section">
                        <div class="mb-2">
                            <a href="/transactions">Reset</a>
                        </div>
                        <span>Filter by Tag</span>
                        @foreach ($tags as $tag)
                            <div class="mt-1 ml-1">
                                <a href="/transactions?filterBy=tag-{{ $tag->id }}">{{ $tag->name }}</a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row__column">
                @if ($yearMonths)
                    @foreach ($yearMonths as $key => $transactions)
                        <h2 class="{{ key($yearMonths) != $key ? 'mt-3' : '' }} mb-2">{{ __('calendar.months.' . ltrim(explode('-', $key)[1], 0)) }}, {{ explode('-', $key)[0] }}</h2>
                        <div class="box">
                            @foreach ($transactions as $transaction)
                                <div class="box__section row">
                                    <div class="row__column row__column--middle">{{ $transaction->description }}</div>
                                    <div class="row__column">
                                        @if ($transaction->tag)
                                            <div class="row">
                                                <div class="row__column row__column--compact row__column--middle mr-05" style="font-size: 12px;">
                                                    <i class="fas fa-tag" style="color: #{{ $transaction->tag->color }};"></i>
                                                </div>
                                                <div class="row__column row__column--compact row__column--middle">{{ $transaction->tag->name }}</div>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="row__column row__column--compact row__column--middle {{ get_class($transaction) == 'App\Earning' ? 'color-green' : 'color-red' }}">{!! $currency !!} {{ $transaction->formatted_amount }}</div>
                                    <div class="row__column row__column--compact row__column--middle ml-1 {{ get_class($transaction) == 'App\Earning' ? 'color-green' : 'color-red' }}">
                                        @if (get_class($transaction) == 'App\Earning')
                                            <i class="fas fa-arrow-alt-left fa-sm"></i>
                                        @else
                                            <i class="fas fa-arrow-alt-right fa-sm"></i>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                @else
                    <div class="box">
                        @include('partials.empty_state', ['payload' => 'transactions'])
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection