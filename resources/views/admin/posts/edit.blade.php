<x-layouts.app>

    <flux:breadcrumbs class="mb-4">
        <flux:breadcrumbs.item :href="route('dashboard')">
            Dashboard
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item :href="route('admin.posts.index')">
            Posts
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item>
            Edit
        </flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data">
        
        @csrf
        @method('PUT')

        <div class="relative mb-2">

            <img id="imgPreview" class="w-full aspect-video object-cover object-center" src="{{ $post->image_path ? Storage::url($post->image_path) : 'https://static.vecteezy.com/system/resources/previews/022/014/063/original/missing-picture-page-for-website-design-or-mobile-app-design-no-image-available-icon-vector.jpg' }}">

            <div class="absolute top-8 right-8">
                <label class="bg-white px-4 py-2 rounded-lg cursor-pointer">
                    Change image
                    <input class="hidden" type="file" name="image" accept="image/*" onchange="previewImage(event, '#imgPreview')" />
                </label>
            </div>

        </div>

        <div class="card space-y-4">
        
        <flux:input
            label="Title"
            name="title"
            placeholder="Post's title"
            value="{{ old('title', $post->title) }}"
        />

        <flux:input readOnly
                label="Slug"
                name="slug"
                id="slug"
                placeholder="Auto generated slug"
                value="{{ old('slug', $post->slug ) }}"
            />

        <flux:select label="Category" name="category_id" placeholder="Select post's category...">
            @foreach ($categories as $category)
                <flux:select.option value="{{ $category->id }}" :selected="$category->id == old('category_id', $post->category_id)">
                    {{ $category->name }}
                </flux:select.option>
            @endforeach
        </flux:select>

        <flux:textarea label="Resume" name="excerpt">
            {{ old('excerpt', $post->excerpt) }}
        </flux:textarea>

        <flux:textarea label="Content" name="content" rows="16">
            {{ old('content', $post->content) }}
        </flux:textarea>

        <div class="flex space-x-2">
            <input id="publish" type="radio" name="is_published" value="1" @checked(old('is_published', $post->is_published) == 1)/>
            <label for="publish" class="flex items-center cursor-pointer">
                Publish
            </label>

            <input id="not_publish" type="radio" name="is_published" value="0" @checked(old('is_published', $post->is_published) == 0)>
            <label for="not_publish" class="flex items-center cursor-pointer">
                Not publish
            </label>
        </div>

        <flux:button variant="primary" class="cursor-pointer mt-4" type="submit">
            Submit
        </flux:button>

        <flux:button :href="route('admin.posts.index')" variant="subtle" class="cursor-pointer mt-4">
            Cancel
        </flux:button>
        
        </div>
    </form>

</x-layouts.app>