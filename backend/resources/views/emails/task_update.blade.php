<!DOCTYPE html>
<html>
<head>
    <title>Task Updated</title>
</head>
<body>
    <h3>Hello, Admin/Manager</h3>
    <p>The following task has been updated:</p>
    <p><strong>Task ID:</strong> {{ $task->id }}</p>
    <p><strong>Updated By:</strong> {{ auth()->user()->name }}</p>
    <p>Check the system for details.</p>
    <p>Thank you!</p>
</body>
</html>
