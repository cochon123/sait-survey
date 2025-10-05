<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-5 py-2.5 bg-red-600 dark:bg-red-500 border border-transparent rounded-lg font-semibold text-sm text-white tracking-wide hover:bg-red-500 dark:hover:bg-red-600 active:bg-red-700 hover:scale-105 active:scale-95 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 focus:ring-offset-transparent transition-all duration-150']) }}>
    {{ $slot }}
</button>
