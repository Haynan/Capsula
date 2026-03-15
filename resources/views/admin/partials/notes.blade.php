<div class="capsula-card">
    <div class="flex items-center justify-between gap-4">
        <div>
            <p class="capsula-section-kicker">Timeline</p>
            <h2 class="mt-2 text-xl font-semibold">Notas internas</h2>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.notes.store') }}" class="mt-6 space-y-4">
        @csrf
        <input type="hidden" name="noteable_type" value="{{ $noteType }}">
        <input type="hidden" name="noteable_id" value="{{ $noteable->id }}">
        <div>
            <label class="capsula-label" for="content_{{ $noteType }}_{{ $noteable->id }}">Nova nota</label>
            <textarea id="content_{{ $noteType }}_{{ $noteable->id }}" name="content" class="capsula-textarea" placeholder="Registre contexto, próxima ação ou observação relevante."></textarea>
            @error('content')
                <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
            @enderror
        </div>
        <button class="capsula-button" type="submit">Adicionar nota</button>
    </form>

    <div class="mt-8 space-y-4">
        @forelse ($noteable->notes as $note)
            <div class="rounded-3xl border border-[var(--capsula-100)] bg-[var(--capsula-50)] px-5 py-4">
                <div class="flex items-center justify-between gap-4 text-sm text-[var(--capsula-500)]">
                    <span>{{ $note->user->name }}</span>
                    <span>{{ $note->created_at?->format('d/m/Y H:i') }}</span>
                </div>
                <p class="mt-3 whitespace-pre-line text-sm leading-7 text-[var(--capsula-700)]">{{ $note->content }}</p>
            </div>
        @empty
            <p class="text-sm text-[var(--capsula-500)]">Ainda não há notas registradas.</p>
        @endforelse
    </div>
</div>
