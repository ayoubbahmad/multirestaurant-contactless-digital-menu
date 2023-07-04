
    @if(\App\Application::all()->count()>=1)
        @php
        $currency = (\App\Application::all()->first()->currency_symbol ?? '$');
        $currency = (auth()->user()->currency_symbol ?? $currency);
        @endphp
        @if(\App\Application::all()->first()->currency_symbol_location  == "right")
        <price> {{number_format((float) $amount, 2, '.', '') }} {{$currency }}</price>
        @else
        <price>{{$currency }} {{number_format((float) $amount, \App\Application::all()->first()->decimal_digits ?? 2 , '.', '') }} </price>
        @endif
    @elseif($account_info)
        @php
            $currency = $account_info->currency_symbol ?? '$';
        @endphp
        <price>{{$currency }} {{number_format((float) $amount,2) }} </price>
    @else
        <price>{{'$'}}{{$amount}}</price>
    @endif


