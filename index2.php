<!DOCTYPE html>
<html>

<head>
  <title>PG Finder - Home</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
  <header>
    <div class="logo">

      <h1>PG Finder</h1>
    </div>
    <nav>
      <ul>
        <li><a href="#">Home</a></li>
        <li><a href="logout.php">Logout</a></li>
        <li><a href="post.php">Post PG</a></li>
        <li><a href="#">Contact</a></li>
      </ul>
    </nav>
  </header>
  <main>
    <div class="search-bar">
      <form action="#" method="get">
        <input type="text" placeholder="Enter city or area" />
        <input type="text" placeholder="Enter budget" />
        <input type="submit" value="Search" />
      </form>
    </div>
    <div class="pg-list">
      <h2>Recently Added PGs</h2>
      <ul>
        <li>
          <a href="#">
            <img src="https://placeimg.com/200/150/arch" alt="PG Image" />
            <h3>PG Title</h3>
            <p>City, Area</p>
            <p>Starting from $500/month</p>
          </a>
        </li>
        <li>
          <a href="#">
            <img src="https://placeimg.com/200/150/nature" alt="PG Image" />
            <h3>PG Title</h3>
            <p>City, Area</p>
            <p>Starting from $500/month</p>
          </a>
        </li>
        <li>
          <a href="#">
            <img src="https://placeimg.com/200/150/tech" alt="PG Image" />
            <h3>PG Title</h3>
            <p>City, Area</p>
            <p>Starting from $500/month</p>
          </a>
        </li>
      </ul>
    </div>
    <div class="featured-pg">
      <h2>Featured PGs</h2>
      <ul>
        <li>
          <a href="#">
            <img src="https://placeimg.com/200/150/people" alt="PG Image" />
            <h3>PG Title</h3>
            <p>City, Area</p>
            <p>Starting from $500/month</p>
          </a>
        </li>
        <li>
          <a href="#">
            <img src="https://placeimg.com/200/150/animals" alt="PG Image" />
            <h3>PG Title</h3>
            <p>City, Area</p>
            <p>Starting from $500/month</p>
          </a>
        </li>
        <li>
          <a href="#">
            <img src="https://placeimg.com/200/150/architecture" alt="PG Image" />
            <h3>PG Title</h3>
            <p>City, Area</p>
            <p>Starting from $500/month</p>
          </a>
        </li>
      </ul>
    </div>
  </main>
  <footer>
    <p>&copy; 2023 PG</p>
  </footer>
  <script>
  // Select the search form and search button
  const searchForm = document.querySelector("#search-form");
  const searchBtn = document.querySelector("#search-btn");

  // Add an event listener to the search button
  searchBtn.addEventListener("click", (event) => {
    // Prevent the form from submitting
    event.preventDefault();

    // Get the search input value
    const searchInput = document.querySelector("#search-input").value;

    // Redirect to the search results page with the search query as a parameter
    window.location.href = `search.php?q=${searchInput}`;
  });

  // Select the featured PGs section
  const featuredPGs = document.querySelector("#featured-pgs");

  // Add an event listener to the featured PGs section
  featuredPGs.addEventListener("click", (event) => {
    // Check if the clicked element is an anchor tag
    if (event.target.tagName === "A") {
      // Get the ID of the clicked PG
      const pgId = event.target.dataset.id;

      // Redirect to the PG details page with the PG ID as a parameter
      window.location.href = `pg-details.php?id=${pgId}`;
    }
  });
  </script>
</body>

</html>