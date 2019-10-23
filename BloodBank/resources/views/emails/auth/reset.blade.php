@component('mail::message')
# Introduction

<h2>Blood Bank reset password</h2>
   <p>Hello {{ $client->name }}
@component('mail::button', ['url' => 'http://blood_bank.com', 'color' => 'success'])
Reset
@endcomponent

<p>Dear user, Your reset password is: {{ $client->pin_code }}</p>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
