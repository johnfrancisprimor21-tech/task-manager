<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap');

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background: #f5f6fa;
            color: #1a1a2e;
            min-height: 100vh;
        }

        /* Navbar */
        .navbar {
            background: #1a1a2e;
            padding: 0 40px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #fff;
            font-size: 15px;
            font-weight: 600;
            letter-spacing: 0.3px;
        }

        .navbar-brand .brand-icon {
            width: 32px;
            height: 32px;
            background: #4f6ef7;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .btn-new {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #4f6ef7;
            color: white;
            padding: 8px 16px;
            border-radius: 7px;
            font-size: 13px;
            font-weight: 500;
            text-decoration: none;
            transition: background 0.15s;
        }
        .btn-new:hover { background: #3a56d4; }

        /* Container */
        .container { max-width: 1080px; margin: 0 auto; padding: 36px 24px; }

        /* Alert */
        .alert {
            background: #edfaf3;
            border: 1px solid #a8e6c1;
            color: #1a6b3c;
            padding: 11px 16px;
            border-radius: 8px;
            font-size: 13px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Stats */
        .stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-bottom: 28px;
        }

        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 22px 24px;
            border: 1px solid #e8eaf0;
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .stat-icon {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .stat-icon.all   { background: #eff1fe; color: #4f6ef7; }
        .stat-icon.pend  { background: #fff8e6; color: #d4900a; }
        .stat-icon.done  { background: #edfaf3; color: #1a9e5c; }

        .stat-info .number {
            font-size: 26px;
            font-weight: 600;
            line-height: 1;
            color: #1a1a2e;
        }

        .stat-info .label {
            font-size: 12px;
            color: #888;
            margin-top: 3px;
        }

        /* Table card */
        .card {
            background: white;
            border-radius: 12px;
            border: 1px solid #e8eaf0;
            overflow: hidden;
        }

        .card-header {
            padding: 16px 24px;
            border-bottom: 1px solid #f0f1f5;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .card-header h2 {
            font-size: 14px;
            font-weight: 600;
            color: #1a1a2e;
        }

        .task-count {
            font-size: 12px;
            color: #888;
            background: #f0f1f5;
            padding: 3px 9px;
            border-radius: 20px;
        }

        table { width: 100%; border-collapse: collapse; }

        th {
            text-align: left;
            padding: 11px 20px;
            font-size: 11px;
            font-weight: 600;
            color: #888;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            background: #fafbfc;
            border-bottom: 1px solid #f0f1f5;
        }

        td {
            padding: 14px 20px;
            font-size: 13.5px;
            color: #2d2d3d;
            border-bottom: 1px solid #f7f8fa;
            vertical-align: middle;
        }

        tr:last-child td { border-bottom: none; }
        tr:hover td { background: #fafbff; }

        .task-name { font-weight: 500; color: #1a1a2e; }
        .task-desc { color: #888; font-size: 12.5px; }

        /* Badges */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }

        .badge-pending  { background: #fff8e6; color: #b07d0a; }
        .badge-completed { background: #edfaf3; color: #1a6b3c; }

        .badge-dot {
            width: 6px; height: 6px;
            border-radius: 50%;
            display: inline-block;
        }
        .badge-pending  .badge-dot { background: #d4900a; }
        .badge-completed .badge-dot { background: #1a9e5c; }

        /* Action buttons */
        .actions { display: flex; gap: 6px; align-items: center; }

        .btn-action {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 500;
            border: none;
            cursor: pointer;
            text-decoration: none;
            transition: opacity 0.15s;
        }
        .btn-action:hover { opacity: 0.85; }

        .btn-edit   { background: #f0f1f5; color: #444; }
        .btn-toggle-done { background: #edfaf3; color: #1a6b3c; }
        .btn-toggle-undo { background: #fff8e6; color: #b07d0a; }
        .btn-delete { background: #fef0f0; color: #c0392b; }

        /* Empty state */
        .empty-state {
            text-align: center;
            padding: 64px 24px;
        }

        .empty-icon {
            width: 56px;
            height: 56px;
            background: #f0f1f5;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
            color: #aaa;
        }

        .empty-state h3 {
            font-size: 15px;
            font-weight: 600;
            color: #1a1a2e;
            margin-bottom: 6px;
        }

        .empty-state p {
            font-size: 13px;
            color: #888;
        }
    </style>
</head>
<body>

<nav class="navbar">
    <div class="navbar-brand">
        <div class="brand-icon">
            <i data-lucide="check-square" style="width:16px;height:16px;"></i>
        </div>
        Task Manager
    </div>
    <a href="{{ route('tasks.create') }}" class="btn-new">
        <i data-lucide="plus" style="width:14px;height:14px;"></i>
        New Task
    </a>
</nav>

<div class="container">

    @if(session('success'))
    <div class="alert">
        <i data-lucide="check-circle-2" style="width:15px;height:15px;flex-shrink:0;"></i>
        {{ session('success') }}
    </div>
    @endif

    <div class="stats">
        <div class="stat-card">
            <div class="stat-icon all">
                <i data-lucide="layers" style="width:20px;height:20px;"></i>
            </div>
            <div class="stat-info">
                <div class="number">{{ $tasks->count() }}</div>
                <div class="label">Total Tasks</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon pend">
                <i data-lucide="clock" style="width:20px;height:20px;"></i>
            </div>
            <div class="stat-info">
                <div class="number">{{ $tasks->where('status', 'Pending')->count() }}</div>
                <div class="label">Pending</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon done">
                <i data-lucide="check-circle-2" style="width:20px;height:20px;"></i>
            </div>
            <div class="stat-info">
                <div class="number">{{ $tasks->where('status', 'Completed')->count() }}</div>
                <div class="label">Completed</div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h2>All Tasks</h2>
            <span class="task-count">{{ $tasks->count() }} {{ $tasks->count() === 1 ? 'task' : 'tasks' }}</span>
        </div>

        @if($tasks->isEmpty())
        <div class="empty-state">
            <div class="empty-icon">
                <i data-lucide="inbox" style="width:26px;height:26px;"></i>
            </div>
            <h3>No tasks yet</h3>
            <p>Click <strong>New Task</strong> to add your first task.</p>
        </div>
        @else
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Task</th>
                    <th>Due Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $index => $task)
                <tr>
                    <td style="color:#bbb;font-size:12px;">{{ $index + 1 }}</td>
                    <td>
                        <div class="task-name">{{ $task->task_name }}</div>
                        @if($task->description)
                        <div class="task-desc">{{ $task->description }}</div>
                        @endif
                    </td>
                    <td>
                        @if($task->due_date)
                            {{ \Carbon\Carbon::parse($task->due_date)->format('M d, Y') }}
                        @else
                            <span style="color:#ccc;">—</span>
                        @endif
                    </td>
                    <td>
                        <span class="badge {{ $task->status === 'Completed' ? 'badge-completed' : 'badge-pending' }}">
                            <span class="badge-dot"></span>
                            {{ $task->status }}
                        </span>
                    </td>
                    <td>
                        <div class="actions">
                            <a href="{{ route('tasks.edit', $task) }}" class="btn-action btn-edit">
                                <i data-lucide="pencil" style="width:12px;height:12px;"></i>
                                Edit
                            </a>
                            <form action="{{ route('tasks.updateStatus', $task) }}" method="POST" style="display:inline">
                                @csrf @method('PATCH')
                                @if($task->status === 'Pending')
                                <button type="submit" class="btn-action btn-toggle-done">
                                    <i data-lucide="check" style="width:12px;height:12px;"></i>
                                    Mark Done
                                </button>
                                @else
                                <button type="submit" class="btn-action btn-toggle-undo">
                                    <i data-lucide="rotate-ccw" style="width:12px;height:12px;"></i>
                                    Undo
                                </button>
                                @endif
                            </form>
                            <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display:inline" onsubmit="return confirm('Delete this task?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-action btn-delete">
                                    <i data-lucide="trash-2" style="width:12px;height:12px;"></i>
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
</div>

<script>lucide.createIcons();</script>
</body>
</html>