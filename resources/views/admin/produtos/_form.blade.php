@csrf
@if(isset($method) && $method === 'PUT') @method('PUT') @endif
<div class="grid gap-6 md:grid-cols-2">
    <div><label class="capsula-label">Nome</label><input name="name" class="capsula-input" value="{{ old('name', $product->name) }}" required></div>
    <div><label class="capsula-label">Slug</label><input name="slug" class="capsula-input" value="{{ old('slug', $product->slug) }}"></div>
    <div class="md:col-span-2"><label class="capsula-label">Descrição curta</label><input name="short_description" class="capsula-input" value="{{ old('short_description', $product->short_description) }}"></div>
    <div class="md:col-span-2"><label class="capsula-label">Descrição longa</label><textarea name="full_description" class="capsula-textarea">{{ old('full_description', $product->full_description) }}</textarea></div>
    <div><label class="capsula-label">Ordem</label><input name="sort_order" type="number" class="capsula-input" value="{{ old('sort_order', $product->sort_order ?? 0) }}"></div>
    <div class="flex flex-col gap-3 pt-8">
        <label class="flex items-center gap-3 text-sm"><input type="checkbox" name="is_active" value="1" @checked(old('is_active', $product->is_active))> Produto ativo</label>
        <label class="flex items-center gap-3 text-sm"><input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $product->is_featured))> Produto em destaque</label>
    </div>
</div>
@if ($errors->any())<div class="mt-4 rounded-3xl border border-rose-200 bg-rose-50 px-5 py-4 text-sm text-rose-700"><ul class="space-y-1">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
<div class="mt-6 flex gap-3"><button class="capsula-button">{{ $submitLabel }}</button><a href="{{ route('admin.products.index') }}" class="capsula-button-secondary">Cancelar</a></div>
