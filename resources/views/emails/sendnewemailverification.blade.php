<x-mail::message>
# Introduction

Please click button below to verify your new email.

<x-mail::button :url="$url">
Verify
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
