<x-admin.layouts.base title="Login">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">

        <div
            class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    Логирајте се на вашата сметка
                </h1>
                <form class="space-y-4 md:space-y-6" action="{{ route('sign-in') }}" method="POST">
                    @csrf
                    <x-admin.parts.form.input label='Е-маил' name='email' :value="old('email')" />
                    <x-admin.parts.form.input label='Лозинка' name='password' type="password"/>
                    @error('loginErr')
                        <x-admin.parts.form.error class="mt-2">{{ $message }}</x-admin.parts.form.error>
                    @enderror
                    <button type="submit"
                        class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 cursor-pointer">Логирајте
                        се </button>
                </form>
            </div>
        </div>
    </div>
</x-admin.layouts.base>
