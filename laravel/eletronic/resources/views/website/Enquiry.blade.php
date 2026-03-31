<!DOCTYPE html>
<html>
<head>
    <title>Enquiry Form</title>
</head>
<body>

<h2>Enquiry Form</h2>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<form action="{{ route('enquiry.store') }}" method="POST">
@csrf

    <label>Name:</label><br>
    <input type="text" name="name" required>
    <br><br>

    <label>Email:</label><br>
    <input type="email" name="email" required>
    <br><br>

    <label>Phone:</label><br>
    <input type="text" name="phone" required>
    <br><br>

    <label>Message:</label><br>
    <textarea name="message"></textarea>
    <br><br>

    <button type="submit">Submit</button>

</form>

</body>
</html>