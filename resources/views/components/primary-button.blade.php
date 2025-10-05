<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn-primary inline-flex items-center px-5 py-2.5 rounded-lg font-semibold text-sm tracking-wide hover:scale-105 active:scale-95 focus:outline-none focus:ring-2 focus:ring-brand focus:ring-offset-2 focus:ring-offset-transparent transition-all duration-150']) }}>
    {{ $slot }}
</button>