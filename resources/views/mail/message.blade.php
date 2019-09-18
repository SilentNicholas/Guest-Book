<h3>{{ $confirm->name }}, спасибо вам за использование нашего сайта! Для подтверждения своего email перейдите по ссылке ниже</h3>
<button><a href="{{ route('email.confirm', $confirm->remember_token) }}">Подтвердить</a></button>
