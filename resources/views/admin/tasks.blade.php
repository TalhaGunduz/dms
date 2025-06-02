@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Görev Yönetimi</h3>
                    <div class="card-toolbar">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTaskModal">
                            <i class="ki-duotone ki-plus fs-2"></i>Yeni Görev
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
                            <thead>
                                <tr class="fw-bold text-muted">
                                    <th class="min-w-150px">Görev</th>
                                    <th class="min-w-100px">Durum</th>
                                    <th class="min-w-100px">Öncelik</th>
                                    <th class="min-w-100px">Bitiş Tarihi</th>
                                    <th class="min-w-100px text-end">İşlemler</th>
                                </tr>
                            </thead>
                            <tbody id="tasksList">
                                <!-- Tasks will be loaded here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Task Modal -->
<div class="modal fade" id="addTaskModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Yeni Görev Ekle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addTaskForm">
                    <div class="mb-3">
                        <label for="taskTitle" class="form-label">Görev Başlığı</label>
                        <input type="text" class="form-control" id="taskTitle" required>
                    </div>
                    <div class="mb-3">
                        <label for="taskPriority" class="form-label">Öncelik</label>
                        <select class="form-select" id="taskPriority" required>
                            <option value="low">Düşük</option>
                            <option value="medium">Orta</option>
                            <option value="high">Yüksek</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="taskDueDate" class="form-label">Bitiş Tarihi</label>
                        <input type="date" class="form-control" id="taskDueDate" required>
                    </div>
                    <div class="mb-3">
                        <label for="taskDescription" class="form-label">Açıklama</label>
                        <textarea class="form-control" id="taskDescription" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">İptal</button>
                <button type="button" class="btn btn-primary" id="saveTask">
                    <span class="indicator-label">Kaydet</span>
                    <span class="indicator-progress">
                        Lütfen bekleyin... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Load tasks from localStorage
        loadTasks();

        // Save new task
        $('#saveTask').on('click', function() {
            const task = {
                id: Date.now(),
                title: $('#taskTitle').val(),
                priority: $('#taskPriority').val(),
                dueDate: $('#taskDueDate').val(),
                description: $('#taskDescription').val(),
                status: 'pending',
                createdAt: new Date().toISOString()
            };

            // Get existing tasks
            let tasks = JSON.parse(localStorage.getItem('tasks') || '[]');
            tasks.push(task);
            localStorage.setItem('tasks', JSON.stringify(tasks));

            // Close modal and reset form
            $('#addTaskModal').modal('hide');
            $('#addTaskForm')[0].reset();

            // Reload tasks
            loadTasks();

            // Show success message
            toastr.success('Görev başarıyla eklendi.');
        });

        // Function to load tasks
        function loadTasks() {
            const tasks = JSON.parse(localStorage.getItem('tasks') || '[]');
            const tasksList = $('#tasksList');
            tasksList.empty();

            tasks.forEach(task => {
                const priorityClass = {
                    'low': 'badge-light-primary',
                    'medium': 'badge-light-warning',
                    'high': 'badge-light-danger'
                }[task.priority];

                const statusClass = {
                    'pending': 'badge-light-warning',
                    'completed': 'badge-light-success',
                    'cancelled': 'badge-light-danger'
                }[task.status];

                const statusText = {
                    'pending': 'Beklemede',
                    'completed': 'Tamamlandı',
                    'cancelled': 'İptal Edildi'
                }[task.status];

                const priorityText = {
                    'low': 'Düşük',
                    'medium': 'Orta',
                    'high': 'Yüksek'
                }[task.priority];

                tasksList.append(`
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="form-check form-check-custom form-check-solid me-3">
                                    <input class="form-check-input" type="checkbox" value="" 
                                        ${task.status === 'completed' ? 'checked' : ''}
                                        onchange="updateTaskStatus(${task.id}, this.checked)" />
                                </div>
                                <div class="d-flex flex-column">
                                    <a href="#" class="text-dark fw-bold text-hover-primary mb-1">${task.title}</a>
                                    <span class="text-muted">${task.description}</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge ${statusClass}">${statusText}</span>
                        </td>
                        <td>
                            <span class="badge ${priorityClass}">${priorityText}</span>
                        </td>
                        <td>${new Date(task.dueDate).toLocaleDateString('tr-TR')}</td>
                        <td class="text-end">
                            <button type="button" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" 
                                onclick="editTask(${task.id})">
                                <i class="ki-duotone ki-pencil fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </button>
                            <button type="button" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm" 
                                onclick="deleteTask(${task.id})">
                                <i class="ki-duotone ki-trash fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </button>
                        </td>
                    </tr>
                `);
            });
        }
    });

    // Update task status
    function updateTaskStatus(taskId, completed) {
        let tasks = JSON.parse(localStorage.getItem('tasks') || '[]');
        const taskIndex = tasks.findIndex(t => t.id === taskId);
        if (taskIndex !== -1) {
            tasks[taskIndex].status = completed ? 'completed' : 'pending';
            localStorage.setItem('tasks', JSON.stringify(tasks));
            loadTasks();
            toastr.success('Görev durumu güncellendi.');
        }
    }

    // Delete task
    function deleteTask(taskId) {
        if (confirm('Bu görevi silmek istediğinizden emin misiniz?')) {
            let tasks = JSON.parse(localStorage.getItem('tasks') || '[]');
            tasks = tasks.filter(t => t.id !== taskId);
            localStorage.setItem('tasks', JSON.stringify(tasks));
            loadTasks();
            toastr.success('Görev başarıyla silindi.');
        }
    }

    // Edit task
    function editTask(taskId) {
        let tasks = JSON.parse(localStorage.getItem('tasks') || '[]');
        const task = tasks.find(t => t.id === taskId);
        if (task) {
            $('#taskTitle').val(task.title);
            $('#taskPriority').val(task.priority);
            $('#taskDueDate').val(task.dueDate);
            $('#taskDescription').val(task.description);
            $('#addTaskModal').modal('show');
            
            // Update save button to handle edit
            $('#saveTask').off('click').on('click', function() {
                task.title = $('#taskTitle').val();
                task.priority = $('#taskPriority').val();
                task.dueDate = $('#taskDueDate').val();
                task.description = $('#taskDescription').val();
                
                localStorage.setItem('tasks', JSON.stringify(tasks));
                $('#addTaskModal').modal('hide');
                loadTasks();
                toastr.success('Görev başarıyla güncellendi.');
            });
        }
    }
</script>
@endpush 