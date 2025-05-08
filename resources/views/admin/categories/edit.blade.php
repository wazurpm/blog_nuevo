<x-layouts.app>

    <flux:breadcrumbs class="mb-4">
        <flux:breadcrumbs.item :href="route('dashboard')">
            Dashboard
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item :href="route('admin.categories.index')">
            Categories
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item>
            Edit
        </flux:breadcrumbs.item>
    </flux:breadcrumbs>

<div class="card">
    <form action="{{ route('admin.categories.update', $category) }}" method="POST">
        
        @csrf

        @method('PUT')
        
        <flux:input
            label="Name"
            name="name"
            placeholder="Category's name"
            value="{{ old('name', $category->name) }}"
        />

        <flux:button variant="primary" class="cursor-pointer mt-4" type="submit">
            Submit
        </flux:button>

        <flux:button :href="route('admin.categories.index')" variant="subtle" class="cursor-pointer mt-4">
            Cancel
        </flux:button>
        
    </form>
</div>

</x-layouts.app>