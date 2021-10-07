@component('mail::message')
# hi {{$user['name']}}
offer mail .

@component('mail::button', ['url' => 'http://ecommerce.test/customer'])
Get offer
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
