<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>�����w��</title>
</head>
<body>
    <h1>�����w�����</h1>
    <form action="process_booking.php" method="POST">
        <label for="rental_date">������:</label>
        <input type="date" id="rental_date" name="rental_date" required><br><br>
        
        <label for="brand">����~�P:</label>
        <select id="brand" name="brand" required>
            <option value="Toyota">Toyota</option>
            <option value="Honda">Honda</option>
            <option value="Ford">Ford</option>
            <option value="BMW">BMW</option>
            <option value="Audi">Audi</option>
        </select><br><br>
        
        <button type="submit">����w��</button>
    </form>
</body>
</html>
