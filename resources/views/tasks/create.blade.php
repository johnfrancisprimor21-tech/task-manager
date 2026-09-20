<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Task — Task Manager</title>
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
        }

        .brand-icon {
            width: 32px; height: 32px;
            background: #4f6ef7;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: #aaa;
            font-size: 13px;
            text-decoration: none;
            transition: color 0.15s;
        }
        .btn-back:hover { color: #fff; }

        .container {
            max-width: 560px;
            margin: 48px auto;
            padding: 0 24px;
        }

        .page-title {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 6px;
            color: #1a1a2e;
        }

        .page-subtitle {
            font-size: 13px;
            color: #888;
            margin-bottom: 28px;
        }

        .card {
            background: white;
            border-radius: 14px;
            border: 1px solid #e8eaf0;
            padding: 32px;
        }

        .form-group { margin-bottom: 22px; }

        label {
            display: block;
            font-size: 12.5px;
            font-weight: 600;
            color: #444;
            margin-bottom: 7px;
            letter-spacing: 0.2px;
        }

        .required { color: #e05252; margin-left: 2px; }

        input[type="text"],
        input[type="date"],
        textarea {
            width: 100%;
            padding: 10px 13px;
            border: 1.5px solid #e0e2ea;
            border-radius: 8px;
            font-size: 13.5px;
            font-family: inherit;
            color: #1a1a2e;
            background: #fff;
            transition: border-color 0.15s;
            outline: none;
        }

        input:focus, textarea:focus {
            border-color: #4f6ef7;
            box-shadow: 0 0 0 3px rgba(79,110,247,0.08);
        }

        textarea {
            resize: vertical;
            min-height: 90px;
            line-height: 1.5;
        }

        .error-msg {
            font-size: 12px;
            color: #e05252;
            margin-top: 5px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .divider {
            height: 1px;
            background: #f0f1f5;
            margin: 24px 0;
        }

        .form-actions {
            display: flex;
            gap: 10px;
        }

        .btn-submit {
            flex: 1;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            background: #4f6ef7;
            color: white;
            padding: 11px 20px;
            border-radius: 8px;
            font-size: 13.5px;
            font-weight: 500;
            border: none;
            cursor: pointer;
            transition: background 0.15s;
            font-family: inherit;
        }
        .btn-submit:hover { background: #3a56d4; }

        .btn-cancel {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            background: #f0f1f5;
            color: #555;
            padding: 11px 20px;
            border-radius: 8px;
            font-size: 13.5px;
            font-weight: 500;
            text-decoration: none;
            transition: background 0.15s;
        }
        .btn-cancel:hover { background: #e4e5ea; }
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
    <a href="{{ route('tasks.index') }}" class="btn-back">
        <i data-lucide="arrow-left" style="width:14px;height:14px;"></i>
        Back to tasks
    </a>
</nav>

<div class="container">
    <div class="page-title">New Task</div>
    <div class="page-subtitle">Fill in the details below to add a task.</div>

    <div class="card">
        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Task Name <span class="required">*</span></label>
                <input type="text" name="task_name" value="{{ old('task_name') }}" placeholder="e.g. Review lecture notes">
                @error('task_name')
                <div class="error-msg">
                    <i data-lucide="alert-circle" style="width:12px;height:12px;"></i>
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label>Description</label>
                <textarea name="description" placeholder="Add more details about this task (optional)">{{ old('description') }}</textarea>
            </div>

            <div class="form-group">
                <label>Due Date</label>
                <input type="date" name="due_date" value="{{ old('due_date') }}">
            </div>

            <div class="divider"></div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">
                    <i data-lucide="plus-circle" style="width:15px;height:15px;"></i>
                    Add Task
                </button>
                <a href="{{ route('tasks.index') }}" class="btn-cancel">Cancel</a>
            </div>
        </form>
    </div>
</div>

<script>lucide.createIcons();</script>
</body>
</html>