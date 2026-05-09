@extends('admin.layout.layout')

@section('content')
<main class="flex-1 overflow-y-auto p-4 md:p-6">

    <h2 class="text-2xl font-bold mb-4">Create Course</h2>

    <form method="POST" action="{{ route('admin.courses.store') }}"
          enctype="multipart/form-data"
          class="bg-white p-6 rounded shadow">

        @csrf

        {{-- COURSE DETAILS --}}
        <div class="mb-6">
            <h3 class="text-lg font-bold mb-4">Course Details</h3>

            <input type="text" name="title" placeholder="Course Title"
                   class="w-full p-2 border mb-3">

            <textarea name="description" placeholder="Description"
                      class="w-full p-2 border mb-3"></textarea>

            <input type="number" name="price" placeholder="Price"
                   class="w-full p-2 border mb-3">

            <input type="number" name="discount" placeholder="Discount"
                   class="w-full p-2 border mb-3">

            <input type="text" name="level" placeholder="Level"
                   class="w-full p-2 border mb-3">

            <input type="number" name="duration" placeholder="Duration"
                   class="w-full p-2 border mb-3">

            <input type="file" name="thumbnail"
                   class="w-full p-2 border mb-3">
        </div>

        {{-- LESSONS SECTION --}}
        <div class="mb-6 border-t pt-6">
            <h3 class="text-lg font-bold mb-4">Add Lessons (Optional)</h3>

            <div id="lessons-container">
                <div class="lesson-item bg-gray-50 p-4 mb-4 rounded border">
                    <div class="flex justify-between items-center mb-3">
                        <h4 class="font-semibold">Lesson 1</h4>
                        <button type="button" class="text-red-500 text-sm remove-lesson" style="display:none;">Remove</button>
                    </div>

                    <input type="text" name="lessons[0][title]" placeholder="Lesson Title"
                           class="w-full p-2 border mb-3">

                    <textarea name="lessons[0][description]" placeholder="Lesson Description"
                              class="w-full p-2 border mb-3"></textarea>

                    <input type="text" name="lessons[0][video_url]" placeholder="Video URL"
                           class="w-full p-2 border mb-3">

                    <input type="number" name="lessons[0][duration]" placeholder="Duration (minutes)"
                           class="w-full p-2 border mb-3">

                    <input type="number" name="lessons[0][order]" placeholder="Order" value="1"
                           class="w-full p-2 border mb-3">

                    <label class="flex items-center">
                        <input type="checkbox" name="lessons[0][is_free]" value="1" class="mr-2">
                        <span>Free Lesson</span>
                    </label>
                </div>
            </div>

            <button type="button" class="px-4 py-2 bg-blue-600 text-white rounded" id="add-lesson-btn">
                + Add Another Lesson
            </button>
        </div>

        <button class="px-4 py-2 bg-green-600 text-white rounded">
            Save Course & Lessons
        </button>

    </form>

</main>

<script>
    let lessonCount = 1;

    document.getElementById('add-lesson-btn').addEventListener('click', function(e) {
        e.preventDefault();
        
        const container = document.getElementById('lessons-container');
        const newLesson = document.querySelector('.lesson-item').cloneNode(true);
        
        // Update all attributes with new index
        newLesson.querySelectorAll('[name]').forEach(input => {
            const newName = input.name.replace(/\[\d+\]/, `[${lessonCount}]`);
            input.name = newName;
            if (input.type === 'checkbox') {
                input.checked = false;
            } else if (input.type === 'number') {
                input.value = '';
            } else {
                input.value = '';
            }
        });

        // Update lesson number
        newLesson.querySelector('h4').textContent = `Lesson ${lessonCount + 1}`;
        
        // Update order field
        newLesson.querySelector(`input[name="lessons[${lessonCount}][order]"]`).value = lessonCount + 1;
        
        // Show remove button
        newLesson.querySelector('.remove-lesson').style.display = 'block';
        
        // Add remove functionality
        newLesson.querySelector('.remove-lesson').addEventListener('click', function(e) {
            e.preventDefault();
            newLesson.remove();
            updateRemoveButtons();
        });

        container.appendChild(newLesson);
        lessonCount++;
        updateRemoveButtons();
    });

    function updateRemoveButtons() {
        const lessons = document.querySelectorAll('.lesson-item');
        lessons.forEach((lesson, index) => {
            const removeBtn = lesson.querySelector('.remove-lesson');
            if (lessons.length > 1) {
                removeBtn.style.display = 'block';
            } else {
                removeBtn.style.display = 'none';
            }
        });
    }
</script>

@endsection