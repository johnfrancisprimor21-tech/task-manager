<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Task Manager</title>
<style>
    body {
        font-family: Arial, Helvetica, sans-serif;
        background-color: #f2f2f2;
        margin: 0;
    }

    .navbar{
        background-color:#333;
    padding:15px 30px;
        display:flex;
            justify-content:space-between;
        align-items:center;
    }
    .navbar h1{
        color:white;
    font-size:20px;
        margin:0;
    }
    .navbar a{
        background:#2d6cdf;
        color:white;
    padding:8px 14px;
        text-decoration:none;
    border-radius:4px;
        font-size:14px;
    }
    .navbar a:hover{
    background:#1e54b7;
    }

    .container{
        max-width:1000px;
    margin:30px auto;
        padding:0 20px;
    }

    .success-box{
        background:#d4edda;
    border:1px solid #c3e6cb;
        color:#155724;
    padding:10px 15px;
        margin-bottom:20px;
    border-radius:4px;
    }

    .stats{
        display:flex;
    gap:15px;
        margin-bottom:25px;
    }
    .stat-box{
        background:white;
        border:1px solid #ddd;
    border-radius:6px;
        padding:15px 20px;
        flex:1;
    text-align:center;
    }
    .stat-box .num{
        font-size:24px;
    font-weight:bold;
    }
    .stat-box .lbl{
        color:#777;
    font-size:13px;
        margin-top:3px;
    }

    table{
        width:100%;
    background:white;
        border-collapse:collapse;
    border:1px solid #ddd;
    }
    th{
        background:#eee;
    text-align:left;
        padding:10px;
        font-size:13px;
    border-bottom:2px solid #ccc;
    }
    td{
        padding:10px;
    border-bottom:1px solid #eee;
        font-size:14px;
    }

    .status-pending{
        background:#fff3cd;
    color:#856404;
        padding:3px 10px;
    border-radius:10px;
        font-size:12px;
    }
    .status-completed{
        background:#d4edda;
    color:#155724;
        padding:3px 10px;
    border-radius:10px;
        font-size:12px;
    }

    .btn-small{
        padding:5px 10px;
    font-size:12px;
        border:none;
    border-radius:3px;
        cursor:pointer;
    text-decoration:none;
        color:white;
    margin-right:4px;
        display:inline-block;
    }
    .edit-btn{background:#6c757d;}
    .done-btn{background:#28a745;}
    .undo-btn{background:#ffc107; color:#333;}
    .delete-btn{background:#dc3545;}

    .empty{
        text-align:center;
    padding:50px 0;
        color:#888;
    }
</style>
</head>
<body>

<div class="navbar">
 <h1>Task Manager</h1>
 <a href="{{ route('tasks.create') }}">+ New Task</a>
</div>
<div class="container">
    @if(session('success'))
<div class="success-box">
        {{ session('success') }}
 </div>
        @endif
    <div class="stats">
        <div class="stat-box">
            <div class="num">{{ $tasks->count() }}</div>
 <div class="lbl">Total</div>
  </div>
 <div class="stat-box">
<div class="num">{{ $tasks->where('status','Pending')->count() }}</div>
 <div class="lbl">Pending</div>
        </div>
        <div class="stat-box">
       <div class="num">{{ $tasks->where('status','Completed')->count() }}</div>
         <div class="lbl">Completed</div>
 </div>
  </div>
@if($tasks->count() == 0)
 <div class="empty">
            No tasks yet. Go add one!
    </div>
    @else
    <table>
        <tr>
            <th>#</th>
            <th>Task</th>
            <th>Due</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    @foreach($tasks as $t)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>
                <b>{{ $t->task_name }}</b><br>
            @if($t->description != null)
                    <small style="color:#888">{{ $t->description }}</small>
                @endif
            </td>
            <td>
                @if($t->due_date)
                    {{ date('M d, Y', strtotime($t->due_date)) }}
            @else
                    -
                @endif
            </td>
            <td>
            @if($t->status == 'Pending')
                    <span class="status-pending">Pending</span>
                @else
                    <span class="status-completed">Completed</span>
            @endif
            </td>
            <td>
                <a class="btn-small edit-btn" href="{{ route('tasks.edit', $t->id) }}">Edit</a>
                <form action="{{ route('tasks.updateStatus', $t->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('PATCH')
                @if($t->status == 'Pending')
                    <button class="btn-small done-btn" type="submit">Done</button>
                    @else
                        <button class="btn-small undo-btn" type="submit">Undo</button>
                @endif
                </form>
            <form action="{{ route('tasks.destroy', $t->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('sure you want to delete this?')">
                    @csrf
                @method('DELETE')
       <button class="btn-small delete-btn" type="submit">Delete</button>
 </form>
           </td>
     </tr>
     @endforeach
</table>
 @endif
</div>
</body>
</html>
