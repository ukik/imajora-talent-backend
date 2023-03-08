@component('mail::message')
    # Selamat anda berhasil membuat akun

    @component('mail::panel')
        Email : {{ $dataSignUp['email'] }}
        <br>
        Password : {{ $dataSignUp['password'] }}
    @endcomponent

    @component('mail::button', ['url' => 'http://localhost:8000/login'])
        Login
    @endcomponent

    Thanks,<br>
    Imajora Corporate
@endcomponent
