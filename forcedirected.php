<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Force-Directed Chart with MySQL Data</title>
    <script src="https://d3js.org/d3.v7.min.js"></script>
</head>
<body>
    <!-- Your chart will be rendered here -->
    <svg id="chart"></svg>

    <script>
        // Fetch data from MySQL database
        fetch('fetch_data.php')
            .then(response => response.json())
            .then(data => {
                // Process the fetched data into a format suitable for creating the force-directed chart
                const nodes = data.nodes.map(node => ({ id: node.username }));
                const links = data.links.map(link => ({ source: link.source, target: link.target }));

                // Create SVG container
                const svg = d3.select("#chart");

                // Create force simulation
                const simulation = d3.forceSimulation(nodes)
                    .force("link", d3.forceLink(links).id(d => d.id))
                    .force("charge", d3.forceManyBody().strength(-100))
                    .force("center", d3.forceCenter(svg.attr("width") / 2, svg.attr("height") / 2));

                // Render links
                const link = svg.append("g")
                    .selectAll("line")
                    .data(links)
                    .enter().append("line");

                // Render nodes
                const node = svg.append("g")
                    .selectAll("circle")
                    .data(nodes)
                    .enter().append("circle")
                    .attr("r", 5);

                // Update node and link positions
                simulation.on("tick", () => {
                    link
                        .attr("x1", d => d.source.x)
                        .attr("y1", d => d.source.y)
                        .attr("x2", d => d.target.x)
                        .attr("y2", d => d.target.y);

                    node
                        .attr("cx", d => d.x)
                        .attr("cy", d => d.y);
                });
            })
            .catch(error => console.error('Error fetching data:', error));
    </script>

    <?php
    // MySQL database connection parameters
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "test_db";

    // Create connection
    $conn = new mysqli($host, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch data from MySQL database
    $sql = "SELECT username, question1, question2, question3 FROM form1";
    $result = $conn->query($sql);

    $data = array(
        'nodes' => array(),
        'links' => array()
    );

    if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            $data['nodes'][] = array('username' => $row['username']);
            // Example: You might have to define your own logic to create links based on the relationships in your data
            $data['links'][] = array('source' => 'Node 1', 'target' => $row['username']);
        }
    } else {
        echo "0 results";
    }

    // Close the database connection
    $conn->close();

    // Return data as JSON
    header('Content-Type: application/json');
    echo json_encode($data);
    ?>
</body>
</html>
