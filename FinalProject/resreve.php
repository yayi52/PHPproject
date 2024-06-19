<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>租車預約</title>
</head>
<body>
    <h1>租車預約表單</h1>
    <form action="process_booking.php" method="POST">
        <label for="rental_date">選取日期:</label>
        <input type="date" id="rental_date" name="rental_date" required><br><br>
        
        <label for="brand">選取品牌:</label>
        <select id="brand" name="brand" required>
            <option value="Toyota">Toyota</option>
            <option value="Honda">Honda</option>
            <option value="Ford">Ford</option>
            <option value="BMW">BMW</option>
            <option value="Audi">Audi</option>
        </select><br><br>
        
        <button type="submit">提交預約</button>
    </form>
</body>
</html>
