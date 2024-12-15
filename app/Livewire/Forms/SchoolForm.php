<?php

namespace App\Livewire\Forms;

use App\Models\School;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Form;

class SchoolForm extends Form
{
    public School $school;

    #[Validate('required|min:1')]
    public $name = "";
    #[Validate('required|min:1')]
    public $abbr = "";
    public $image = null;

    public $existing_image = "";

    public function setForm(School $school): void
    {
        $this->school = $school;
        $this->name = $school->name;
        $this->abbr = $school->abbr;
        $this->existing_image = $school->image;
    }

    public function create(): void
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'abbr' => $this->abbr,
        ];

        if ($this->image) {
            $path = $this->image->store('schools', 'public');
            $data['image'] = Storage::url($path);
        }

        School::create($data);
        $this->reset(['name', 'abbr', 'image']);
    }

    public function update(): void
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'abbr' => $this->abbr,
        ];

        if ($this->image) {
            // Delete old image if exists
            if ($this->existing_image) {
                // Convert URL back to path for deletion
                $oldPath = str_replace('/storage/', '', $this->existing_image);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }

            // Store new image and get URL
            $path = $this->image->store('schools', 'public');
            $data['image'] = Storage::url($path);
        }

        $this->school->update($data);
        $this->existing_image = $data['image'] ?? $this->existing_image;
    }
}
