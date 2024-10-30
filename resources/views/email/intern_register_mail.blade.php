<h1>Pendaftaran Berhasil</h1>
<p>Halo, {{ $name }}</p>
<p>Terima kasih telah mendaftar. Berikut adalah detail pendaftaran Anda:</p>
<p>Link untuk memantau status pendaftaran Anda: <a href="{{ route('internRegister.showByToken', $token) }}">{{ route('internRegister.showByToken', $token) }}</a></p>
<p>Gunakan token ini untuk memantau status pendaftaran Anda.</p>
