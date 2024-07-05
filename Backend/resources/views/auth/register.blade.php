<x-guest-layout>
    @include('auth.script-alert')
    <div class="font-sans min-h-screen antialiased bg-gray-900 pt-24 pb-5">
        <div class="flex flex-col justify-center sm:w-96 sm:m-auto mx-5 mb-5 space-y-8">
            <h1 class="font-bold text-center text-4xl text-yellow-500">Register<span class="text-blue-500">Account</span>
            </h1>
            <form method="POST" action="{{ route('auth.register.store') }}">
                @csrf
                <div class="flex flex-col bg-white p-10 rounded-lg shadow space-y-6">
                    <h1 class="font-bold text-xl text-center">Register account</h1>

                    <div class="flex flex-col space-y-1">
                        <input type="text" name="name" id="name"
                            class="border-2 rounded px-3 py-2 w-full focus:outline-none focus:border-blue-400 focus:shadow"
                            placeholder="Name" :value="old('Name')" required autofocus />
                    </div>

                    <div class="flex flex-col space-y-1">
                        <input type="email" name="email" id="email"
                            class="border-2 rounded px-3 py-2 w-full focus:outline-none focus:border-blue-400 focus:shadow"
                            placeholder="Email" :value="old('email')" required autofocus />
                    </div>

                    <div class="flex flex-col space-y-1">
                        <input type="password" name="password" id="password"
                            class="border-2 rounded px-3 py-2 w-full focus:outline-none focus:border-blue-400 focus:shadow"
                            placeholder="Password" :value="old('password')" required />
                    </div>

                    <div class="flex flex-col space-y-1">
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="border-2 rounded px-3 py-2 w-full focus:outline-none focus:border-blue-400 focus:shadow"
                            placeholder="Re-enter password" required />
                    </div>

                    <div class="flex flex-col space-y-1">
                        <input type="text" name="profile" id="profile"
                            class="border-2 rounded px-3 py-2 w-full focus:outline-none focus:border-blue-400 focus:shadow"
                            hidden />
                    </div>

                    <div class="flex flex-col-reverse sm:flex-row sm:justify-between items-center">
                        <button type="submit"
                            class="bg-blue-500 text-white font-bold px-5 py-2 rounded focus:outline-none shadow hover:bg-blue-700 transition-colors m-auto">Register</button>
                    </div>
                    <a class="text-center" href="{{ url('/') }}">Login account</a>
                </div>
            </form>
            <div class="flex justify-center text-gray-500 text-sm">
                <p>Copyright
                    <script>
                        document.write(new Date().getFullYear());
                    </script>
                </p>
            </div>
        </div>
    </div>

    {{-- alert when the password not match --}}
    @if (Session::has('message'))
        <script>
            swal("Messages", "{{ Session::get('message') }}", 'error'), {
                button: true,
                button: "OK",
                timer: 3000,
                dangerMode: true,
            };
        </script>
    @endif

    <script>
        // Set up profile for the user
        var files = document.getElementById("profile");
        files.value = 'Profile.jpg';
    </script>
</x-guest-layout>
