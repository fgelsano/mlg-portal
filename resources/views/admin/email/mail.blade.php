@component('mail::message')
# Greetings {{ $profile->first_name .' '. $profile->last_name }}!

Your bill for {{ $sem }} of AY {{ $ay }} is now ready.<br>
Access your billing profile <a href="{{ $url }}">here</a>.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
