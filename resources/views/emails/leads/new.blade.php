<x-mail::message>
# Novo lead recebido

Um novo lead foi registrado no site da Cápsula Corretora.

<x-mail::panel>
Nome: {{ $lead->name }}<br>
E-mail: {{ $lead->email }}<br>
Telefone: {{ $lead->phone }}<br>
WhatsApp: {{ $lead->whatsapp ?: 'Não informado' }}<br>
Cidade/UF: {{ trim(($lead->city ?: '').' / '.($lead->state ?: ''), ' /') ?: 'Não informado' }}<br>
Produto: {{ $lead->product?->name ?: 'Não informado' }}<br>
Origem: {{ $lead->source }}
</x-mail::panel>

@if($lead->message)
Mensagem:

{{ $lead->message }}
@endif

Obrigado,<br>
{{ config('app.name') }}
</x-mail::message>
