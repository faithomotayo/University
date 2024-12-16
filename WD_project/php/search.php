<!DOCTYPE html>
<html>
<head>
    <title>Search for book</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" 
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
        crossorigin="anonymous">
</head>

<body>
<header>
        <nav class="navbar">
        
            <a href="displayReserved.php">Reserve</a>
            <a href="search.php">Search</a>
            <a href="logout.php">Log out</a>
    
        </nav>

        <div class="library-content">
            <h1>Reader's Corner</h1>
            <img src="../images/people.jpeg" alt="People reading" width="1000" height="400" class="header-img">
        </div>
    </header>
    <div class="container">
        <form action="displaySearch.php" method="get">
            <input type= "text" placeholders
            ="Search books" name="search" required>
            <button type="submit" name="submit"> Search</button>
        
            <div class="form-group">
            <label for="category">Category:</label>
            <select id="category" name="category" class="form-control">
                <option value="">Select Category</option>
                <option value="Health">Health</option>
                <option value="Business">Business</option>
                <option value="Biography">Biography</option>
                <option value="Technology">Technology</option>
                <option value="Travel">Travel</option>
                <option value="Self-Help">Self-Help</option>
                <option value="Cookery">Cookery</option>
                <option value="Fiction">Fiction</option>
            </select>
        </div>
        </form>
    </div>
    <footer id="footer">
    ©2024 Created by <strong>Faith Omotayo</strong>
</footer>
</body>
</html>




