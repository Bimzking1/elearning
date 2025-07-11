@extends('layouts.admin.dashboard')

@section('content')
<div class="w-full mx-auto bg-white p-6 rounded-lg shadow-md">
    <div>
        <a href="{{ route('admin.materials.view', $material->id) }}"
            class="inline-block bg-gray-300 text-gray-900 px-4 py-2 rounded-md shadow-md hover:bg-gray-400 transition">
            ← Back
        </a>
    </div>
    <h2 class="text-2xl font-bold text-gray-800 my-6">Edit Material</h2>

    <form action="{{ route('admin.materials.update', $material->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Material Name -->
        <div class="mb-4">
            <label class="block text-gray-700 font-medium">Material Name</label>
            <input type="text" name="name" value="{{ old('name', $material->name) }}" required
                   class="w-full border border-gray-300 rounded-lg p-2 mt-1">
        </div>

        <!-- Subject -->
        <div class="mb-4">
            <label class="block text-gray-700 font-medium">Subject</label>
            <select name="subject_id" required class="w-full border border-gray-300 rounded-lg p-2 mt-1">
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}" {{ $material->subject_id == $subject->id ? 'selected' : '' }}>
                        {{ $subject->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Classroom -->
        <div class="mb-4">
            <label class="block text-gray-700 font-medium">Classroom</label>
            <select name="classroom_id" required class="w-full border border-gray-300 rounded-lg p-2 mt-1">
                @foreach($classrooms as $classroom)
                    <option value="{{ $classroom->id }}" {{ $material->classroom_id == $classroom->id ? 'selected' : '' }}>
                        {{ $classroom->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Description -->
        <div class="mb-4">
            <label class="block text-gray-700 font-medium">Description</label>
            <textarea name="description" rows="3"
                      class="w-full border border-gray-300 rounded-lg p-2 mt-1">{{ old('description', $material->description) }}</textarea>
        </div>

        <!-- File -->
        <div class="mb-4">
            <label class="block text-gray-700 font-medium">Replace File (Optional)</label>
            @if($material->file_path)
                <p class="text-sm text-blue-600 mb-1">
                    Current file: <a href="{{ assetSubmissionPhoto($material->file_path) }}" target="_blank" class="underline">Download</a>
                </p>
            @endif
            <input type="file" name="file" class="w-full mt-1">
        </div>

        <!-- Link URLs -->
        <div class="mb-4">
            <label class="block text-gray-700 font-medium">Link URLs</label>
            <div id="linkFields" class="flex flex-col gap-2">
                @forelse($material->link_urls ?? [] as $url)
                    <div class="flex items-center gap-2">
                        <input type="url" name="link_urls[]" value="{{ $url }}"
                               class="w-full border border-gray-300 rounded-lg p-2 mt-1">
                        <button type="button" onclick="removeLinkField(this)" class="text-red-500 hover:text-red-700 mt-1 text-sm">Remove</button>
                    </div>
                @empty
                    <div class="flex items-center gap-2">
                        <input type="url" name="link_urls[]" class="w-full border border-gray-300 rounded-lg p-2 mt-1" placeholder="https://example.com">
                        <button type="button" onclick="removeLinkField(this)" class="text-red-500 hover:text-red-700 mt-1 text-sm">Remove</button>
                    </div>
                @endforelse
            </div>
            <button type="button" onclick="addLinkField()" class="text-sm text-blue-600 hover:underline mt-2">+ Add another link</button>
        </div>

        <!-- Submit -->
        <button type="submit"
                class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition">
            Update Material
        </button>
    </form>
</div>

<script>
function addLinkField() {
    const container = document.getElementById('linkFields');
    const wrapper = document.createElement('div');
    wrapper.className = 'flex items-center gap-2';

    const input = document.createElement('input');
    input.type = 'url';
    input.name = 'link_urls[]';
    input.placeholder = 'https://example.com';
    input.className = 'w-full border border-gray-300 rounded-lg p-2 mt-1';

    const removeBtn = document.createElement('button');
    removeBtn.type = 'button';
    removeBtn.innerText = 'Remove';
    removeBtn.className = 'text-red-500 hover:text-red-700 mt-1 text-sm';
    removeBtn.onclick = function () {
        removeLinkField(removeBtn);
    };

    wrapper.appendChild(input);
    wrapper.appendChild(removeBtn);
    container.appendChild(wrapper);
}

function removeLinkField(button) {
    button.parentElement.remove();
}
</script>
@endsection
