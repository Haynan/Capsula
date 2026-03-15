@csrf
@if(isset($method) && $method === 'PUT') @method('PUT') @endif
<div class="grid gap-6 md:grid-cols-2">
    <div><label class="capsula-label">Nome</label><input name="name" class="capsula-input" value="{{ old('name', $partner->name) }}" required></div>
    <div><label class="capsula-label">Slug</label><input name="slug" class="capsula-input" value="{{ old('slug', $partner->slug) }}"></div>
    <div><label class="capsula-label">Website</label><input name="website_url" class="capsula-input" value="{{ old('website_url', $partner->website_url) }}"></div>
    <div><label class="capsula-label">Ordem</label><input name="sort_order" type="number" class="capsula-input" value="{{ old('sort_order', $partner->sort_order ?? 0) }}"></div>
    <div class="md:col-span-2"><label class="capsula-label">Descrição</label><textarea name="description" class="capsula-textarea">{{ old('description', $partner->description) }}</textarea></div>
    <div><label class="capsula-label">Logo</label><input name="logo" type="file" class="capsula-input"></div>
    <div class="flex flex-col gap-3 pt-8">
        <label class="flex items-center gap-3 text-sm"><input type="checkbox" name="is_active" value="1" @checked(old('is_active', $partner->is_active))> Parceiro ativo</label>
        @if($partner->logo_path)
            <label class="flex items-center gap-3 text-sm"><input type="checkbox" name="remove_logo" value="1"> Remover logo atual</label>
        @endif
    </div>
</div>
@if($partner->logo_path)
    <div class="mt-6"><img src="{{ $partner->logo_url }}" alt="{{ $partner->name }}" class="h-16 w-auto object-contain"></div>
@endif
@if ($errors->any())<div class="mt-4 rounded-3xl border border-rose-200 bg-rose-50 px-5 py-4 text-sm text-rose-700"><ul class="space-y-1">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
<div class="mt-6 flex gap-3"><button class="capsula-button">{{ $submitLabel }}</button><a href="{{ route('admin.partners.index') }}" class="capsula-button-secondary">Cancelar</a></div>
