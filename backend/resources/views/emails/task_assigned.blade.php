<!DOCTYPE html>
<html>
<head>
    <title>New Task Assigned</title>
</head>
<body>
    <h3>Hello, {{ $task->assignedUser->name }}</h3>
    <p>A new task has been assigned to you for project ID: {{ $task->project_id }}</p>
    <p>Thank you!</p>
</body>
</html>
