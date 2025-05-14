<x-layouts.app>

        <flux:breadcrumbs class="mb-4">
            <flux:breadcrumbs.item :href="route('dashboard')">
                Dashboard
            </flux:breadcrumbs.item>
            <flux:breadcrumbs.item :href="route('admin.posts.index')">
                Posts
            </flux:breadcrumbs.item>
            <flux:breadcrumbs.item>
                New
            </flux:breadcrumbs.item>
        </flux:breadcrumbs>

    <div class="card">
        <form action="{{ route('admin.posts.store') }}" method="POST" class="space-y-4">
            
            @csrf
            
            <flux:input
                onInput="string_to_slug(this.value, '#slug')"
                label="Title"
                name="title"
                placeholder="Post's title"
                value="{{ old('title') }}"
            />

            <flux:input readOnly
                label="Slug"
                name="slug"
                id="slug"
                placeholder="Auto generated slug"
                value="{{ old('slug') }}"
            />

            <flux:select label="Category" name="category_id" placeholder="Select post's category...">
                @foreach ($categories as $category)
                    <flux:select.option value="{{ $category->id }}">
                        {{ $category->name }}
                    </flux:select.option>
                @endforeach
            </flux:select>

            <flux:button variant="primary" class="cursor-pointer" type="submit">
                Submit
            </flux:button>

            <flux:button :href="route('admin.posts.index')" variant="subtle" class="cursor-pointer mt-4">
                Cancel
            </flux:button>
            
        </form>
    </div>

</x-layouts.app>