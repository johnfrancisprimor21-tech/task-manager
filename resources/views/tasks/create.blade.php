<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add New Task</title>
<style>
    body{
        font-family: Arial, Helvetica, sans-serif;
    background:#f2f2f2;
        margin:0;
    }
    .navbar{
        background:#333;
    padding:15px 30px;
        display:flex;
        justify-content:space-between;
    align-items:center;
    }
    .navbar h1{color:white;font-size:20px;margin:0;}
    .navbar a{color:#bbb;text-decoration:none;font-size:14px;}
    .navbar a:hover{color:white;}

    .box{
        max-width:500px;
    background:white;
        margin:40px auto;
        padding:25px;
    border:1px solid #ddd;
        border-radius:6px;
    }
    .box h2{margin-top:0;}

    label{
        display:block;
    margin-bottom:5px;
        font-weight:bold;
        font-size:14px;
    }
    input[type=text], input[type=date], textarea{
        width:100%;
    padding:8px;
        margin-bottom:15px;
    border:1px solid #ccc;
        border-radius:4px;
        font-size:14px;
    box-sizing:border-box;
        font-family:inherit;
    }
    textarea{
        height:80px;
    }

    .err{
        color:red;
    font-size:12px;
        margin-top:-10px;
        margin-bottom:10px;
    }

    button{
        background:#2d6cdf;
    color:white;
        border:none;
        padding:10px 20px;
    border-radius:4px;
        cursor:pointer;
        font-size:14px;
    }
    button:hover{background:#1e54b7;}

    .cancel-link{
        margin-left:10px;
    color:#666;
        text-decoration:none;
        font-size:14px;
    }
</style>
</head>
<body>

<div class="navbar">
    <h1>Task Manager</h1>
        <a href="{{ route('tasks.index') }}">&larr; back</a>
</div>

<div class="box">
    <h2>Add New Task</h2>

    <form method="POST" action="{{ route('tasks.store') }}">
        @csrf

        <label>Task Name</label>
    <input type="text" name="task_name" value="{{ old('task_name') }}" placeholder="what do you need to do?">
        @error('task_name')
            <div class="err">{{ $message }}</div>
    @enderror

        <label>Description (optional)</label>
        <textarea name="description">{{ old('description') }}</textarea>

    <label>Due Date</label>
        <input type="date" name="due_date" value="{{ old('due_date') }}">

        <button type="submit">Save Task</button>
    <a href="{{ route('tasks.index') }}" class="cancel-link">cancel</a>
    </form>
</div>

</body>
</html>
