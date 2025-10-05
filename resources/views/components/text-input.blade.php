@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'form-input border border-primary/20 focus:border-brand focus:ring-brand focus:ring-offset-0 rounded-lg transition-all']) }}>
