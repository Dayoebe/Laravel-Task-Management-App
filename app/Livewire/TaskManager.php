<?php

namespace App\Livewire;

use Livewire\Component;

class TaskManager extends Component
{
    public $tasks = [];
    public $title = '';
    public $description = '';
    public $priority = 'medium';
    public $search = '';
    public $showCompleted = false;

    protected $rules = [
        'title' => 'required|min:3',
        'priority' => 'in:low,medium,high'
    ];

    public function addTask()
    {
        $this->validate();
        
        $this->tasks[] = [
            'id' => uniqid(),
            'title' => $this->title,
            'description' => $this->description,
            'priority' => $this->priority,
            'completed' => false,
            'created_at' => now()
        ];
        
        $this->reset(['title', 'description']);
        session()->flash('message', 'Task created successfully!');
    }

    public function toggleTask($taskId)
    {
        foreach ($this->tasks as &$task) {
            if ($task['id'] === $taskId) {
                $task['completed'] = !$task['completed'];
                break;
            }
        }
    }

    public function render()
    {
        return view('livewire.task-manager');
    }
}