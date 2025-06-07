<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskFlow - Livewire Demo</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.13.3/cdn.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <style>
        [x-cloak] { display: none !important; }
        .task-card {
            transition: all 0.3s ease;
            transform: translateY(0);
        }
        .task-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .priority-high { border-left: 4px solid #ef4444; }
        .priority-medium { border-left: 4px solid #f59e0b; }
        .priority-low { border-left: 4px solid #10b981; }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Livewire App Container -->
    <div id="livewire-app">
        <!-- Header Component -->
        <header class="bg-white shadow-sm border-b">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center py-4">
                    <div class="flex items-center">
                        <h1 class="text-2xl font-bold text-gray-900">TaskFlow</h1>
                        <span class="ml-2 px-2 py-1 text-xs bg-blue-100 text-blue-800 rounded-full">Livewire Demo</span>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="text-sm text-gray-500">
                            <span id="task-count">0 tasks</span> • 
                            <span id="completed-count">0 completed</span>
                        </div>
                        <button onclick="toggleTheme()" class="p-2 rounded-md hover:bg-gray-100">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Task Creation Form -->
            <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Create New Task</h2>
                <form id="task-form" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Task Title</label>
                            <input type="text" id="task-title" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   placeholder="Enter task title..." required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Priority</label>
                            <select id="task-priority" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="low">Low Priority</option>
                                <option value="medium" selected>Medium Priority</option>
                                <option value="high">High Priority</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                        <textarea id="task-description" rows="3" 
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                  placeholder="Task description (optional)..."></textarea>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" 
                                class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"></path>
                                </svg>
                                Add Task
                            </span>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Filters and Search -->
            <div class="bg-white rounded-lg shadow-sm p-4 mb-6">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-3 sm:space-y-0">
                    <div class="flex items-center space-x-4">
                        <div>
                            <input type="text" id="search-tasks" 
                                   class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   placeholder="Search tasks...">
                        </div>
                        <div>
                            <select id="filter-priority" class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">All Priorities</option>
                                <option value="high">High Priority</option>
                                <option value="medium">Medium Priority</option>
                                <option value="low">Low Priority</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <button id="show-completed" class="px-3 py-2 text-sm border border-gray-300 rounded-md hover:bg-gray-50">
                            Show Completed
                        </button>
                        <button onclick="clearAllTasks()" class="px-3 py-2 text-sm text-red-600 border border-red-300 rounded-md hover:bg-red-50">
                            Clear All
                        </button>
                    </div>
                </div>
            </div>

            <!-- Tasks Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="tasks-container">
                <!-- Tasks will be populated here -->
            </div>

            <!-- Empty State -->
            <div id="empty-state" class="text-center py-12 hidden">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No tasks yet</h3>
                <p class="mt-1 text-sm text-gray-500">Get started by creating your first task above.</p>
            </div>
        </main>

        <!-- Toast Notifications -->
        <div id="toast-container" class="fixed top-4 right-4 z-50 space-y-2">
            <!-- Toasts will appear here -->
        </div>
    </div>

    <script>
        // Simulating Livewire functionality with vanilla JavaScript
        class TaskManager {
            constructor() {
                this.tasks = JSON.parse(localStorage.getItem('livewire_tasks') || '[]');
                this.showCompleted = false;
                this.searchTerm = '';
                this.priorityFilter = '';
                this.init();
            }

            init() {
                this.bindEvents();
                this.render();
                this.updateCounts();
            }

            bindEvents() {
                // Task form submission
                document.getElementById('task-form').addEventListener('submit', (e) => {
                    e.preventDefault();
                    this.addTask();
                });

                // Search functionality
                document.getElementById('search-tasks').addEventListener('input', (e) => {
                    this.searchTerm = e.target.value;
                    this.render();
                });

                // Priority filter
                document.getElementById('filter-priority').addEventListener('change', (e) => {
                    this.priorityFilter = e.target.value;
                    this.render();
                });

                // Show completed toggle
                document.getElementById('show-completed').addEventListener('click', () => {
                    this.showCompleted = !this.showCompleted;
                    document.getElementById('show-completed').textContent = 
                        this.showCompleted ? 'Hide Completed' : 'Show Completed';
                    this.render();
                });
            }

            addTask() {
                const title = document.getElementById('task-title').value;
                const priority = document.getElementById('task-priority').value;
                const description = document.getElementById('task-description').value;

                if (!title.trim()) return;

                const task = {
                    id: Date.now(),
                    title: title.trim(),
                    description: description.trim(),
                    priority: priority,
                    completed: false,
                    createdAt: new Date().toISOString()
                };

                this.tasks.unshift(task);
                this.saveTasks();
                this.render();
                this.updateCounts();
                this.clearForm();
                this.showToast(`Task "${title}" created successfully!`, 'success');
            }

            toggleTask(taskId) {
                const task = this.tasks.find(t => t.id === taskId);
                if (task) {
                    task.completed = !task.completed;
                    this.saveTasks();
                    this.render();
                    this.updateCounts();
                    this.showToast(
                        `Task ${task.completed ? 'completed' : 'reopened'}!`, 
                        task.completed ? 'success' : 'info'
                    );
                }
            }

            deleteTask(taskId) {
                const taskIndex = this.tasks.findIndex(t => t.id === taskId);
                if (taskIndex > -1) {
                    const task = this.tasks[taskIndex];
                    this.tasks.splice(taskIndex, 1);
                    this.saveTasks();
                    this.render();
                    this.updateCounts();
                    this.showToast(`Task "${task.title}" deleted!`, 'error');
                }
            }

            getFilteredTasks() {
                return this.tasks.filter(task => {
                    const matchesSearch = task.title.toLowerCase().includes(this.searchTerm.toLowerCase()) ||
                                        task.description.toLowerCase().includes(this.searchTerm.toLowerCase());
                    const matchesPriority = !this.priorityFilter || task.priority === this.priorityFilter;
                    const matchesCompleted = this.showCompleted || !task.completed;
                    
                    return matchesSearch && matchesPriority && matchesCompleted;
                });
            }

            render() {
                const container = document.getElementById('tasks-container');
                const emptyState = document.getElementById('empty-state');
                const filteredTasks = this.getFilteredTasks();

                if (filteredTasks.length === 0) {
                    container.innerHTML = '';
                    emptyState.classList.remove('hidden');
                    return;
                }

                emptyState.classList.add('hidden');
                container.innerHTML = filteredTasks.map(task => this.renderTask(task)).join('');
            }

            renderTask(task) {
                const priorityClass = `priority-${task.priority}`;
                const completedClass = task.completed ? 'opacity-60' : '';
                
                return `
                    <div class="task-card ${priorityClass} ${completedClass} bg-white rounded-lg shadow-sm p-6 fade-in">
                        <div class="flex items-start justify-between mb-3">
                            <h3 class="text-lg font-semibold text-gray-900 ${task.completed ? 'line-through' : ''}">${task.title}</h3>
                            <div class="flex items-center space-x-2">
                                <span class="px-2 py-1 text-xs rounded-full ${this.getPriorityBadgeClass(task.priority)}">
                                    ${task.priority.charAt(0).toUpperCase() + task.priority.slice(1)}
                                </span>
                                <button onclick="taskManager.deleteTask(${task.id})" 
                                        class="text-red-500 hover:text-red-700 p-1">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        ${task.description ? `<p class="text-gray-600 mb-4 ${task.completed ? 'line-through' : ''}">${task.description}</p>` : ''}
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-500">${this.formatDate(task.createdAt)}</span>
                            <button onclick="taskManager.toggleTask(${task.id})" 
                                    class="flex items-center space-x-2 px-3 py-1 rounded-md text-sm ${task.completed ? 'bg-yellow-100 text-yellow-800 hover:bg-yellow-200' : 'bg-green-100 text-green-800 hover:bg-green-200'}">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    ${task.completed ? 
                                        '<path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"></path>' :
                                        '<path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>'
                                    }
                                </svg>
                                <span>${task.completed ? 'Undo' : 'Complete'}</span>
                            </button>
                        </div>
                    </div>
                `;
            }

            getPriorityBadgeClass(priority) {
                const classes = {
                    high: 'bg-red-100 text-red-800',
                    medium: 'bg-yellow-100 text-yellow-800',
                    low: 'bg-green-100 text-green-800'
                };
                return classes[priority] || classes.medium;
            }

            formatDate(dateString) {
                const date = new Date(dateString);
                return date.toLocaleDateString() + ' ' + date.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
            }

            updateCounts() {
                const totalTasks = this.tasks.length;
                const completedTasks = this.tasks.filter(t => t.completed).length;
                
                document.getElementById('task-count').textContent = `${totalTasks} task${totalTasks !== 1 ? 's' : ''}`;
                document.getElementById('completed-count').textContent = `${completedTasks} completed`;
            }

            clearForm() {
                document.getElementById('task-title').value = '';
                document.getElementById('task-description').value = '';
                document.getElementById('task-priority').value = 'medium';
            }

            saveTasks() {
                localStorage.setItem('livewire_tasks', JSON.stringify(this.tasks));
            }

            showToast(message, type = 'info') {
                const toast = document.createElement('div');
                const colors = {
                    success: 'bg-green-500',
                    error: 'bg-red-500',
                    info: 'bg-blue-500'
                };
                
                toast.className = `${colors[type]} text-white px-4 py-2 rounded-md shadow-lg transform transition-all duration-300 translate-x-full`;
                toast.textContent = message;
                
                document.getElementById('toast-container').appendChild(toast);
                
                setTimeout(() => toast.classList.remove('translate-x-full'), 100);
                setTimeout(() => {
                    toast.classList.add('translate-x-full');
                    setTimeout(() => toast.remove(), 300);
                }, 3000);
            }
        }

        function clearAllTasks() {
            if (confirm('Are you sure you want to delete all tasks?')) {
                taskManager.tasks = [];
                taskManager.saveTasks();
                taskManager.render();
                taskManager.updateCounts();
                taskManager.showToast('All tasks cleared!', 'info');
            }
        }

        function toggleTheme() {
            document.body.classList.toggle('dark');
            // In a real Livewire app, this would emit an event to update the theme preference
        }

        // Initialize the task manager
        const taskManager = new TaskManager();

        // Add some sample data if no tasks exist
        if (taskManager.tasks.length === 0) {
            taskManager.tasks = [
                {
                    id: 1,
                    title: "Welcome to TaskFlow!",
                    description: "This is a sample task to demonstrate Livewire functionality. Try creating, completing, and deleting tasks.",
                    priority: "medium",
                    completed: false,
                    createdAt: new Date().toISOString()
                },
                {
                    id: 2,
                    title: "Learn Laravel Livewire",
                    description: "Study the documentation and build amazing reactive components.",
                    priority: "high",
                    completed: false,
                    createdAt: new Date().toISOString()
                }
            ];
            taskManager.saveTasks();
            taskManager.render();
            taskManager.updateCounts();
        }
    </script>
</body>
</html>