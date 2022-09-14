@component('mail::message')

@if($request->has('url'))
# New Content Indexing Request
@else
# New Contact Information
@endif

Hello,

{{ $request->name }} has sent you a request on {{ date('F j, Y, g:i a') }}. This email was generated from ({{ config('app.url') }}).

<p>
@component('mail::panel')
<strong>Name</strong><br>
{{ $request->name }}<br>

<strong>Email</strong><br>
{{ $request->email }}<br>

<strong>Comments</strong><br>
{{ $request->comments }}<br>

@if($request->has('url'))
<strong>Content Title</strong><br>
{{ $request->title }}<br>

<strong>Content URL</strong><br>
{{ $request->url }}
@endif
@endcomponent
</p>

Thanks,<br><br>
{{ config('app.name') }} Team<br>
<strong>National Aeronautics and Space Administration</strong>
@endcomponent
