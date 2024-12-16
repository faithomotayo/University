<!DOCTYPE html>
<html>
<head>
    <title>Home Page</title>
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
    
    <section class="books">
        <div class="container">
            <h5><mark>All Books</mark></h2>
            <?php
            require_once 'database.php';
            
            $limit = 5; 
            $page = isset($_GET['page']) ? intval($_GET['page']) : 1; 
            $offset = ($page - 1) * $limit; 

            // Query to fetch books with pagination
            $sql = "SELECT * FROM `Books` LIMIT $limit OFFSET $offset";
            $result = $conn->query($sql);

            // Query to get the total number of books
            $totalBooksQuery = "SELECT COUNT(*) AS total FROM `Books`";
            $totalBooksResult = $conn->query($totalBooksQuery);
            $totalBooksRow = $totalBooksResult->fetch_assoc();
            $totalBooks = $totalBooksRow['total'];
            $totalPages = ceil($totalBooks / $limit); // Calculate total pages
            ?>

            <?php if ($result && $result->num_rows > 0): ?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ISBN</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Edition</th>
                            <th>Year</th>
                            <th>Category</th>
                            <th>Reserved</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['ISBN']); ?></td>
                                <td><?php echo htmlspecialchars($row['BookTitle']); ?></td>
                                <td><?php echo htmlspecialchars($row['Author']); ?></td>
                                <td><?php echo htmlspecialchars($row['Edition']); ?></td>
                                <td><?php echo htmlspecialchars($row['Year']); ?></td>
                                <td><?php echo htmlspecialchars($row['Category']); ?></td>
                                <td><?php echo htmlspecialchars($row['Reserved']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>

                <!-- Pagination Links -->
                <nav>
                    <ul class="pagination justify-content-center">
                        <?php if ($page > 1): ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?php echo $page - 1; ?>">Previous</a>
                            </li>
                        <?php endif; ?>
                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                                <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                            </li>
                        <?php endfor; ?>
                        <?php if ($page < $totalPages): ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?php echo $page + 1; ?>">Next</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            <?php else: ?>
                <p class="text-warning">No books available in the library.</p>
            <?php endif; ?>
        </div>
    </section>

<footer id="footer">
    ©2024 Created by <strong>Faith Omotayo</strong>
</footer>

</body>
</html>
