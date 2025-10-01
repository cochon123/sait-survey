<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>SAIT Survey Application</title>
</head>
<body>
    <h1>New SAIT Survey Application</h1>
    
    <p><strong>Name:</strong> {{ $name }}</p>
    <p><strong>Program:</strong> {{ $program }}</p>
    <p><strong>Competence/Skill:</strong> {{ $competence ?: 'Not specified' }}</p>
    
    <p>Thank you for your interest in the SAIT Student Survey project!</p>
</body>
</html>