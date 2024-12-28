<?php

namespace App\Livewire\Forms;

use App\Models\Faculty;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Form;

class FacultyForm extends Form
{
    public Faculty $faculty;

    #[Validate('required|min:1')]
    public $name = "";
    #[Validate('required|min:1')]
    public $abbr = "";
    public $image_url = null;

    public $existing_image = "";

    public function setForm(Faculty $faculty): void
    {
        $this->faculty = $faculty;
        $this->name = $faculty->name;
        $this->abbr = $faculty->abbr;
        $this->existing_image = $faculty->image_url;
    }

    public function create(): void
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'abbr' => $this->abbr,
        ];

        if ($this->image_url) {
            $path = $this->image_url->store('faculties', 'public');
            $data['image_url'] = Storage::url($path);
        }

        Faculty::create($data);
        $this->reset(['name', 'abbr', 'image_url']);
    }

    public function update(): void
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'abbr' => $this->abbr,
        ];

        if ($this->image_url) {
            // Delete old image if exists
            if ($this->existing_image) {
                // Convert URL back to path for deletion
                $oldPath = str_replace('/storage/', '', $this->existing_image);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }

            // Store new image and get URL
            $path = $this->image_url->store('faculties', 'public');
            $data['image_url'] = Storage::url($path);
        }

        $this->faculty->update($data);
        $this->existing_image = $data['image_url'] ?? $this->existing_image;
    }
}
