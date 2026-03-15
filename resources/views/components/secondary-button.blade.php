<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center rounded-full border border-[var(--capsula-300)] bg-white px-5 py-3 text-xs font-semibold uppercase tracking-[0.2em] text-[var(--capsula-700)] transition hover:border-[var(--capsula-500)] hover:text-[var(--capsula-900)] focus:outline-none focus:ring-2 focus:ring-[var(--capsula-500)] focus:ring-offset-2 disabled:opacity-25']) }}>
    {{ $slot }}
</button>
