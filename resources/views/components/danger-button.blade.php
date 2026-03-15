<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center rounded-full bg-rose-600 px-5 py-3 text-xs font-semibold uppercase tracking-[0.2em] text-white transition hover:bg-rose-500 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:ring-offset-2']) }}>
    {{ $slot }}
</button>
